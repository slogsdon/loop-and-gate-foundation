# Loop & Gate — microsite

Static microsite for the Loop & Gate family, served at
`https://projects.logsdon.io/loop-and-gate/`.

Sources, all read-only from this worktree (branch `feature/website`):

| Repo | Revision | What it supplied |
|---|---|---|
| `slogsdon/loop-and-gate-foundation` | `2f0fe5234102cd8ae2beea1ce4fdac80c2d0721c` (this worktree's HEAD) | `README.md`, `GETTING-STARTED.md`, `ARCHITECTURE.md`, `skills/`, `config.yaml` |
| `slogsdon/loop-and-gate-build-kit` | `9f07b86a53d46379f0be2a054ea2d8ec4d4d01b6` | `README.md`, `GETTING-STARTED.md`, `reference/gates.md`, `reference/pipeline-snapshot.md` |
| `slogsdon/loop-and-gate-grow-kit` | `9e9b3405299eaa237d68b22849a1516814df9903` | `README.md`, `GETTING-STARTED.md`, `reference/grow-gates.md`, `reference/tools.md` |
| `slogsdon/loop-and-gate-accountability-kit` | `3223792dd57889ba10e9c2afa52824b7891d9c30` | `README.md`, `GETTING-STARTED.md`, `reference/accountability-gates.md`, `reference/the-deferral-engine.md` |

Plus the legacy product page and field guides on the personal site
(`slogsdon/shane.logsdon.io`, read-only), inventoried in `MIGRATION.md`.

All four source revisions are dated 2026-09-30, which is therefore `site.json`'s
`lastmod` and the sitemap's `lastmod`.

## Build

Node 26.12.0, PHP 8.3+, and Composer are required.

```sh
cd website
composer install --no-interaction --prefer-dist
npm install                        # or npm ci once the lock is committed
node scripts/build-site.ts         # SITE_NOINDEX=1 by default: preview, noindex
SITE_NOINDEX=0 node scripts/build-site.ts   # indexable production artifact
```

Output is a physical subtree at `website/dist/loop-and-gate/`, plus
`dist/_headers` in preview builds. Nothing else is written at the `dist/` root:
the hub owns `/robots.txt`, `/sitemap.xml`, and the slashless `/loop-and-gate`
redirect.

Packaging (local only; neither command deploys):

```sh
npm ci
npx --no-install cf build --mode microsite
npx --no-install cf build --mode microsite-production
```

## Pages

`scripts/build-site.ts` discovers canonical pages recursively from `pages/` —
`index.php` → `/`, `kits/build.php` → `/kits/build/` — and asserts one HTML file per
page plus the 404:

| File | URL |
|---|---|
| `pages/index.php` | `/loop-and-gate/` — F · Frontispiece (family intro, foundation-first) |
| `pages/getting-started.php` | `/loop-and-gate/getting-started/` — D · Assembly Order (the Foundation, 8 dependent steps) |
| `pages/kits/build.php` | `/loop-and-gate/kits/build/` — the Build Kit |
| `pages/kits/grow.php` | `/loop-and-gate/kits/grow/` — the Grow Kit |
| `pages/kits/accountability.php` | `/loop-and-gate/kits/accountability/` — the Accountability Kit |
| `pages/404.html.php` | `/loop-and-gate/404.html` — G · Recovery |

The shared layout's primary nav is fixed ("Getting started", "Source",
"Projects"), so the kit pages cross-link in the body instead: the root page's
"the four pieces" and "where to go" lists, and each kit page's "where to go".

## One file drives the site

`site.json` holds the values the build and the pages need — `slug`, `name`,
`origin`, `description`, `lastmod` — plus the `source` URL. `scripts/build-site.ts`
validates them, exports them to the PHP layout as `SITE_SLUG`, `SITE_NAME`,
`SITE_ORIGIN`, `SITE_SOURCE` and `SITE_NOINDEX`, and mounts every emitted URL under
`/loop-and-gate/`.

## What the build asserts

Unchanged from the collection skeleton: required artifacts exist and are
non-empty; nothing named `_redirects`, `robots.txt`, `sitemap.xml`, `index.html`
or `404.html` sits at the `dist/` root; every HTML page has exactly one `<h1>`, a
unique `<title>`, a meta description, the skip link, the `main` landmark and the
primary `nav`; canonical and `og:url` equal
`https://projects.logsdon.io/loop-and-gate/<path>` and the 404 carries neither;
the `noindex` meta matches `SITE_NOINDEX`; the footer links both
`https://projects.logsdon.io/` and `https://shane.logsdon.io/`; no
`href`/`src` is root-relative outside `/loop-and-gate/`; every local link target
exists in the artifact; and the sitemap lists exactly the five canonical pages
with `lastmod` from `site.json`.

## Content and design provenance

- Content is derived from the four source revisions above and from the legacy
  personal-site page. Nothing is copied wholesale: each kit README's framing is
  rewritten, the gate lists are condensed to a table of questions and lenses, and
  the worked examples are tightened. Kit-specific install commands are quoted
  verbatim, because a paraphrase of a command is a bug.
- Status qualifiers are kept as the sources state them: the Build Kit's own
  status note lists profile glue and a final package pass as still ahead; the
  Foundation's no-terminal walkthrough is "new and being validated with first
  users"; the plugin install does not persist skill self-edits; the tool snapshots
  are dated (build pipeline and grow tools verified 2026-07-12 by the source) and
  labelled disposable. No benchmark, percentage, savings figure, or testimonial is
  published — the sources contain none.
- The three field guides stay on the personal site as editorial and are linked,
  not duplicated: see `MIGRATION.md` §1.
- `public/assets/tokens.css`, the fonts, `assets/fonts/LICENSES.txt` and the first
  part of `public/assets/site.css` are the collection hub's, unmodified;
  `design/provenance.json` records their origin. The appended "Project microsite
  additions" section is also untouched: the pages use only rules that were already
  there (`.intro--compact`, `.page-section`, `.prose`, `.facts`, `.link-list`,
  `.table-wrap`, `.assembly`, `.harness`, `.guide-source`, `.btn-arrow`). No new
  colors, no new weights.
- No client JavaScript, no images, no analytics.

## Migration

`MIGRATION.md` is the T11 deliverable: every old Loop & Gate product URL, field
guide, public Markdown alternative, download, asset and inbound reference, each
with a disposition — moved, retained, or newly added — plus the single-hop 301
plan for T15 and the rollback.

Headline: `/loop-and-gate/` and `/loop-and-gate/your-first-gate/` move here; the
three field guides stay where they are (editorial, canonicals unchanged) and are
linked from the kit pages; no public Markdown or download exists to migrate.

## Verified here

- `composer install`, `node scripts/build-site.ts` (preview and `SITE_NOINDEX=0`),
  and every assertion listed above.
- `npm ci` and both `npx --no-install cf build` modes (packaging only, no deploy).
- The absence of out-of-namespace root-relative URLs, and the preview/production
  indexing difference (`dist/_headers` and the robots meta present only when
  `SITE_NOINDEX=1`).
- Every old-to-new mapping in `MIGRATION.md` §1 and §6 resolves to a page that
  exists in `dist/loop-and-gate/`.
- Title uniqueness and the "contains the project name" rule, compared against the
  HTML-escaped name (`Loop &amp; Gate`).

## Not verified here (Unverified)

No product command was executed while building this site. Every command below is
quoted from the source revision named beside it; none was run (Claude Code, pi,
and the plugins are not installed in this build environment).

- `/plugin marketplace add slogsdon/loop-and-gate-foundation`,
  `/plugin marketplace add slogsdon/loop-and-gate-build-kit`,
  `/plugin marketplace add slogsdon/loop-and-gate-grow-kit`,
  `/plugin marketplace add slogsdon/loop-and-gate-accountability-kit` — from each
  repo's `README.md` (Install) and `GETTING-STARTED.md`.
- `pi install git:github.com/slogsdon/loop-and-gate-{foundation,build-kit,grow-kit,accountability-kit}`
  — foundation `README.md` (Or install in pi); each kit `README.md` (Using pi?).
- `npm install -g @anthropic-ai/claude-code`, `git clone
  https://github.com/slogsdon/loop-and-gate-foundation.git`, `cd
  loop-and-gate-foundation`, `claude`, `claude --remote-control` — foundation
  `README.md` (Install, Working across devices).
- `./scripts/setup.sh ~/my-vault` — foundation `README.md` (Advanced /
  non-interactive). The bare-script path is documented as clone-only; the plugin
  path finds the script in its cache instead.
- `"remoteControlAtStartup": true` in `settings.json`, `"vault"` in
  `config.yaml`, `~/.config/loop-and-gate/pi-deps-declined` — foundation
  `README.md`. Read, not exercised.
- The `add-kits` offer, the `improve` pass, `profile-interview`, `inbox-triage`,
  `verify`, and the `loop` skill's subagent dispatch — foundation `README.md`.
  Described from the docs; no session was run.
- The pipeline installs `/plugin marketplace add obra/superpowers-marketplace`,
  `/plugin install superpowers@superpowers-marketplace`, `/plugin marketplace add
  addyosmani/agent-skills`, `/plugin install agent-skills@addy-agent-skills`,
  `pi install git:github.com/obra/superpowers`,
  `pi install git:github.com/addyosmani/agent-skills` — build-kit
  `GETTING-STARTED.md` and `reference/pipeline-snapshot.md`.
- The design and copy installs `/plugin marketplace add
  slogsdon/claude-code-config`, `/plugin install
  skills-design@slogsdon-claude-code-config`, `/plugin install
  skills-writing@slogsdon-claude-code-config`, `pi install
  git:github.com/slogsdon/skills-design`, `pi install
  git:github.com/slogsdon/skills-writing` — grow-kit `GETTING-STARTED.md` and
  `reference/tools.md`.
- Every ritual command (`/morning`, `/log`, `/eod`, `/plan-tomorrow`,
  `/weekly-signals`, `/decide`), `/loop-and-gate`, `/grow-and-gate`, and
  `/skill:setup` — each repo's `README.md` and `GETTING-STARTED.md`.
- The three-strike pattern alert's wording — accountability-kit
  `reference/the-deferral-engine.md`. Quoted from the reference; no run produced
  it.
- The gate counts (11 including ∞ for build, 8 including ∞ for accountability,
  ∞ + G0–G6 across three cadences for grow), the lens/mode/rhythm assignments, and
  the deferral-engine mechanics — the `reference/*.md` files. Read, not exercised.
- "Most grow gates have no tool at all" and the tool footprint — grow-kit
  `reference/tools.md`, whose snapshot is dated 2026-07-12. Published as the
  source's dated claim, with the date and the "disposable" label intact.
- macOS/iCloud defaults, the `~/second-brain` fallback, the Windows Git
  requirement, and the iCloud offload caveat — foundation `README.md` and
  `GETTING-STARTED.md`. The site does not claim to have reproduced them on any
  platform.

## Deployment

Published 2026-11-09 with a manual deploy from this directory. There is no Workers
Builds connection yet, so a content change needs the same steps:

```sh
npm ci
npm run build:production
npx --no-install cf build --mode microsite-production
npx --no-install cf deploy --prebuilt --mode microsite-production
```

Before going live, the site was checked on a noindex Worker Preview from
`npx --no-install cf previews deploy microsite --mode microsite`. The hub owns the
hostname (`projects.logsdon.io`), the sitemap index, and the slashless redirect;
this Worker claims only `projects.logsdon.io/loop-and-gate/*`.
