# second-brain-agent

An AI agent that **remembers** — and gets better at working with you over
time. Built on [Claude Code](https://claude.com/claude-code) and
[Obsidian](https://obsidian.md), using nothing but plain markdown files and
two small shell scripts.

No prior experience with agents, loops, or Obsidian required. This README
assumes you're starting from zero.

## The problem this solves

Every AI chat session starts from a blank slate. You explain your project,
your preferences, your constraints — and when the session ends, all of it
evaporates. Tomorrow you explain it again.

This system fixes that with a simple idea: **the agent writes things down.**

- Facts it learns go into notes (a "second brain" it can read back later)
- What happened each day goes into a daily log
- After every session, it writes an honest self-review: what worked, what
  didn't, and one lesson
- Periodically, repeated lessons get applied as *actual edits to its own
  instructions* — so next week's agent is measurably sharper than today's

The AI model itself never changes. What improves is everything around it:
its notes, its instructions, its habits. That's what "self-improving" means
here — the system compounds, one session at a time.

## The pieces (60-second tour)

**Obsidian** is a free note-taking app that stores notes as plain markdown
files in a folder (a "vault"). Perfect for agent memory: you can read
everything the agent knows, edit it, and watch it grow — in a nice UI with
links between notes. (Obsidian is optional — the files are just markdown and
work fine without it.)

**Claude Code** is Anthropic's command-line AI agent. It can read and write
files, run commands, and follow instruction files called **skills**.

**A skill** is just a markdown file that teaches Claude a repeatable
procedure. This repo's skills:

| Skill | What it does |
|-------|--------------|
| `session-start` | Loads memory at the start of a session (the index, the latest daily log, the latest reflection) |
| `capture` | Saves a durable fact to the Knowledge folder and indexes it |
| `inbox-triage` | Clears `vault/Inbox/` — the raw thoughts you dumped from your phone — sorting each into a fact, an idea, a task, or noise, with your confirmation |
| `profile-interview` | Interviews you to build a voice profile (how you write) and a taste profile (how you judge), so the agent can sound like you and make calls you'd agree with |
| `reflect` | Ends a session: logs what happened + writes a self-review with one lesson |
| `improve` | Applies lessons that have come up repeatedly — by editing the skill files themselves |
| `loop` | For bigger goals: your session becomes the orchestrator — it breaks the goal into tasks and dispatches a fresh subagent per iteration, verifying each result before it's committed |

**The loop** ties it together: one interactive Claude Code session = one
iteration. Open Claude Code in this folder and the SessionStart hook loads
memory while `CLAUDE.md` runs the protocol (load memory → work → save
learnings → reflect). When you're done, exit. Next time, a fresh session
picks up where the *files* left off. Only the memory files carry over between
sessions — that's deliberate, it keeps the agent focused and reliable.

## The memory layout

```
vault/
├── MEMORY.md        ← the index: who you are, active goals, lessons,
│                      one line per knowledge note. Kept SHORT on purpose.
├── Inbox/           ← raw thoughts you dump from your phone, cleared by
│                      the inbox-triage skill (see "Capturing on the go")
├── Profiles/        ← how you write + how you judge, built by
│                      profile-interview (see "Teaching it your voice")
├── Daily/           ← one note per day: what happened in each session
├── Knowledge/       ← one note per topic: facts the agent has learned
└── Reflections/     ← the agent's self-reviews and improvement proposals
```

Three kinds of memory, if you like the theory: **episodic** (Daily — what
happened), **semantic** (Knowledge — what's true), and the current session's
context window (working memory, discarded every iteration). The index keeps
it all findable without loading everything.

## Setup (5 minutes)

You need: a Mac or Linux machine, [Node.js](https://nodejs.org), and a
Claude subscription or API key.

```bash
# 1. Install Claude Code (skip if you have it)
npm install -g @anthropic-ai/claude-code

# 2. Clone this repo
git clone https://github.com/slogsdon/second-brain-agent.git
cd second-brain-agent

# 3. Run setup — checks prerequisites, installs the skills
./scripts/setup.sh
```

Optional but nice: install [Obsidian](https://obsidian.md), then
"Open folder as vault" → pick the `vault/` folder. Now you can watch the
agent's brain grow.

## Your first session

Open Claude Code in this folder, then give it a goal:

```bash
claude
# then, in the session:
# "Get to know me: ask about my current project and preferences, then save what you learn"
```

(Or open the folder in the Claude Code desktop app or your IDE — same result;
the hook and `CLAUDE.md` do the priming.) It's a normal interactive session —
you can talk to it, steer it, interrupt it. What happens:

1. A session-start hook injects `vault/MEMORY.md` (nearly empty right now)
   plus the latest daily note and reflection — automatically, every session
2. It asks you questions, and **captures** the answers into
   `vault/Knowledge/` notes
3. When you wrap up, it **reflects**: logs the session to `vault/Daily/`,
   writes its first self-review to `vault/Reflections/`, and commits
4. Exit the session (Ctrl+D or /exit)

Open the vault and look around. Everything the agent "knows" is right there
in readable markdown. That transparency is the point.

## Daily use

Open Claude Code in this folder (`claude`, the desktop app, or your IDE) and
give it a goal — or none:

```
"Research the best CRM options for a 3-person consultancy and write up a comparison"
```

With no goal, it picks up open items from the last daily note. The
SessionStart hook loads memory and `CLAUDE.md` runs the protocol either way.

One session = one iteration of the loop. Work until done or blocked, let it
reflect, exit. The next session starts fresh and continues from what the
files say — you can run one iteration a day or ten in a row.

For a goal too big for one session, ask for the **loop skill**
("run the loop on: <goal>"). Your session stays as the orchestrator and
human gate. Each iteration runs in a subagent with a fresh context, and
nothing lands in memory until the orchestrator verifies it. Best of both:
clean-slate iterations *and* you watching every step.

## Capturing on the go

The best ideas don't wait until you're at your desk. This is where Obsidian's
mobile app earns its keep — it's the same vault in your pocket. Drop a thought
into `vault/Inbox/inbox.md` from your phone (one line, no structure) and it
syncs back to your machine. The system doesn't care how it arrives: Obsidian
Sync, iCloud, or a plain `git pull` all work, since the inbox is just a file.

Next session, ask the agent to **triage the inbox**. It reads each thought,
sorts it into a fact, an idea, a task, or noise, and — this is the part that
matters — shows you its sorting and waits for your yes before it files
anything. You capture in two seconds at a red light. The agent does the filing
later, on your terms. Nothing gets filed you didn't approve, and nothing gets
dropped you didn't see.

No app to build, no server to run. Obsidian mobile plus Claude Code on your
machine *is* the cross-platform setup.

## Teaching it your voice

Run **profile-interview** once ("build my voice profile") and the agent
interviews you — one question at a time — about how you write and how you judge
good work. It writes two reference docs into `vault/Profiles/`: a voice profile
(so anything it drafts can sound like you) and a taste profile (so it has a
standard to point at when it has to make a call you'd normally make yourself).
Re-run it anytime to sharpen either one. It merges rather than overwrites.

## The self-improvement part

After you've run a handful of sessions, start a session and ask for an
improvement pass:

```
"Run the improve pass: apply the reflections that have earned it."
```

The agent reads all the accumulated self-reviews and applies the lessons that
have **come up more than once** — by editing the skill files, the memory
index, or the config. It walks you through each change as it makes it, and
commits so there's a diff:

```bash
git show   # review what the agent changed about itself
```

Why only repeated lessons? One bad session is noise. The same problem twice
is a pattern. This gate is what separates self-improvement from an agent
thrashing its own instructions. And why the git commit? So *you* stay in the
review loop — every change the agent makes to itself is a diff you can read
and revert.

That's the whole trick, and it compounds: sharper instructions → better
sessions → better reflections → sharper instructions.

## Dials you can turn

- `config.yaml` → `vault` — point at a different vault (e.g. your
  real Obsidian vault) once you outgrow the starter one
- `CLAUDE.md` — the agent's standing behavior rules, edit to taste (the
  improve skill will also propose edits here over time)

## FAQ

**Does the AI actually learn?** The model's weights never change — no
deployed system does that. What changes is its *environment*: notes,
instructions, config. Functionally, it remembers and improves. Mechanically,
it's markdown files getting better.

**What if it writes something wrong into memory?** Edit the file — it's
markdown. Or `git revert`. Every memory change is a commit.

**Can it mess up its own skills?** The improve skill has guardrails (only
repeated signals, no gate-weakening, everything committed for your review),
and `git revert` undoes any bad edit.

**Do I need Obsidian?** No — it's a viewer. The system is just files.

## Going deeper

- `ARCHITECTURE.md` — the architecture, the research behind each decision, and
  what was deliberately left out
- Lilian Weng's [LLM Powered Autonomous Agents](https://lilianweng.github.io/posts/2023-06-23-agent/)
  — the canonical writeup of agent planning, memory, and reflection
- Andrej Karpathy's ["system prompt learning"](https://x.com/karpathy/status/1921368644069765486)
  — the idea this repo implements literally: an agent that edits its own
  instructions
