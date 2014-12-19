/*!
 *
 * MS BING MAP 2012 DEVELOPED BY HESK
 * dependencies - wsm_base_obj.bin, msMapTypeId, msbingapikey
 */
var map = null;
var layer1 = null;
var layer2 = null;
function init_bing(w, h) {
    if ( typeof (Microsoft.Maps) == "undefined") {
        console.log("Microsoft.Maps : undefined");
        return;
    }
    jQuery('#mapcanvas').html("");
    layer1 = new Microsoft.Maps.EntityCollection();
    layer2 = new Microsoft.Maps.EntityCollection();
    map = new Microsoft.Maps.Map(document.getElementById('mapcanvas'), {
        credentials : msbingapikey,
        width : w,
        height : h,
        disableBirdseye : true,
        center : new Microsoft.Maps.Location(22.298984, 114.175565),
        zoom : 15,
        //  clusteringEnabled: true,
        showMapTypeSelector : false,
        mapTypeId : msMapTypeId
    });
    for (var i = 0; i < bardata.length; i++) {
        var offset = new Microsoft.Maps.Point(0, 5);
        var iconset = wsm_base_obj.bin + 'pin_piont_bartype.png';
        var pushpinOptions = {
            icon : iconset,
            text : i,
            visible : true,
            textOffset : offset
        };
        var pushpin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(parseFloat(bardata[i].coordinations.lng), parseFloat(bardata[i].coordinations.lat)), pushpinOptions);
        layer1.push(pushpin);
        map.entities.push(layer1);
        //console.log("added icon at");
        //console.log([parseFloat(bardata[i].coordinations.lng), parseFloat(bardata[i].coordinations.lat)]);
        //  var latlng = new GLatLng(
        //     bardata[i].lng,
        //     bardata[i].lat
        // );
        //http://www.bingmapsportal.com/ISDK/AjaxV7#SpatialDataServices4
    }
    //console.log(bardata);
}

function init_menu() {
    //hard code for the menu - slug
    var list = ['central', 'jordan', 'tst', 'mk', 'wanchai', 'causewaybay'];
    jQuery("#list_loactions_filter>li>a").each(function(i) {
        jQuery(this).parent().attr("area", list[i]);
        jQuery(this).attr("href", "javascript:at_district('" + list[i] + "')");
    });
}

function fill_bars(i) {
    var gHTML = detail;
    if(wsm_base_obj.isNowMobile){
        gHTML=detail+'<a id="returntotop" class="butt hover" href="#">Up</a>';
    }
    jQuery(".bardetail").html(gHTML);
    jQuery(".bar_name").html("<a href='" + bardata[i].permlink + "'>" + bardata[i].barname + "</a><a href='" + bardata[i].permlink + "' class='enter'>進入</a>");
    //jQuery(".upcoming_events").html(loading);
    jQuery(".bar_place").html(bardata[i].linkr_address);
    jQuery(".reserv.button .text").html("Reserve Table Now<br>" + bardata[i].linkr_phone);
    if (wsm_base_obj.ismobile) {
        jQuery(".reserv.button").attr("href", "tel:" + bardata[i].linkr_phone);
    } else {
        jQuery(".reserv.button").attr("href", bardata[i].permlink);
    }
    jQuery(".bar_feature_images").html(wsm_base_obj.loading);
    if(wsm_base_obj.isNowMobile){
    var flag = false;
    jQuery("#returntotop").bind('touchstart click', function(){
        if (!flag) {
            flag = true;
            setTimeout(function(){ flag = false; }, 1000);
            var toPos = jQuery("#circlemenu").offset();
            scroll_to_mobile(toPos.top);
        }
        return false
    });
    }
}

function focusBar(i) {
    var loc = new Microsoft.Maps.Location(parseFloat(bardata[i].coordinations.lng), parseFloat(bardata[i].coordinations.lat));
    map.setView({
        centerOffset : new Microsoft.Maps.Point(-50, 50),
        center : loc,
        zoom : 17
    });
    layer2.clear();
    var infoboxOptions = {
        title : bardata[i].barname,
        description : bardata[i].linkr_address,
        showCloseButton : true,
        offset : new Microsoft.Maps.Point(0, 20)
    };
    //var defaultInfobox = new Microsoft.Maps.Infobox(map.getCenter(), infoboxOptions );
    var defaultInfobox = new Microsoft.Maps.Infobox(loc, infoboxOptions);
    layer2.push(defaultInfobox);
    map.entities.push(layer2);
}

//---------deprecated
function jax_district(slug) {
    //---------deprecated
    jQuery.ajax({
        type : 'POST',
        url : wsm_base_obj.ajaxurl,
        data : {
            "action" : "hkmcrossref_cat_level_1",
            "slug" : slug,
            "type" : "<?php echo HKM_BAR; ?>",
            "tax" : "linkrarea"
        },
        success : function(json) {
            var jresponse = eval("(" + json + ")");
            jQuery(".bar_feature_images").html(parseimg(jresponse));
            jQuery(".rAppBar").royalSlider({
                // general options go gere
                autoScaleSlider : true,
                fullscreen : {
                    // fullscreen options go gere
                    enabled : true,
                    native : true
                },
                autoPlay : {
                    // autoplay options go gere
                    enabled : true,
                    pauseOnHover : true
                }
            });
        },
        error : function(json) {
            console.log("error");
        }
    });
    //---------deprecated
}

function scroll_to_mobile(top) {
    setTimeout(function() {
        jQuery("body").animate({
            scrollTop : top,
        }, 1000);
    }, 1000);
}

//---------deprecated
/*!
 * THIS IS FROM THE WHEEL OF THE CONTROL IN MOBILE VIEW
 */
function goto(n) {
    if (n == 10) {
        at_district('causewaybay');
    } else if (n == 1) {
        at_district('mk');
    } else if (n == 2) {
        at_district('tst');
    } else if (n == 3) {
        at_district('jordan');
    } else {
        alert("對不起，沒有結果");
    }
    if (wsm_base_obj.isNowMobile) {
        var toPos = jQuery("#mobile_bar_detail").offset();
        scroll_to_mobile(toPos.top);
    }
}

/*!
 * part for sorting the club types
 * parsing images and more..
 */
var inOnepage = 13;
var totalpages = 0;
var currentPage = 0;
var nav_content = "<nav class='pages'><a id='lbPrevLink' href='javascript:page(-1);'></a><a id='lbNextLink' href='javascript:page(1);'></a></nav>";
var no_result_content = "<div id='sorry'>對不起，沒有結果</div>";
var areatype;
function page(p) {
    console.log(' p : ' + p);
    currentPage = p + currentPage;
    if (currentPage >= totalpages)
        currentPage = 0;
    else if (currentPage < 0)
        currentPage = totalpages - 1;
    console.log('currentPage : ' + currentPage);
    var fromdatabase = jQuery(".hide.bardata .bar");
    var found = 0;
    var prepare_on_stage = "";
    var stage = jQuery(".bardetailthumb");
    console.log('areatype : ' + areatype);
    fromdatabase.each(function(i) {
        var bar = jQuery(this);
        var area = bar.attr("area");
        if (areatype == area) {
            found++;
            if ((found > inOnepage * currentPage) && (found < inOnepage * currentPage + inOnepage)) {
                var html = jQuery('<div>').append(bar.clone()).remove().html()
                prepare_on_stage += html;
            }
        }
    });
    if (found > 0) {
        // var stage = jQuery(".bardetailthumb");
        // stage.hide().append(nav_content);

        stage.fadeOut(300, function() {
            stage.html("");
            stage.hide().append(nav_content, prepare_on_stage).fadeIn(function() {
                scanbarbuttons();
            });
        });

    }
}

function scanbarbuttons() {
    var module_sub = function(i) {
        focusBar(i);
        fill_bars(i);
        hkmbarjax_feature_images(bardata[i].barid);
    }
    if (wsm_base_obj.isNowMobile) {
        jQuery(".bardetailthumb .bar").bind('touchend', function(event) {
            var toPos = jQuery("#mobile_bar_slider_small").offset();
            scroll_to_mobile(toPos.top);
            //jQuery.colorbox({html:"<Center><p>"+"Y to the "+toPos.top+"</p></center>", width:"100px;"});
            module_sub(jQuery(this).index());
            event.stopPropagation();
            event.preventDefault();
        });
    } else {
        jQuery(".bardetailthumb .bar").click(function() {
            module_sub(jQuery(this).index());
        });
    }
}

var atDist = false;
function at_district(slug) {
    if (!atDist) {
        atDist = true;
        areatype = slug;
    } else {
        return;
    }
    /*get the control of the location lights*/
    jQuery("#list_loactions_filter li").removeClass("current_main_bar");
    jQuery("#list_loactions_filter li[area='" + slug + "']").addClass("current_main_bar");
    //console.log(slug);
    var found = 0;
    var fromdatabase = jQuery(".hide.bardata .bar");
    var stage = jQuery(".bardetailthumb");
    var bar_on_stage = jQuery(".bardetailthumb .bar");
    var prepare_on_stage = "";
    totalpages = 1;
    fromdatabase.each(function(i) {
        var bar = jQuery(this);
        var area = bar.attr("area");
        var html = jQuery('<div>').append(bar.clone()).remove().html()
        //console.log(area +" ? " + slug);
        //console.log(html);
        if (slug == area) {
            found++;
            if (found < inOnepage) {
                prepare_on_stage += html;
            } else {
                return;
            }
        }
    });
    //if(!bar_on_stage.hasClass("off")) {
    bar_on_stage.fadeOut(300, function() {
        //bar_on_stage.addClass("off");
        bar_on_stage.remove();
        jQuery("nav.pages").remove();
    });
    //}
    setTimeout(function() {
        console.log(found);
        if (found == 0) {
            if (jQuery(".bardetailthumb #sorry").size() == 0) {
                jQuery(".bardetailthumb").append(no_result_content);
            } else {
                jQuery("#sorry").fadeIn();
            }
            atDist = false;
        } else {
            totalpages = Math.ceil(found / inOnepage);
            stage.hide();
            console.log('totalpages ' + totalpages);
            jQuery("#sorry").fadeOut();
            stage.hide().append(nav_content, prepare_on_stage).fadeIn(function() {
                atDist = false;
                scanbarbuttons();
            });
        }
    }, 300);
}

function hkmbarjax_feature_images(i) {
    jQuery.ajax({
        type : 'POST',
        url : wsm_base_obj.ajaxurl,
        data : {
            "action" : "hkmcrossreference",
            "id" : i,
            "type" : "linker-bar",
            "field" : "linkr_sliders_bar"
        },
        success : function(json) {
            var jresponse = eval("(" + json + ")");
            if (jresponse == [])
                return;
            jQuery(".bar_feature_images").html(parseimg(jresponse));
            jQuery(".rAppBar").royalSlider({
                // general options go gere
                autoScaleSlider : true,
                fullscreen : {
                    // fullscreen options go gere
                    enabled : true,
                    native : true
                },
                autoPlay : {
                    // autoplay options go gere
                    enabled : true,
                    pauseOnHover : true
                }
            });
        },
        error : function(json) {
            console.log("error");
        }
    });
}

function parseimg(imagelist) {
    var data = "";
    for (var i = 0; i < imagelist.length; i++) {
        var src = imagelist[i][0];
        //data += "<a href='"+bardata[i].permlink+"'><img class='rsImg' src='" + src + "' /></a>";
        data += "<img class='rsImg' src='" + src + "' />";
    }
    data = "<div class='rAppBar rSilder rsDefault' id='barslider'>" + data + "</div>";
    return data;
}