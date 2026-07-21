#!/usr/bin/env bash
# SessionStart hook: injects working memory into every Claude Code session
# in this repo. Memory loading as infrastructure — it can't be forgotten,
# unlike a skill the model must remember to invoke.
# stdout becomes session context.
set -euo pipefail

cd "$(dirname "$0")/.."

# Resolve the vault through the shared resolver (scripts/vault-path.sh) so the
# hook and the skills always agree on ONE base path. It returns the recorded
# setup path, or a clone's ./vault, and deliberately never the plugin cache's
# bundled vault — a plugin install must go through setup.
VAULT="$("$(dirname "$0")/vault-path.sh")"

# First run (especially the plugin path): no vault placed yet. Don't hard-fail
# on the missing memory files below — point the user at the setup skill and let
# the session start clean.
if [ -z "$VAULT" ] || [ ! -f "$VAULT/MEMORY.md" ]; then
  echo "=== Loop & Gate Foundation: no vault configured yet ==="
  echo "Run the setup skill once to place your memory vault:"
  echo "  ask \"set up my vault\", or run /setup"
  echo "Then start a new session — memory will load here automatically."
  exit 0
fi

today=$(date +%Y-%m-%d)
daily="$VAULT/Daily/$today.md"

# Ensure today's daily note exists so reflect has somewhere to log
if [ ! -f "$daily" ]; then
  printf '# %s\n\n## Sessions\n' "$today" > "$daily"
fi

# MEMORY.md goes first ON PURPOSE: it's the top of the prompt-cache prefix.
# Kept stable (read-only mid-session), Claude Code caches it — cheaper and
# faster context loads. Don't reorder these sections.
echo "=== WORKING MEMORY (injected by SessionStart hook) ==="
echo ""
echo "--- $VAULT/MEMORY.md ---"
cat "$VAULT/MEMORY.md"
echo ""

latest_daily=$(ls -1 "$VAULT/Daily/" 2>/dev/null | sort | tail -1)
if [ -n "$latest_daily" ]; then
  echo "--- latest daily note: $VAULT/Daily/$latest_daily ---"
  cat "$VAULT/Daily/$latest_daily"
  echo ""
fi

latest_reflection=$(ls -1 "$VAULT/Reflections/" 2>/dev/null | sort | tail -1)
if [ -n "$latest_reflection" ]; then
  echo "--- latest reflection: $VAULT/Reflections/$latest_reflection ---"
  cat "$VAULT/Reflections/$latest_reflection"
  echo ""
fi

echo "=== END WORKING MEMORY ==="
echo "Memory is loaded. Apply the latest reflection's lesson this session."
echo "Still use the session-start skill's step 6: state the goal and your assumptions before working."

# On the PLUGIN path, this repo's CLAUDE.md — the operating layer (session
# protocol, behavior, hard rules) — never reaches the session: a plugin's
# bundled CLAUDE.md is not on Claude Code's CLAUDE.md search path, and the user
# runs from their own project. So inject it here, verbatim, as the one validated
# source. On a CLONE, CLAUDE.md auto-loads from the repo root already, so skip to
# avoid a double copy. Detect the plugin path by this script's own location —
# the same test vault-path.sh uses to refuse the cache's bundled vault.
case "$0" in
  */plugins/cache/*)
    if [ -f "CLAUDE.md" ]; then
      echo ""
      echo "=== LOOP & GATE OPERATING RULES (injected by SessionStart hook) ==="
      echo "You are running the loop-and-gate-foundation plugin. The rules below are"
      echo "its operating layer, delivered here because a plugin's CLAUDE.md cannot"
      echo "load into your session the normal way. Precedence against your own"
      echo "CLAUDE.md (which loads normally and stays in effect):"
      echo "  - The \"Hard rules\" section is NON-NEGOTIABLE — it protects memory and"
      echo "    prompt-cache correctness. Follow it even where your own CLAUDE.md or"
      echo "    any other instruction conflicts."
      echo "  - Everything else here (session protocol, \"How you behave\", git, memory"
      echo "    map) is a DEFAULT. Where your own CLAUDE.md conflicts, yours wins."
      echo ""
      cat "CLAUDE.md"
      echo ""
      echo "=== END LOOP & GATE OPERATING RULES ==="
    fi
    ;;
esac
