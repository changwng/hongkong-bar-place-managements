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

function init_archive() {
	scanbarbuttons();
}

var ini_widget_top = 0;
function init_menu() {
	//hard code for the menu - slug
	var list = ['central', 'jordan', 'tst', 'mk', 'wanchai', 'causewaybay'];
	jQuery("#list_loactions_filter>li").each(function(i) {
		var self = jQuery(this);
		self.attr("area", list[i]);
		//self.html("<a href=\"javascript:at_district('aaa')\"></a>");
		//self.html('<a data="hahaha">hahaha</a>');
		//self.html("<a hrdffgdfgdistrict('" + list[i] + "')\"></a>");
		self.on("touchend click", function() {
			at_district(list[i]);
		});
		console.log("init_menu +list[i] " + list[i]);
	});
	ini_widget_top = jQuery("#mobile_bar_slider_small").offset();
	ini_widget_top = ini_widget_top.top;
	load_front_bars_collection();
	//jQuery("#mobile_bar_slider_small").css({"display":"none"});
}
//select bar within the order number [i]
function fill_bars(i) {
	// console.log("mobile run 1 "+i);
	//console.log("is now mobile:"+wsm_base_obj.isNowMobile)
	if (wsm_base_obj.isNowMobile) {
		console.log("mobile run 2");
		window.location = bardata[i].permlink;
	} else {
		var gHTML = detail;
		//jQuery(".bardetail").html(gHTML);
		jQuery(".bar_name").html("<a href='" + bardata[i].permlink + "'>" + bardata[i].barname + "</a><a href='" + bardata[i].permlink + "' class='enter'>進入</a>");
		//jQuery(".upcoming_events").html(loading);
		console.log(bardata[i].linkr_phone);
		jQuery(".reserv .phonenumber").html(bardata[i].linkr_phone);
		if (wsm_base_obj.ismobile) {
			jQuery(".reserv.button:first-child").attr("href", "tel:" + bardata[i].linkr_phone);
		} else {
			jQuery(".reserv.button:first-child").attr("href", bardata[i].permlink);
		}
		jQuery(".bar_place").html(bardata[i].linkr_address);
		jQuery(".bar_feature_images").html(wsm_base_obj.loading);
	}
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
	} else if (n == 4) {
		at_district('wanchai');
	} else if (n == 5) {
		at_district('central');
	} else {
		alert("對不起，沒有結果");
	}
	if (wsm_base_obj.isNowMobile) {
		//var toPos = jQuery("#mobile_bar_detail").offset();
		// scroll_to_mobile(toPos.top);
	}
}

/*!
 * part for sorting the club types
 * parsing images and more..
 */
var inOnepage = 13;
var totalpages = 0;
var currentPage = 0;
var nav_content = "<nav class='pages'><a id='lbPrevLink' href='javascript:page(-1);'></a><div id='pageReport'></div><a id='lbNextLink' href='javascript:page(1);'></a></nav>";
var nav_content_mobile = "<nav class='pages'><a id='PREVLink' href='javascript:page(-1);'></a><div id='pageReport'></div><a id='NEXTLink' href='javascript:page(1);'></a><a id='TOPLink' href='javascript:SlideTheWheel(false);'></a></nav>";
var no_result_content = "<div id='sorry'>對不起，沒有結果</div>";
var no_result_content_navmobile = "<nav class='pages'><a class='rightonly' id='TOPLink' href='javascript:SlideTheWheel(false);'></a></nav>";
var areatype;
var currentDistrictName = null;
function page(p) {
	var $ = jQuery;
	console.log(' p : ' + p);
	currentPage = p + currentPage;
	if (currentPage >= totalpages)
		currentPage = 1;
	else if (currentPage < 1)
		currentPage = totalpages;
	console.log('currentPage : ' + currentPage);
	var found = 0;
	var bars_content = "";
	var stage = $("#barstage");
	console.log('areatype : ' + areatype);
	$("#storeddata .bar").each(function(i) {
		console.log('loop++');
		var bar = $(this);
		var area = bar.attr("area");
		if (areatype == area) {
			found++;
			console.log('found++');
			var html = $('<div>').append(bar.clone()).remove().html();
			bars_content += html;
			/*if ((found > inOnepage * currentPage) && (found < inOnepage * currentPage + inOnepage)) {
			 }*/
		}
	});
	var afterAppend = function() {
		scanbarbuttons();
		$("#pageReport").html(currentPage + "/" + totalpages);
		//select_first_bar();
	}
	if (currentPage == 1 && totalpages == 1) {
		//	return false;
	}
    console.log("found items: "+found);
	if (found > 0) {
		console.log("found out");
		$("#pages_content").html(bars_content).fadeIn(afterAppend);
		$("#sorry:not(.disabled)").fadeOut(function(){$(this).addClass("disabled")});
		$("#pagenav:not(.enabled)").fadeIn(function(){$(this).addClass("enabled")});
	} else {
		console.log("not found in here");
		$("#pages_content").hide();
		$("#sorry.disabled").fadeIn(function(){$(this).removeClass("disabled")});
		$("#pagenav.enabled").fadeOut(function(){$(this).removeClass("enabled")});
	}
}

function findid(id) {
	console.log("index() = " + id);
	for (var i = 0; i < bardata.length; i++) {
		if (bardata[i].barid == id)
			return i;
	}
}

function scanbarbuttons() {
	var module_sub = function(i) {
		var c = findid(i);
		fill_bars(c);
		hkmbarjax_feature_images(bardata[c].barid);
	};
	if (wsm_base_obj.isNowMobile) {
		jQuery("#barstage .bar .direct2bar").bind('touchend', function(event) {
			//var toPos = jQuery("#mobile_bar_slider_small").offset();
			// scroll_to_mobile(toPos.top);
			var myid = jQuery(this).attr("barid");
			//jQuery.colorbox({html:"<Center><p>"+"Y to the "+toPos.top+"</p></center>", width:"100px;"});
			module_sub(myid);
			event.stopPropagation();
			event.preventDefault();
		});
	} else {
		jQuery("#barstage .bar").click(function() {
			var self = jQuery(this);
			var myid = self.attr("barid");
			module_sub(myid);
			var y_position = self.offset().top;
			mobile_bar_slider_small_loop(y_position);
		});
	}
}

function select_first_bar() {
	var $ = jQuery;
	if ($("#barstage .bar").size() > 0) {
		var first = $("#barstage .bar").eq(0);
		var id = first.attr("barid");
		module_sub(id);
		var y_position = first.offset().top;
		mobile_bar_slider_small_loop(y_position);
	}
}

var atDist = false;
function bar_tab_creation(obj_original) {
	//var bar = obj_original;
	return jQuery('<div>').append(obj_original.clone()).remove().html();
}

function SlideTheWheel(open_list) {
	if (wsm_base_obj.isNowMobile) {
		if (open_list) {
			/*jQuery("#circlemenu").slideUp();
			 jQuery("#barstage").slideDown();*/
			jQuery("#circlemenu").addClass("UP");
			jQuery("#barstage").removeClass("UP");
		} else {
			/*jQuery("#circlemenu").slideDown();
			 jQuery("#barstage").slideUp();*/
			jQuery("#circlemenu").removeClass("UP");
			jQuery("#barstage").addClass("UP");
		}

	}
}

function at_district(slug) {
	var $ = jQuery;
	if (areatype == slug) {
		//atDist = true;
		console.log("false request on at_district. You are already at the same district.");
		return;
	} else {
		areatype = slug;
	}
	//SlideTheWheel(true);
	/*get the control of the location lights*/
	$("#list_loactions_filter li").removeClass("current_main_bar");
	$("#list_loactions_filter li[area='" + slug + "']").addClass("current_main_bar");
	totalpages = 1;
	$('#pages_content').html("");
	if ($("#quickview_allbars").hasClass("active")) {
		$("#quickview_allbars").fadeOut(function() {
			$("#pagenav").fadeIn(function() {
				currentPage = 1;
				page(0);
			});
		});
	} else {
		$("#pagenav").fadeIn(function() {
			currentPage = 1;
			page(0);
		});
	}
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
			// console.log(jresponse);
			if (jresponse == [])
				return;
			jQuery(".bar_feature_images").html(parseimg(jresponse.imagelist));
			jQuery(".rAppBar").royalSlider(wsm_base_obj.rslideConfiguration);
			jQuery(".reserv.button:last-child").attr("href", jresponse.loc_url);
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

function mobile_bar_slider_small_loop(position_y) {
	var self = jQuery("#mobile_bar_slider_small");
	//var y = self.offset().top;
	var shelfHeight = jQuery("#barstage").height();
	var selfHeight = self.height();
	var max = parseInt(shelfHeight - selfHeight);
	var pos = position_y - ini_widget_top;
	if (pos > max) {
		pos = max;
	}
	if (pos < ini_widget_top) {
		pos = 70;
	}
	self.css({
		"display" : "block"
	}).animate({
		top : pos + "px"
	}, 500);
	//alert(ini_widget_top);
	//self.children(".bar_place").html(pos);
}

function load_front_bars_collection() {
	var totalbars = 15;
	jQuery.ajax({
		type : 'POST',
		url : wsm_base_obj.ajaxurl,
		data : {
			"action" : "get_randomized_bars_font_end",
			"field" : "linkr_sliders_bar"
		},
		success : function(json) {
			var oak = eval("(" + json + ")");
			// console.log(jresponse);
			if (oak == [])
				return;
			var m = "";
			jQuery.each(oak, function(index, obj) {
				m += '<div class="cell"><a href="' + obj.link + '">' + obj.img + '</a></div>';
			});
			jQuery("#quickview_allbars").append(m);
		},
		error : function(json) {
			console.log("error");
		}
	});
}

