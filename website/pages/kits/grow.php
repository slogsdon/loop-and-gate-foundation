<?php
/**
 * The Grow Kit: the authoritative product page for one kit in the family.
 * Derived from the grow-kit repo's README.md, reference/grow-gates.md,
 * reference/tools.md and GETTING-STARTED.md.
 */
$this->layout('partials::layout', [
    'title' => 'The Grow Kit · Loop & Gate',
    'description' => 'The same judgment method pointed at go-to-market: audience and the one claim, the design, the copy, the channel, and whether it worked. Requires the Loop & Gate Foundation.',
    'path' => '/kits/grow/',
    'notFound' => false,
]);
?>
<section class="intro intro--compact" aria-labelledby="kit-title">
    <p class="t-smallcaps">loop &amp; gate · grow kit</p>
    <h1 id="kit-title">The Grow <span class="t-accent">Kit.</span></h1>
    <p class="t-lead">A judgment layer for taking software to market with an agentic loop.
        Anyone can install the tools that generate design and draft copy. Almost nobody knows
        where to intervene — whether the design is actually yours, whether the copy is true,
        which audience is really yours, and whether this is worth shipping now.</p>
    <a class="btn-arrow" href="#install">Install it</a>
</section>

<section class="page-section" aria-labelledby="what-title">
    <header class="index-head">
        <h2 id="what-title" class="t-smallcaps-lg">what it is</h2>
        <span class="t-dateline">the other half of the loop</span>
    </header>
    <div class="prose">
        <p>A growth loop can generate designs, draft posts, spin variants, and schedule them on
            its own, and it should. But it can't tell tasteful from on-trend slop, it can't
            feel when a claim is technically true but sounds like a lie, it can't read which
            audience is actually yours, and left alone it will confidently blast a good message
            into the wrong channel at the wrong time. So the loop stops at fixed points and
            waits for you.</p>
        <p>This is the build side's mirror image. In Loop & Gate, the Build Kit takes an idea
            to shipped software; this kit takes shipped software to the right people and reads
            whether it worked. They close a loop through the Foundation vault: this kit's last
            gate writes market signals where the Build Kit's first gate picks them up to decide
            what to build next.</p>
        <p><strong>It is not</strong> the design or copy tooling — it sits on top of two public
            skills for that — and it is not an autopilot. Every gate stops for your
            decision.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="foundation-title">
    <header class="index-head">
        <h2 id="foundation-title" class="t-smallcaps-lg">it needs the Foundation</h2>
        <span class="t-dateline">not optional</span>
    </header>
    <div class="prose">
        <p>The design gate checks output against your <strong>taste profile</strong> and the
            copy gate against your <strong>voice profile</strong>, and both live in the
            Foundation. Set that up and run its profile interview first, or those two gates are
            just guessing. The kit's own tools reference says the same thing twice: Grow
            requires the Foundation, it doesn't just recommend it.</p>
        <p><a href="/loop-and-gate/getting-started/">The Foundation's getting-started page</a>
            covers the install, the vault, and the profile interview — step 6 is the one this
            kit depends on.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="gates-title">
    <header class="index-head">
        <h2 id="gates-title" class="t-smallcaps-lg">the gates</h2>
        <span class="t-dateline">three rhythms</span>
    </header>
    <div class="prose">
        <p>Unlike the build side, these don't run in one straight pass. Growth is three
            cadences, and a gate belongs to the rhythm it runs on. Gate ∞ runs every time and
            decides how much a given piece or campaign earns: a reply in a thread gets a glance
            at voice and a send; a launch page gets the full per-piece set.</p>
    </div>
    <div class="table-wrap">
        <table>
            <caption class="t-smallcaps">the grow gates, by cadence</caption>
            <thead>
                <tr><th scope="col">Cadence</th><th scope="col">Gate</th><th scope="col">The question</th><th scope="col">Lens</th></tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">every time</th>
                    <td>∞</td>
                    <td>How much does this piece deserve? Read reach and permanence first, and
                        let them set the process.</td>
                    <td>All, above the others</td>
                </tr>
                <tr>
                    <th scope="row" rowspan="2">strategy<br>(set periodically, reused)</th>
                    <td>1</td>
                    <td>Who's the audience, and what do they need to hear? A person in a
                        situation, mapped with the four switching forces — push, pull, habit,
                        anxiety — and written to the force that is actually binding.</td>
                    <td>Positioning</td>
                </tr>
                <tr>
                    <td>6-define</td>
                    <td>What would “it worked” even mean? Name the observable outcome before you
                        make the thing, so the feedback cadence has something real to read.</td>
                    <td>Positioning</td>
                </tr>
                <tr>
                    <th scope="row" rowspan="5">per-piece<br>(every artifact)</th>
                    <td>0</td>
                    <td>Ready to show? Is the destination worth the attention you're about to
                        drive to it? A great post pointing at a rough landing page wastes a
                        first impression.</td>
                    <td>Experience</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>What's the one claim? One piece, one point — the one true thing that
                        speaks to the binding force, not the longest feature list.</td>
                    <td>Positioning</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Does the design carry it, on-brand, not slop? On-brand isn't “looks
                        nice,” it's “could only be us.”</td>
                    <td>Design</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Is the copy true, in voice, nothing fabricated? Check every specific
                        against reality — a number, a testimonial, a capability claim.</td>
                    <td>Content</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Right channel, format, time? Put the piece where the audience already
                        gathers, in a window you can be around to reply in.</td>
                    <td>Marketing / Content</td>
                </tr>
                <tr>
                    <th scope="row">feedback<br>(continuous)</th>
                    <td>6-measure</td>
                    <td>What happened, and did it feed the next build? Read the outcome you
                        named at 6-define, and write the signal where the build side will read
                        it.</td>
                    <td>Positioning and Marketing</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="prose">
        <p>Order for a single artifact: ∞ → 0 → 2 → 3 → 4 → 5. On a rhythm, run 6-measure and
            feed what you learn back to the build side. That last step is where the loop
            closes.</p>
    </div>
</section>

<section class="page-section" id="install" aria-labelledby="install-title">
    <header class="index-head">
        <h2 id="install-title" class="t-smallcaps-lg">install</h2>
        <span class="t-dateline">Foundation first</span>
    </header>
    <div class="assembly">
        <section class="assembly__step" aria-labelledby="install-1-title">
            <span class="assembly__num" aria-hidden="true">01</span>
            <h3 id="install-1-title" class="t-headline-sm">Set up the Foundation</h3>
            <div class="prose">
                <p>Not a prerequisite you can skip: the profiles this kit reads come from there.
                    Follow <a href="/loop-and-gate/getting-started/">the Foundation's assembly
                    order</a>, and run the profile interview — a conversation about how you
                    write and how you judge good work — before coming back.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-2-title">
            <span class="assembly__num" aria-hidden="true">02</span>
            <h3 id="install-2-title" class="t-headline-sm">Add the kit</h3>
            <div class="prose">
                <p>In the Code chat box:</p>
                <pre><code>/plugin marketplace add slogsdon/loop-and-gate-grow-kit</code></pre>
                <p>Click <strong>Install</strong> on the menu that appears.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-3-title">
            <span class="assembly__num" aria-hidden="true">03</span>
            <h3 id="install-3-title" class="t-headline-sm">Add the design and copy skills</h3>
            <div class="prose">
                <p>Both are public, through the <code>slogsdon/claude-code-config</code>
                    marketplace, and both read the profiles you built in step 1.
                    <code>skills-design</code> generates on-brand design;
                    <code>skills-writing</code> drafts and cleans up copy in your voice.</p>
                <pre><code>/plugin marketplace add slogsdon/claude-code-config
/plugin install skills-design@slogsdon-claude-code-config
/plugin install skills-writing@slogsdon-claude-code-config</code></pre>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-4-title">
            <span class="assembly__num" aria-hidden="true">04</span>
            <h3 id="install-4-title" class="t-headline-sm">Run it</h3>
            <div class="prose">
                <pre><code>/grow-and-gate</code></pre>
                <p>Tell it whether you're setting strategy, making a piece, or reading results.
                    Strategy is once per campaign; a piece is every artifact; results are a
                    rhythm.</p>
                <p>On pi, one command installs the kit and the two skills are separate
                    <code>pi install</code> lines listed in
                    <code>reference/tools.md</code>:</p>
                <pre><code>pi install git:github.com/slogsdon/loop-and-gate-grow-kit</code></pre>
            </div>
        </section>
    </div>
</section>

<section class="page-section" aria-labelledby="example-title">
    <header class="index-head">
        <h2 id="example-title" class="t-smallcaps-lg">a worked example</h2>
        <span class="t-dateline">a launch page</span>
    </header>
    <div class="prose">
        <p>You're about to post a launch page, so you run <code>/grow-and-gate</code>.</p>
        <p><strong>Gate ∞.</strong> High reach, permanent, hard to walk back — it earns the
            full per-piece set. <strong>Gate 2.</strong> The agent lists five things you could
            say, and you cut to the one claim that speaks to your audience's real hesitation.
            <strong>Gate 3.</strong> The design looks clean but generic; checked against your
            taste profile it's “could be anyone,” so it goes back until it's yours.</p>
        <p><strong>Gate 4.</strong> The copy is persuasive and contains a statistic you never
            gave it. Cut the invented number, rewrite in your voice. <strong>Gate 5.</strong>
            One channel where your audience actually is, at a time you can be around to reply.</p>
        <p>A quick reply, run through the same skill, earns a glance at voice and a send. That
            difference is Gate ∞ doing its job.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="tools-title">
    <header class="index-head">
        <h2 id="tools-title" class="t-smallcaps-lg">the tool footprint</h2>
        <span class="t-dateline">most gates have no tool</span>
    </header>
    <div class="prose">
        <p>The kit's own snapshot was verified against a live setup on 2026-07-12 and is
            labelled disposable on purpose. Its honest read-out: audience, the one claim,
            ready-to-show and how-much-process are pure judgment with no tool at all. Only
            design and copy have a skill behind them, scheduling has an optional free-tier
            account, and metrics use whatever is already free.</p>
        <p>So the whole footprint is two public plugins, one optional free account, and free
            platform analytics. You can work every gate with no paid tools, and every gate with
            no external accounts at all if you post by hand. When the tool names change, the
            gates don't.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="next-title">
    <header class="index-head">
        <h2 id="next-title" class="t-smallcaps-lg">where to go</h2>
        <span class="t-dateline">after the install</span>
    </header>
    <ul class="link-list">
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/grow-field-guide/">The Grow Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>The narrative version of these gates, with a worked example carried through one
                real product's go-to-market. Long-form writing, kept on the personal site.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-grow-kit">Source on GitHub<span aria-hidden="true"> ↗</span></a>
            <p>The skill, the grow gates reference, the audience-brief template, and the tools
                snapshot.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/build/">The Build Kit<span aria-hidden="true"> →</span></a>
            <p>The other half: idea to shipped software, and the first gate this kit feeds.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/accountability/">The Accountability Kit<span aria-hidden="true"> →</span></a>
            <p>Where an unposted piece gets caught instead of quietly slipping.</p>
        </li>
    </ul>
</section>
