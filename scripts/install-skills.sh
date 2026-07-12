#!/usr/bin/env bash
# Symlinks the four skills into this project's .claude/skills/ so
# Claude Code discovers them when run from the repo root.
# Symlink (not copy) so the "improve" skill can edit skills in place
# and the change is immediately live.
set -euo pipefail

cd "$(dirname "$0")/.."
repo="$(pwd)"

mkdir -p .claude/skills

for skill in session-start capture inbox-triage profile-interview reflect improve loop; do
  dst=".claude/skills/$skill"
  if [ -L "$dst" ] || [ -e "$dst" ]; then
    rm -rf "$dst"
  fi
  ln -s "../../skills/$skill" "$dst"
  echo "installed: $skill -> .claude/skills/$skill"
done

echo "Skills installed. Claude Code will pick them up when run from $repo"
