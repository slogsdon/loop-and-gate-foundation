<?php
/**
 * D · Assembly Order: genuinely sequential setup for the Foundation. Step 4
 * depends on step 3, and the kit step depends on all of them. A kit cannot read
 * memory that was never placed, and nothing works without the paid plan at step 1.
 * Each step carries an id so a reader can enter at step 6 from a link.
 */
$this->layout('partials::layout', [
    'title' => 'Getting started · Loop & Gate',
    'description' => 'Set up the Loop & Gate Foundation in order: a paid Claude plan, the desktop app, the plugin or clone, the vault, a first session, and the profile interview the kits read.',
    'path' => '/getting-started/',
    'notFound' => false,
]);
?>
<section class="intro intro--compact" aria-labelledby="guide-title">
    <p class="t-smallcaps">loop &amp; gate · assembly order</p>
    <h1 id="guide-title">Getting <span class="t-accent">started.</span></h1>
    <p class="t-lead">Eight steps for the Foundation, the bottom layer of Loop & Gate. They
        are in this order because each one depends on the last: a kit can't read memory that
        was never placed, and nothing works without the plan at step 1.</p>
    <p class="t-meta guide-source">Commands below are quoted from the Foundation's
        <code>README.md</code> and <code>GETTING-STARTED.md</code> at the revision this
        site was built from. They were not executed while building this page.</p>
</section>

<div class="assembly">
    <section class="assembly__step" id="step-1" aria-labelledby="step-1-title">
        <span class="assembly__num" aria-hidden="true">01</span>
        <h2 id="step-1-title" class="t-headline-sm">Get a paid Claude plan</h2>
        <div class="prose">
            <p>Pro or Max. The free plan does not include Claude Code, so nothing here works
                on it. This is the step people miss, so check it before anything else.</p>
            <p><a href="https://claude.ai">claude.ai</a></p>
        </div>
    </section>

    <section class="assembly__step" id="step-2" aria-labelledby="step-2-title">
        <span class="assembly__num" aria-hidden="true">02</span>
        <h2 id="step-2-title" class="t-headline-sm">Install Claude Code</h2>
        <div class="prose">
            <p>The desktop app is a normal application you double-click: the <code>.dmg</code>
                on a Mac, the <code>.exe</code> on Windows. On Windows the app may ask you to
                install Git first — say yes and reopen it. The Foundation's memory loader is
                a small shell script, so Git is the thing to check if memory doesn't load
                later.</p>
            <p>Installers are on <a href="https://code.claude.com/docs">code.claude.com/docs</a>.
                Sign in, then click the <strong>Code</strong> tab.</p>
            <p>Terminal users install it instead of the app, and open the folder from there:</p>
            <pre><code>npm install -g @anthropic-ai/claude-code</code></pre>
        </div>
    </section>

    <section class="assembly__step" id="step-3" aria-labelledby="step-3-title">
        <span class="assembly__num" aria-hidden="true">03</span>
        <h2 id="step-3-title" class="t-headline-sm">Install the Foundation</h2>
        <div class="prose">
            <p>Two ways in. They are not a sequence — read the one that matches how much of
                the loop you want.</p>
        </div>

        <div class="harness">
            <h3 class="harness__title">Plugin — the quickest start</h3>
            <div class="prose">
                <p>One command in the Code chat box, no download:</p>
                <pre><code>/plugin marketplace add slogsdon/loop-and-gate-foundation</code></pre>
                <p>A menu appears; click <strong>Install</strong>. The skills and the
                    memory-loader are then available in every session, not just one folder.</p>
                <p><strong>The limit of this path.</strong> Skills live in a versioned cache
                    that is replaced on every update. The agent still improves its memory,
                    but edits it makes to its own instructions don't survive the next update,
                    and that self-editing is half of what makes the loop interesting over
                    months.</p>
            </div>
        </div>

        <div class="harness">
            <h3 class="harness__title">Clone — the full self-improving loop</h3>
            <div class="prose">
                <p>Here the skills are your working copy, so the <code>improve</code> skill can
                    edit them. Terminal:</p>
                <pre><code>git clone https://github.com/slogsdon/loop-and-gate-foundation.git
cd loop-and-gate-foundation</code></pre>
                <p>No terminal: on the
                    <a href="https://github.com/slogsdon/loop-and-gate-foundation">Foundation
                    repo</a>, use the green <strong>Code</strong> button →
                    <strong>Download ZIP</strong>, unzip it, then <strong>File → Open
                    folder</strong> in the app and pick that folder.</p>
            </div>
        </div>

        <div class="harness">
            <h3 class="harness__title">pi — the other harness</h3>
            <div class="prose">
                <p>Using <a href="https://pi.dev">pi</a> (0.86.1 or later) instead of Claude
                    Code:</p>
                <pre><code>pi install git:github.com/slogsdon/loop-and-gate-foundation</code></pre>
                <p>Every skill also becomes a <code>/skill:&lt;name&gt;</code> command. On
                    first launch it offers, once, to install two community packages that stand
                    in for Claude Code built-ins — <code>pi-subagents</code> for the
                    <code>subagent</code> tool that <code>loop</code>, <code>verify</code> and
                    <code>improve</code> dispatch, and <code>rpiv-ask-user-question</code> for
                    the <code>ask_user_question</code> tool behind the setup and add-kits
                    gates. Declining is remembered; delete
                    <code>~/.config/loop-and-gate/pi-deps-declined</code> to be asked again. A
                    clone works in pi too — pi loads <code>CLAUDE.md</code> natively.</p>
            </div>
        </div>
    </section>

    <section class="assembly__step" id="step-4" aria-labelledby="step-4-title">
        <span class="assembly__num" aria-hidden="true">04</span>
        <h2 id="step-4-title" class="t-headline-sm">Place your vault</h2>
        <div class="prose">
            <p>Open a folder to work in (<strong>File → Open folder</strong> — your Documents
                is fine), then ask, in plain words:</p>
            <p class="t-lead"><em>Set up my vault.</em></p>
            <p>That runs the <code>setup</code> skill — or <code>/setup</code>, the same front
                door on both paths. It asks where the vault should live and scaffolds it. On a
                Mac it recommends the Obsidian iCloud folder, so the same notes sync to
                Obsidian on your phone and tablet for free. You do this once.</p>
            <p>Advanced, clone path only: run the underlying script directly. Without a path
                it auto-picks a location (iCloud on macOS, else <code>~/second-brain</code>)
                rather than asking.</p>
            <pre><code>./scripts/setup.sh ~/my-vault</code></pre>
            <p><strong>Optional, worth it.</strong> git-init the vault — setup prints the
                command — so every change the agent makes to what it knows is tracked and
                reversible.</p>
        </div>
    </section>

    <section class="assembly__step" id="step-5" aria-labelledby="step-5-title">
        <span class="assembly__num" aria-hidden="true">05</span>
        <h2 id="step-5-title" class="t-headline-sm">Run a first real session</h2>
        <div class="prose">
            <p>Give it a goal instead of a test:</p>
            <p class="t-lead"><em>Get to know me: ask about my current project and
                preferences, then save what you learn.</em></p>
            <p>What happens on its own:</p>
            <ul>
                <li>A SessionStart hook injects <code>vault/MEMORY.md</code> — the index —
                    plus the latest daily note and the latest reflection, every session.</li>
                <li>The agent asks questions and captures the answers into
                    <code>vault/Knowledge/</code> notes, indexed by one line in
                    <code>MEMORY.md</code>.</li>
                <li>When you wrap up it reflects: logs the session to <code>vault/Daily/</code>,
                    writes a self-review with one lesson to <code>vault/Reflections/</code>,
                    and commits.</li>
            </ul>
            <p>Then open the vault and look around. Everything the agent knows is readable
                markdown, and that transparency is the point.</p>
        </div>
    </section>

    <section class="assembly__step" id="step-6" aria-labelledby="step-6-title">
        <span class="assembly__num" aria-hidden="true">06</span>
        <h2 id="step-6-title" class="t-headline-sm">Run the profile interview</h2>
        <div class="prose">
            <p>One conversation, one question at a time, that writes two reference docs into
                <code>vault/Profiles/</code>: a voice profile (how you write) and a taste
                profile (how you judge). Re-run it any time; it merges rather than
                overwrites.</p>
            <p class="t-lead"><em>Run the profile interview so you know how I write and what
                good looks like to me.</em></p>
            <p>This is optional for the Build and Accountability kits and <strong>required
                for the Grow Kit</strong>, whose design gate checks against the taste profile
                and whose copy gate checks against the voice profile.</p>
        </div>
    </section>

    <section class="assembly__step" id="step-7" aria-labelledby="step-7-title">
        <span class="assembly__num" aria-hidden="true">07</span>
        <h2 id="step-7-title" class="t-headline-sm">Read the memory yourself</h2>
        <div class="prose">
            <p>Install <a href="https://obsidian.md/download">Obsidian</a> — free, and
                optional: it's a viewer, and the system is just files. Choose
                <strong>Open folder as vault</strong> and point it at the folder setup just
                created.</p>
            <p>Install the mobile app too, pointed at the same vault, and the inbox works: jot
                a thought into <code>vault/Inbox/</code> from your phone, and next session ask
                the agent to <em>triage the inbox</em>. It sorts each thought into a fact, an
                idea, a task, or noise, shows you the sorting, and waits for your yes before
                it files anything.</p>
            <p>The vault layout is small on purpose: <code>MEMORY.md</code> is the index,
                <code>Inbox/</code> the raw capture, <code>Profiles/</code> the voice and
                taste, <code>Daily/</code> what happened, <code>Knowledge/</code> what's true,
                <code>Reflections/</code> the self-reviews.</p>
        </div>
    </section>

    <section class="assembly__step" id="step-8" aria-labelledby="step-8-title">
        <span class="assembly__num" aria-hidden="true">08</span>
        <h2 id="step-8-title" class="t-headline-sm">Add a kit</h2>
        <div class="prose">
            <p>Foundation is the ground floor. Three kits sit on it, and the Foundation's own
                <code>add-kits</code> skill offers each one, then offers each kit's pipeline
                separately — every piece a gated, declinable choice. It skips whatever is
                already installed, so it's safe to re-run.</p>
            <p class="t-lead"><em>Add the rest of the stack.</em></p>
            <p>Or install one directly. Each kit needs a different amount of company:</p>
        </div>
        <div class="table-wrap">
            <table>
                <caption class="t-smallcaps">what each kit needs</caption>
                <thead>
                    <tr><th scope="col">Kit</th><th scope="col">Command</th><th scope="col">Also needs</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><a href="/loop-and-gate/kits/accountability/">Accountability</a></th>
                        <td><code>/plugin marketplace add slogsdon/loop-and-gate-accountability-kit</code></td>
                        <td>Nothing. Runs on Claude alone.</td>
                    </tr>
                    <tr>
                        <th scope="row"><a href="/loop-and-gate/kits/build/">Build</a></th>
                        <td><code>/plugin marketplace add slogsdon/loop-and-gate-build-kit</code></td>
                        <td><code>superpowers</code> + <code>agent-skills</code> — the free public plugins that run the loop between the gates.</td>
                    </tr>
                    <tr>
                        <th scope="row"><a href="/loop-and-gate/kits/grow/">Grow</a></th>
                        <td><code>/plugin marketplace add slogsdon/loop-and-gate-grow-kit</code></td>
                        <td>The Foundation, plus <code>skills-design</code> + <code>skills-writing</code> from the public <code>slogsdon/claude-code-config</code> marketplace.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="prose">
            <p>That's a working setup. The Accountability Kit is the lightest place to start
                because it needs nothing else — install it, run <code>/morning</code>, and
                you have a Foundation that remembers you and a kit that keeps you honest about
                your days.</p>
        </div>
    </section>
</div>

<section class="page-section" aria-labelledby="daily-title">
    <header class="index-head">
        <h2 id="daily-title" class="t-smallcaps-lg">daily use</h2>
        <span class="t-dateline">one session, one iteration</span>
    </header>
    <div class="prose">
        <p>Open the folder and give it a goal — or none. With no goal it picks up open items
            from the last daily note. One session is one iteration of the loop: work until
            done or blocked, let it reflect, exit. The next session starts fresh and continues
            from what the files say.</p>
        <p><code>MEMORY.md</code> is the most-read file in the system, and the hook injects it
            at the top of every session. That's why it's written once, at session end, and why
            mid-session facts go into <code>Knowledge/</code> notes immediately while their
            index lines wait for the close-out: one write per session keeps the cached prefix
            intact, and the session cheaper and faster.</p>
        <p>For a goal too big for one session, ask for the loop skill — <em>“run the loop on:
            &lt;goal&gt;”</em>. Your session stays the orchestrator and the human gate; each
            iteration runs in a subagent with fresh context, and nothing lands in memory until
            the orchestrator verifies it.</p>
        <p>After a handful of sessions, ask for an improvement pass — <em>“run the improve
            pass: apply the reflections that have earned it”</em>. Only lessons that came up
            more than once get applied, each is checked by a fresh agent that never saw the
            work, and every change is committed so you can read the diff.</p>
    </div>
</section>

<section class="page-section" id="working-across-devices" aria-labelledby="devices-title">
    <header class="index-head">
        <h2 id="devices-title" class="t-smallcaps-lg">working across devices</h2>
        <span class="t-dateline">the session runs where the vault lives</span>
    </header>
    <div class="prose">
        <p><strong>Remote Control</strong> lets a session running on your desktop be driven
            from another Claude app — web, mobile, tablet. It's off by default; turn it on once
            so it's the default for every session:</p>
        <pre><code>claude --remote-control</code></pre>
        <p>Permanent: <code>"remoteControlAtStartup": true</code> in settings, or Settings →
            Claude Code in the desktop app.</p>
        <p><strong>Dispatch</strong> is the other half: hand a task off from the mobile app and
            it spins up a Code session on your desktop, then notifies you when it's done or
            needs a decision. The session always runs on the machine that holds your vault, so
            memory and skills come along without copying anything.</p>
        <p>The vault has to sync underneath. macOS and iOS get iCloud, which setup picks by
            default — tell iCloud Drive to keep the Obsidian folder downloaded on each device,
            or a larger vault is offloaded and slow to open. Android and Windows have no
            iCloud: Obsidian Sync, the community git plugin, or a Dropbox / OneDrive folder all
            do the same job. Sync isn't instant, so a note written on your phone can read as
            missing or stale to a desktop session for a few seconds. That's lag, not loss.</p>
        <p>Running more than one session at once? Give each its own git worktree and delete
            them when you're done, and keep commits and pushes on one machine so history has a
            single writer. This applies to every kit, not just the Foundation: they all read
            and write the same vault.</p>
    </div>
</section>

<section class="page-section" aria-labelledby="limits-title">
    <header class="index-head">
        <h2 id="limits-title" class="t-smallcaps-lg">limits worth knowing</h2>
        <span class="t-dateline">stated by the source</span>
    </header>
    <div class="prose">
        <dl class="facts">
            <div class="fact">
                <dt>Plugin vs clone</dt>
                <dd>Plugin skills live in a read-only cache, so <code>improve</code> evolves
                    your memory but not the skill files. Windows plugin users may also need
                    developer mode for the compatibility symlink. Clone for the full
                    self-improving loop.</dd>
            </div>
            <div class="fact">
                <dt>Windows</dt>
                <dd>The memory-loader is a small shell script that needs Git. If memory isn't
                    loading on Windows, that's the thing to check.</dd>
            </div>
            <div class="fact">
                <dt>The no-terminal path</dt>
                <dd>Described in the source as new and being validated with first users. If a
                    step doesn't match what you see, that's useful feedback.</dd>
            </div>
            <div class="fact">
                <dt>Dials</dt>
                <dd><code>config.yaml</code> → <code>vault</code> points at a different vault
                    once you outgrow the starter one. <code>CLAUDE.md</code> holds the agent's
                    standing behavior rules.</dd>
            </div>
            <div class="fact">
                <dt>The model never changes</dt>
                <dd>What improves is the environment around it: notes, instructions, config.
                    Mechanically it's markdown files getting better, and every memory change
                    is a commit you can revert.</dd>
            </div>
        </dl>
    </div>
</section>

<section class="page-section" aria-labelledby="next-title">
    <header class="index-head">
        <h2 id="next-title" class="t-smallcaps-lg">where to go</h2>
        <span class="t-dateline">after setup</span>
    </header>
    <ul class="link-list">
        <li>
            <a href="/loop-and-gate/">The family introduction<span aria-hidden="true"> →</span></a>
            <p>What the four pieces are and how they fit together.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/build/">The Build Kit<span aria-hidden="true"> →</span></a>
            <p>Eleven gates for an agentic build loop, and the pipeline they sit on.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/grow/">The Grow Kit<span aria-hidden="true"> →</span></a>
            <p>The same method on go-to-market. Needs the profiles from step 6.</p>
        </li>
        <li>
            <a href="/loop-and-gate/kits/accountability/">The Accountability Kit<span aria-hidden="true"> →</span></a>
            <p>Eight gates, five rituals, and the deferral engine. Needs nothing else.</p>
        </li>
        <li>
            <a href="https://github.com/slogsdon/loop-and-gate-foundation/blob/main/ARCHITECTURE.md">ARCHITECTURE.md<span aria-hidden="true"> ↗</span></a>
            <p>The architecture, the research behind each decision, and what was deliberately
                left out.</p>
        </li>
    </ul>
</section>
