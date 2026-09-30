---
name: add-kits
description: Offer to install the rest of the Loop & Gate stack — the Build, Grow, and Accountability kits, and each kit's swappable build/grow pipeline. Use after setup (or /add-kits), or whenever the user wants to add a sibling kit. Every install is a gated offer, never automatic; the pipeline layer is always declinable so you can bring your own tools.
---

# Add Kits

One job: offer to install the other Loop & Gate kits and the pipeline each one
sits on, letting the human choose every piece. Foundation is the hub — its
marketplace lists all the kits — so this skill reads that list and makes the
offer. It never installs anything the user didn't just pick.

This is deliberately an **offer**, not a dependency. The kits and especially
their pipelines are a disposable, swappable layer; forcing them on install would
contradict the whole stack's "the tools are interchangeable, compose your own"
stance. So this skill asks, every time.

It is also **data-driven**, so it never needs editing as the stack grows: the kit
list comes from `marketplace.json`, and each kit's pipeline comes from
`kits.json` next to this file. A new kit published in the marketplace shows up in
the offer on its own.

## Steps

1. **Locate the Foundation root** (works on both the clone and plugin-cache
   paths). Gate the working-copy branch on the file this skill actually needs —
   its own `kits.json` — not on any `marketplace.json`, or a run started from a
   *different* plugin repo's directory will falsely resolve to that repo:

   ```bash
   root="${LOOP_GATE_ROOT:-.}"   # pi: exported by the Foundation extension
   if [ ! -f "$root/skills/add-kits/kits.json" ]; then
     kf=$(find "${CLAUDE_CONFIG_DIR:-$HOME/.claude}/plugins" \
       -path '*loop-and-gate-foundation*/skills/add-kits/kits.json' 2>/dev/null | sort -V | tail -1)
     [ -n "$kf" ] && root=$(dirname "$(dirname "$(dirname "$kf")")")
   fi
   echo "root=$root"
   ```

   If `$root/skills/add-kits/kits.json` still doesn't resolve, tell the user the
   Foundation plugin isn't installed where expected and stop.

2. **Read the offer data with the Read tool** (not shell parsing):
   - `$root/.claude-plugin/marketplace.json` → the marketplace's own `name`
     (the install target, e.g. `loop-and-gate`) and its `plugins[]`. Every plugin
     **except `loop-and-gate-foundation`** (the host, already installed) is an
     offerable kit. Use each entry's `description` for the choice text.
   - `$root/skills/add-kits/kits.json` → each kit's pipeline, keyed by plugin
     name. A kit absent from this file has no pipeline (that's expected, e.g. the
     accountability kit).

3. **See what's already installed** so the offer doesn't re-list it:

   ```bash
   claude plugin list --json   # Claude Code
   pi list                     # pi — installed sources, e.g. git:github.com/<repo>
   ```

   Mark kits already present as installed; drop them from the choices (or show
   them greyed as "already installed").

4. **Gate 1 — which kits?** Ask with AskUserQuestion (Claude Code) or
   `ask_user_question` (pi), `multiSelect: true`, listing the
   not-yet-installed kits, each with its one-line description. The human picks
   zero or more. Picking none is valid — and, crucially, does **not** end the
   skill: a user with every kit already installed can still be missing pipelines,
   which the next gate handles. If every kit is already installed, say so and go
   straight to step 6.

5. **Install each chosen kit** from the Foundation marketplace by its declared
   name (from step 2), one command per kit:

   ```bash
   claude plugin install <kit-plugin-name>@<marketplace-name>   # Claude Code
   pi install git:github.com/<source.repo>                      # pi — the entry's source.repo
   ```

6. **Gate 2 — the pipeline, per installed kit that's missing one.** Consider
   every kit that is now installed — the ones just chosen **and** the ones that
   were already there. For each that has a `kits.json` entry, split its tools into
   **core** (no `optional` flag) and **optional augments** (`"optional": true`),
   and drop from each list whatever's already installed (from step 3's list).
   **On pi, a tool with no `pi` field isn't offered** — it has no pi build. Then,
   per kit:

   - **Core pipeline** — if any core tool is missing, one ask-tool offer to
     install the core set (install-all / skip). **Label it swappable**: name the
     tools and make clear the sensible default for someone who already has their
     own brainstorm/plan/build/test/review or design/writing tools is to decline —
     the kit works either way.
   - **Optional augments** — if any augment is missing, a *separate* ask-tool question
     (`multiSelect: true`) listing each augment with a one-line "what it adds", so
     the human picks any subset (default none). These are extras that run alongside
     the core, not gate-fillers, so none is a perfectly good answer. Both ask
     tools allow at most four options per question — if a kit ever lists more than four
     missing augments, chunk them across additional questions.

   For every tool the human chose, add its marketplace then install it (add is safe
   to re-run):

   ```bash
   # Claude Code
   claude plugin marketplace add <source>
   claude plugin install <plugin>@<marketplace>
   # pi — the tool's `pi` field
   pi install <pi>
   ```

   A kit with no `kits.json` entry, or whose pipeline (core and augments) is already
   fully installed, gets no question — skip it silently.

7. **Report and reload.** List exactly what was installed (kits and any pipeline
   tools), then tell the user to run `/reload-plugins` (Claude Code) or `/reload`
   (pi), or restart the session, so the new skills load now. Name the entry points
   they just gained — e.g. `/loop-and-gate` for the Build Kit, `/grow-and-gate` for
   the Grow Kit (`/skill:loop-and-gate`, `/skill:grow-and-gate` on pi).

## Rules

- **Never install without the gate.** Every kit and every pipeline is a
  human-picked choice through the ask tool. This skill's reason to exist is that
  these are offers, not dependencies.
- **The pipeline is always declinable, and framed that way.** Never present the
  build/grow tools as required. They are the disposable appendix; declining in
  favor of your own stack is a first-class answer.
- **Don't hardcode the kit list.** It comes from `marketplace.json` every run, so
  a newly published kit appears without touching this skill. To give a future kit
  a pipeline, add one entry to `kits.json` — nothing here changes.
- **Idempotent.** Skip already-installed kits; `marketplace add` and re-`install`
  are safe to repeat. Running this skill twice never duplicates or breaks
  anything.
- **Foundation is the host, not an offer.** Never list `loop-and-gate-foundation`
  as an installable kit — it's the plugin this skill ships in.
