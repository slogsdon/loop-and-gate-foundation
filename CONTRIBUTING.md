# Contributing to loop-and-gate-foundation

Thanks for wanting to help. This is a small, opinionated project — plain
markdown skills, two shell scripts, and a SessionStart hook. Contributions that
keep it small and sharp are very welcome.

## Reporting bugs

Open a [bug report](.github/ISSUE_TEMPLATE/bug_report.md) issue. Include your
Claude Code version, install method (clone or plugin), OS, and the exact steps
plus any error output. A minimal repro beats a long description.

Never paste credentials, tokens, or private vault contents into an issue. For
anything security-sensitive, follow [SECURITY.md](.github/SECURITY.md) instead
of opening a public issue.

## Proposing skill or hook changes

Skills live in `skills/` and hook wiring in `hooks/` + `.claude/`. Before
proposing a change:

1. **Open a feature request first** for anything non-trivial, so the design can
   be discussed before you write it. Small fixes (a typo, a broken link, a
   clarified sentence) can go straight to a PR.
2. **Match the existing style.** Skills are terse, imperative, and scoped to one
   procedure. Don't add speculative structure or "for later" scaffolding.
3. **Keep changes surgical.** Touch only what the change needs. Don't reorganize
   the vault layout, rename notes, or reformat unrelated files.

### The improve gate is by design

The `improve` skill lets the agent edit its own skills — but only from lessons
that have come up **more than once**, with every change committed for human
review, and never weakening its own gates. That gate is the core safety property
of the whole system, not an inconvenience to route around.

**Pull requests that weaken this gate will be declined.** That includes: making
`improve` apply single-occurrence signals, removing the human-review commit
step, letting a skill edit `skills/improve/SKILL.md` to relax its own rules, or
deleting the Daily/Reflections audit trail. If you think a gate genuinely needs
to change, open an issue and make the case first.

## Pull request conventions

- **Branch names:** `feature/<short-desc>`, `fix/<short-desc>`, or
  `chore/<short-desc>`.
- **Commits:** [Conventional Commits](https://www.conventionalcommits.org) —
  `feat:`, `fix:`, `docs:`, `refactor:`, `test:`, `chore:`. Small, atomic
  commits, one logical unit each.
- **Scope:** one concern per PR. Keep the diff as small as the change allows.
- **Docs:** update the README or relevant reference docs in the same PR as the
  behavior change.

By contributing, you agree your contributions are licensed under the project's
[MIT License](LICENSE).
