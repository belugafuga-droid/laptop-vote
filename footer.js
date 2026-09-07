(function () {
  "use strict";
  var anchor = document.querySelector(".page-footer");
  if (!anchor) return;
  var page = anchor.getAttribute("data-page") || "";

  var PRODUCT = [["explore", "explore.html"], ["analytics", "analytics.html"], ["create", "create.html"], ["profile", "profile.html"], ["docs", "docs.html"]];
  var LEGAL = [["privacy", "privacy.html"], ["terms", "terms.html"], ["risk_notice", "risk_notice.html"]];

  function link(entry) {
    var name = entry[0], href = entry[1];
    var cls = name === page ? ' class="hl-dim"' : "";
    return '<a href="' + href + '"' + cls + ">[" + name + "]</a>";
  }

  var footer =
    '<section class="screen footer">' +
      '<div class="screen-body">' +
        '<div class="f-cols">' +
          '<div class="f-col"><h4 class="mono">// product</h4>' +
            PRODUCT.map(link).join("") +
          "</div>" +
          '<div class="f-col"><h4 class="mono">// legal</h4>' +
            LEGAL.map(link).join("") +
          "</div>" +
        "</div>" +
        '<div class="risk mono"><span class="hl-amber">!!</span> RISK NOTICE: transactions are submitted through your wallet and may be irreversible. tokens can be volatile or lose all value. vote is informational &bull; not financial advice.</div>' +
        '<div class="f-bottom mono"><span>© 2026 vote.terminal</span><span>sig: LAPTOP_0x76Ed &bull; est. on-chain</span></div>' +
      "</div>" +
    "</section>";

  anchor.outerHTML = footer;
})();