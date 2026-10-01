/**
 * Sticky header behaviour for the RT Mega Menu Elementor widget.
 *
 * This used to be printed as two inline <script> blocks inside the widget's
 * render(), chosen in PHP. The bodies are unchanged; the widget now adds the
 * rtmega-sticky-on / rtmega-backscroll-on classes to its container and the
 * branch is chosen here instead, so no script is written into the page by hand.
 */
(function ($) {
	'use strict';

	function rtmegaStickyWithBackscroll() {
                var header = $('header');
                var page = $('#page');
                var topbar = $('.rt-topbar-hide');
                header.addClass("sticky-header-on");
                header.addClass("rt-mega-up-scroll-hide");
                function updatePaddingAndMargin() {
                    var headerHeight = header.outerHeight();
                    var topbarHeight = topbar.length ? topbar.outerHeight() : 0;
        
                    if (header.length && page.length) {
        	            if (!header.hasClass('fixed-header')) {
                               page.css('padding-top', headerHeight + 'px');
                           } else {
                               page.css('padding-top', '');
                           }
                       }
        
                   	if (header.length) {
        	            if (header.hasClass('rt-mega-up-scroll-hide')) {
        	                header.css('margin-top', `-${topbarHeight}px`);
        	            } else {
        	                header.css('margin-top', '0px');
        	            }
        	        }
                }
        
                if ($('.sticky-header-on').length) {
                    let lastScroll = 0;
        
                    function sticky_header() {
                        var headerHeight = header.innerHeight();
                        let scroll = $(window).scrollTop();
        
                        if (scroll > headerHeight ) {
                            header.addClass('sticky-header');
                        } else {
                            header.removeClass('sticky-header');
                        }
        
                        if (scroll > headerHeight ) {
                            header.addClass('rt-mega-up-scroll-hide');
                        } else {
                            header.removeClass('rt-mega-up-scroll-hide');
                        }
        
                        if (scroll > headerHeight && scroll > lastScroll) {
                            header.addClass('sticky-headers');
                        } else if (scroll < lastScroll) {
                            header.removeClass('sticky-headers');
                        }
                        lastScroll = scroll;
                        updatePaddingAndMargin();
                    }
        
                    $(document).ready(() => {
                        updatePaddingAndMargin();
                        sticky_header();
                    });
        
                    window.onload = () => {
                        updatePaddingAndMargin();
                        sticky_header();
                    };
        
                    $(window).on('scroll resize', () => {
                        sticky_header();
                        updatePaddingAndMargin();
                    });
                }
        
            })(jQuery);
        </script>
	}

	function rtmegaStickyPlain() {
                var header = $('header');
                var page = $('#page');
                var topbar = $('.rt-topbar-hide');
                header.addClass("sticky-header-on");
                function updatePaddingAndMargin() {
                    var headerHeight = header.outerHeight();
                    var topbarHeight = topbar.length ? topbar.outerHeight() : 0;
        
                    if (header.length && page.length) {
        	            if (!header.hasClass('fixed-header')) {
                               page.css('padding-top', headerHeight + 'px');
                           } else {
                               page.css('padding-top', '');
                           }
                       }
        
                   	if (header.length) {
        	            if (header.hasClass('sticky-headers')) {
        	                header.css('margin-top', `-${topbarHeight}px`);
        	            } else {
        	                header.css('margin-top', '0px');
        	            }
        	        }
                }
        
                if ($('.sticky-header-on').length) {
                    let lastScroll = 0;
        
                    function sticky_header() {
        
                        var headerHeight = header.innerHeight();
                        let scroll = $(window).scrollTop();
        
                        if (scroll > headerHeight ) {
                            header.addClass('sticky-header');
                        } else {
                            header.removeClass('sticky-header');
                        }				                 
        
                        if (scroll > headerHeight && scroll > lastScroll) {
                            header.addClass('sticky-headers');
                        } else if (scroll < lastScroll) {
                            header.removeClass('sticky-headers');
                        }
        
                        lastScroll = scroll;
                        updatePaddingAndMargin();
                    }
        
                    $(document).ready(() => {
                        updatePaddingAndMargin();
                        sticky_header();
                    });
        
                    window.onload = () => {
                        updatePaddingAndMargin();
                        sticky_header();
                    };
        
                    $(window).on('scroll resize', () => {
                        sticky_header();
                        updatePaddingAndMargin();
                    });
                }
        
            })(jQuery);
        </script>
	}

	$(function () {
		var $wrap = $('.rtmega-sticky-on').first();

		if (!$wrap.length) {
			return;
		}

		if ($wrap.hasClass('rtmega-backscroll-on')) {
			rtmegaStickyWithBackscroll();
		} else {
			rtmegaStickyPlain();
		}
	});
})(jQuery);
