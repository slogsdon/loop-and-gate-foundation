---
name: profile-interview
description: Bootstrap the user's voice profile and taste profile by interviewing them, one question at a time. Use when vault/Profiles/ is empty or stale, or when the user says "build my voice profile" / "taste interview" / "teach the agent how I write". Produces reference docs other skills read so the agent can write in the user's voice and make on-taste calls.
---

# Profile Interview

One job: extract how the user writes and how they judge, into two reference
documents precise enough that a skill with no memory of them could still write
in their voice and make a call they'd agree with.

Two profiles, run as two separate interviews:

- **Voice** → `vault/Profiles/voice-profile.md`. Writing DNA. Consumed by any
  skill that produces prose — nothing publishes in a voice the kit hasn't been
  taught.
- **Taste** → `vault/Profiles/taste-profile.md`. Design and product judgment.
  Consumed at gates where the agent has to decide what's on-brand, what reads
  as slop, what's worth building. This is how the agent covers a lens the user
  doesn't have yet.

Ask which one to run. Default to voice first (immediately useful), taste second.

## How to interview

- **One question at a time. Wait for the answer before the next.** Never batch.
- **Push on vague answers.** "I like it simple" → "Simple how? Show me simple
  done right and simple done lazy." Extract the truth people can't self-report.
- **Ask for real examples.** "Show me a sentence you've written that does this."
- **Call out contradictions.** If an answer clashes with an earlier one, say so.
- **Follow the thread.** When something unusual surfaces, dig there before
  moving on. The category list is a map, not a script.
- **Don't accept "I don't know" cheaply.** Reframe, approach from another angle.
- **The user can stop anytime.** On "that's enough" / "compile it", write the
  profile from what you have and note which areas are thin. A partial profile
  beats no profile. The interview is re-runnable to deepen it later.

Depth is the user's call: a **quick** pass (~15 questions, the essentials) or a
**full** pass (the whole map below, ~80–100 questions). Ask which.

## Voice interview — the map

Cover these. Counts are for a full pass, scale down for quick.

- **Beliefs & contrarian takes** (15) — what they believe that their field
  doesn't; hot takes they'd defend; conventional wisdom they think is wrong.
- **Writing mechanics** (20) — how they *actually* write vs. how they think
  they do; default sentence shapes; how they open and close; punctuation,
  formatting, line breaks; words they overuse, love, would never use.
- **Aesthetic crimes** (15) — what makes them cringe in others' writing;
  phrases like nails on a chalkboard; what reads as lazy.
- **Voice & personality** (15) — humor; serious vs. casual tone; how they
  handle disagreement; excited vs. skeptical.
- **Structural preferences** (15) — how they organize; lists/headers/bullets;
  transitions; default structures.
- **Hard nos** (10) — what they'd never write about; approaches they'd never
  take; lines they won't cross.
- **Red flags** (10) — what makes them instantly distrust a piece; signals
  someone doesn't know what they're talking about.

## Taste interview — the map

- **Design judgment** (15) — products/sites/objects they admire and *why*
  (push past "clean"); what reads as slop; their reaction to specific
  this-vs-that pairs you show them.
- **Product judgment** (15) — what's worth building vs. over-engineered; how
  they tell a real problem from a loud one; what "good enough to ship" means.
- **Brand & tone** (10) — what on-brand feels like for their work; adjectives
  they want, adjectives they refuse.
- **Hard nos & red flags** (10) — design/product patterns they'd never ship;
  what makes them distrust a product on sight.

## Output

Write the profile as a full reference doc — not a summary. Preserve answers,
don't compress them away.

```markdown
# Voice Profile — <name>     (or Taste Profile — <name>)

## Core Identity
<3 sentences — the only summary section>

## <Category>
**Q: <the question you asked>**
<their answer, kept in their words>
... (every answered question, grouped by category)

## Quick Reference Card
**Always:** <specific patterns to follow, pulled from answers>
**Never:** <specific things to avoid>
**Signature phrases & structures:** <real examples they gave>
**Calibration quotes:** <key lines that capture the tone/judgment>
```

Then add the one-line index entry in `vault/MEMORY.md` under `## Knowledge
index` (or a `## Profiles` line if you add one), e.g.
`- [Voice Profile](Profiles/voice-profile.md) — how I write; read before drafting prose`.

## Rules

- The profile is the user's, in the user's words. Don't sand their answers into
  neutral prose — the specificity *is* the value.
- One topic per file: voice and taste stay separate documents.
- Re-running refines, never wipes: merge new answers into the existing profile,
  keep git history for the rest.
- The Quick Reference Card is what other skills read most — keep it sharp and
  concrete, no vague adjectives.
