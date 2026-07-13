#!/usr/bin/env bash
# POWER MOVE (terminal only): git-init the vault so every memory change is tracked
# and reversible + a prereq check. The kit works without this — skills live in
# .claude/skills/ and the SessionStart hook seeds today's note, so opening the
# folder in Claude Code is enough. Run this when you want a full history of how
# your second brain grew.
set -euo pipefail

cd "$(dirname "$0")/.."

echo "== second-brain-agent setup =="

# 1. Check for Claude Code CLI
if ! command -v claude >/dev/null 2>&1; then
  echo "MISSING: Claude Code CLI not found."
  echo "  Install: npm install -g @anthropic-ai/claude-code"
  echo "  Then run this script again."
  exit 1
fi
echo "ok: claude CLI found ($(claude --version 2>/dev/null | head -1))"

# 2. Check git
if ! command -v git >/dev/null 2>&1; then
  echo "MISSING: git. Install Xcode command line tools or git package."
  exit 1
fi
echo "ok: git found"

# 3. Initialize vault git tracking (memory history = git history)
if [ ! -d .git ]; then
  git init -b main
  echo "ok: git repo initialized"
else
  echo "ok: already a git repo"
fi

# 4. Seed today's daily note so the first session has somewhere to log
today=$(date +%Y-%m-%d)
daily="vault/Daily/$today.md"
if [ ! -f "$daily" ]; then
  cat > "$daily" <<EOF
# $today

## Sessions

(sessions will be logged here by the loop)
EOF
  echo "ok: created $daily"
else
  echo "ok: $daily already exists"
fi

echo ""
echo "Setup complete. Open Claude Code in this folder and give it a goal:"
echo "  claude"
echo "  (or open this folder in the Claude Code desktop app / your IDE)"
echo "Skills are in .claude/skills/ (already discovered); the SessionStart hook"
echo "loads memory and CLAUDE.md runs the protocol."
