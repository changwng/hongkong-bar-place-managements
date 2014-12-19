/* Use this js doc for Coupon Single page JS */

// -----------------------------------------------------------------------
// printThis v1.1
// Printing plug-in for jQuery
//
// Resources (based on) :
//              jPrintArea: http://plugins.jquery.com/project/jPrintArea
//              jqPrint: https://github.com/permanenttourist/jquery.jqprint
//              Ben Nadal: http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm
//
// Dual licensed under the MIT and GPL licenses:
//              http://www.opensource.org/licenses/mit-license.php
//              http://www.gnu.org/licenses/gpl.html
//
// (c) Jason Day 2012
//
// Usage:
//
// $("#mySelector").printThis({
//      debug: false, //show the iframe for debugging
//      importCSS: true, // import page CSS
//      printContainer: true, // grab outer container as well as the contents of the selector
//      loadCSS: "path/to/my.css" //path to additional css file
//  });
//
// Notes:
//  - the loadCSS option does not need @media print
//------------------------------------------------------------------------

(function ($) {
    var opt;

    $.fn.printThis = function (options) {
        opt = $.extend({}, $.fn.printThis.defaults, options);

        var $element = (this instanceof jQuery) ? this : $(this);

        // if Opera, open a new tab
        if ($.browser.opera) {
            var tab = window.open("", "Print Preview");
            tab.document.open();


        }
        // add dynamic iframe to DOM
        else {
            var strFrameName = ("printThis-" + (new Date()).getTime());

            var $iframe = $("<iframe id='" + strFrameName + "' src='about:blank'/>");

            if (!opt.debug) {
                $iframe.css({ position: "absolute", width: "0px", height: "0px", left: "-600px", top: "-600px" });
            }

            $iframe.appendTo("body");

        }
        // allow iframe to fully render before action
        setTimeout(function () {

            if ($.browser.opera) {
                var $doc = tab.document;
            } else {
                var $doc = $("#" + strFrameName).contents();
            }


            // import page css
            if (opt.importCSS) {
                $("link[rel=stylesheet]").each(function () {
                    var href = $(this).attr('href');
                    if (href) {
                        var media = $(this).attr('media') || 'all';
                        $doc.find("head").append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                    }
                });
            }

            // add another stylesheet
            if (opt.loadCSS) {
                $doc.find("head").append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");

            }

            //grab outer container
            if (opt.printContainer) {
                $doc.find("body").append($element.outer());
            }
            else {
                $element.each(function () {
                    $doc.find("body").append($(this).html());
                });
            }

            //$doc.close();
            // print
            ($.browser.opera ? tab : $iframe[0].contentWindow).focus();
            setTimeout(function () {
                ($.browser.opera ? tab : $iframe[0].contentWindow).print();
                if (tab) {
                    tab.close();
                }
            }, 1000);

            //removed iframe after 60 seconds
            setTimeout(
                function () {
                    $iframe.remove();
                },
                (60 * 1000)
            );
        }, 333);
    }


    $.fn.printThis.defaults = {
        debug: false, //show the iframe for debugging
        importCSS: true, // import page CSS
        printContainer: true, // grab outer container as well as the contents of the selector
        loadCSS: "" //path to additional css file
    };


    jQuery.fn.outer = function () {
        return $($('<div></div>').html(this.clone())).html();
    }
})(jQuery);

function printcoupon() {
    jQuery('#printarea').printThis({
        debug: false, //show the iframe for debugging
        importCSS: true, // import page CSS
        printContainer: false // grab outer container as well as the contents of the selector
    });
}

jQuery(document).ready(function ($) {

    /* Use this js doc for all application specific JS */

    /* TABS --------------------------------- */
    /* Remove if you don't need :) */

    function activateTab($tab) {
        var $activeTab = $tab.closest('dl').find('a.active'),
            contentLocation = $tab.attr("href") + 'Tab';

        //Make Tab Active
        $activeTab.removeClass('active');
        $tab.addClass('active');

        //Show Tab Content
        jQuery(contentLocation).closest('.tabs-content').children('li').hide();
        jQuery(contentLocation).css('display', 'block');
    }

    jQuery('dl.tabs').each(function () {
        //Get all tabs
        var tabs = jQuery(this).children('dd').children('a');
        tabs.click(function (e) {
            activateTab(jQuery(this));
        });
    });

    if (window.location.hash) {
        activateTab(jQuery('a[href="' + window.location.hash + '"]'));
    }

    /* ALERT BOXES ------------ */
    jQuery(".alert-box").delegate("a.close", "click", function (event) {
        event.preventDefault();
        jQuery(this).closest(".alert-box").fadeOut(function (event) {
            jQuery(this).remove();
        });
    });


    /* PLACEHOLDER FOR FORMS ------------- */
    /* Remove this and jquery.placeholder.min.js if you don't need :) */

    jQuery('input, textarea').placeholder();

    /* TOOLTIPS ------------ */
    jQuery(this).tooltips();


    /* UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE6/7/8 SUPPORT AND ARE USING .block-grids */
//	jQuery('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
//	jQuery('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
//	jQuery('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
//	jQuery('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});


    /* DROPDOWN NAV ------------- */

    var lockNavBar = false;
    jQuery('.nav-bar a.flyout-toggle').live('click', function (e) {
        e.preventDefault();
        var flyout = jQuery(this).siblings('.flyout');
        if (lockNavBar === false) {
            jQuery('.nav-bar .flyout').not(flyout).slideUp(500);
            flyout.slideToggle(500, function () {
                lockNavBar = false;
            });
        }
        lockNavBar = true;
    });
    if (Modernizr.touch) {
        jQuery('.nav-bar>li.has-flyout>a.main').css({
            'padding-right': '75px'
        });
        jQuery('.nav-bar>li.has-flyout>a.flyout-toggle').css({
            'border-left': '1px dashed #eee'
        });
    } else {
        jQuery('.nav-bar>li.has-flyout').hover(function () {
            jQuery(this).children('.flyout').show();
        }, function () {
            jQuery(this).children('.flyout').hide();
        })
    }


    /* DISABLED BUTTONS ------------- */
    /* Gives elements with a class of 'disabled' a return: false; */


});