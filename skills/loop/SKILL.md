---
name: loop
description: Orchestrate a goal through subagent iterations. Use when the user gives a goal to run "the loop" on — decomposes the goal, dispatches one subagent per iteration with fresh context, verifies each result before memory is committed.
---

# Loop

One job: drive a goal to done through iterations, keeping the human in the
gate. You (the main session) NEVER do the work yourself — you orchestrate,
verify, and commit. Subagents do the work, one iteration each, each with a
fresh context.

## Why this shape

- Each subagent starts clean — no confusion carryover between iterations
  (the fresh-context property that makes loops reliable).
- Your context stays small: goal, iteration summaries, verdicts. You can
  run many iterations in one sitting without rotting your own window.
- You verify every iteration BEFORE its memory writes are committed —
  self-improvement only compounds on verified work.

## Steps

1. Use the `session-start` skill yourself (load MEMORY.md, latest daily +
   reflection) so you can decompose and judge with context.

2. Break the goal into iteration-sized tasks: each completable by one agent
   in one run, with a pass/fail check you can state up front. Show the user
   the task list; adjust if they object.

3. For each task, dispatch ONE subagent (general-purpose) with this brief:

   ```
   You are one iteration of an agent loop in <repo path>.
   1. Read vault/MEMORY.md, the latest note in vault/Daily/, and the latest
      note in vault/Reflections/. Apply the reflection's lesson.
   2. Do exactly this task: <task>. Done means: <pass/fail criteria>.
   3. Follow skills/capture/SKILL.md to save any durable facts to
      vault/Knowledge/ (update existing notes over creating duplicates).
   4. Follow skills/reflect/SKILL.md steps 1-3 to log the session and write
      a reflection — but do NOT git commit (the orchestrator commits).
   5. Return: what you did, what you captured, outcome
      (done/partial/blocked), and your one-sentence lesson.
   ```

   Run iterations SEQUENTIALLY — subagents write shared memory files
   (daily note, MEMORY.md); parallel iterations corrupt them. Parallel is
   fine only for read-only research subagents that write nothing.

4. Verify the iteration: check the task's pass/fail criteria yourself
   (read the output, run the check, inspect `git diff` of the vault).
   - Pass → commit: `git add -A && git commit -m "chore: loop iteration — <task>"`
   - Fail → `git checkout -- vault/` to discard its memory writes, then
     re-dispatch once with your feedback appended to the brief. Two fails →
     stop and ask the user.

5. Between iterations, give the user one line: task, verdict, lesson. This
   is the human gate — pause if they want to steer.

6. When all tasks are done (or you're blocked), use the `reflect` skill
   yourself to close out the orchestration session: what the loop achieved,
   what the decomposition got wrong, one lesson.

## Rules

- Never parallelize memory-writing subagents.
- Never commit an unverified iteration. Verification is what separates
  compounding from thrashing.
- If a subagent's reflection contradicts your verification (it says done,
  the check fails), record YOUR verdict in the daily note — external
  verification outranks self-report.
- Improvement passes (the improve skill) stay in the main session,
  interactive. Never delegate improve to a subagent.
