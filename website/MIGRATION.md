# Loop & Gate — migration map

Inventory of the Loop & Gate surface on the personal site
(`slogsdon/shane.logsdon.io`, Netlify, `https://shane.logsdon.io`), and where each
piece lands on this microsite. The personal site was read only: nothing in
`/Volumes/Dock/Code/shane.logsdon.io` was created, edited, or deployed for this
work. Redirects are **not applied here** — T15 applies them, after these
destinations are live.

Where "old" and "new" are the same URL, the page is *retained*: it keeps its
existing canonical, stays in the personal sitemap, and the new pages link to it
as the narrative version of the same material.

## 1. Product URLs

| Old URL (indexable?) | What it is | Old source file | New URL | Disposition |
|---|---|---|---|---|
| `https://shane.logsdon.io/loop-and-gate/` (yes — in `dist/sitemap.xml`) | Family hub: mental model, the four pieces, the from-scratch path, layering the kits, cross-device notes, suggested order, credits | `pages/loop-and-gate.php` | `https://projects.logsdon.io/loop-and-gate/` | **Moved, 301 at T15.** Content split across the new root, `/getting-started/` and the three kit pages — see §5. |
| `https://shane.logsdon.io/loop-and-gate/your-first-gate/` (live, and **not** in today's `dist/sitemap.xml` — but only because that file was last generated 2026-08-29, before this page existed on 2026-10-13. The flat-file build does not honour `draft: true` and `scripts/generate-sitemap.php` has no draft filter, so the next personal-site build lists it) | Hands-on setup walkthrough: get the Foundation folder, place the vault, run a first session | `pages/loop-and-gate/your-first-gate.md` | `https://projects.logsdon.io/loop-and-gate/getting-started/` | **Moved, 301 at T15.** Superseded by the Foundation's eight-step assembly order, which covers the same ground at greater depth. It is linked twice from the hub page, so it is live whether or not the sitemap knows about it. |
| `https://shane.logsdon.io/loop-and-gate/build-field-guide/` (yes) | Eleven-gate narrative field guide, one product carried through the whole build | `pages/loop-and-gate/build-field-guide.md` | unchanged — `https://shane.logsdon.io/loop-and-gate/build-field-guide/` | **Retained as editorial.** Long-form writing, ~327 lines, tied to the author's own project. New page `/loop-and-gate/kits/build/` links to it as the narrative version. No redirect. |
| `https://shane.logsdon.io/loop-and-gate/grow-field-guide/` (yes) | Grow-gate narrative field guide | `pages/loop-and-gate/grow-field-guide.md` | unchanged | **Retained as editorial.** Linked from `/loop-and-gate/kits/grow/`. |
| `https://shane.logsdon.io/loop-and-gate/accountability-field-guide/` (yes) | Eight-gate narrative field guide | `pages/loop-and-gate/accountability-field-guide.md` | unchanged | **Retained as editorial.** Linked from `/loop-and-gate/kits/accountability/`. |

Why the guides stay: `tasks/plan.md` keeps editorial articles on the personal
site and links them to the project site, and forbids redirecting distinct pages
to a home page. The guides are narrative essays, not product documentation, and
the kit repos call them "the narrative version" of the terse gate reference the
new pages carry. Moving them would mean either duplicating 850 lines of personal
essay or dropping it; neither is this task.

## 2. Public Markdown alternatives

| Candidate | Result |
|---|---|
| `/loop-and-gate/*.md` | **Do not exist.** `scripts/generate-md.php` writes Markdown alternates only for `resources/data/articles-list.json` entries, into `/articles/<category>/<slug>.md`, plus `/llms-full.txt`. The `pages/loop-and-gate/*.md` files are *sources* rendered to HTML by the flat-file generator; they are not published. Verified: `find dist -path '*loop-and-gate*'` returns four `index.html` files and the two `/images/loop-and-gate-*.png` social cards — no `.md` — and `dist/llms.txt` / `dist/llms-full.txt` contain no `loop-and-gate` mention. |
| `/llms-full.txt` | Contains articles only; no Loop & Gate body text. Nothing to carry over. |
| GitHub-side Markdown (`GETTING-STARTED.md`, `reference/gates.md`, `reference/grow-gates.md`, `reference/accountability-gates.md`, `reference/the-deferral-engine.md`) | Stays authoritative in its own repo. The new pages link to the files they summarize rather than copying them. |

So: **no Markdown alternative URL needs a redirect**, and none is being re-hosted
here.

## 3. Downloads and binary assets

| Asset | Referenced by | Disposition |
|---|---|---|
| `/images/loop-and-gate-og.png`, `/images/loop-and-gate-linkedin.png` | the hub page's `image` / social card | **Not migrated.** This microsite's shared layout emits `og:title`, `og:description`, `og:url` and `og:type` only — no `og:image`. The files stay where they are until T15 removes the hub page; they have no remaining consumer after that. |
| `/images/build-field-guide-hero.png`, `-og.png` | retained build guide | stays |
| `/images/grow-field-guide-hero.png`, `-og.png` | retained grow guide | stays |
| `/images/accountability-field-guide-hero.png`, `-og.png` | retained accountability guide | stays |
| `/images/your-first-gate-hero.png`, `-og.png` | `/loop-and-gate/your-first-gate/` only | **Orphaned by the T15 redirect.** Candidate for deletion in T15 after confirming no other reference; not referenced by this site. |

There is no ZIP, PDF, installer, or any other file download on a Loop & Gate URL
on the personal site. The only non-HTML artifacts are the images above.

## 4. Inbound links and references

Listed so T15 can update them in one pass; **none of these was edited**.

Personal site:

- `pages/work.php` — project list entry, `href => '/loop-and-gate/'`.
- `pages/about.php` — inline link to `/loop-and-gate/`.
- `pages/articles/technical-deep-dives/prompts-i-actually-reuse.md` — link to
  `https://shane.logsdon.io/loop-and-gate/`.
- The three retained field guides link back to `/loop-and-gate/` in their footer
  (`resources/partials/layouts/loop-and-gate-guide.php`), and each guide's
  frontmatter drives its own canonical, which stays unchanged.

GitHub (each repo README links the hub as "the whole stack"):

- `slogsdon/loop-and-gate-foundation` — `README.md`, "Going deeper".
- `slogsdon/loop-and-gate-build-kit` — `README.md`, "What this sits next to".
- `slogsdon/loop-and-gate-grow-kit` — `README.md`, "The whole stack".
- `slogsdon/loop-and-gate-accountability-kit` — `README.md`, "What this sits next to".

Repository `homepage` fields, observed 2026-11-02 in
`shane.logsdon.io/tasks/microsites-sources.json` (planning evidence, read-only):
all four Loop & Gate repos currently point `homepage` at
`https://shane.logsdon.io/loop-and-gate/`. Those four fields become stale when the
301 lands.

Out of scope: `/hermes-dispatch/` and its assets (excluded by the plan), and the
`DefinedTerm` JSON-LD block inside the old hub page.

## 5. Content map — where the hub page's sections went

| Old section (`/loop-and-gate/`) | New home |
|---|---|
| Hero, "the mental model" | `/loop-and-gate/` — intro + "the idea" |
| "a gate at work" (the retry-once memory example) | dropped from the site, stated in one line in "the idea" (the example is a story about memory, not a product claim; the field guides carry the long form) |
| "the pieces" (the four catalog entries) | `/loop-and-gate/` "the four pieces" (condensed) + one page per kit |
| "how they fit together" | `/loop-and-gate/` "how they fit together" |
| "from scratch" steps 01–05 | `/loop-and-gate/getting-started/` steps 1–8 |
| "layering in the kits" | the install section of each kit page, plus step 8 of getting started |
| "working across devices" | `/loop-and-gate/getting-started/#working-across-devices` |
| "a suggested order" | `/loop-and-gate/` "how they fit together" |
| "built on" (credits) | `/loop-and-gate/` "where to go" (`Building on the Margins`), and the Foundation's `ARCHITECTURE.md` for the full set |
| "get it" (repo links) | `/loop-and-gate/` "where to go" + each kit page |
| `DefinedTerm` JSON-LD | **not carried.** The shared `resources/partials/layout.php` has no slot for page-level JSON-LD, and the hub owns collection-level structured data. |
| `#working-across-devices` and `#step-01`…`#step-05` anchors | only `#working-across-devices` has a new equivalent (same id, new page). The numbered step anchors are not reproduced; deep links to them land on the new getting-started page without a matching fragment. |

## 6. New pages with no legacy equivalent

These are additions, not migrations — the old site had no per-kit page; kit
detail lived in each GitHub README and in the field guides.

- `/loop-and-gate/kits/build/`
- `/loop-and-gate/kits/grow/`
- `/loop-and-gate/kits/accountability/`

## 7. Redirect plan for T15 (not applied here)

Single hop, permanent, in `netlify.toml`, above the existing wildcard catch-alls:

```toml
[[redirects]]
from = "/loop-and-gate"
to = "https://projects.logsdon.io/loop-and-gate/"
status = 301
force = true

[[redirects]]
from = "/loop-and-gate/"
to = "https://projects.logsdon.io/loop-and-gate/"
status = 301
force = true

[[redirects]]
from = "/loop-and-gate/your-first-gate/"
to = "https://projects.logsdon.io/loop-and-gate/getting-started/"
status = 301
force = true
```

Do **not** redirect the three field guides. Leave them at their current paths,
with their current canonicals, and keep them in the personal sitemap.

Sitemap effect at T15: `scripts/generate-sitemap.php` walks `dist/` for
`index.html` files and has no draft filter, so deleting `pages/loop-and-gate.php`
and `pages/loop-and-gate/your-first-gate.md` removes exactly those two entries
from the regenerated sitemap and no others. `pages/loop-and-gate.php` is a page
file and `pages/loop-and-gate/*.md` are page files too, so removing the hub page
and the draft leaves the three guides building. Note that today's
`dist/sitemap.xml` is stale (2026-08-29) and does not yet list
`/loop-and-gate/your-first-gate/`; the next build would add it, which is another
reason to land the redirect and the deletions in the same pass.

Rollback: remove the three `[[redirects]]` blocks and restore the two deleted
page files. Nothing in this worktree depends on the personal site, so the
microsite can ship first and the redirects can be reverted independently.

## 8. Destination verification

Every new URL in §1 and §6 is emitted by `node scripts/build-site.ts` and checked
by it:

- `dist/loop-and-gate/{index.html,getting-started/index.html,kits/build/index.html,kits/grow/index.html,kits/accountability/index.html,404.html}` exist and are non-empty.
- `dist/loop-and-gate/sitemap.xml` lists exactly the five canonical pages, all
  with `lastmod` 2026-09-30 (the source revision date, not the build date). The
  404 is excluded.
- Each page carries a self-canonical and `og:url` under
  `https://projects.logsdon.io/loop-and-gate/`, so no destination canonicalizes
  back to an old URL.
- Every local link resolves inside the artifact. Every outbound link to
  `shane.logsdon.io` points at a page the personal site still publishes: the three
  retained field guides, the `Building on the Margins` article, `/about/` (footer
  attribution, from the shared layout), and the site root.

Not verified here: live 301 behaviour, Search Console canonical selection, and
the personal site's post-T15 sitemap. Those are T15/T16 gates and need
deployments, which this task does not perform.
