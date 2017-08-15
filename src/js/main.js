/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

      // Init Masonry
      _this.$masonry = $('.masonry-holder').masonry({
        itemSelector: '.masonry-item',
        transitionDuration: 0,
      });

      // Re-layout as images get loaded
      _this.$masonry.imagesLoaded().progress( function() {
        _this.$masonry.masonry('layout');
      });
    });

  },

  onResize: function() {
    var _this = this;

    // Debounced masonry re-layout
    clearTimeout(_this.resizeTimer);
    _this.resizeTimer = setTimeout(function() {
      _this.$masonry.masonry('layout');
    }, 250);

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.init();
