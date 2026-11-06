<?php
/**
 * The Accountability Kit: the authoritative product page for one kit in the family.
 * Derived from the accountability-kit repo's README.md,
 * reference/accountability-gates.md, reference/the-deferral-engine.md and
 * GETTING-STARTED.md.
 */
$this->layout('partials::layout', [
    'title' => 'The Accountability Kit · Loop & Gate',
    'description' => 'Eight gates for your own follow-through, five daily rituals, and a deferral engine that counts the focus you keep skipping and forces the call at three strikes.',
    'path' => '/kits/accountability/',
    'notFound' => false,
]);
?>
<section class="intro intro--compact" aria-labelledby="kit-title">
    <p class="t-smallcaps">loop &amp; gate · accountability kit</p>
    <h1 id="kit-title">The Accountability <span class="t-accent">Kit.</span></h1>
    <p class="t-lead">A judgment layer for your own follow-through. Habit apps remember what
        you did. This remembers what you said you would do and didn't, counts it, and catches
        you when you keep quietly deferring the hard thing.</p>
    <a class="btn-arrow" href="#install">Install it</a>
</section>

<section class="page-section" aria-labelledby="what-title">
    <header class="index-head">
        <h2 id="what-title" class="t-smallcaps-lg">what it is</h2>
        <span class="t-dateline">runs on Claude alone</span>
    </header>
    <div class="prose">
        <p>In Loop & Gate, this kit points the whole method at you. A daily loop can remind,
            track, and score on its own, and it should. But it can't want the outcome for you,
            it can't decide a task is worth killing, and it can't tell you a streak is
            theater. So the loop stops at a fixed set of points and waits for you. Those points
            are the gates.</p>
        <p>The engine underneath does the one mechanical thing willpower forgets: every morning
            focus that doesn't show up in the day's log gets a deferral increment, and at three
            strikes it trips a pattern alert that forces a decision. That mechanic, not the
            note-taking, is the whole point.</p>
        <p><strong>It is not</strong> a habit tracker that rewards streaks, and it is not an
            autopilot: it surfaces the reckoning and counts the misses, but the follow-through
            is yours. Answer it with a comfortable story and all you get is a well-documented
            record of your own avoidance.</p>
        <p><strong>Nothing else to install.</strong> No pipeline, no account, no local model,
            no subscription beyond your Claude plan. The reckoning, the counting, and the weekly
            aggregation are done by the agent you're already talking to, over plain text
            files.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="gates-title">
    <header class="index-head">
        <h2 id="gates-title" class="t-smallcaps-lg">the eight gates</h2>
        <span class="t-dateline">∞ first, every day</span>
    </header>
    <div class="prose">
        <p>Each gate names its mode — Commit for deciding what deserves you, Reckon for facing
            what you did, or Pattern for reading the trend — so you know what kind of call
            you're making. Gate ∞ decides how much of the rest today earns: a day with one
            exhausted hour earns a one-line log.</p>
    </div>
    <div class="table-wrap">
        <table>
            <caption class="t-smallcaps">the gates, in the order they run</caption>
            <thead>
                <tr><th scope="col">Gate</th><th scope="col">The question</th><th scope="col">Mode</th></tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">∞</th>
                    <td><strong>How much of this loop does today deserve?</strong> Right-size
                        the loop to the day you actually have, not the day you wish you had.</td>
                    <td>Above the others</td>
                </tr>
                <tr>
                    <th scope="row">0</th>
                    <td>What am I trying to move? The small set of outcomes worth your scarce
                        attention, with your known avoidance patterns written next to them.</td>
                    <td>Commit</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>What's the one thing today? The single most important thing, chosen
                        against a goal rather than against your mood. One, not five.</td>
                    <td>Commit</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Did I capture what I did? One line, whenever something finishes or a
                        decision gets made — the cheap evidence the night reckoning reads.</td>
                    <td>Reckon</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Did I do what I said? Face the gap truthfully, and don't silently edit
                        the morning focus to match the day — the miss is the signal.</td>
                    <td>Reckon</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Am I avoiding this? At three deferrals, kill it or commit to it with a
                        real, specific reason. There is no third option.</td>
                    <td>Pattern</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>What's tomorrow? Commit to tomorrow's one thing now, so the morning is a
                        start and not a reconstruction.</td>
                    <td>Commit</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>What patterns emerged? Read the week honestly — tasks deferred twice or
                        more, days with no log, and how much logged work maps to a stated goal —
                        and let it change next week.</td>
                    <td>Pattern</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="page-section" aria-labelledby="rituals-title">
    <header class="index-head">
        <h2 id="rituals-title" class="t-smallcaps-lg">five rituals</h2>
        <span class="t-dateline">plus one on demand</span>
    </header>
    <div class="prose">
        <p>You don't run all of it every day. On a brutal day, <code>/log</code> one line and
            move on. On a normal day, morning and night. On a Sunday, the weekly pass.</p>
    </div>
    <dl class="facts">
        <div class="fact">
            <dt><code>/morning</code></dt>
            <dd>Sets the one thing today, chosen against a goal. Surfaces what you carried over
                and flags anything you're starting to avoid.</dd>
        </div>
        <div class="fact">
            <dt><code>/log</code></dt>
            <dd>One line, whenever you finish something or make a decision. The cheap capture
                the night reckoning reads.</dd>
        </div>
        <div class="fact">
            <dt><code>/eod</code></dt>
            <dd>The honest checkpoint, and the one with teeth: it compares this morning's focus
                to what you actually logged, and counts the misses.</dd>
        </div>
        <div class="fact">
            <dt><code>/plan-tomorrow</code></dt>
            <dd>Sets tomorrow while today is still honest, so you start cold without
                reconstructing anything.</dd>
        </div>
        <div class="fact">
            <dt><code>/weekly-signals</code></dt>
            <dd>Once a week, the zoomed-out view: what you keep deferring, which days you fell
                out of the loop, and how much of your week actually served a goal. Told
                straight, not cheerfully.</dd>
        </div>
        <div class="fact">
            <dt><code>/decide</code></dt>
            <dd>On demand, for a decision that keeps circling: cut through it. Not part of the
                daily loop. Add <code>hard</code> to strip the softening.</dd>
        </div>
    </dl>
</section>

<section class="page-section" aria-labelledby="engine-title">
    <header class="index-head">
        <h2 id="engine-title" class="t-smallcaps-lg">the deferral engine</h2>
        <span class="t-dateline">what makes it more than a journal</span>
    </header>
    <div class="prose">
        <p>Six steps, and only one of them is bookkeeping:</p>
        <ol>
            <li><strong>Morning names the target.</strong> Gate 1 writes one primary focus, and
                up to two secondaries, to today's daily note.</li>
            <li><strong>The day gets captured.</strong> Gate 2 appends one-line log entries.
                Cheap on purpose — the log is the evidence the reckoning reads.</li>
            <li><strong>Night reckons and counts.</strong> Gate 3 diffs the focus against the
                log and increments a deferral counter for every focus item the log doesn't show
                as done.</li>
            <li><strong>Three strikes trips an alert.</strong> At a count of 3 the reckoning
                stops being polite and forces a choice: re-commit with a reason and a slot, or
                cut it.</li>
            <li><strong>Named patterns get checked.</strong> The avoidance patterns you wrote in
                <code>goals.md</code> — “infrastructure over output,” say — are checked at the
                morning and weekly gates, and flagged by name when they match.</li>
            <li><strong>The week is scored straight.</strong> Gate 6 aggregates tasks deferred
                twice or more, days with no log at all, and the share of logged work that maps
                to a stated goal. A low alignment score is the mirror, not an error.</li>
        </ol>
        <p>The whole engine converts a vague background guilt into a specific number and a
            forced choice. The deferral log itself is one row per tracked task in
            <code>patterns.md</code>, with a count, the last date, a category and a note —
            struck-through rows are the completion log, kept for history.</p>
    </div>
</section>

<section class="page-section" id="install" aria-labelledby="install-title">
    <header class="index-head">
        <h2 id="install-title" class="t-smallcaps-lg">install</h2>
        <span class="t-dateline">three steps</span>
    </header>
    <div class="assembly">
        <section class="assembly__step" aria-labelledby="install-1-title">
            <span class="assembly__num" aria-hidden="true">01</span>
            <h3 id="install-1-title" class="t-headline-sm">Get Claude Code</h3>
            <div class="prose">
                <p>A paid Claude plan — Pro or Max — and the desktop app, or the CLI. The free
                    plan does not include Claude Code.
                    <a href="/loop-and-gate/getting-started/">The Foundation's guide</a> covers
                    this if it's all new.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-2-title">
            <span class="assembly__num" aria-hidden="true">02</span>
            <h3 id="install-2-title" class="t-headline-sm">Add the kit</h3>
            <div class="prose">
                <p>In the Code chat box:</p>
                <pre><code>/plugin marketplace add slogsdon/loop-and-gate-accountability-kit</code></pre>
                <p>Click <strong>Install</strong> on the menu that appears. The five ritual
                    commands and the gates are now available, and there is nothing else to
                    install.</p>
                <p>Name clash? If you already have commands called <code>morning</code>,
                    <code>log</code>, <code>eod</code>, <code>plan-tomorrow</code> or
                    <code>weekly-signals</code>, use the plugin-prefixed form Claude Code shows
                    in its menu.</p>
            </div>
        </section>

        <section class="assembly__step" aria-labelledby="install-3-title">
            <span class="assembly__num" aria-hidden="true">03</span>
            <h3 id="install-3-title" class="t-headline-sm">Pick where your notes live</h3>
            <div class="prose">
                <p>Open a folder for your accountability notes — a fresh empty one is fine —
                    then type:</p>
                <pre><code>/morning</code></pre>
                <p>The first time, it creates an <code>accountability/</code> folder with
                    <code>goals.md</code>, the <code>patterns.md</code> deferral log, and
                    <code>daily/</code>, one note per day. Already keep an Obsidian vault? Open
                    that folder instead: the rituals detect the vault and write to your daily
                    notes, with no separate scaffold.</p>
                <p>Fill in <code>goals.md</code> once — that's Gate 0, and everything measures
                    against it. Keeping the folder in git is optional and worth it: the history
                    of <code>daily/</code> becomes a free, honest audit trail.</p>
                <p>On pi, one command, and each ritual is a <code>/skill:&lt;name&gt;</code>
                    command:</p>
                <pre><code>pi install git:github.com/slogsdon/loop-and-gate-accountability-kit</code></pre>
            </div>
        </section>
    </div>
</section>

<section class="page-section" aria-labelledby="limits-title">
    <header class="index-head">
        <h2 id="limits-title" class="t-smallcaps-lg">status and limits</h2>
        <span class="t-dateline">as stated by the source</span>
    </header>
    <div class="prose">
        <p>The source lists the asset as complete: the gates reference, the deferral-engine
            mechanic, the five ritual skills, the templates, and the no-terminal on-ramp. It
            runs on Claude alone, and the Obsidian-vault path is auto-detected when one is
            present.</p>
        <p>Where state lives is deliberately disposable — plain markdown in the project folder
            by default, your vault when you keep one. The gates are the part meant to last: when
            the files get rebuilt, they don't change.</p>
        <p>The kit stands alone, but if the Build and Grow kits are installed, the nightly
            reckoning is where a stalled build or an unposted launch gets caught — which is how
            Build → Grow → Accountability → Build closes.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="next-title">
    <header class="index-head">
        <h2 id="next-title" class="t-smallcaps-lg">where to go</h2>
        <span class="t-dateline">after the install</span>
    </header>
    <ul class="link-list">
        <li>
            <a href="https://shane.logsdon.io/loop-and-gate/accountability-field-guide/">The Accountability Field Guide<span aria-hidden="true"> ↗</span></a>
            <p>The narrative version of these eight gates, with one honest story carried the
                whole way through. Long-form writing, kept on the personal site.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-accountability-kit">Source on GitHub<span aria-hidden="true"> ↗</span></a>
            <p>The five ritual skills, the eight-gate reference, the deferral engine, and the
                templates.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/build/">The Build Kit<span aria-hidden="true"> →</span></a>
            <p>Eleven gates for an agentic build loop — the reason a stalled build has
                somewhere to show up.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/grow/">The Grow Kit<span aria-hidden="true"> →</span></a>
            <p>The same method on go-to-market, and the signals the build side reads next.</p>
        </li>
    </ul>
</section>
