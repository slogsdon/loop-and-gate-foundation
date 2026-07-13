#!/usr/bin/env bash
# SessionStart hook: injects working memory into every Claude Code session
# in this repo. Memory loading as infrastructure — it can't be forgotten,
# unlike a skill the model must remember to invoke.
# stdout becomes session context.
set -euo pipefail

cd "$(dirname "$0")/.."

VAULT="vault"
[ -f config.yaml ] && VAULT="$(grep -E '^vault:' config.yaml | sed 's/^vault:[[:space:]]*//')"

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
