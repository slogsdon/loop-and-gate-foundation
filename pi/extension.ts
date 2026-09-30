/**
 * pi port of the Foundation's two Claude Code SessionStart hooks.
 *
 * Runs the same scripts the hooks run (scripts/inject-operating-rules.sh and
 * scripts/session-start-hook.sh), once per session, and appends their output to
 * the system prompt. The snapshot is taken once and reused verbatim every turn,
 * so the prompt-cache prefix stays stable — the same reason MEMORY.md is
 * read-only until close-out (CLAUDE.md → Hard rules).
 *
 * Also exports LOOP_GATE_ROOT so skills' bash steps can find this package's
 * scripts and data without searching the Claude Code plugin cache.
 */
import type { ExtensionAPI, ExtensionContext } from "@earendil-works/pi-coding-agent";
import { execFileSync } from "node:child_process";
import { existsSync, mkdirSync, writeFileSync } from "node:fs";
import { homedir } from "node:os";
import { dirname, join, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const root = resolve(dirname(fileURLToPath(import.meta.url)), "..");
const script = (name: string) => join(root, "scripts", name);

function run(name: string, ...args: string[]): string {
	try {
		return execFileSync(script(name), args, { encoding: "utf8", timeout: 10_000 }).trim();
	} catch {
		return "";
	}
}

// pi's stand-ins for Claude Code built-ins the skills rely on. Installed as
// separate pi packages, not bundled: two packages registering the same tool is
// fatal at pi startup, so a bundled copy would break anyone who already has one.
const DEPENDENCIES = [
	{ tool: "subagent", source: "npm:pi-subagents", usedBy: "loop, verify, improve" },
	{ tool: "ask_user_question", source: "npm:@juicesharp/rpiv-ask-user-question", usedBy: "setup, add-kits" },
];
const declinedMarker = join(homedir(), ".config", "loop-and-gate", "pi-deps-declined");

async function offerDependencies(pi: ExtensionAPI, ctx: ExtensionContext): Promise<void> {
	const tools = new Set(pi.getAllTools().map((tool) => tool.name));
	const missing = DEPENDENCIES.filter((dep) => !tools.has(dep.tool));
	// Headless runs (pi -p, subagent children) can't answer; wait for an interactive session.
	if (missing.length === 0 || !ctx.hasUI || existsSync(declinedMarker)) return;
	const list = missing.map((dep) => `${dep.source} (${dep.usedBy})`).join("\n");
	if (!(await ctx.ui.confirm("Loop & Gate: install companion packages?", list))) {
		mkdirSync(dirname(declinedMarker), { recursive: true });
		writeFileSync(declinedMarker, `${list}\n`); // ask once; delete this file to be asked again
		ctx.ui.notify(`Loop & Gate: skipped. Install later with pi install <source>:\n${list}`, "info");
		return;
	}
	const results: string[] = [];
	for (const dep of missing) {
		const result = await pi.exec("pi", ["install", dep.source], { timeout: 180_000 });
		results.push(`${dep.source}: ${result.code === 0 ? "installed" : `failed — ${result.stderr.trim()}`}`);
	}
	ctx.ui.notify(`Loop & Gate:\n${results.join("\n")}\nRun /reload to load the new tools.`, "info");
}

export default function loopAndGateFoundation(pi: ExtensionAPI): void {
	process.env.LOOP_GATE_ROOT = root;
	let snapshot: string | undefined;

	pi.on("session_start", async (_event, ctx) => {
		snapshot = undefined; // new/resume/fork/reload: re-read memory on the next prompt
		if (!run("vault-path.sh")) {
			ctx.ui.notify("Loop & Gate: no memory vault yet — run /skill:setup", "warning");
		}
		// Not awaited: blocking session_start on a dialog at startup makes pi exit on the answer.
		void offerDependencies(pi, ctx).catch(() => {});
	});

	pi.on("before_agent_start", async (event) => {
		if (snapshot === undefined) {
			// On a clone, pi already loads this repo's CLAUDE.md as a context file.
			const rulesLoaded = (event.systemPromptOptions.contextFiles ?? []).some(
				(file) => resolve(file.path) === join(root, "CLAUDE.md"),
			);
			snapshot = [rulesLoaded ? "" : run("inject-operating-rules.sh", "--force"), run("session-start-hook.sh")]
				.filter(Boolean)
				.join("\n\n");
		}
		if (!snapshot) return;
		return { systemPrompt: `${event.systemPrompt}\n\n${snapshot}` };
	});
}
