# ARCHITECTURE.md — loop-and-gate-foundation

Architecture decisions and the research behind them. If you just want to use
the system, read README.md instead.

## What this is

A self-improving agent loop that uses an Obsidian vault as persistent memory.
"Self-improving" here means the precise, real thing — not the hype version:

- **Self-learning** (the model updates its own weights) does not exist in
  production. No system you can run today does this.
- **Self-improving** (the *system around* the model compounds) is buildable
  now: each session writes lessons to memory, skills sharpen as rules get
  added, the memory index accumulates verified facts. The model stays the
  same. The environment it runs in gets sharper. (Karpathy calls the missing
  weight-update mechanism "continual learning" and estimates it's years away;
  his proposed interim is exactly this — "system prompt learning," where the
  agent edits its own instructions.)

## The agent loop, step by step

One **interactive Claude Code session = one iteration** (the "Ralph loop"
pattern — Geoffrey Huntley / Ryan Carson / Addy Osmani — adapted to
interactive use). Open Claude Code in this folder: the SessionStart hook
loads memory and `CLAUDE.md` enforces the protocol — no launcher needed:

```
┌─────────────────────────────────────────────┐
│ 1. Fresh interactive session starts         │
│ 2. session-start skill: load memory         │
│    (MEMORY.md + latest daily + reflection)  │
│ 3. Work on the goal (user can steer —       │
│    it's a normal Claude Code session)       │
│ 4. capture skill: save durable facts        │
│    to Knowledge/, index them in MEMORY.md   │
│ 5. reflect skill: log session to Daily/,    │
│    write lesson + proposal to Reflections/, │
│    git commit (audit trail)                 │
│ 6. User exits. Context is DISCARDED —       │
│    next session starts fresh at step 1      │
└─────────────────────────────────────────────┘
         separately, run deliberately:
┌─────────────────────────────────────────────┐
│ ask for the improve pass → improve skill    │
│ (also interactive): read Reflections/, apply│
│ REPEATED signals as edits to skills /       │
│ MEMORY.md / config / CLAUDE.md, walk the    │
│ user through each diff, commit              │
└─────────────────────────────────────────────┘
```

**Why fresh context every iteration?** Context degrades before it fills — one
benchmark shows recall dropping from ~98% to ~64% well within the window
("context rot"), with no error signal. The stateless-but-iterative design
sidesteps this: every iteration gets a clean window, and continuity lives in
files. This is the single most important reliability decision in the design.

**Why interactive instead of headless (`claude -p`)?** Karpathy's product
guidance: "Iron Man suit, not Iron Man robot" — keep the human in the
session as the verification step. Interactive sessions mean you can steer
mid-task, answer the agent's questions immediately, and watch it write
memory. The loop's cadence is human-paced: run a session, exit, run another.
Headless batch iteration is a later upgrade once trust is earned, not the
starting point for a beginner.

## Memory: what lives where

Lilian Weng's taxonomy maps human memory onto agents. We implement all three
tiers as plain markdown in an Obsidian vault:

| Tier | Human analogue | Here | Written by |
|------|----------------|------|-----------|
| Short-term | working memory | the session's context window | nobody — discarded each iteration |
| Long-term semantic | facts/concepts | `vault/Knowledge/` — one topic per note | capture skill |
| Long-term episodic | experiences | `vault/Daily/` — one note per day, session log | reflect skill |
| Long-term procedural | skills/habits | `.claude/skills/*/SKILL.md` + `config.yaml` | improve skill (gated) |

**Memory loading is infrastructure, not behavior**: a SessionStart hook
(`.claude/settings.json` → `scripts/session-start-hook.sh`) injects
MEMORY.md + the latest daily note + the latest reflection into every
session's context before the model does anything. A skill the model must
remember to invoke can be skipped. A hook cannot. The session-start skill
remains for the protocol's judgment half (state goal + assumptions) and as
manual fallback.

Plus the piece that makes retrieval work:

- **`vault/MEMORY.md`** — the index. One line per fact/goal/note. Loaded
  every session. Everything else loaded on demand. This is the
  "index + detail" pattern: the index stays under ~40 lines, detail notes
  hold the content. Practitioner consensus and Anthropic's own memory
  guidance both converge here — a small always-loaded index beats a big
  always-loaded dump.

**Why files, not a vector DB?** Files-first is a legitimate production
architecture (it's how Claude Code's own memory works): human-readable,
git-diffable, portable, zero infra, and Obsidian gives you a free UI with
backlinks and graph view. Vector search earns its complexity when the corpus
outgrows an index a model can scan — hundreds of notes, not dozens. Start
here. MemPalace-style semantic search is a later bolt-on if ever needed.

**Schema rules that prevent memory rot** (the append-only trap):

- Knowledge notes state facts timelessly and get **edited in place** when
  facts change — git holds history, the note holds truth. The capture skill
  checks the index for an existing note before creating one (conflict
  detection on write).
- MEMORY.md sections have caps (10 standing lessons, ~40 lines total) with
  explicit demotion rules, so the index can't silently bloat.
- The raw event stream (Daily/) is append-only and never edited. Every
  index/summary is derived and rebuildable from it.

## How self-improvement actually works

Research discriminators between "self-improving" and "merely looping":

1. **Reflection must be re-injected.** Reflexion's entire gain (91% vs 80%
   on HumanEval) comes from routing the post-mortem back into the next
   attempt. Reflection generated but never re-read is ceremony — the most
   common failure in the wild. Here: the SessionStart hook injects the
   latest reflection into every session's context — re-injection is
   guaranteed by infrastructure, not model discipline.

2. **Write-back must be gated.** Voyager's ablation: remove self-verification
   and performance drops 73%. Unverified self-modification makes agents
   worse. Here the gate is the **two-strike rule**: reflect can only propose
   (`status: proposed`). Improve applies only signals that repeated across
   2+ sessions. One bad session is noise. The same problem twice is a pattern.

3. **Improvements must be durable artifacts.** Applied changes land in skill
   files, MEMORY.md, or config — things every future session loads. That's
   the compounding channel (and Karpathy's system-prompt-learning idea,
   implemented literally: the agent edits its own instructions).

4. **A human reviews the diff.** Every improvement pass is a git commit.
   Two reasons: audit trail, and an entropy source — loops that feed purely
   on their own outputs converge on their own quirks (Karpathy's model-
   collapse point). Your review injects outside signal.

The full signal path:

```
session goes badly
  → reflect writes: lesson + proposed change (status: proposed)
  → next sessions hit the same issue → "REPEAT SIGNAL" noted
  → user asks for the improve pass
  → improve skill: repeat? concrete target? → edit skill/MEMORY/config
  → status: applied, git commit
  → every future session runs with the sharper instruction
```

## Containing bad assumptions before the memory matures

The gates above protect a *mature* memory. The harder question a reviewer asked:
what stops a wrong assumption made in the first few sessions — when MEMORY.md is
nearly empty — from compounding into a standing lesson? Four things do, and two
honest gaps remain.

What contains it:

1. **Propose and apply are separate skills.** Reflect only writes
   `status: proposed` into Reflections/. That directory is a quarantine: a
   proposal influences nothing until an improve pass promotes it. A bad early
   idea sits inert, out of the injected context.
2. **The two-strike gate needs a repeat.** A single occurrence is rejected or
   held, never applied. An early coincidence has to recur before it can become a
   rule, and most don't.
3. **Verification outranks self-report.** In a loop, the orchestrator checks
   each iteration against a pass/fail stated up front; a fail runs
   `git checkout -- vault/`, discarding that iteration's memory writes before
   they are ever committed. Bad work does not reach memory to compound from.
4. **Every write is a reviewed, reversible commit.** You see each improve diff,
   and any bad entry that slips through is one `git revert` away.

The honest gaps:

- **The second strike is not independent.** Reflect reads the previous
  reflection, so once a wrong lesson is written down, the next session can see it
  and rationalize a confirming second occurrence. Correlated evidence can satisfy
  a gate meant for independent evidence. (Loop's fresh-context subagents don't
  carry this; reflect itself does.)
- **A young memory has leverage.** When MEMORY.md holds three lines, one wrong
  line is a third of the standing context. There is no confidence weight — every
  standing lesson is treated as equally true.

So the real safeguard during immaturity is not the memory, it's you. The human
gate is heaviest exactly when the corpus is youngest and the automated gates have
the least to work with: the CLAUDE.md behavior rules force the agent to state its
assumptions before acting, improve passes are interactive, and nothing is applied
without a diff you approve. The memory-side gates take over as the corpus fills
and repeats become real signal rather than small-sample noise.

Hardening on the roadmap (not yet implemented): generate the second strike from a
fresh context blind to the first, so confirmation is independent; tag entries with
an evidence count and weight injection by it; expire held proposals that never
repeat.

## The skills

Atomic on purpose — one job each, so the improve skill can edit one without
side effects on the others, and so each stays small enough to be reliably
followed:

| Skill | One job | Reads | Writes |
|-------|---------|-------|--------|
| session-start | load memory cheaply | MEMORY.md, latest Daily + Reflection | today's Daily (creates if missing) |
| capture | persist durable facts | MEMORY.md index | Knowledge/, MEMORY.md index line |
| inbox-triage | route captured-elsewhere thoughts | vault/Inbox/, MEMORY.md index | Knowledge/ or Daily/ (human-confirmed), empties Inbox/ |
| profile-interview | learn the user's voice + taste | user, one Q at a time | Profiles/voice-profile.md, Profiles/taste-profile.md |
| reflect | close the session honestly | session context | Daily/, Reflections/, MEMORY.md goals |
| improve | apply repeated signals | Reflections/, MEMORY.md | .claude/skills/, CLAUDE.md, MEMORY.md lessons, config.yaml |
| loop | orchestrate subagent iterations | MEMORY.md + iteration results | git commits (verified iterations only) |

**The loop skill** is the scaled-up loop: the interactive session becomes
orchestrator + human gate, and each iteration runs in a *subagent* with a
fresh context — recovering the Ralph property (clean slate per iteration)
without giving up the human. It adds the verification the single-session
mode can't: the orchestrator checks each iteration's pass/fail criteria and
reverts unverified memory writes before they're committed (Voyager's
lesson — unverified write-back is where loops stop compounding). Iterations
run sequentially because they share memory files. Only read-only research
fans out in parallel.

Guardrails encoded in the skills themselves: reflect never applies, improve
never acts on single occurrences, improve may not weaken its own gates, and
skills stay under ~80 lines (a rule added must displace a rule dropped).

## Repo structure

```
loop-and-gate-foundation/
├── README.md              # beginner-facing intro + quickstart
├── ARCHITECTURE.md        # this file
├── CLAUDE.md              # standing behavior: session protocol, memory map,
│                          #   guardrails — loaded by every session in this dir
├── config.yaml            # optional clone-only vault override (see vault-path.sh)
├── .claude/
│   ├── settings.json      # registers the SessionStart hook (clone path)
│   └── skills/            # the skills, discovered automatically on folder-open
│       └── */SKILL.md
├── hooks/hooks.json       # registers the SessionStart hook (plugin path)
├── vault.example/         # committed EXAMPLE of the structure. The real vault
│   ├── Inbox/             #   lives OUTSIDE the repo — placed by the setup skill,
│   ├── Profiles/          #   resolved via ~/.config/loop-and-gate/vault. The
│   ├── Daily/             #   repo's own vault/ is gitignored.
│   ├── Knowledge/
│   ├── Reflections/
│   └── MEMORY.md          # the always-loaded index
└── scripts/
    ├── setup.sh               # scaffolds a vault + records its path
    ├── vault-path.sh          # single source of truth for the vault base path
    └── session-start-hook.sh  # injects working memory into every session
```

Skills live in `.claude/skills/` as real files — where Claude Code discovers them
automatically the moment you open this folder. No symlink, no install step. When
improve edits `.claude/skills/reflect/SKILL.md`, the live skill changes on the next
session. This is also what lets the kit work from a downloaded ZIP: there's nothing
to build or link, opening the folder is enough.

## What was deliberately left out

- **Vector search / embeddings** — index + grep covers dozens-to-hundreds of
  notes. Add when retrieval actually misses.
- **Multi-agent orchestration** — one loop, one agent. Practitioner guidance:
  iterate deeper before scaling wider.
- **Automated skill generation** — improve edits existing skills. It proposes
  new ones for a human to create. Self-authored skills without review is
  where self-modification goes wrong.
- **YAML parser, task JSON, PRD tooling** — grep-able config and a goal
  string cover the beginner use case. The Ralph-loop task-list pattern is a
  natural upgrade once goals outgrow one sentence.

## Sources

- Lilian Weng, "LLM Powered Autonomous Agents" (2023) — memory taxonomy,
  Reflexion/ReAct mechanics, failure modes.
  https://lilianweng.github.io/posts/2023-06-23-agent/
- Karpathy — Dwarkesh interview (decade of agents, continual-learning gap),
  "system prompt learning" post (https://x.com/karpathy/status/1921368644069765486),
  LLM-OS framing, model-collapse/entropy point.
- Addy Osmani, "Self-Improving Coding Agents" (2026) — Ralph loop mechanics,
  fresh-context-per-task, AGENTS.md as improvement channel.
  https://addyosmani.com/blog/self-improving-agents/
- Voyager (arXiv:2305.16291) — skill library + verification ablations.
- Reflexion — verbal self-reflection re-injection numbers.
- MemGPT (arXiv:2310.08560) — OS-style memory paging (considered, not used).
- Anthropic context-engineering cookbook — compaction, tool-result clearing,
  memory-tool patterns; context-rot numbers.
