---
name: reflect
description: Close out an agent session. Use at the END of every session — logs what happened to the daily note, then writes an honest self-assessment to Reflections/ with one actionable lesson.
---

# Reflect

One job: end the session with an honest written record — what happened
(episodic memory) and what to do differently (improvement signal).

This is the heart of self-improvement. A reflection that never gets written,
or is written as vague praise, breaks the whole loop.

> All `vault/…` paths below resolve against the vault base (see CLAUDE.md →
> "Resolving the vault path"); on a clone that's the repo's `vault/`, on a plugin
> install it's the setup-recorded path. Resolve the base before writing.

## Steps

1. **Log the session** — append to today's `vault/Daily/YYYY-MM-DD.md` under
   `## Sessions`:

   ```markdown
   ### HH:MM — <short session title>

   - Goal: <what this session set out to do>
   - Did: <what actually happened, including links to any [[Knowledge notes]] captured>
   - Outcome: <done / partial / blocked — and why>
   - Open: <what the next session should pick up, or "nothing">
   ```

2. **Write the reflection** — create or append to
   `vault/Reflections/YYYY-MM-DD.md`:

   ```markdown
   ## Session: <title> (HH:MM)

   ### What worked
   - <specific behavior that helped>

   ### What didn't
   - <specific behavior that hurt — be honest, this is the improvement signal>

   ### Lesson (one sentence, actionable)
   <a rule a future session could actually follow>

   ### Proposed change
   - target: <.claude/skills/<name>/SKILL.md | CLAUDE.md | vault/MEMORY.md | config.yaml | none>
   - change: <one sentence describing the edit>
   - status: proposed
   ```

3. **Update MEMORY.md** — this is the session's ONE MEMORY.md write (it's
   read-only until now for prompt-cache stability): mark the goal done or
   update its one-line status, and add any Knowledge index lines queued by
   capture. Stale goals rot the index.

4. **Commit memory** — commit in the vault's own git repo if it has one:
   `git -C <base> add -A && git -C <base> commit -m "chore: memory update — <short summary>"`
   (`<base>` = `cat ~/.config/loop-and-gate/vault`, or the clone's `vault/`).
   If the vault isn't under git, skip. Every session that can leaves an
   auditable trail.

## Rules

- Reflect does NOT apply changes. It only proposes them (`status: proposed`).
  The improve skill applies them later, when a signal has repeated. This gate
  is deliberate: unverified self-modification makes agents worse, not better.
- "What didn't" must contain something real. A session where nothing went
  wrong still had something inefficient. If truly nothing: write "no signal"
  — but that should be rare.
- One lesson per session, not five. Pick the one that matters most.
- If the same lesson already appears in a previous reflection, say so
  explicitly: "REPEAT SIGNAL — also in YYYY-MM-DD". Repeats are what
  authorize the improve skill to act.
