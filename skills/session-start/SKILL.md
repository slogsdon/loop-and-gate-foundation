---
name: session-start
description: Load working memory at the start of every agent session. Use FIRST in any session before doing work — reads MEMORY.md, today's daily note, and the latest reflection, then states assumptions before acting.
---

# Session Start

One job: load the right memory into context, cheaply. Nothing else.

## Steps

1. Read `vault/MEMORY.md` in full. This is the index — who you work for,
   active goals, standing lessons, and what Knowledge notes exist.
2. Read the most recent note in `vault/Daily/` (today's if it exists,
   otherwise the latest). This tells you what happened last and what's open.
3. Read the most recent note in `vault/Reflections/`. Apply its lesson to
   how you work THIS session.
4. Do NOT bulk-read `vault/Knowledge/`. Open a Knowledge note only when the
   current goal needs that specific topic — the MEMORY.md index tells you
   which one.
5. If today's daily note doesn't exist, create `vault/Daily/YYYY-MM-DD.md`:

   ```markdown
   # YYYY-MM-DD

   ## Sessions
   ```

6. Before starting work, state in one short block:
   - The goal as you understand it
   - Which open items from the daily note are relevant
   - Any assumptions you're making — if the goal is ambiguous, ask instead
     of guessing

## Rules

- This skill loads memory; it never writes Knowledge or Reflections.
- Total reading: MEMORY.md + 1 daily note + 1 reflection + at most 2-3
  Knowledge notes. If you're reading more than that, stop — you're burning
  context the session needs for actual work.
