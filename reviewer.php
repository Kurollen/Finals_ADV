<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PHP Quiz Reviewer — Lessons 3 & 4</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0d0f14;
    --card: #141720;
    --card2: #1a1e2a;
    --border: #2a2f3f;
    --green: #00e5a0;
    --blue: #4d9fff;
    --purple: #b06aff;
    --red: #ff5c7a;
    --yellow: #ffd166;
    --text: #e2e8f0;
    --muted: #64748b;
    --mono: 'Space Mono', monospace;
    --sans: 'Sora', sans-serif;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: var(--sans);
    min-height: 100vh;
    padding: 2rem 1rem 4rem;
  }

  /* ── HEADER ── */
  header {
    text-align: center;
    margin-bottom: 3rem;
  }
  .badge-row {
    display: flex;
    justify-content: center;
    gap: .6rem;
    margin-bottom: 1rem;
  }
  .badge {
    font-family: var(--mono);
    font-size: .65rem;
    letter-spacing: .12em;
    padding: .25rem .75rem;
    border-radius: 2rem;
    border: 1px solid;
  }
  .badge-l3 { color: var(--blue); border-color: var(--blue); background: #4d9fff18; }
  .badge-l4 { color: var(--purple); border-color: var(--purple); background: #b06aff18; }
  header h1 {
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: 700;
    letter-spacing: -.02em;
    line-height: 1.1;
  }
  header h1 span { color: var(--green); }
  header p {
    margin-top: .75rem;
    color: var(--muted);
    font-size: .95rem;
  }

  /* ── SCORE BAR ── */
  #score-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
  }
  #score-display {
    font-family: var(--mono);
    font-size: 1.1rem;
    color: var(--green);
  }
  #progress-wrap {
    width: 220px;
    height: 6px;
    background: var(--border);
    border-radius: 99px;
    overflow: hidden;
  }
  #progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--green), var(--blue));
    border-radius: 99px;
    transition: width .4s ease;
    width: 0%;
  }

  /* ── LESSON SECTION ── */
  .lesson-section {
    max-width: 860px;
    margin: 0 auto 3rem;
  }
  .lesson-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: .75rem;
    border-bottom: 1px solid var(--border);
  }
  .lesson-num {
    font-family: var(--mono);
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    padding: .3rem .8rem;
    border-radius: .4rem;
  }
  .l3 .lesson-num { background: #4d9fff22; color: var(--blue); }
  .l4 .lesson-num { background: #b06aff22; color: var(--purple); }
  .lesson-title { font-size: 1.1rem; font-weight: 600; }

  /* ── QUESTION CARD ── */
  .q-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    margin-bottom: 1.25rem;
    overflow: hidden;
    transition: border-color .25s;
  }
  .q-card.correct  { border-color: var(--green); }
  .q-card.wrong    { border-color: var(--red); }

  .q-header {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    padding: 1.1rem 1.3rem .8rem;
  }
  .q-num {
    font-family: var(--mono);
    font-size: .75rem;
    color: var(--muted);
    flex-shrink: 0;
    margin-top: .15rem;
  }
  .q-prompt { font-size: .97rem; line-height: 1.6; }

  /* ── CODE BLOCK ── */
  .code-wrap {
    margin: 0 1.3rem 1.1rem;
    background: #0a0c11;
    border: 1px solid var(--border);
    border-radius: .75rem;
    overflow: hidden;
  }
  .code-topbar {
    display: flex;
    align-items: center;
    gap: .4rem;
    padding: .5rem .9rem;
    background: #12151d;
    border-bottom: 1px solid var(--border);
  }
  .dot { width: 10px; height: 10px; border-radius: 50%; }
  .dot-r { background: #ff5f57; }
  .dot-y { background: #ffbd2e; }
  .dot-g { background: #28c840; }
  .code-lang { margin-left: auto; font-family: var(--mono); font-size: .65rem; color: var(--muted); }

  pre {
    padding: 1rem 1.1rem;
    font-family: var(--mono);
    font-size: .82rem;
    line-height: 1.75;
    overflow-x: auto;
    white-space: pre;
  }

  /* keyword colours */
  .kw  { color: var(--purple); }
  .fn  { color: var(--blue); }
  .str { color: var(--yellow); }
  .cmt { color: #4a5568; font-style: italic; }
  .num { color: var(--green); }
  .var { color: #e2e8f0; }

  /* ── BLANK INPUT ── */
  .blank {
    display: inline-block;
    background: #1e2436;
    border: 1.5px dashed var(--blue);
    border-radius: .3rem;
    min-width: 90px;
    padding: 0 .3rem;
    font-family: var(--mono);
    font-size: .82rem;
    color: var(--text);
    outline: none;
    transition: border-color .2s, background .2s;
    vertical-align: middle;
    line-height: 1.4;
  }
  .blank:focus { border-color: var(--green); background: #1a2e26; }
  .blank.ok   { border-color: var(--green); background: #0a2318; color: var(--green); }
  .blank.err  { border-color: var(--red);   background: #2a0e14; color: var(--red); }

  /* ── HINT / ANSWER ── */
  .q-footer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .6rem;
    padding: .6rem 1.3rem .9rem;
  }
  .btn-hint, .btn-check, .btn-reveal {
    font-family: var(--mono);
    font-size: .72rem;
    letter-spacing: .05em;
    padding: .35rem .85rem;
    border-radius: .4rem;
    border: 1px solid;
    cursor: pointer;
    transition: background .2s, transform .1s;
  }
  .btn-hint   { color: var(--yellow); border-color: var(--yellow); background: #ffd16612; }
  .btn-check  { color: var(--green);  border-color: var(--green);  background: #00e5a012; }
  .btn-reveal { color: var(--muted);  border-color: var(--border); background: transparent; }
  .btn-hint:hover   { background: #ffd16628; }
  .btn-check:hover  { background: #00e5a028; }
  .btn-reveal:hover { background: #2a2f3f; }
  .btn-check:active, .btn-hint:active { transform: scale(.96); }

  .hint-box {
    display: none;
    width: 100%;
    font-size: .83rem;
    color: var(--yellow);
    background: #ffd16610;
    border: 1px solid #ffd16630;
    border-radius: .5rem;
    padding: .5rem .8rem;
    margin-top: .2rem;
  }
  .hint-box.show { display: block; }

  .result-msg {
    font-size: .82rem;
    font-weight: 600;
    display: none;
  }
  .result-msg.show { display: inline; }
  .result-msg.ok  { color: var(--green); }
  .result-msg.err { color: var(--red); }

  /* ── CONCEPT PILLS ── */
  .concept-row {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    padding: 0 1.3rem .9rem;
  }
  .cpill {
    font-size: .7rem;
    font-family: var(--mono);
    color: var(--muted);
    background: var(--card2);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: .2rem .6rem;
  }

  /* ── CHEAT SHEET ── */
  .cheat-sheet {
    max-width: 860px;
    margin: 0 auto 2rem;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 1.5rem 1.5rem;
  }
  .cheat-sheet h2 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--yellow);
    margin-bottom: 1rem;
    font-family: var(--mono);
    letter-spacing: .05em;
  }
  .cs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: .75rem;
  }
  .cs-item {
    background: var(--card2);
    border: 1px solid var(--border);
    border-radius: .6rem;
    padding: .65rem .9rem;
  }
  .cs-item .cs-fn { font-family: var(--mono); font-size: .8rem; color: var(--blue); }
  .cs-item .cs-desc { font-size: .78rem; color: var(--muted); margin-top: .2rem; }

  /* ── FOOTER ── */
  footer {
    text-align: center;
    color: var(--muted);
    font-size: .78rem;
    margin-top: 3rem;
    font-family: var(--mono);
  }
</style>
</head>
<body>

<header>
  <div class="badge-row">
    <span class="badge badge-l3">LESSON 3</span>
    <span class="badge badge-l4">LESSON 4</span>
  </div>
  <h1>PHP Quiz <span>Reviewer</span></h1>
  <p>Fill in the blanks to complete each PHP code snippet. Good luck tomorrow! 🍀</p>
</header>

<!-- Score bar -->
<div id="score-bar">
  <span id="score-display">0 / 0 correct</span>
  <div id="progress-wrap"><div id="progress-fill"></div></div>
</div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  LESSON 3 — CONTROL STRUCTURES                        -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="lesson-section l3">
  <div class="lesson-header">
    <span class="lesson-num">LESSON 3</span>
    <span class="lesson-title">Control Structures &amp; Operators</span>
  </div>

  <!-- Q1 -->
  <div class="q-card" id="q1">
    <div class="q-header">
      <span class="q-num">#1</span>
      <span class="q-prompt">Complete this <strong>if / else if / else</strong> chain that checks a student's grade and prints a remark.</span>
    </div>
    <div class="code-wrap">
      <div class="code-topbar"><span class="dot dot-r"></span><span class="dot dot-y"></span><span class="dot dot-g"></span><span class="code-lang">php</span></div>
      <pre><span class="kw">&lt;?php</span>
<span class="var">$score</span> = <span class="num">78</span>;

<span class="kw"><input class="blank" id="q1a" data-ans="if" size="4" placeholder="___"></span> (<span class="var">$score</span> <span class="kw">&gt;=</span> <span class="num">90</span>) {
    <span class="fn">echo</span> <span class="str">"Excellent!"</span>;
} <span class="kw"><input class="blank" id="q1b" data-ans="else if" size="9" placeholder="_______"></span> (<span class="var">$score</span> <span class="kw">&gt;=</span> <span class="num">75</span>) {
    <span class="fn">echo</span> <span class="str">"Passed!"</span>;
} <span class="kw"><input class="blank" id="q1c" data-ans="else" size="5" placeholder="___"></span> {
    <span class="fn">echo</span> <span class="str">"Failed."</span>;
}
<span class="kw">?&gt;</span></pre>
    </div>
    <div class="concept-row">
      <span class="cpill">if</span><span class="cpill">else if</span><span class="cpill">else</span><span class="cpill">comparison operators</span>
    </div>
    <div class="q-footer">
      <button class="btn-check" onclick="checkQ('q1',['q1a','q1b','q1c'])">Check ✓</button>
      <button class="btn-hint"  onclick="showHint('h1')">Hint 💡</button>
      <button class="btn-reveal" onclick="revealQ('q1',['q1a','q1b','q1c'])">Reveal</button>
      <span class="result-msg" id="r-q1"></span>
      <div class="hint-box" id="h1">Keywords that start / continue conditional branches: <code>if</code> → <code>else if</code> → <code>else</code></div>
    </div>
  </div>

  <!-- Q2 -->
  <div class="q-card" id="q2">
    <div class="q-header">
      <span class="q-num">#2</span>
      <span class="q-prompt">Complete this <strong>switch</strong> statement that prints the day name based on a number.</span>
    </div>
    <div class="code-wrap">
      <div class="code-topbar"><span class="dot dot-r"></span><span class="dot dot-y"></span><span class="dot dot-g"></span><span class="code-lang">php</span></div>
      <pre><span class="kw">&lt;?php</span>
<span class="var">$day</span> = <span class="num">3</span>;

<span class="kw"><input class="blank" id="q2a" data-ans="switch" size="7" placeholder="______"></span> (<span class="var">$day</span>) {
    <span class="kw"><input class="blank" id="q2b" data-ans="case" size="5" placeholder="___"></span> <span class="num">1</span>:
        <span class="fn">echo</span> <span class="str">"Monday"</span>;
        <span class="kw"><input class="blank" id="q2c" data-ans="break" size="6" placeholder="_____"></span>;
    <span class="kw">case</span> <span class="num">2</span>:
        <span class="fn">echo</span> <span class="str">"Tuesday"</span>;
        <span class="kw">break</span>;
    <span class="kw">case</span> <span class="num">3</span>:
        <span class="fn">echo</span> <span class="str">"Wednesday"</span>;
        <span class="kw">break</span>;
    <span class="kw"><input class="blank" id="q2d" data-ans="default" size="8" placeholder="_______"></span>:
        <span class="fn">echo</span> <span class="str">"Invalid day"</span>;
}
<span class="kw">?&gt;</span></pre>
    </div>
    <div class="concept-row">
      <span class="cpill">switch</span><span class="cpill">case</span><span class="cpill">break</span><span class="cpill">default</span>
    </div>
    <div class="q-footer">
      <button class="btn-check" onclick="checkQ('q2',['q2a','q2b','q2c','q2d'])">Check ✓</button>
      <button class="btn-hint"  onclick="showHint('h2')">Hint 💡</button>
      <button class="btn-reveal" onclick="revealQ('q2',['q2a','q2b','q2c','q2d'])">Reveal</button>
      <span class="result-msg" id="r-q2"></span>
      <div class="hint-box" id="h2">The switch block starts with <code>switch(n)</code>. Each option is a <code>case</code>, ends with <code>break</code>. The fallback is <code>default</code>.</div>
    </div>
  </div>

</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  LESSON 4 — FUNCTIONS                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="lesson-section l4">
  <div class="lesson-header">
    <span class="lesson-num">LESSON 4</span>
    <span class="lesson-title">Built-in &amp; User-Defined Functions</span>
  </div>

  <!-- Q3 -->
  <div class="q-card" id="q3">
    <div class="q-header">
      <span class="q-num">#3</span>
      <span class="q-prompt">Use the correct <strong>built-in string functions</strong> to fill each blank.</span>
    </div>
    <div class="code-wrap">
      <div class="code-topbar"><span class="dot dot-r"></span><span class="dot dot-y"></span><span class="dot dot-g"></span><span class="code-lang">php</span></div>
      <pre><span class="kw">&lt;?php</span>
<span class="var">$text</span> = <span class="str">"Hello World"</span>;

<span class="cmt">// 1. Get the number of characters</span>
<span class="fn">echo</span> <span class="fn"><input class="blank" id="q3a" data-ans="strlen" size="7" placeholder="______"></span>(<span class="var">$text</span>);         <span class="cmt">// 11</span>

<span class="cmt">// 2. Reverse the string</span>
<span class="fn">echo</span> <span class="fn"><input class="blank" id="q3b" data-ans="strrev" size="7" placeholder="______"></span>(<span class="var">$text</span>);      <span class="cmt">// dlroW olleH</span>

<span class="cmt">// 3. Convert to all uppercase</span>
<span class="fn">echo</span> <span class="fn"><input class="blank" id="q3c" data-ans="strtoupper" size="11" placeholder="_________"></span>(<span class="var">$text</span>);   <span class="cmt">// HELLO WORLD</span>

<span class="cmt">// 4. Replace "World" with "PHP"</span>
<span class="fn">echo</span> <span class="fn"><input class="blank" id="q3d" data-ans="str_replace" size="12" placeholder="__________"></span>(<span class="str">"World"</span>, <span class="str">"PHP"</span>, <span class="var">$text</span>);
<span class="kw">?&gt;</span></pre>
    </div>
    <div class="concept-row">
      <span class="cpill">strlen()</span><span class="cpill">strrev()</span><span class="cpill">strtoupper()</span><span class="cpill">str_replace()</span>
    </div>
    <div class="q-footer">
      <button class="btn-check" onclick="checkQ('q3',['q3a','q3b','q3c','q3d'])">Check ✓</button>
      <button class="btn-hint"  onclick="showHint('h3')">Hint 💡</button>
      <button class="btn-reveal" onclick="revealQ('q3',['q3a','q3b','q3c','q3d'])">Reveal</button>
      <span class="result-msg" id="r-q3"></span>
      <div class="hint-box" id="h3">String functions: length → <code>str<b>len</b></code>, reverse → <code>str<b>rev</b></code>, uppercase → <code>strtoupper</code>, find-replace → <code>str_replace</code></div>
    </div>
  </div>

  <!-- Q4 -->
  <div class="q-card" id="q4">
    <div class="q-header">
      <span class="q-num">#4</span>
      <span class="q-prompt">Define a <strong>user-defined function</strong> called <code>greetUser</code> that accepts a name and returns a greeting string.</span>
    </div>
    <div class="code-wrap">
      <div class="code-topbar"><span class="dot dot-r"></span><span class="dot dot-y"></span><span class="dot dot-g"></span><span class="code-lang">php</span></div>
      <pre><span class="kw">&lt;?php</span>

<span class="cmt">// Define the function</span>
<span class="kw"><input class="blank" id="q4a" data-ans="function" size="9" placeholder="________"></span> greetUser(<span class="var"><input class="blank" id="q4b" data-ans="$name" size="6" placeholder="_____"></span>) {
    <span class="kw"><input class="blank" id="q4c" data-ans="return" size="7" placeholder="______"></span> <span class="str">"Hello, "</span> . <span class="var">$name</span> . <span class="str">"!"</span>;
}

<span class="cmt">// Call the function</span>
<span class="var">$result</span> = <span class="fn"><input class="blank" id="q4d" data-ans="greetUser" size="10" placeholder="_________"></span>(<span class="str">"Maria"</span>);
<span class="fn">echo</span> <span class="var">$result</span>; <span class="cmt">// Hello, Maria!</span>

<span class="kw">?&gt;</span></pre>
    </div>
    <div class="concept-row">
      <span class="cpill">function keyword</span><span class="cpill">parameters</span><span class="cpill">return</span><span class="cpill">function call</span>
    </div>
    <div class="q-footer">
      <button class="btn-check" onclick="checkQ('q4',['q4a','q4b','q4c','q4d'])">Check ✓</button>
      <button class="btn-hint"  onclick="showHint('h4')">Hint 💡</button>
      <button class="btn-reveal" onclick="revealQ('q4',['q4a','q4b','q4c','q4d'])">Reveal</button>
      <span class="result-msg" id="r-q4"></span>
      <div class="hint-box" id="h4">Syntax: <code>function functionName($param) { return ...; }</code> — then call it like <code>functionName("value")</code>.</div>
    </div>
  </div>

</section>

<!-- ═════════════════════════════════════ CHEAT SHEET ══ -->
<div class="cheat-sheet">
  <h2>// QUICK REFERENCE</h2>
  <div class="cs-grid">
    <div class="cs-item"><div class="cs-fn">if / else if / else</div><div class="cs-desc">Multi-branch conditional</div></div>
    <div class="cs-item"><div class="cs-fn">switch ($n) { case X: break; }</div><div class="cs-desc">Select from many cases</div></div>
    <div class="cs-item"><div class="cs-fn">strlen($s)</div><div class="cs-desc">Number of characters</div></div>
    <div class="cs-item"><div class="cs-fn">str_word_count($s)</div><div class="cs-desc">Count words in string</div></div>
    <div class="cs-item"><div class="cs-fn">strrev($s)</div><div class="cs-desc">Reverse a string</div></div>
    <div class="cs-item"><div class="cs-fn">strpos($s, "find")</div><div class="cs-desc">Position of substring</div></div>
    <div class="cs-item"><div class="cs-fn">str_replace($f,$r,$s)</div><div class="cs-desc">Find & replace in string</div></div>
    <div class="cs-item"><div class="cs-fn">strtolower($s)</div><div class="cs-desc">All lowercase</div></div>
    <div class="cs-item"><div class="cs-fn">strtoupper($s)</div><div class="cs-desc">All uppercase</div></div>
    <div class="cs-item"><div class="cs-fn">ucwords($s)</div><div class="cs-desc">Capitalize each word</div></div>
    <div class="cs-item"><div class="cs-fn">round($n, $decimals)</div><div class="cs-desc">Round a float</div></div>
    <div class="cs-item"><div class="cs-fn">abs($n)</div><div class="cs-desc">Absolute value</div></div>
    <div class="cs-item"><div class="cs-fn">rand($min, $max)</div><div class="cs-desc">Random integer</div></div>
    <div class="cs-item"><div class="cs-fn">date("d/m/Y")</div><div class="cs-desc">Format current date</div></div>
    <div class="cs-item"><div class="cs-fn">function name($p) { return; }</div><div class="cs-desc">User-defined function</div></div>
  </div>
</div>

<footer>PHP Reviewer · Lessons 3 &amp; 4 · Good luck on your quiz! 💻</footer>

<script>
  // Track totals
  const checked = {};   // qId -> bool

  function normalize(s) {
    return s.trim().toLowerCase().replace(/\s+/g,'');
  }

  function checkQ(qId, ids) {
    const card = document.getElementById(qId);
    let allOk = true;
    ids.forEach(id => {
      const inp = document.getElementById(id);
      const ans = normalize(inp.dataset.ans);
      const val = normalize(inp.value);
      if (val === ans) {
        inp.classList.add('ok'); inp.classList.remove('err');
      } else {
        inp.classList.add('err'); inp.classList.remove('ok');
        allOk = false;
      }
    });
    const msg = document.getElementById('r-' + qId);
    msg.className = 'result-msg show ' + (allOk ? 'ok' : 'err');
    msg.textContent = allOk ? '✓ All correct!' : '✗ Some blanks are wrong.';
    card.classList.toggle('correct', allOk);
    card.classList.toggle('wrong', !allOk);
    checked[qId] = allOk;
    updateScore();
  }

  function revealQ(qId, ids) {
    ids.forEach(id => {
      const inp = document.getElementById(id);
      inp.value = inp.dataset.ans;
      inp.classList.add('ok'); inp.classList.remove('err');
    });
    const card = document.getElementById(qId);
    card.classList.add('correct'); card.classList.remove('wrong');
    const msg = document.getElementById('r-' + qId);
    msg.className = 'result-msg show ok';
    msg.textContent = '(revealed)';
    checked[qId] = false; // don't count as scored
    updateScore();
  }

  function showHint(hId) {
    const box = document.getElementById(hId);
    box.classList.toggle('show');
  }

  function updateScore() {
    const total = 4;
    const correct = Object.values(checked).filter(Boolean).length;
    document.getElementById('score-display').textContent = `${correct} / ${total} correct`;
    document.getElementById('progress-fill').style.width = (correct/total*100) + '%';
  }
</script>
</body>
</html>