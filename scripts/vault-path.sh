#!/usr/bin/env bash
# Single source of truth for the vault's absolute base path.
# Both the SessionStart hook and the skills resolve the vault through this, so
# they always agree — on a clone (cwd is the repo) and on a plugin install
# (cwd is anywhere; the vault lives outside the read-only plugin cache).
#
# Resolution order:
#   1. Recorded path written by setup  (~/.config/loop-and-gate/vault)
#   2. Clone convenience: the repo's own ./vault, but NEVER the plugin cache's
#      bundled vault — a plugin install must go through setup.
# Prints the absolute base to stdout, or nothing if unresolved (caller nudges
# the user to run the setup skill).
set -euo pipefail

recorded="$HOME/.config/loop-and-gate/vault"
if [ -f "$recorded" ]; then
  cat "$recorded"
  exit 0
fi

# No recorded path. Fall back ONLY for a clone — detect a plugin install by this
# script's own location and refuse to adopt its bundled vault.
case "$0" in
  */plugins/cache/*) : ;;  # plugin install: no local fallback, force setup
  *)
    base_dir="$(cd "$(dirname "$0")/.." 2>/dev/null && pwd)"
    # Optional clone override: an absolute vault: path in config.yaml.
    if [ -f "$base_dir/config.yaml" ]; then
      cfg_vault="$(grep -E '^vault:' "$base_dir/config.yaml" | sed 's/^vault:[[:space:]]*//')"
      case "$cfg_vault" in
        /*) [ -f "$cfg_vault/MEMORY.md" ] && { printf '%s\n' "$cfg_vault"; exit 0; } ;;
      esac
    fi
    # Otherwise the clone's own ./vault, if it exists (it's gitignored, so this
    # is only present if the user scaffolded one in place).
    if [ -f "$base_dir/vault/MEMORY.md" ]; then
      printf '%s\n' "$base_dir/vault"
      exit 0
    fi
    ;;
esac

# Unresolved — the caller (hook) nudges the user to /setup.
exit 0
