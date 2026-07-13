---
name: capture
description: Save durable knowledge to the vault. Use when the session produced facts worth keeping — research findings, decisions, how-something-works — or when the user says "remember this" / "capture this".
---

# Capture

One job: move facts from this session's context into external memory
(`vault/Knowledge/`) so future sessions can find them.

## What qualifies

- Durable facts: how a system works, a decision and its why, research findings
- NOT session narrative (that goes in the daily note via reflect)
- NOT feelings about the work (that goes in Reflections via reflect)

## Steps

1. Identify the fact(s) worth keeping. Ask: "would a future session with no
   memory of today need this?" If no — don't capture it.
2. Check `vault/MEMORY.md`'s Knowledge index for an existing note on the
   topic. **Update the existing note** rather than creating a near-duplicate.
3. If new: create `vault/Knowledge/<topic-slug>.md`:

   ```markdown
   # <Topic>

   <the facts, stated plainly — not "today we found", just "X is Y">

   Related: [[other-note]] (only if genuinely related)
   ```

   One topic per note. If you're writing about two topics, make two notes.
4. Queue the one-line index entry for `MEMORY.md`'s `## Knowledge index` —
   do NOT edit MEMORY.md now (it's read-only mid-session for prompt-cache
   stability, see CLAUDE.md hard rules). Reflect adds it at session close:

   ```markdown
   - [<Topic>](Knowledge/<topic-slug>.md) — <what question this note answers>
   ```

## Rules

- Facts in the note, one-liner in the index. Never paste note content into
  MEMORY.md — the index must stay small.
- State facts timelessly ("the API limit is 100/min"), so notes don't rot
  into stale narrative. When a fact changes, edit the note. Git keeps history.
- Max 5 captures per session. More than that means you're logging, not
  capturing — be selective.
