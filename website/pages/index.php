<?php
/**
 * F · Frontispiece: the single entry point to this family's set.
 * It names the work, states the problem, and indexes what follows.
 * No figure: a frontispiece carries no argument. The install steps live on
 * the getting-started page, not here.
 */
$this->layout('partials::layout', [
    'title' => 'Loop & Gate · an agent that remembers, and the gates you work',
    'description' => 'A Foundation layer that gives an AI agent a memory across sessions, plus Build, Grow and Accountability kits that stop the loop at the gates where a human decides.',
    'path' => '/',
    'notFound' => false,
]);
?>
<section class="intro" aria-labelledby="project-title">
    <p class="t-smallcaps">shane logsdon · loop &amp; gate</p>
    <h1 id="project-title">The loop does the work.<br>You work the <span class="t-accent">gates.</span></h1>
    <p class="t-lead">A small stack for working with an AI agent: one Foundation layer
        that remembers you across sessions, and three kits that stop an agentic loop at
        the points where a human has to decide.</p>
    <p>Loop & Gate is the name for one specific way of working: the loop runs
        on its own, and it stops at a fixed set of gates where a human decides. It is the
        opinionated instance of what the field now calls loop engineering and
        human-in-the-loop control.</p>
    <a class="btn-arrow" href="/loop-and-gate/getting-started/">Start with the Foundation</a>
    <p class="t-meta guide-source">MIT licensed, and it needs a paid Claude plan. Pro or
        Max; the free plan does not include Claude Code.</p>
</section>

<section class="page-section" aria-labelledby="idea-title">
    <header class="index-head">
        <h2 id="idea-title" class="t-smallcaps-lg">the idea</h2>
        <span class="t-dateline">one pattern, four repos</span>
    </header>
    <div class="prose">
        <p>Most people meet an AI agent as a blank chat box. It is brilliant, and it
            forgets you the moment the window closes. It will build whatever you ask,
            including the wrong thing, confidently. And it has no opinion about whether
            you actually shipped the work you meant to.</p>
        <p>An agentic <em>loop</em> can run on its own most of the time. But it has to stop
            at a fixed set of <em>gates</em> where a human decides. The loop does the work
            between the gates; you work the gates. Each gate marks a place where the agent
            is weak: it can't tell a real problem from a loud one, it can't feel when an
            architecture will hurt in six months, it can't tell a demo from evidence, and
            left alone it will confidently build more than you asked.</p>
        <p>The gates are the asset. The tools that fill the space between them are a
            snapshot, and every kit says so in its own reference files: named, dated, and
            disposable on purpose. When the tools change, the gates don't.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="pieces-title">
    <header class="index-head">
        <h2 id="pieces-title" class="t-smallcaps-lg">the four pieces</h2>
        <span class="t-dateline">foundation first</span>
    </header>
    <div class="prose">
        <p>The Foundation sits underneath all three kits. The kits work better when it is
            there, because they can read your voice and taste and write what they learn
            back into your memory. One of them requires it. The other two can start
            without it.</p>
    </div>
    <dl class="facts">
        <div class="fact">
            <dt>The Foundation</dt>
            <dd>An agent that remembers: memory as plain markdown in an Obsidian vault,
                with no vector database, no server to stand up, and nothing to sign up for. It
                captures what you tell it, files it, and writes one honest lesson at the end
                of each session. A profile interview turns how you write and what good looks
                like to you into notes the kits can read.
                <a href="/loop-and-gate/getting-started/">Set it up<span aria-hidden="true"> →</span></a></dd>
        </div>
        <div class="fact">
            <dt>The Build Kit</dt>
            <dd>Eleven gates for an agentic build loop, sized by the master gate before any
                of them run. It sits on top of a build pipeline it does not ship: two free
                public plugins provide the loop between the gates.
                <a href="/loop-and-gate/kits/build/">The Build Kit<span aria-hidden="true"> →</span></a></dd>
        </div>
        <div class="fact">
            <dt>The Grow Kit</dt>
            <dd>The same method pointed at go-to-market: audience and the one claim, the
                design, the copy, the channel, and whether it worked. It requires the
                Foundation, because its design gate reads your taste profile and its copy
                gate reads your voice profile.
                <a href="/loop-and-gate/kits/grow/">The Grow Kit<span aria-hidden="true"> →</span></a></dd>
        </div>
        <div class="fact">
            <dt>The Accountability Kit</dt>
            <dd>The loop pointed at your own follow-through: eight gates, five daily
                rituals, and a deferral engine that counts the focus you keep skipping and
                forces the call at three strikes. Runs on Claude alone, with nothing else
                to install.
                <a href="/loop-and-gate/kits/accountability/">The Accountability Kit<span aria-hidden="true"> →</span></a></dd>
        </div>
    </dl>
</section>

<section class="page-section" aria-labelledby="fit-title">
    <header class="index-head">
        <h2 id="fit-title" class="t-smallcaps-lg">how they fit together</h2>
        <span class="t-dateline">build → grow → accountability</span>
    </header>
    <div class="prose">
        <p>You build something with the Build Kit. You take it to market with the Grow
            Kit, whose feedback gate reads whether it actually landed and writes those
            signals back into the Foundation vault. The Build Kit's first gate reads the
            same signals to decide what is worth building next. The Accountability Kit
            runs underneath the whole thing, so a stalled build or a launch that never
            went out gets caught at the nightly reckoning instead of quietly slipping.</p>
        <p>The Foundation is the shared bus in the middle. You do not need all four to get
            value: each kit stands on its own, with the one exception that Grow requires
            the Foundation. Start with what maps to your actual problem and add the rest
            when you feel the seam.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="status-title">
    <header class="index-head">
        <h2 id="status-title" class="t-smallcaps-lg">status</h2>
        <span class="t-dateline">four public repos</span>
    </header>
    <div class="prose">
        <p>All four repositories are public and MIT licensed. Each one installs with a
            <code>/plugin marketplace add</code> line of its own, or with a single
            <code>pi install</code>, and each can be cloned and used directly without a
            plugin at all.</p>
        <p><strong>A plugin install is not the full loop.</strong> The Foundation's
            <code>improve</code> skill rewrites the skill files as it learns, and that
            self-editing only persists in a clone, where the skills are your working copy.
            Installed as a plugin, the skills sit in a cache that is replaced on update, so
            the agent still evolves your memory but not its own instructions.</p>
        <p>Two qualifiers the sources state and this page keeps: the Build Kit's own status
            note lists the profile glue and a final package pass as still ahead, and the
            Foundation's no-terminal walkthrough is described as new and still being
            validated with first users. The gate counts and ritual names on the kit pages are
            the parts that are settled.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="next-title">
    <header class="index-head">
        <h2 id="next-title" class="t-smallcaps-lg">where to go</h2>
        <span class="t-dateline">six routes</span>
    </header>
    <ul class="link-list">
        <li>
            <a href="/loop-and-gate/getting-started/">Getting started<span aria-hidden="true"> →</span></a>
            <p>The Foundation, in order: a plan, the desktop app, the install, the vault,
                the first session, and the profile interview the Grow Kit depends on.</p>
        </li>
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/build-field-guide/">The Build Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>The narrative version of the eleven gates, with one real product carried
                through the whole build. Long-form writing, kept on the personal site.</p>
        </li>
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/grow-field-guide/">The Grow Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>The grow gates as essays rather than checklists, with the worked example
                carried through one launch.</p>
        </li>
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/accountability-field-guide/">The Accountability Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>Eight gates for following through, illustrated with the same honest story
                the other two guides use.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-foundation">Source on GitHub<span aria-hidden="true"> ↗</span></a>
            <p>The Foundation: skills, hooks, the setup script, the vault template, and
                <code>ARCHITECTURE.md</code> with the research behind each decision.</p>
        </li>
        <li>
            <a href="https://shane.logsdon.io/articles/strategic-insights/building-on-the-margins/">Building on the Margins<span aria-hidden="true"> ↗</span></a>
            <p>The essay this system came out of, on the personal site.</p>
        </li>
    </ul>
</section>
