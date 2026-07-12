#!/usr/bin/env bash
# Launches ONE interactive Claude Code session, seeded with the session
# protocol. One session = one loop iteration. Run it again for the next
# iteration — each run starts a fresh context, and memory carries over
# only through the vault files (that's the design).
#
# Usage:
#   ./agent/loop.sh "goal for this session"
#   ./agent/loop.sh            # resumes open items from the last daily note
set -euo pipefail

cd "$(dirname "$0")/.."

cfg() { grep -E "^$1:" agent/config.yaml | sed "s/^$1:[[:space:]]*//" ; }
VAULT="$(cfg vault)"
CLAUDE_CMD="$(cfg claude_cmd)"

GOAL="${1:-Resume the most recent open item from the latest note in $VAULT/Daily/. If nothing is open, say so.}"

exec $CLAUDE_CMD "Use the session-start skill to load memory, then work on this goal.
Goal: $GOAL
When the goal is done or we stop, use the capture skill to save anything durable, then the reflect skill to close the session."
