(function () {
  "use strict";

  var state = {
    yes: 1513,
    no: 255,
    goal: 2000,
  };

  var els = {};
  var feedVotes = [];

  var REDUCED = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function $(id) { return document.getElementById(id); }

  document.addEventListener("DOMContentLoaded", function () {
    cacheEls();
    boot(function () {
      seedFeed();
      startFeed();
      render();
      bindEvents();
    });
  });

  function cacheEls() {
    els.yesBtn = $("voteYes");
    els.noBtn = $("voteNo");
    els.copyLink = $("copyLink");
    els.copyLabel = $("copyLabel");
    els.clock = $("clock");
    els.feedList = $("feedList");
    els.feedCount = $("feedCount");
    els.boot = $("boot");
    els.bootText = $("bootText");
  }

  function total() { return state.yes + state.no; }
  function yesPct() { return total() ? Math.round((state.yes / total()) * 100) : 0; }
  function noPct() { return 100 - yesPct(); }
  function fmt(n) { return n.toLocaleString("en-US"); }

  /* ---------- boot sequence ---------- */
  var BOOT_LINES = [
    "> vote.terminal v2.6.1",
    "> mounting /ballot .......... OK",
    "> loading token LAPTOP 0x76Ed..0b7F",
    "> connecting to robinhood.chain ..... OK",
    "> syncing tallies ......... 1,768 votes",
    "> opening feed stream ...... LIVE",
    "> ready.",
  ];

  function boot(done) {
    if (!els.boot) { done(); return; }
    if (REDUCED) { els.boot.classList.add("done"); done(); return; }
    var i = 0;
    els.bootText.textContent = "";
    (function type() {
      if (i >= BOOT_LINES.length) {
        setTimeout(function () {
          els.boot.classList.add("done");
          setTimeout(done, 350);
        }, 380);
        return;
      }
      els.bootText.textContent += (i ? "\n" : "") + BOOT_LINES[i];
      i++;
      setTimeout(type, 200 + Math.random() * 180);
    })();
  }

  /* ---------- render ---------- */
  function render() {
    var yp = yesPct();
    var np = noPct();

    $("yesMeta").textContent = fmt(state.yes) + " . " + yp + "%";
    $("noMeta").textContent = fmt(state.no) + " . " + np + "%";
    $("cntYes").textContent = fmt(state.yes);
    $("cntNo").textContent = fmt(state.no);
    $("cntTotal").textContent = fmt(total());
    $("supportNum").textContent = yp;

    els.barYes = els.barYes || $("barYes");
    els.barNo = els.barNo || $("barNo");
    els.barYes.style.width = yp + "%";
    els.barNo.style.width = np + "%";

    els.milestoneFill = els.milestoneFill || $("milestoneFill");
    var mPct = Math.min(100, Math.round((total() / state.goal) * 100));
    els.milestoneFill.style.width = mPct + "%";
    $("milestonePct").textContent = mPct;

    $("yesPct").textContent = "[" + yp + "%]";
    $("noPct").textContent = "[" + np + "%]";
    $("totalTag").textContent = "votes";
  }

  /* ---------- events ---------- */
  function bindEvents() {
    els.yesBtn.addEventListener("click", noop);
    els.noBtn.addEventListener("click", noop);
    els.copyLink.addEventListener("click", copyVoteLink);

    window.addEventListener("scroll", function () {
      var y = window.scrollY;
      document.querySelector(".header").classList.toggle("hidden-up", y > 90 && y > (window._lastY || 0));
      window._lastY = y;
    });

    setInterval(tickClock, 1000);
  }

  function noop() {}

  function tickClock() {
    if (!els.clock) return;
    var d = new Date();
    var p = function (x) { return (x < 10 ? "0" : "") + x; };
    els.clock.textContent = p(d.getHours()) + ":" + p(d.getMinutes()) + ":" + p(d.getSeconds());
  }

  /* ---------- feed ---------- */
  var SEED = [
    ["0xFB4A\u202685B1", true], ["0x7220\u2026E153", false],
    ["0x31C8\u2026A6E1", true], ["0x71B9\u2026866A", true],
    ["0xD4E0\u2026A1E2", false], ["0x3207\u2026B78C", true],
    ["0x99C4\u2026F012", true], ["0x5E3B\u2026D291", true],
    ["0xB1F8\u2026730C", false], ["0x2C1A\u20269E4D", true],
    ["0xE89D\u20265510", true], ["0x6A3F\u20260C81", true],
  ];

  function seedFeed() {
    var base = Date.now() - SEED.length * 90000;
    for (var i = 0; i < SEED.length; i++) {
      feedVotes.push({ addr: SEED[i][0], yes: SEED[i][1], time: base + i * 90000 });
    }
    renderFeed();
  }

  function startFeed() {
    (function loop() {
      setTimeout(function () {
        var yes = Math.random() > 0.14;
        var addr = randAddress();
        pushFeed(yes, "0x" + addr.slice(2, 6).toUpperCase() + "\u2026" + addr.slice(-4).toUpperCase());
        if (!document.hidden) {
          if (yes) state.yes++; else state.no++;
          render();
        }
        loop();
      }, 4200 + Math.random() * 4800);
    })();

    setInterval(function () {
      if (document.hidden) return;
      renderFeed();
    }, 45000);

    setInterval(function () {
      var extra = Math.max(0, (total() - 1768) / 10);
      $("feedCount").textContent = (24 + Math.round(extra)) + " votes / 10 min";
    }, 6000);
  }

  function pushFeed(yes, shortAddr) {
    feedVotes.unshift({ addr: shortAddr, yes: yes, time: Date.now() });
    if (feedVotes.length > 60) feedVotes.pop();
    renderFeed(true);
  }

  function renderFeed(animateNew) {
    els.feedList.innerHTML = "";
    var n = Math.min(feedVotes.length, 30);
    for (var i = 0; i < n; i++) {
      var v = feedVotes[i];
      var line = document.createElement("div");
      line.className = "log-line mono" + (animateNew && i === 0 ? " new" : "");

      var t = document.createElement("span");
      t.className = "ll-time";
      t.textContent = stamp(v.time);

      var a = document.createElement("span");
      a.className = "ll-addr";
      a.textContent = v.addr;

      var vt = document.createElement("span");
      vt.className = "ll-vote " + (v.yes ? "yes" : "no");
      vt.textContent = v.yes ? "YES" : "NO";

      line.appendChild(t); line.appendChild(a); line.appendChild(vt);
      els.feedList.appendChild(line);
    }
  }

  function stamp(t) {
    var d = new Date(t);
    var p = function (x) { return (x < 10 ? "0" : "") + x; };
    return p(d.getHours()) + ":" + p(d.getMinutes()) + ":" + p(d.getSeconds());
  }

  function randAddress() {
    var hex = "0123456789abcdef";
    var out = "0x";
    for (var i = 0; i < 40; i++) out += hex[Math.floor(Math.random() * 16)];
    return out;
  }

  /* ---------- copy ---------- */
  function copyVoteLink() {
    var done = function () {
      els.copyLabel.textContent = "[copied!]";
      toast("vote link copied to clipboard.", "info");
      setTimeout(function () { els.copyLabel.textContent = "[copy_vote_link]"; }, 1600);
    };
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(location.href).then(done).catch(function () { fallbackCopy(done); });
    } else fallbackCopy(done);
  }

  function fallbackCopy(done) {
    var ta = document.createElement("textarea");
    ta.value = location.href;
    ta.style.cssText = "position:fixed;opacity:0";
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand("copy"); done(); } catch (e) {}
    document.body.removeChild(ta);
  }

  /* ---------- toast ---------- */
  function toast(msg, kind) {
    var wrap = $("toastWrap");
    if (!wrap) return;
    while (wrap.children.length >= 4) wrap.removeChild(wrap.firstChild);
    var t = document.createElement("div");
    t.className = "toast mono";
    t.innerHTML = "<span class='toast-" + kind + "'>" +
      (kind === "ok" ? "[\u2713]" : kind === "err" ? "[\u2715]" : "[i]") +
      "</span> " + msg;
    wrap.appendChild(t);
    setTimeout(function () {
      t.classList.add("out");
      setTimeout(function () { if (t.parentNode) t.parentNode.removeChild(t); }, 320);
    }, 3000);
  }

  /* ---------- debris ---------- */
  var SYM_YES = ["\u2588", "\u2593", "\u2592", "\u270E", "\u222A", "\u25C9", "\uF8FF"];
  var SYM_NO = ["\u2715", "\u2588", "\u25CE", "\u2198"];

  function burstYes() { burstDebris(SYM_YES, 64, false); }
  function burstNo() { burstDebris(SYM_NO, 34, true); }

  function burstDebris(syms, count, red) {
    var layer = $("debris");
    for (var i = 0; i < count; i++) {
      var p = document.createElement("span");
      p.className = "debris-piece" + (red ? " red" : "");
      p.textContent = syms[Math.floor(Math.random() * syms.length)];
      p.style.left = 6 + Math.random() * 88 + "%";
      p.style.fontSize = (12 + Math.random() * 16) + "px";
      p.style.animationDuration = (1.5 + Math.random() * 1.6) + "s";
      p.style.animationDelay = (Math.random() * 0.35) + "s";
      layer.appendChild(p);
      (function (el) {
        setTimeout(function () { if (el.parentNode) el.parentNode.removeChild(el); }, 3600);
      })(p);
    }
  }

  /* ---------- static grain ---------- */
  initStatic();

  function initStatic() {
    if (REDUCED) return;
    var cv = document.createElement("canvas");
    cv.id = "staticCanvas";
    cv.style.cssText = "position:fixed;inset:0;z-index:3;pointer-events:none;opacity:0.5;width:100%;height:100%";
    document.body.appendChild(cv);
    function grain() {
      var w = cv.width = cv.offsetWidth;
      var h = cv.height = cv.offsetHeight;
      var ctx = cv.getContext("2d");
      var img = ctx.createImageData(w, h);
      for (var i = 0; i < img.data.length; i += 4) {
        var v = Math.random() * 255;
        img.data[i] = v; img.data[i + 1] = v * 0.9; img.data[i + 2] = v * 0.7; img.data[i + 3] = 14;
      }
      ctx.putImageData(img, 0, 0);
      clearTimeout(grain._t);
      grain._t = setTimeout(grain, 260);
    }
    grain();
  }
})();