# ClaudePluginHub — how listings are scored

ClaudePluginHub (claudepluginhub.com) is a directory of Claude Code plugins. It
scores each listing and syncs from GitHub periodically. What raises a listing:

## Community health

Reads GitHub's **community profile**. Add the files GitHub checks — each present
file raises the profile:

- `LICENSE`, `README.md`, `CONTRIBUTING.md`, `CODE_OF_CONDUCT.md` — repo root
- `SECURITY.md`, `PULL_REQUEST_TEMPLATE.md`, `ISSUE_TEMPLATE/` — under `.github/`
  (GitHub also accepts root or `docs/` for most of these)

## Install instructions

The hub scans the README for an **"Install" section** — a heading whose text
contains "install". A section titled "Setup" is missed. Give each README a
top-level `## Install`.

## Documentation

Also wants **usage examples** (a `## Usage` section with real command examples)
and **screenshots** of the plugin running, one per plugin.

## Verified badge — two separate things

1. **Ownership claim** = the verified status. Sign in to claudepluginhub.com
   with GitHub (read-only: username + org membership), claim the plugin. Unlocks
   analytics, listing edits, and the verified badge. Manual, per repo.
2. **The markdown badge** you embed in the README:

   ```
   [![Listed on ClaudePluginHub](https://www.claudepluginhub.com/badge/slogsdon-<repo>)](https://www.claudepluginhub.com/plugins/slogsdon-<repo>?ref=badge)
   ```

   Plugin slug = `<github-owner>-<repo>` (e.g. `slogsdon-loop-and-gate-build-kit`).

"**Anthropic Verified**" is a different, review-gated badge (quality + safety
review) — not self-serve, no guarantee a community plugin gets it.

## Gotchas

- Nothing reaches the hub until commits are **pushed to GitHub** and the hub
  runs its next sync. Local commits score nothing.
- Direct fetches of claudepluginhub.com are Cloudflare-blocked (403 to
  WebFetch); use WebSearch or a real browser to read hub pages.
- The Foundation repo was renamed `second-brain-agent` → `loop-and-gate-foundation`;
  GitHub redirects the old name, but use the canonical one in links.

Related: [[launch-assets]] (its demo shot-list frames double as the required
listing screenshots), [[launch-strategy]]
