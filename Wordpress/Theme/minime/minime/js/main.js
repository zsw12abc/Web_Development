

var $ = jQuery.noConflict();

$(document).ready(function ($) {

    /*-------------------------------------------------*/
    /* = preload animate
    /*-------------------------------------------------*/

    try {

        setTimeout(function () { $("#loader-wrapper").slideUp() }, 2000);
    } catch (err) {
    }


    /*-------------------------------------------------*/
    /* = menu
    /*-------------------------------------------------*/

    $('.menu li').click(function () {
        $('.menu li').removeClass('current');
        $(this).addClass('current');
       });

    // Mobile menu toggle
    var mobile_nav = $(".mini-menu");
    mobile_nav.click(function () {
        $("#top").find(".menu").toggle(2000);
    });




    /**
    * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
    * Dual licensed under MIT and GPL.
    * @author Ariel Flesler
    * @version 1.4.3
    */
    ; (function ($) { var h = $.scrollTo = function (a, b, c) { $(window).scrollTo(a, b, c) }; h.defaults = { axis: 'xy', duration: parseFloat($.fn.jquery) >= 1.3 ? 0 : 1, limit: true }; h.window = function (a) { return $(window)._scrollable() }; $.fn._scrollable = function () { return this.map(function () { var a = this, isWin = !a.nodeName || $.inArray(a.nodeName.toLowerCase(), ['iframe', '#document', 'html', 'body']) != -1; if (!isWin) return a; var b = (a.contentWindow || a).document || a.ownerDocument || a; return /webkit/i.test(navigator.userAgent) || b.compatMode == 'BackCompat' ? b.body : b.documentElement }) }; $.fn.scrollTo = function (e, f, g) { if (typeof f == 'object') { g = f; f = 0 } if (typeof g == 'function') g = { onAfter: g }; if (e == 'max') e = 9e9; g = $.extend({}, h.defaults, g); f = f || g.duration; g.queue = g.queue && g.axis.length > 1; if (g.queue) f /= 2; g.offset = both(g.offset); g.over = both(g.over); return this._scrollable().each(function () { if (!e) return; var d = this, $elem = $(d), targ = e, toff, attr = {}, win = $elem.is('html,body'); switch (typeof targ) { case 'number': case 'string': if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)) { targ = both(targ); break } targ = $(targ, this); if (!targ.length) return; case 'object': if (targ.is || targ.style) toff = (targ = $(targ)).offset() } $.each(g.axis.split(''), function (i, a) { var b = a == 'x' ? 'Left' : 'Top', pos = b.toLowerCase(), key = 'scroll' + b, old = d[key], max = h.max(d, a); if (toff) { attr[key] = toff[pos] + (win ? 0 : old - $elem.offset()[pos]); if (g.margin) { attr[key] -= parseInt(targ.css('margin' + b)) || 0; attr[key] -= parseInt(targ.css('border' + b + 'Width')) || 0 } attr[key] += g.offset[pos] || 0; if (g.over[pos]) attr[key] += targ[a == 'x' ? 'width' : 'height']() * g.over[pos] } else { var c = targ[pos]; attr[key] = c.slice && c.slice(-1) == '%' ? parseFloat(c) / 100 * max : c } if (g.limit && /^\d+$/.test(attr[key])) attr[key] = attr[key] <= 0 ? 0 : Math.min(attr[key], max); if (!i && g.queue) { if (old != attr[key]) animate(g.onAfterFirst); delete attr[key] } }); animate(g.onAfter); function animate(a) { $elem.animate(attr, f, g.easing, a && function () { a.call(this, e, g) }) } }).end() }; h.max = function (a, b) { var c = b == 'x' ? 'Width' : 'Height', scroll = 'scroll' + c; if (!$(a).is('html,body')) return a[scroll] - $(a)[c.toLowerCase()](); var d = 'client' + c, html = a.ownerDocument.documentElement, body = a.ownerDocument.body; return Math.max(html[scroll], body[scroll]) - Math.min(html[d], body[d]) }; function both(a) { return typeof a == 'object' ? a : { top: a, left: a} } })(jQuery);

        $(document).on("scroll", onScroll);

        //smoothscroll
        $('nav a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            $(document).off("scroll");

            $('a').each(function () {
                $(this).removeClass('active');
            })
            $(this).addClass('active');

            var target = this.hash,
            menu = target;
            $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 500, 'swing', function () {
                window.location.hash = target;
                $(document).on("scroll", onScroll);
            });

        });


    function onScroll(event) {
        try {
            var scrollPos = $(document).scrollTop();
            $('.menu a').each(function () {
                var currLink = $(this);
                var refElement = $(currLink.attr("href"));
                if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                    $('.menu li a').removeClass("active");
                    currLink.addClass("active");
                }
                else {
                    currLink.removeClass("active");
                }

            });
        } catch (err) {

        }
    }

    /*-------------------------------------------------*/
    /* = skills animate
    /*-------------------------------------------------*/

    try {

        var skillBar = $('.skills-progress');
        skillBar.appear(function () {

            var animateElement = $(".meter > p");
            animateElement.each(function () {
                $(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
					    width: $(this).data("origWidth")
					}, 1200);
            });

        });
    } catch (err) {
}

    /********************************************
    PORTFOLIO
    ********************************************/
    $(window).load(function () {
        var $container = $('.albumContainer');
        $container.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        $('.albumFilter li').click(function () {
            $('.albumFilter .current').removeClass('current');
            $(this).addClass('current');

            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
    });

    /********************************************
    OPEN PAGE DETAILS
    ********************************************/
    $(document).ready(function () {
        $(".smooth-redirect").click(function (event) {
            event.preventDefault();
            linkLocation = this.href;
            $("body").fadeOut(1000, redirectPage);
        });
        function redirectPage() {
            window.location = linkLocation;
        }
    });

    /********************************************
    CAROUSEL
    ********************************************/
    $("#owl-demo").owlCarousel({

        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true

        // "singleItem:true" is a shortcut for:
        // items : 1, 
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });

    /********************************************
    CAROUSEL BLOG
    ********************************************/
    $("#owl-demo-blog").owlCarousel({
        navigation: false,
        slideSpeed: 300,
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 3
    });

    
});

    /********************************************
    EMAIL CONTROL
    ********************************************/

$(function () {
    "use strict";
    $('#contact_form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var name = $("#name").val();
        var email = $("#email").val();
        var text = $("#message").val();
        var dataString = 'name=' + name + '&email=' + email + '&message=' + text;
        var proceed = true;
        if (name == "") {
            $('input[name=name]').css('border-color', '#e41919');
            proceed = false;
        }
        if (email == "") {
            $('input[name=email]').css('border-color', '#e41919');
            proceed = false;
        }

        if (text == "") {
            $('textarea[name=message]').css('border-color', '#e41919');
            proceed = false;
        }
        
            function isValidEmail(emailAddress) {
                var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                return pattern.test(emailAddress);
            };
            if (isValidEmail(email) && proceed) {
//            if (isValidEmail(email) && (text.length > 20) && (name.length > 1)) {
                $.ajax({
                    type: 'POST',
                    url: "contact_form/contact_process.php",
                    data: dataString,
                    success: function () {
                        $('.success').fadeIn(1000);
                        $("#name").val("");
                        $("#email").val("");
                        $("#message").val("");
                    }
                });
            } else {
                $('.error').fadeIn(1000);
            }
        
    });
    });




    /********************************************
    GOOGLE MAPS
    ********************************************/

// The following example creates a marker in Stockholm, Sweden
// using a DROP animation. Clicking on the marker will toggle
// the animation between a BOUNCE animation and no animation.
$(document).ready(function ($) {
    "use strict";

    $(".cover-map").click(function () {
        $(this).toggleClass("map-active");
        $(this).find(".mm-open").toggle();
        $(this).find(".mm-close").toggle();
    });

});


/***BUTTON ANCHOR TOP****/
$(function () {
    "use strict";
    $().UItoTop({
        scrollSpeed: 500,
        easingType: 'linear'
    });
});