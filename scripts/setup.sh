#!/usr/bin/env bash
# One-time setup for second-brain-agent (Loop & Gate Foundation).
# Picks a home for your vault, scaffolds it, and records the path so the
# SessionStart hook knows where your memory lives — in both clone and
# plugin installs. Safe to re-run: never overwrites files you've started.
set -euo pipefail

CONFIG_DIR="$HOME/.config/loop-and-gate"
CONFIG_FILE="$CONFIG_DIR/vault"

echo "== second-brain-agent — setup =="

# 1. Choose a vault home. Priority: arg > env > iCloud (macOS) > ~/second-brain.
icloud="$HOME/Library/Mobile Documents/iCloud~md~obsidian/Documents"
if [ -n "${1:-}" ]; then
  VAULT="$1"
elif [ -n "${LOOP_GATE_VAULT:-}" ]; then
  VAULT="$LOOP_GATE_VAULT"
elif [ -d "$icloud" ]; then
  VAULT="$icloud/SecondBrain"
  echo "Found the Obsidian iCloud folder — using $VAULT"
  echo "On macOS/iOS/iPadOS this syncs your vault to Obsidian mobile for free:"
  echo "edit memory on your phone or iPad, the agent reads the same files."
else
  VAULT="$HOME/second-brain"
fi
echo "Vault home: $VAULT"

# 2. Scaffold (idempotent).
for dir in Daily Reflections Knowledge Inbox Profiles; do mkdir -p "$VAULT/$dir"; done
[ -f "$VAULT/MEMORY.md" ] || printf '# Memory\n\n## Index\n' > "$VAULT/MEMORY.md"
for p in voice taste; do
  f="$VAULT/Profiles/$p.md"
  [ -f "$f" ] || printf '# %s profile\n\n_Run /profile-interview to fill this in._\n' "$p" > "$f"
done

# 3. Record the path where the SessionStart hook reads it (takes precedence over config.yaml).
mkdir -p "$CONFIG_DIR"
printf '%s\n' "$VAULT" > "$CONFIG_FILE"
echo "Recorded vault path in $CONFIG_FILE"

# 4. Optional power move: git-track the vault so every memory change is reversible.
if command -v git >/dev/null 2>&1 && [ ! -d "$VAULT/.git" ]; then
  echo
  echo "Optional — track memory history with git:"
  echo "  git -C \"$VAULT\" init -b main && git -C \"$VAULT\" add -A && git -C \"$VAULT\" commit -m 'init vault'"
fi

echo
echo "Done. Enable the plugin (or open this folder in Claude Code), then run /morning."
