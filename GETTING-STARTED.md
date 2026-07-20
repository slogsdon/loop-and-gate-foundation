# Getting Started (no terminal)

This is the path for someone who has never opened a terminal and doesn't want to.
Everything here happens inside the app — a couple of clicks and one pasted command,
no command line. About 15 minutes, most of it one-time.

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

## Step 2 — install the Claude desktop app

The desktop app is a normal application you double-click to install — no terminal.

- **Mac:** download the `.dmg`, open it, drag Claude to Applications.
- **Windows:** download the `.exe` and run it. If it asks you to install **Git**
  first, say yes, install it, then reopen the app.

Get the installers from Anthropic's Claude Code download page
([code.claude.com/docs](https://code.claude.com/docs)). Open the app, sign in with
your Claude account (the browser opens for a second), and click the **Code** tab.
That's the whole install.

## Step 3 — install the Foundation

The Foundation installs the same way as the kits — one command in the chat, no
download. In the Code chat box, type this and press Enter:

```
/plugin marketplace add slogsdon/loop-and-gate-foundation
```

A menu appears. Click **Install** on the *loop-and-gate-foundation* plugin. That's it —
the skills and the memory-loader are now available in every session.

## Step 4 — place your vault

Open a folder to work in (**File → Open folder** — your Documents is fine), then in
the chat, ask the agent to set up where your memory lives:

> Set up my vault.

This runs the **setup skill**, which asks you where the vault should live and
then creates it — the folder of notes that is the agent's memory. On a Mac it
recommends iCloud, so the *same* notes sync to Obsidian on your iPhone and iPad
for free (that's what makes "capturing on the go" below work). You only do this
once.

## Step 5 — your first session

Now give it a real goal, in plain words:

> Get to know me: ask about my current project and preferences, then save what you
> learn.

Here's what happens on its own:

- The moment the session starts, the agent **loads its memory** (empty for now)
  so it always picks up where it left off.
- It asks you questions and **saves the answers** into notes it can read back
  later.
- When you wrap up, it **writes down what happened** and one lesson for next time,
  so it gets a little sharper each session.

Install [Obsidian](https://obsidian.md) (free), choose **Open folder as vault**, and
point it at the vault the setup script just created — now you can read everything the
agent knows in a nice UI, with links between notes. It's all plain, readable
markdown; that transparency is the point.

> **Want the full self-improving loop?** Installed as a plugin, the Foundation's
> skills sit in a read-only cache, so on some platforms the agent can improve its
> memory but not rewrite its own skill files. If you want that too, download the repo
> instead — on the [Foundation repo](https://github.com/slogsdon/loop-and-gate-foundation)
> click the green **Code** button → **Download ZIP**, open the folder with **File →
> Open folder**, and run the setup the same way. The plugin is the quickest start;
> the download is the complete one.

## Capturing on the go — power move

Install the **Obsidian** mobile app on your phone and tablet, pointed at the same
vault the setup script created. Then a thought at a red light goes into the vault's
`Inbox/` from your phone, and next session you ask the agent to "triage the inbox" —
it sorts each note and files it with your OK. That's how the ideas survive until
you're back at the desk. This is where the whole thing starts to feel like a second
brain that's always with you.

## Working across devices

You're not limited to capture on the phone. Turn on **Remote Control** (in the
Claude app's settings, or just ask the agent to enable it) and you can steer a
session running on your desktop from the mobile or web app — same session, same
vault. Or hand a task to **Dispatch** from the mobile app: it spins up a session on
your desktop and pings you when it needs a decision. The session always runs where
your vault lives, so your memory and skills come along for free. The [Foundation
README](README.md#working-across-devices) has the full cross-device guide, including
sync options for Android and Windows, where iCloud isn't available.

## Notes and limits

- **Mac works out of the box.** On **Windows**, the memory-loader is a small script
  that needs **Git** installed (the app prompts you for it in Step 2). If memory
  isn't loading on Windows, that's the thing to check.
- **Power move (optional).** Want every memory change tracked and reversible, like
  a time machine for what the agent knows? Put your **vault** under `git` (the setup
  script prints the command). You don't need it to start, and it's a satisfying
  upgrade once the agent is a real part of your day.
- This no-terminal path is new and being validated with first users. If a step
  doesn't match what you see, that's useful feedback.
