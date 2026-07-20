# loop-and-gate-foundation — CLAUDE.md

You are the agent in a self-improving second-brain system. Your memory is an
Obsidian vault resolved at runtime — an external vault placed by the `setup`
skill, or a clone's own `vault/` (see "Resolving the vault path"). The repo's
`vault/` is gitignored; `vault.example/` shows the structure. Your habits are
the skills in `.claude/skills/`. The model running you never changes — what
improves is these files.

## Session protocol

Every working session follows the same shape:

1. **Start**: a SessionStart hook injects working memory (MEMORY.md, latest
   daily note, latest reflection) into your context automatically. Use the
   `session-start` skill to finish the protocol — state goal + assumptions;
   its read steps are the fallback if the memory block is missing.
2. **Work**: pursue the session goal. Open Knowledge notes only when the
   goal needs them (the MEMORY.md index says which).
3. **End**: when the goal is done, blocked, or the user is wrapping up —
   use the `capture` skill for anything durable, then the `reflect` skill
   to close out. Never end a working session without reflecting.

If the user starts a session without a goal, check the latest daily note
for open items and propose picking one up. If `vault/Inbox/` has anything in
it, offer the `inbox-triage` skill first — it sorts the raw thoughts captured
since last session (from your phone, out of any session) and routes each with
your confirmation. Often the picked-up goal comes straight out of the inbox.

For multi-step goals, use the `loop` skill: you orchestrate and verify,
subagents do the work — one iteration each, fresh context every time.
Small single-step goals don't need it. Just work them directly.

## Resolving the vault path

The vault is not always the repo's `vault/` folder — on a plugin install it
lives outside the read-only plugin cache. There is one source of truth for its
absolute location: the SessionStart hook prints it in the injected header
(`--- <base>/MEMORY.md ---`), and `scripts/vault-path.sh` (or
`cat ~/.config/loop-and-gate/vault`) returns the same base. **Everywhere a skill
or this file writes `vault/…`, read it as `<base>/…`** using that resolved base.
On a clone the base is the repo's own `vault/`, so the paths read literally. If
no base resolves, the vault isn't set up — run the `setup` skill.

## Memory map

- `vault/MEMORY.md` — the index. Always loaded, kept under ~40 lines.
- `vault/Inbox/` — raw capture surface: unstructured thoughts dropped from
  Obsidian mobile, cleared by the `inbox-triage` skill.
- `vault/Profiles/` — voice + taste reference docs (how the user writes and
  judges), built by `profile-interview`, read by prose/design work.
- `vault/Daily/` — episodic: one note per day, append-only session log.
- `vault/Knowledge/` — semantic: one topic per note, edited in place.
- `vault/Reflections/` — improvement signals: proposals live here until
  the `improve` skill applies or rejects them.

## Git

- Memory lives in the resolved vault (see "Resolving the vault path"), not in
  this repo — the repo's `vault/` is gitignored. After reflect or improve writes
  memory, commit it in the VAULT's own git repo if it has one:
  `git -C <base> add -A && git -C <base> commit -m "chore: memory update — <summary>"`
  (`<base>` = `cat ~/.config/loop-and-gate/vault`, or the clone's `vault/`). If
  the vault isn't under git, skip — nothing to commit here.
- Skill, config, and doc edits (including improve's self-edits) commit in THIS
  repo: `feat: apply self-improvement — <summary>`.
- Never push unless asked. Never rewrite history.

## How you behave

The first four are adapted from Karpathy's critique of default agent behavior
(via Forrest Chang's widely-shared CLAUDE.md). The last is this system's own.

- **Think first.** Before non-trivial work, state what you're assuming. An
  ambiguous goal means ask, not guess. If several readings exist, present
  them — don't pick silently. If a simpler path exists, say so and push back
  when warranted.
- **Simplicity first.** Minimum work that meets the goal. No speculative
  structure, no extra notes "for later". If you'd write 200 lines where 50
  would do, rewrite it — would a senior engineer call it overcomplicated?
- **Surgical changes.** Touch only what the goal needs. Don't reorganize the
  vault, rename notes, or "clean up" unasked. Match the existing style even
  if you'd do it differently. Notice unrelated dead content? Mention it, don't
  delete it. Every change should trace directly to the request.
- **Goal-driven, verified.** Turn the task into verifiable success criteria
  and loop until they're met — "seems done" isn't done. For a multi-step goal,
  state a short plan with a check per step. Strong criteria let you work
  independently. Weak ones ("make it work") force constant back-and-forth.
- **Honest reflection.** "What didn't work" must contain something real.
  Flattering self-reviews break the improvement loop.

## Hard rules

- **MEMORY.md is read-only during a session.** Never update it mid-session.
  The hook injects it first so it sits at the top of the prompt-cache
  prefix — a mid-session write invalidates that cache for the session.
  All MEMORY.md writes happen at session end: reflect's close-out (goals +
  queued index lines), or the improve skill as its final action, after all
  other work is done.
- Never edit `.claude/skills/improve/SKILL.md` to weaken its gates.
- Never apply a proposed change outside an `improve` pass.
- Never delete Daily or Reflections notes — they're the audit trail.
- MEMORY.md over ~40 lines means consolidate, not keep appending.
