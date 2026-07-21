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

# MEMORY.md goes first among the memory sections ON PURPOSE: kept stable
# (read-only mid-session), it anchors the mutable part of the prompt-cache
# prefix. The inject-operating-rules.sh hook runs before this one, so the even
# more stable CLAUDE.md sits above it — the two form the stable prefix together.
# Don't reorder these sections.
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
