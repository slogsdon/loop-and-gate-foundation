---
name: improve
description: Apply accumulated self-improvement signals. Use when the user runs an improvement pass (agent/reflect.sh) or asks to "apply reflections" — reads Reflections/, applies changes that have earned it, updates standing lessons in MEMORY.md.
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
     marked REPEAT SIGNAL) AND the target is concrete.
   - **Reject** if it appeared once and never again (write `status: rejected`
     with one line why), or if it's vague ("be more careful" is not a change).
   - **Hold** (leave proposed) if it appeared once and is recent — it may
     repeat.

3. Apply accepted changes:
   - `skills/*/SKILL.md` → edit the skill. Add the rule where it belongs in
     the existing structure; don't append a "lessons" dump at the bottom.
     Keep each skill under ~80 lines — if a new rule won't fit, an old rule
     must be dropped or merged. Never change a skill's one job.
   - `vault/MEMORY.md` → add a one-line entry under `## Standing lessons`
     (max 10; if full, demote the least-relevant lesson back to its
     Reflections note).
   - `agent/config.yaml` → change the value, keep the comment accurate.

4. Mark each applied proposal `status: applied` in its Reflections note.

5. Report: what you applied, what you rejected, what you held — one line each.

## Rules

- Never apply a single-occurrence signal. One bad session is noise; the same
  problem twice is a pattern. (This gate is what separates self-improvement
  from self-thrashing.)
- Every applied change must be committed by the caller (agent/reflect.sh does
  this) so the human can review the diff. Self-modification without a
  reviewable audit trail is forbidden.
- Skills stay atomic: if a proposal would give a skill a second job, reject
  it and propose a new skill in your report instead.
- Do not edit this skill (improve) to weaken its own gates.
