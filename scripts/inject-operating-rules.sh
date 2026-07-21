#!/usr/bin/env bash
# SessionStart hook (PLUGIN path only): injects this repo's CLAUDE.md — the
# operating layer (session protocol, behavior, hard rules) — into the session.
# A plugin's bundled CLAUDE.md is NOT on Claude Code's CLAUDE.md search path, so
# on a plugin install it otherwise never loads. On a CLONE, CLAUDE.md auto-loads
# from the repo root, so this self-skips to avoid a double copy.
#
# This is deliberately a SEPARATE SessionStart hook from session-start-hook.sh
# (which injects working memory). Hook output is capped at 10,000 characters PER
# STRING — over that, Claude Code offloads to a file and only a short preview
# reaches context. Memory + the full CLAUDE.md together exceed the cap, so they
# must be delivered as two independent hook outputs, each under 10k. Keep
# CLAUDE.md well under ~9,000 chars so this string (preamble + file + footer)
# stays under the cap; the guard below warns on stderr (not context) if it grows.
#
# stdout becomes session context.
set -euo pipefail

cd "$(dirname "$0")/.."

# Plugin path only. Detect by this script's own location — confirmed at runtime
# that Claude Code invokes the hook via a path under */plugins/cache/*, while a
# clone runs it from the project dir. Same test vault-path.sh uses.
case "$0" in
  */plugins/cache/*) ;;
  *) exit 0 ;;
esac

[ -f "CLAUDE.md" ] || exit 0

# Guard: warn (to stderr, which does NOT enter context) if the assembled block
# would breach the 10k cap and get offloaded — the exact bug this split fixed.
size=$(wc -c < "CLAUDE.md" | tr -d ' ')
if [ "$size" -gt 9000 ]; then
  echo "loop-and-gate: CLAUDE.md is ${size} bytes; operating-rules injection risks the 10k SessionStart cap." >&2
fi

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
echo "Precedence recap: the \"Hard rules\" above are absolute. Everything else here"
echo "is a default — your own CLAUDE.md, loaded earlier this session, overrides on"
echo "conflict."
echo "=== END LOOP & GATE OPERATING RULES ==="
