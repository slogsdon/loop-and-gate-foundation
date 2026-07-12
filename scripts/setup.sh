#!/usr/bin/env bash
# One-time setup: checks prerequisites and initializes the vault.
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

# 5. Install skills into Claude Code
./scripts/install-skills.sh

echo ""
echo "Setup complete. Start your first session with:"
echo "  ./agent/loop.sh \"your first goal here\""
