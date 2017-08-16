/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    _this.$ratioImages = $('.ratio-image');
    _this.$masonryHolder = $('.masonry-holder');

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      // Size ratio images and layout masonry as loaded
      if (_this.$ratioImages.length) {
        $('#main-content').imagesLoaded().progress( function() {
          _this.sizeImages();
        });
      }
    });

  },

  onResize: function() {
    var _this = this;

    if (_this.$ratioImages.length) {
      // Debounced masonry & image re-layout
      clearTimeout(_this.resizeTimer);
      _this.resizeTimer = setTimeout(function() {
        _this.sizeImages();
      }, 250);
    }

  },

  layoutMasonry: function() {
    var _this = this;

    _this.$masonryHolder.masonry({
      itemSelector: '.masonry-item',
      transitionDuration: 0,
    });
  },

  sizeImages: function() {
    var _this = this;

    // Set image max-height to width of container
    _this.$ratioImages.each(function() {
      var width = $(this).parent().width();

      $(this).css('max-height', width);
    });

    // Layout masonry after $.each (synchronous)
    if (_this.$masonryHolder.length) {
      _this.layoutMasonry();
    }
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
