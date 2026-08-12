---
name: improve
description: Apply accumulated self-improvement signals. Use when the user asks to run an improvement pass or "apply reflections" — reads Reflections/, applies changes that have earned it, updates standing lessons in MEMORY.md.
---

# Improve

One job: turn repeated reflection signals into actual changes — skill edits,
MEMORY.md standing lessons, config tweaks. This is where the system compounds:
the model never changes, but the environment it runs in gets sharper.

## Steps

1. Read all notes in `vault/Reflections/` (newest first). Collect every
   `Proposed change` block with `status: proposed`.

2. For each proposal, decide:
   - **Apply** if the signal repeated (same lesson in 2+ reflections, or
     marked REPEAT SIGNAL) AND the target is concrete AND it survives step 2a.
   - **Reject** if it appeared once and never again (write `status: rejected`
     with one line why), or if it's vague ("be more careful" is not a change).
   - **Hold** (leave proposed) if it appeared once and is recent — it may
     repeat.

2a. **Verify every proposal that reached Apply.** Use the `verify` skill: one
    fresh-context subagent per proposal, given the claim and the evidence paths
    (daily notes, vault git diffs, the actual files) and never the Reflections
    notes. A `drop` verdict sends the proposal back to Hold with the verifier's
    one-line why appended — repeats are not evidence on their own, because the
    hook shows each session the last reflection before it writes its own.

3. Apply accepted changes:
   - `.claude/skills/*/SKILL.md` → edit the skill. Add the rule where it belongs in
     the existing structure. Don't append a "lessons" dump at the bottom.
     Keep each skill under ~80 lines — if a new rule won't fit, an old rule
     must be dropped or merged. Never change a skill's one job.
   - `CLAUDE.md` → edit the standing behavior rules. Never touch the
     "Hard rules" section.
   - `vault/MEMORY.md` → add a one-line entry under `## Standing lessons`
     (max 10; if full, demote the least-relevant lesson back to its
     Reflections note).
   - `config.yaml` → change the value, keep the comment accurate.

4. Mark each applied proposal `status: applied` in its Reflections note.

5. Commit — memory and code live in different repos now:
   Stage the files you edited by path in both — never `add -A`, which commits
   whatever else is in the tree under your message.
   - Skill/`CLAUDE.md`/`config.yaml` edits (this repo):
     `git add <the files you edited> && git commit -m "feat: apply self-improvement — <summary>"`.
   - The `MEMORY.md` standing-lessons edit lands in the vault (external; see
     CLAUDE.md → "Resolving the vault path"). Commit it in the vault's own git
     if it has one:
     `git -C <base> add MEMORY.md <any Reflections notes you restatused> && git -C <base> commit -m "chore: memory update — standing lessons"`.
   Self-modification without a reviewable diff is forbidden.

6. **Release it — committed is not shipped.** A skill edit lands in a source
   repo; the agent loads the installed copy. For a plugin skill: bump
   `.claude-plugin/plugin.json`, push, then `claude plugin marketplace update
   <marketplace>` and `claude plugin update <plugin>@<marketplace>`. Verify by
   grepping the NEW cache dir for the text you added — the source file you
   edited proves nothing about what runs. Skip only if the agent loads the
   edited file directly.

7. Report: what you applied, what you rejected, what you held — one line each.
   Say where each applied change is installed, not just committed.

## Rules

- Never apply a single-occurrence signal. One bad session is noise; the same
  problem twice is a pattern. This gate is what stops self-thrashing.
- Never apply a proposal the count alone approved. Two strikes get it to the
  verifier; the verifier decides. Counting mentions of a claim is not the same
  as checking it.
- Walk the user through each applied diff — improvement passes run
  interactively so the human stays in the review loop.
- MEMORY.md updates come LAST — after all skill/CLAUDE.md/config edits,
  immediately before the commit; it is the prompt-cache prefix (see CLAUDE.md).
- An applied proposal that was never installed is a held proposal with extra
  steps. Two passes in a row have shipped fixes the running agent never saw.
- Skills stay atomic: if a proposal would give a skill a second job, reject
  it and propose a new skill in your report instead.
- Do not edit this skill (improve) to weaken its own gates.
