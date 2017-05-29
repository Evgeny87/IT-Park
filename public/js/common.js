$(document).ready(function() {
! function(i) {
      var o, n;
      i(".title_block").on("click", function() {
        o = i(this).parents(".accordion_item"), n = o.find(".info"),
          o.hasClass("active_block") ? (o.removeClass("active_block"),
            n.slideUp()) : (o.addClass("active_block"), n.stop(!0, !0).slideDown(),
            o.siblings(".active_block").removeClass("active_block").children(
              ".info").stop(!0, !0).slideUp())
      })
    }(jQuery);
});
