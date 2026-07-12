#!/usr/bin/env bash
# Launches an interactive Claude Code session for the improvement pass.
# Run this after a handful of sessions (weekly is a good rhythm).
# Separate from loop.sh on purpose: reflection happens every session
# (cheap, append-only), improvement happens deliberately (edits skills
# and config, with you watching).
#
# Usage: ./agent/reflect.sh
set -euo pipefail

cd "$(dirname "$0")/.."

cfg() { grep -E "^$1:" agent/config.yaml | sed "s/^$1:[[:space:]]*//" ; }
CLAUDE_CMD="$(cfg claude_cmd)"
VAULT="$(cfg vault)"

exec $CLAUDE_CMD "Use the improve skill: read all notes in $VAULT/Reflections/ with proposed changes, plus MEMORY.md standing lessons. Apply the changes that have earned it, mark them applied, commit, and walk me through what you changed and why."
