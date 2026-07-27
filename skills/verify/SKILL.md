---
name: verify
description: Check a claim from a fresh context. Use before the improve skill applies a proposal, or any time a worker's self-report is the only evidence that something is true. Dispatches one subagent that never saw the work and asks it to refute the claim.
---

# Verify

One job: take a claim and try to kill it, using an agent that has never seen the
work the claim came from.

A checker that read the worker's session isn't checking, it's agreeing. This
skill exists so a self-report can't serve as its own confirmation.

## When to use it

- **Before `improve` applies a proposal.** The two-strike gate counts repeats,
  but repeats can be correlated: the SessionStart hook injects the latest
  reflection, so a session can read a claim and then write the confirmation. A
  second strike generated that way is an echo. Verify settles the claim against
  artifacts instead of counting mentions.
- Any time "done" rests on nothing but the agent saying done.

Not for taste calls, and not for claims with no artifact behind them. If nothing
outside the session can settle it, verify will drop it — correctly. Take it to
the human.

## Steps

1. **State the claim in one sentence.** If you can't, it isn't checkable — say
   so and stop.
2. **Collect the evidence paths**: the files, vault git diffs, daily notes, or
   test output that would show the claim true or false. Paths only — never the
   session or the Reflections note that produced the claim.
3. **Dispatch ONE subagent** (general-purpose) with this brief:

   ```
   You are a skeptic with no history here. You have not seen the work you are
   judging, and you must not go looking for it.

   CLAIM:    <one sentence>
   EVIDENCE: <paths>

   1. Read ONLY the evidence paths above. Do NOT read vault/Reflections/ — a
      claim's own write-up is not evidence for it.
   2. Try to REFUTE the claim. Look for the case where it's false.
   3. Return exactly these three lines:
      verdict: keep | drop
      why: <one sentence>
      evidence: <the path that decided it>

   If the evidence doesn't settle it, return drop.
   ```

4. **Report the verdict verbatim** to whoever called you, drop reason included.
   Never soften a drop into a "partly."

## Rules

- **Never hand the verifier the worker's context** — not the session, not the
  Reflections note, not your own summary of what happened. The claim and the
  artifacts, nothing else. This one rule is the whole skill.
- **Uncertain means drop.** A verifier that keeps by default is a rubber stamp
  with a subagent bill attached.
- **One verifier per claim.** Batch two claims into one subagent and the strong
  one carries the weak one.
- **Verify never edits anything.** It returns a verdict. The caller acts on it.
- A claim with no artifact behind it cannot pass here. That's the design, not a
  gap — route it to the human rather than inventing evidence for it.
