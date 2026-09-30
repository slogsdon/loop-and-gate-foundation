---
name: setup
description: Place and scaffold the memory vault on first run. Use once right after installing — as a plugin (ask "set up my vault", /setup, or /skill:setup on pi) or a fresh clone — or whenever the SessionStart hook reports no vault is configured. Prompts for the location, then records the path so memory loads every session after.
---

# Setup

One job: give the agent a memory vault to read and write. Ask where it should
live, scaffold the folder structure there, and record the path so the
SessionStart hook and every skill resolve the same vault afterward. Run once per
machine. Idempotent — it never overwrites files you've already started.

This exists mainly for the **plugin install path**, where there is no
`scripts/setup.sh` in your working directory to run — the script ships inside
the read-only plugin cache. This skill locates that bundled script, asks you
where the vault goes, and runs it. On a clone it does the same with the local
script.

## Steps

1. Locate the bundled setup script. On pi the Foundation extension exports
   `LOOP_GATE_ROOT`; otherwise prefer the working copy, then fall back to the
   Claude Code plugin cache (the version-pinned path a plugin user can't easily
   type):

   ```bash
   script="${LOOP_GATE_ROOT:-.}/scripts/setup.sh"
   if [ ! -x "$script" ]; then
     script=$(find "${CLAUDE_CONFIG_DIR:-$HOME/.claude}/plugins" \
       -path '*loop-and-gate-foundation*/scripts/setup.sh' 2>/dev/null | sort -V | tail -1)
   fi
   ```

   If neither resolves, tell the user the plugin isn't installed where expected
   and stop. Don't scaffold by hand — `setup.sh` is the one source of truth for
   what a vault contains.

2. **Ask where the vault should live — this is a gate, don't decide it for the
   user.** Check the OS first (`uname`). Ask with AskUserQuestion (Claude Code) or
   `ask_user_question` (pi), as a location choice:
   - **On macOS**, put the Obsidian iCloud folder first and mark it
     *(Recommended)* — `~/Library/Mobile Documents/iCloud~md~obsidian/Documents/SecondBrain`
     syncs the vault to Obsidian on iPhone/iPad for free. Silently adopting a
     location is what broke earlier setups.
   - Offer a plain local folder (`~/second-brain`, no cloud sync).
   - Offer "an existing Obsidian vault" — the user pastes an absolute path and
     the scaffold lands inside it.
   Off macOS, drop the iCloud option and recommend the local folder.

3. Run the script with the chosen path as its one argument:

   ```bash
   "$script" "<chosen-vault-path>"
   ```

4. Report where the vault landed (the script prints and records the path) and
   the next steps: start a session, run `profile-interview` to teach it your
   voice, or run `add-kits` to add the rest of the Loop & Gate stack (the Build,
   Grow, and Accountability kits). Offer `add-kits` here but don't run it inline —
   it's a separate gated skill, and vault setup is done.

## Rules

- Never reimplement the scaffold logic here. This skill's only job is to ask the
  location and run `setup.sh`. Two copies of the folder layout would drift.
- Never pick the location silently. The location is the user's call — that is
  the whole reason this skill asks the user instead of trusting the script's
  auto-detection.
- Run it once. It's a first-run step, not a session ritual.
- Keep `setup.sh`'s git gate: the script *prints* the vault git-init command
  rather than running it. Don't git-init the vault for the user unasked.
