# Getting Started (no terminal)

This is the path for someone who has never opened a terminal and doesn't want to.
Everything here is download-and-click. About 15 minutes, most of it one-time.

Prefer the terminal? The [README](README.md) has the `git clone` + `claude` path.
Both end in the same place.

## What you need

- A **Mac or Windows** computer.
- A **paid Claude plan** — Pro or Max. **The free Claude plan does not include
  Claude Code**, so this won't work on free. Pro is the usual starting point.

## Step 1 — get a Claude plan

Go to [claude.ai](https://claude.ai) and make sure you're on **Pro** or **Max**
(not the free plan). This is the one thing people miss, and nothing works without
it.

## Step 2 — install the Claude Code Desktop app

The Desktop app is a normal application you double-click to install — no terminal.

- **Mac:** download the `.dmg`, open it, drag Claude to Applications.
- **Windows:** download the `.exe` and run it. If it asks you to install **Git**
  first, say yes, install it, then reopen the app.

Get the installers from Anthropic's Claude Code download page
([code.claude.com/docs](https://code.claude.com/docs)). Open the app, sign in with
your Claude account (the browser opens for a second), and click the **Code** tab.
That's the whole install.

## Step 3 — download this kit

On this project's GitHub page, click the green **Code** button, then **Download
ZIP**. Double-click the downloaded file to unzip it. You'll get a folder named
`second-brain-agent`. Move it somewhere you'll find it, like your Documents.

## Step 4 — open it in the app

In the Claude Code Desktop app, **File → Open folder**, and pick the
`second-brain-agent` folder you just unzipped.

That's it. There's no setup to run. The skills are already inside the folder
(in `.claude/skills/`), and a memory-loader turns on automatically every time you
open it. Nothing to install, nothing to link.

## Step 5 — your first session

In the chat, type a goal, in plain words:

> Get to know me: ask about my current project and preferences, then save what you
> learn.

Here's what happens on its own:

- The moment the session starts, the agent **loads its memory** (empty for now)
  so it always picks up where it left off.
- It asks you questions and **saves the answers** into notes it can read back
  later.
- When you wrap up, it **writes down what happened** and one lesson for next time,
  so it gets a little sharper each session.

Open the folder in Finder (or install [Obsidian](https://obsidian.md) and "Open
folder as vault" on the `vault/` folder) and you can read everything the agent
knows — it's all plain, readable notes. That transparency is the point.

## Capturing on the go — power move

Once you're comfortable, level it up: install the **Obsidian** mobile app on your
phone and point it at the same `vault/` folder. Then a thought at a red light goes
into `vault/Inbox/` from your phone, and next session you ask the agent to "triage
the inbox" — it sorts each note and files it with your OK. That's how the ideas
survive until you're back at the desk. This is where the whole thing starts to feel
like a second brain that's always with you.

## Notes and limits

- **Mac works out of the box.** On **Windows**, the memory-loader is a small script
  that needs **Git** installed (the Desktop app prompts you for it in Step 2). If
  memory isn't loading on Windows, that's the thing to check.
- **Power move (optional).** Want every memory change tracked and reversible, like
  a time machine for what the agent knows? Put the folder under `git`. That's the
  terminal path in the README. You don't need it to start, and it's a satisfying
  upgrade once the agent is a real part of your day.
- This no-terminal path is new and being validated with first users. If a step
  doesn't match what you see, that's useful feedback.
