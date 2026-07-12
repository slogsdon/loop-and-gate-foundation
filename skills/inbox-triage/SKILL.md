---
name: inbox-triage
description: Process raw thoughts captured elsewhere (phone at a red light, Obsidian mobile) that landed in vault/Inbox/. Use at the start of a session, or when the user says "process my inbox" / "triage" / "clear the inbox". Sorts each item and routes it, but the human confirms every destination.
---

# Inbox Triage

One job: take the pile of half-formed captures in `vault/Inbox/` and route
each one to where it belongs — without losing anything and without deciding
for the user.

This is the async half of memory. The `capture` skill saves facts from *this
session's* context. Triage handles thoughts you dumped from your phone hours
ago, out of any session — the idea at a red light, the bug you noticed in the
shower. Capture is synchronous. Triage is the catch-up.

## The capture surface

- `vault/Inbox/inbox.md` — one bullet (`- `) per thought. Append to it from
  Obsidian mobile. No structure required at capture time.
- Any standalone `.md` file dropped in `vault/Inbox/` also counts as one item
  (mobile "new note").

Each bullet and each standalone file is one item to triage.

## Steps

1. Read every item in `vault/Inbox/`. If it's empty, say so and stop.
2. Classify each item into one of four buckets, and propose a destination:
   - **fact** — durable, "how X works" / a decision → `Knowledge/` (via the
     `capture` skill's rules)
   - **idea** — something to explore later → `## Ideas` in today's daily note
   - **task** — a concrete next action → `## Open` in today's daily note
   - **noise** — already stale or not worth keeping → discard
3. **Show the whole batch as a list — item → proposed bucket — and wait for
   the user to confirm or correct.** This is the gate. Triage sorts. The human
   decides. Batch-approve is fine ("all good", "3 is a task not an idea").
4. Apply the confirmed routing:
   - fact → follow the `capture` skill (dedupe against the Knowledge index,
     state it timelessly, add the one-line index entry). Don't re-implement
     that here.
   - idea / task → append a bullet under the right heading in
     `vault/Daily/YYYY-MM-DD.md`, creating the heading if absent.
   - noise → drop it, keep a running count.
5. Empty the inbox: clear the processed bullets from `inbox.md` and delete the
   processed standalone files. Git keeps the history, so nothing is truly lost.
6. Report: how many went where (`2 facts, 1 idea, 1 task, 1 discarded`), and
   confirm the inbox is empty.

## Rules

- **Never file an item the user hasn't confirmed.** Auto-filing is a gate
  skip — the whole point is that the human stays in the loop on what their
  own memory keeps.
- **Lose nothing unreviewed.** An item you genuinely can't classify stays in
  the inbox, flagged in your report — never discarded to make the inbox empty.
- **Cheap beats thorough.** If triage costs more effort than the capture
  saved, the loop dies. Keep the confirm step fast. Batch it. Don't
  interrogate the user item by item.
- **Reflections are off-limits.** Feelings about the work go to `Reflections/`
  via the `reflect` skill, never through triage.
