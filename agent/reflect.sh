#!/usr/bin/env bash
# Self-improvement step: run periodically (weekly, or after a few sessions).
# Reads accumulated Reflections/ and applies repeated signals as real changes
# via the improve skill. Separate from loop.sh on purpose: reflection happens
# every session (cheap, append-only), improvement happens deliberately
# (edits skills/config, so it gets its own reviewable run + commit).
#
# Usage: ./agent/reflect.sh
set -euo pipefail

cd "$(dirname "$0")/.."

cfg() { grep -E "^$1:" agent/config.yaml | sed "s/^$1:[[:space:]]*//" ; }
CLAUDE_CMD="$(cfg claude_cmd)"
VAULT="$(cfg vault)"

prompt="Use the improve skill: read all notes in $VAULT/Reflections/ with proposed changes, plus MEMORY.md standing lessons. Apply the changes that have earned it (repeated signal, concrete target). Mark applied proposals as applied. Report what you changed and why."

$CLAUDE_CMD -p "$prompt" --permission-mode acceptEdits

# Commit so every self-modification is a reviewable diff
git add -A
git diff --cached --quiet || git commit -q -m "feat: apply self-improvement from reflections"

echo ""
echo "Improvement pass done. Review what changed with: git show"
