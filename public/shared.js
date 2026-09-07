(function () {
  "use strict";

  var REDUCED = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function $(id) { return document.getElementById(id); }

  var els = {};
  var BOOT_LINES = [
    "> vote.terminal v2.6.1",
    "> mounting /page .......... OK",
    "> connecting to robinhood.chain ..... OK",
    "> ready.",
  ];

  document.addEventListener("DOMContentLoaded", function () {
    cacheEls();
    boot();
    bind();
    if (els.clock) setInterval(tickClock, 1000);
    initGrain();
  });

  function cacheEls() {
    els.clock = $("clock");
    els.boot = $("boot");
    els.bootText = $("bootText");
  }

  function boot() {
    if (!els.boot) return;
    if (REDUCED) { els.boot.classList.add("done"); return; }
    var i = 0;
    (function type() {
      if (i >= BOOT_LINES.length) {
        setTimeout(function () { els.boot.classList.add("done"); }, 320);
        return;
      }
      els.bootText.textContent += (i ? "\n" : "") + BOOT_LINES[i];
      i++;
      setTimeout(type, 160 + Math.random() * 140);
    })();
  }

  function bind() {
    window.addEventListener("scroll", function () {
      var h = document.querySelector(".header");
      if (!h) return;
      var y = window.scrollY;
      h.classList.toggle("hidden-up", y > 90 && y > (window._lastY || 0));
      window._lastY = y;
    });
  }

  function tickClock() {
    if (!els.clock) return;
    var d = new Date();
    var p = function (x) { return (x < 10 ? "0" : "") + x; };
    els.clock.textContent = p(d.getHours()) + ":" + p(d.getMinutes()) + ":" + p(d.getSeconds());
  }

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
  window.VTToast = toast;

  function initGrain() {
    if (REDUCED) return;
    var cv = document.createElement("canvas");
    cv.style.cssText = "position:fixed;inset:0;z-index:3;pointer-events:none;opacity:0.4;width:100%;height:100%";
    document.body.appendChild(cv);
    var t = null;
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
      clearTimeout(t);
      t = setTimeout(grain, 300);
    }
    grain();
  }
})();