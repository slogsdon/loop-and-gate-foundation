# Example — What this vault is

This folder (`Knowledge/`) holds **semantic memory**: durable facts and domain
notes the agent builds up over time. One topic per note. The agent creates
these with the `capture` skill and indexes each one in `MEMORY.md`.

A good Knowledge note:

- Has ONE topic (atomic — split if it grows two topics)
- States facts, not session narrative ("The API rate limit is 100/min",
  not "today we discovered the API rate limit")
- Links to related notes with `[[wikilinks]]`
- Gets updated in place when facts change — history lives in git

Delete this note once you have a few real ones.
