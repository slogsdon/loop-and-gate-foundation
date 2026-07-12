#!/usr/bin/env bash
# Main entry point: runs one agent session per iteration, each with a FRESH
# context (this is what keeps the loop reliable — no confusion carryover).
# Memory persists between iterations only through vault files.
#
# Usage:
#   ./agent/loop.sh "goal for this run"
#   ./agent/loop.sh            # resumes open items from the last daily note
set -euo pipefail

cd "$(dirname "$0")/.."
repo="$(pwd)"

# -- read config (grep, no yaml parser needed) --------------------------------
cfg() { grep -E "^$1:" agent/config.yaml | sed "s/^$1:[[:space:]]*//" ; }
VAULT="$(cfg vault)"
CLAUDE_CMD="$(cfg claude_cmd)"
MAX_ITER="$(cfg max_iterations)"
AUTO="$(cfg auto_continue)"
MODEL="$(cfg model)"

GOAL="${1:-}"
[ -n "$MODEL" ] && MODEL_FLAG="--model $MODEL" || MODEL_FLAG=""

for i in $(seq 1 "$MAX_ITER"); do
  echo ""
  echo "=== iteration $i/$MAX_ITER ==="

  # Each iteration is one fresh Claude session. The session-start skill
  # loads memory; the capture/reflect skills write it back.
  prompt="Use the session-start skill to load memory, then work on this goal.
Goal: ${GOAL:-Resume the most recent open item from the latest note in $VAULT/Daily/. If nothing is open, say so and stop.}
When the goal is done or you are blocked, use the capture skill to save what you learned, then use the reflect skill to close the session. If you are blocked on the user, say BLOCKED and what you need. If everything is done, say DONE."

  # shellcheck disable=SC2086
  output=$($CLAUDE_CMD -p "$prompt" $MODEL_FLAG --permission-mode acceptEdits 2>&1 | tee /dev/stderr) || {
    echo "claude exited non-zero; stopping loop."
    exit 1
  }

  # Commit memory changes so every iteration is auditable (git log = audit trail)
  git add -A "$VAULT" 2>/dev/null || true
  git diff --cached --quiet || git commit -q -m "chore: memory update after loop iteration $i"

  case "$output" in
    *DONE*)    echo "Loop finished: goal complete."; exit 0 ;;
    *BLOCKED*) echo "Loop stopped: agent is blocked on you. See output above."; exit 0 ;;
  esac

  if [ "$AUTO" != "true" ]; then
    printf "Continue to next iteration? [y/N] "
    read -r ans
    [ "$ans" = "y" ] || { echo "Stopped by user."; exit 0; }
  fi
done

echo "Hit max_iterations ($MAX_ITER). Raise it in agent/config.yaml if the goal needs more."
