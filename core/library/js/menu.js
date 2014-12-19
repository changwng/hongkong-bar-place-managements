/**!
 * Controller on Single Bar Detail layout used by Linkr.
 *
 * @Author: HESKEYO KAM
 * @Copyright: © DEVHKM 2012
 *
 * {@link http://hkmdev.wordpress.com/}
 * {@link http://imusictech.com/}
 *
 * Released under the terms of the GNU General Public License.
 * You should have received a copy of the GNU General Public License,
 * along with this software. In the main directory, see: /licensing/
 * If not, see: {@link http://www.gnu.org/licenses/}.
 *
 * @package response
 * @since 2.0
 */
(function($) {

    /*!
    * THIS CODE IS DEVELOPED BY HESKEMO KAM
    *
    */
    //variable for storing the menu count when no ID is present
    //plugin code
    jQuery.fn.interface_mobile = function(options) {
        //plugin's default options
        var settings = {
            switchWidth : 720,
            topOptionText : 'Select a page',
            indentString : '&nbsp;&nbsp;&nbsp;'
        };
        var $ = jQuery;
        var top_menu_set_loc = $("#menu-item-433, #mega_location");
        var top_menu_set_type = $("#menu-item-432, #mega_type");
        var set_menu_accordion = $(".ac-menu>li");
        var web_init_first = false, mobile_init_first = false, triggered_set_menu = false, triggered_a_set_menu = false

        function trigger_set_menu_accordion(e) {
            var n = $(this);
            if (e.type == "click")
                n.unbind("touchend");
            if (e.type == "touchend")
                n.unbind("click");
            if (!n.hasClass("active")) {
                n.addClass('active');
            } else {
                n.removeClass('active');
            }
            $("#header").scrollTop(0);
            //console.log(e);
            e.stopImmediatePropagation();
        }

        function trigger_set_menu_accordion_a(e) {
            var n = $(this);
            if (e.type == "click")
                n.unbind("touchend");
            if (e.type == "touchend")
                n.unbind("click");
            //console.log(e);
            //  $("#loading").html(wsm_base_obj.loading).fadeIn();
            var url = $(this).attr("data-href");

            if ($.browser.webkit) {
                //window.location.href = url;
            } else if($.browser.msie){
              //  alert("no webkit");
                //alert($.browser.version);
                //console.log("no webkit");
                //window.location.href = url;
            }
            window.location.href = url;
            e.stopImmediatePropagation();
            return false;
        }

        function trigger_mobile_all_a(e) {
            var n = $(this);
            if (e.type == "click")
                n.unbind("touchend");
            if (e.type == "touchend")
                n.unbind("click");
            // $("#loading").html(wsm_base_obj.loading).fadeIn();
        }

        function mobile_init() {
            // test case for native app in here
            // var f = $("#smallmenubar").attr("data-native");
            var mobile = $("#smallmenubar").attr("data-mobile");
            //alert(mobile);
            if (!mobile_init_first) {
                console.log("m");
                web_init_first = false;
                mobile_init_first = true;
                if (set_menu_accordion.size() == 0) {
                    alert("not found menu");
                }
                set_menu_accordion.on("touchend click", trigger_set_menu_accordion);
                $("#mobile_main_menu .sub-menu a").on("touchend click", trigger_set_menu_accordion_a);
                $("a.ecdrinkad, .crumbs_text a, .linkrbarfeat a, a.coming_events, a.barban, a.page-numbers").on("touchend click", trigger_mobile_all_a);
                top_menu_set_loc.unbind();
                top_menu_set_type.unbind();
                $("#gridbutton").hide();
                $("#location_pie").show();
            }
        }

        function web_init() {
            if (!web_init_first) {
                web_init_first = true;
                mobile_init_first = false;
                console.log("web");
                set_menu_accordion.unbind();
                $("#location_pie").hide();
                top_menu_set_loc.on("mouseover", function(e) {
                    $("#mega_location").addClass('active');
                });
                top_menu_set_loc.on("mouseout", function(e) {
                    $("#mega_location").removeClass('active');
                });
                top_menu_set_type.on("mouseover", function(e) {
                    $("#mega_type").addClass('active');
                });
                top_menu_set_type.on("mouseout", function(e) {
                    $("#mega_type").removeClass('active');
                });
                $(".sf_button").click(function(e) {
                    return false
                });
                var test = $(".sf_input").val();
                $(".sf_input").val("");
                $(".sf_input").attr('placeholder', test);
                var status_menu = "off";
                var gridbutton = $("#gridbutton");
                var controller = $(".maincontentright");
                if (gridbutton.size() > 0) {
                    gridbutton.show();
                    gridbutton.on("touchend click", function(e) {
                        var n = $(this);
                        if (e.type == "click")
                            n.unbind("touchend");
                        if (e.type == "touchend")
                            n.unbind("click");
                        if (controller.hasClass("listing")) {
                            controller.removeClass("listing");
                        } else {
                            controller.addClass("listing");
                        }
                    });
                }
            }
        }

        //function to decide if mobile or not
        function isMobile() {
            return ($(window).width() < settings.switchWidth);
        }

        //plugin functionality
        function run(self) {
            //menu doesn't exist
            wsm_base_obj.isNowMobile = isMobile();
            if (isMobile()) {
                mobile_init();
            } else {
                web_init();
            }
        }

        return this.each(function() {
            //override the default settings if user provides some
            if (options) {
                $.extend(settings, options);
            }
            //cache "this"
            var self = $(this);
            //bind event to browser resize
            $(window).resize(function() {
                run(self);
            });
            //run plugin
            run(self);
        });
    }
})(jQuery);
var hkmMegaMenu = {
    processMegaSubMenus : function() {
        jQuery(".MegaSubMenus .MegaSub").each(function(k, v) {
            var contenthtml = jQuery(this).clone();
            var firstClass = jQuery(this).attr("class").split(" ");
            firstClass = firstClass[0];
            hkmMegaMenu.addMegaMenu(firstClass, contenthtml);
        });
    },
    addMegaMenu : function(classLocation, htmlContent) {
        console.log(classLocation);
        jQuery('#nav_menu li.' + classLocation).append(htmlContent);
        if (wsm_base_obj.browser.isIE8) {
            //alert("shit, this is IE8");
            jQuery("#nav_menu.topnavmenu_ie8 ." + classLocation).hover(function() {
                var selfself = jQuery(this);
                var hovered = selfself.hasClass("hover");
                selfself.children(".MegaSub").css("display", "none");
                if (!hovered) {
                    //alert("addclass");
                    selfself.addClass("hover");
                    selfself.children(".MegaSub").css("visibility", "visble");
                }
            }, function() {
                var selfself = jQuery(this);
                var hovered = selfself.hasClass("hover");
                if (hovered) {
                    //alert("removeClass");
                    selfself.removeClass("hover");
                    selfself.children(".MegaSub").css("visibility", "hidden");
                }
            });
        }
        // jQuery('#nav_menu li.'+classLocation+' .'+classLocation).hide();
        /*jQuery('#nav_menu li.'+classLocation).on("hover",function(){
         var dat = jQuery(this);
         dat.children("."+classLocation).fadeTo("fast", 1.0);
         });*/
    },
    ini : function() {
        var $ = jQuery;
        // $("#nav_menu>.menu_bartype").on("mouseenter",function(e){$("#nav_menu .submegaType.MegaSub").addClass('active');});
        // $("#nav_menu>.menu_bartype").on("mouseout",function(e){$("#nav_menu .submegaType.MegaSub").removeClass('active');});
        $("#nav_menu>.menu_loc").on("mouseenter", function(e) {
            $("#nav_menu .submegaType.MegaSub").addClass('active');
        });
        $("#nav_menu>.menu_loc").on("mouseout", function(e) {
            $("#nav_menu .submegaType.MegaSub").removeClass('active');
        });
        console.log("inis");
    },
    warper : function(selector, number, extra_class) {
        var $ = jQuery;
        var j = $(selector);
        if (extra_class == null || extra_class == undefined)
            extra_class = '';
        if (j.size() > 0) {
            j.each(function(e) {
                var f = e % number;
                if (f == 0) {
                    j
                    //  .children()
                    .slice(e, e + number).wrapAll('<div class="row use ' + extra_class + '" />');
                }
            });
        }
    }
}

jQuery(document).ready(function($) {

    // if (wsm_base_obj.ismobileDropMenuResponsive)
    //  $('#nav_menu').mobileMenu();
    //   if (wsm_base_obj.ismobileUseResponsiveInterface)
    //     $('body').interface_mobile();
    $(".es-carousel img").hover(function() {
        $(this).fadeTo("fast", 0.7);
    }, function() {
        $(this).fadeTo("fast", 1.0);
    });
    $("#gallery ul a:hover img").css("opacity", 1);
    $("#portfolio_wrap .portfolio_caption").css("opacity", 0);
    $("#portfolio_wrap a").hover(function() {
        $(this).children("img").fadeTo("fast", 0.3);
        $(this).children(".portfolio_caption").fadeTo("fast", 1.0);
    }, function() {
        $(this).children("img").fadeTo("fast", 1.0);
        $(this).children(".portfolio_caption").fadeTo("fast", 0);
    });
    $(".featured-image img").hover(function() {
        $(this).fadeTo("fast", 0.75);
    }, function() {
        $(this).fadeTo("fast", 1.0);
    });
    hkmMegaMenu.warper('.banner_150', 3, 'hide-on-desktops');
    hkmMegaMenu.warper('.banner_400', 2);

    $('body').interface_mobile();
    // var wsm_message = wsm_base_obj.
    console.log(wsm_base_obj);
});

