<?php
/**
 * The Build Kit: the authoritative product page for one kit in the family.
 * Derived from the build-kit repo's README.md, reference/gates.md and
 * GETTING-STARTED.md — the gates are quoted from the reference, the framing is
 * rewritten, and nothing is copied wholesale.
 */
$this->layout('partials::layout', [
    'title' => 'The Build Kit · Loop & Gate',
    'description' => 'Eleven human-judgment gates for an agentic build loop: the master gate that sizes a change, the ten gates it earns, and the free public pipeline that runs the loop between them.',
    'path' => '/kits/build/',
    'notFound' => false,
]);
?>
<section class="intro intro--compact" aria-labelledby="kit-title">
    <p class="t-smallcaps">loop &amp; gate · build kit</p>
    <h1 id="kit-title">The Build <span class="t-accent">Kit.</span></h1>
    <p class="t-lead">A judgment layer for building software with an agentic loop. Anyone
        can install the tools that write code. Almost nobody knows where to intervene. This
        kit is the map of those points, and how to work each one even when its expertise
        isn't yours yet.</p>
    <a class="btn-arrow" href="#install">Install it</a>
</section>

<section class="page-section" aria-labelledby="what-title">
    <header class="index-head">
        <h2 id="what-title" class="t-smallcaps-lg">what it is</h2>
        <span class="t-dateline">the judgment layer, not the loop</span>
    </header>
    <div class="prose">
        <p>An agentic build loop can run brainstorm → plan → build → test → review → ship on
            its own, and it should. But it makes wrong assumptions and runs with them, it
            overbuilds, it calls a one-off demo “tested,” and it can't tell a real problem
            from a loud one. So the loop stops at a fixed set of points and waits for a human.
            Those points are the gates. In Loop & Gate, this is the build half: an idea to
            shipped software.</p>
        <p>Work them well and a mediocre tool stack ships good software. Work them badly and
            the best tools on the market ship you a fast, tested, well-reviewed mistake.</p>
        <p><strong>It is not</strong> the build tooling. It sits on top of a loop it doesn't
            ship — two free public plugins do that — and it is not an autopilot: every gate
            stops for your decision. The gates are the asset. The tools are a disposable
            appendix, and the kit's own reference files label the tool table as a dated
            snapshot for exactly that reason.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="gates-title">
    <header class="index-head">
        <h2 id="gates-title" class="t-smallcaps-lg">the eleven gates</h2>
        <span class="t-dateline">∞ first, every time</span>
    </header>
    <div class="prose">
        <p>Each gate names its lens — Business for product judgment, Engineering for developer
            judgment, or Both — so you know when you're on home ground and when to slow down
            and lean on the structure. Gate ∞ is the one you never hand to the agent, because
            it is the decision about how much to trust the agent.</p>
    </div>
    <div class="table-wrap">
        <table>
            <caption class="t-smallcaps">the gates, in the order they run</caption>
            <thead>
                <tr><th scope="col">Gate</th><th scope="col">The question</th><th scope="col">Lens</th></tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">∞</th>
                    <td><strong>How much process does this change deserve?</strong> Right-size
                        the process to the stakes — how deep, and how wide. A typo fix doesn't
                        get a spec and a security pass; a billing change gets all of it.</td>
                    <td>Both, above the others</td>
                </tr>
                <tr>
                    <th scope="row">0</th>
                    <td>Should this exist? Does it move the product toward the outcome you care
                        about, and is it worth your scarcest resource — your attention this
                        month? “Would be nice” is not a yes.</td>
                    <td>Business</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Who is it for, and what's a win? A specific person and an observable
                        success signal, not a segment and “customers will love it.”</td>
                    <td>Business</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Which direction? The one that fits where the product is going, not just
                        the one that solves today's ticket.</td>
                    <td>Business</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Right plan, right scope? Approve, adjust or send back: does the scope
                        match Gate 1, and is the approach sound enough to build on?</td>
                    <td>Both</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Is the architecture sane? Trading present convenience against future
                        cost, before it becomes load-bearing.</td>
                    <td>Engineering</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Off the rails? Is the loop converging or spinning, and does a choice it
                        made on the fly need your input?</td>
                    <td>Engineering</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Does the test prove it? An assertion that is still true next month, or
                        just the agent's transcript of a run?</td>
                    <td>Engineering</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Is the cost right? Match the spend to the stage; cheap work goes to
                        cheap models, and infra is sized for the load you have.</td>
                    <td>Engineering</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Risk acceptable to ship? Passing gates is necessary, not sufficient.
                        Ship, hold, or ship narrowly.</td>
                    <td>Both</td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td>Ship now, to whom? When it goes live and who gets it first — timing,
                        communication, staged exposure.</td>
                    <td>Business</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="prose">
        <p>Each gate in the reference also carries what good judgment looks like, how to work
            it when its lens isn't yours, and the failure modes of rubber-stamping it. That
            reference ships inside the plugin as <code>reference/gates.md</code>.</p>
    </div>
</section>

<section class="page-section" id="install" aria-labelledby="install-title">
    <header class="index-head">
        <h2 id="install-title" class="t-smallcaps-lg">install</h2>
        <span class="t-dateline">three steps, one paid plan</span>
    </header>
    <div class="prose">
        <p>You need a Mac or Windows machine and a paid Claude plan — Pro or Max. The free plan
            does not include Claude Code. If you have never installed any of this, the
            <a href="/loop-and-gate/getting-started/">Foundation's getting-started page</a>
            walks the same ground more slowly, and the kit's own
            <code>GETTING-STARTED.md</code> assumes no coding background.</p>
    </div>
    <div class="assembly">
        <section class="assembly__step" aria-labelledby="install-1-title">
            <span class="assembly__num" aria-hidden="true">01</span>
            <h3 id="install-1-title" class="t-headline-sm">Add the kit</h3>
            <div class="prose">
                <p>In the Code chat box, on the desktop app, the web app or the CLI:</p>
                <pre><code>/plugin marketplace add slogsdon/loop-and-gate-build-kit</code></pre>
                <p>Then click <strong>Install</strong> on the menu that appears. The
                    <code>loop-and-gate</code> skill is now available.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-2-title">
            <span class="assembly__num" aria-hidden="true">02</span>
            <h3 id="install-2-title" class="t-headline-sm">Add the build pipeline</h3>
            <div class="prose">
                <p>The gates are a layer <em>on top of</em> a build loop, so the loop has to be
                    there too. Same place, one line at a time — the first pair is the core loop,
                    the second fills the gaps it leaves:</p>
                <pre><code>/plugin marketplace add obra/superpowers-marketplace
/plugin install superpowers@superpowers-marketplace
/plugin marketplace add addyosmani/agent-skills
/plugin install agent-skills@addy-agent-skills</code></pre>
                <p>Both are public and free. Bringing your own loop instead is a supported
                    answer, not a workaround: the Foundation's <code>add-kits</code> skill
                    offers each kit's pipeline as a declinable choice, and this kit's snapshot
                    notes which gates have no tool at all.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-3-title">
            <span class="assembly__num" aria-hidden="true">03</span>
            <h3 id="install-3-title" class="t-headline-sm">Run a change through it</h3>
            <div class="prose">
                <p>Open the folder you want to build in, then:</p>
                <pre><code>/loop-and-gate</code></pre>
                <p>Tell it what you want to build, in plain words. It sizes the change first,
                    then walks you through only the gates that change earns.</p>
                <p>On pi, the install is one command and the skill is a
                    <code>/skill:</code> command:</p>
                <pre><code>pi install git:github.com/slogsdon/loop-and-gate-build-kit</code></pre>
                <p>Or <code>git clone</code> the repo and use the skill directly;
                    <code>scripts/setup.sh</code> is an optional convenience on that path.</p>
            </div>
        </section>
    </div>
</section>

<section class="page-section" aria-labelledby="example-title">
    <header class="index-head">
        <h2 id="example-title" class="t-smallcaps-lg">a worked example</h2>
        <span class="t-dateline">one repro, two sizes</span>
    </header>
    <div class="prose">
        <p>A customer reports the lead export is missing a field. You run
            <code>/loop-and-gate</code>:</p>
        <p><strong>Gate ∞ first.</strong> What breaks if this is wrong, and is it reversible?
            An export change with no money and no auth in it is reversible, so it earns a few
            gates rather than all ten.</p>
        <p><strong>Gate 1.</strong> Who asked, why it matters, and what “fixed” means to
            them. <strong>Gate 3.</strong> Approve the plan — and make the agent list what it
            is <em>not</em> doing, which is how the missing backfill for existing rows surfaces
            before it ships. <strong>Gate 6.</strong> “If this breaks next month, what turns
            red?” No answer means it's a demo, not a test. <strong>Gate 9.</strong> Ship to the
            customer who asked first, tell them, then widen.</p>
        <p>A one-line copy fix, run through the same skill, earns two gates and ships in
            minutes. That difference is Gate ∞ doing its job.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="limits-title">
    <header class="index-head">
        <h2 id="limits-title" class="t-smallcaps-lg">status and limits</h2>
        <span class="t-dateline">as stated by the source</span>
    </header>
    <div class="prose">
        <p>The asset — the gates reference and the operating skill — the business-context
            template, and the pipeline snapshot with its compose-your-own guide are all in the
            repo. The source's own status note lists two things still ahead: glue to read the
            Foundation's voice and taste profiles, and a final package pass. This page does not
            claim those are done.</p>
        <p>The kit doesn't decide for you. It surfaces the call, applies the heuristics, puts
            the agent to work making the decision defensible, then stops. Use it to
            <em>work</em> each gate and you level up on the lens you're missing. Use it to
            <em>skip</em> the gate and you just fail faster, with nicer tooling.</p>
        <p>PRs that remove a gate or auto-approve one will be declined: the gates are the
            asset.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="next-title">
    <header class="index-head">
        <h2 id="next-title" class="t-smallcaps-lg">where to go</h2>
        <span class="t-dateline">after the install</span>
    </header>
    <ul class="link-list">
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/build-field-guide/">The Build Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>The narrative version of these eleven gates, with one real product carried
                through the entire build — a kill decision, an architecture redo, a test-rigor
                call, and a careful rollout. Long-form writing, kept on the personal site.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-build-kit">Source on GitHub<span aria-hidden="true"> ↗</span></a>
            <p>The skill, the gates reference, the pipeline snapshot, and the templates.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-build-kit/blob/main/reference/gates.md">reference/gates.md<span aria-hidden="true"> ↗</span></a>
            <p>The runnable form of all eleven gates, read straight from the repo.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/grow/">The Grow Kit<span aria-hidden="true"> →</span></a>
            <p>The other half of the loop: shipped software to the right people, and the
                signal that comes back to Gate 0.</p>
        </li>
        <li>
            <a href="/loop-and-gate/getting-started/">The Foundation<span aria-hidden="true"> →</span></a>
            <p>Memory, capture, and the voice and taste profiles this kit reads when it can.</p>
        </li>
    </ul>
</section>
