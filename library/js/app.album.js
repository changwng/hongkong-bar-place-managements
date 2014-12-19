var currencies = ["USD", "CAD", "AUD", "GBP", "EUR", "RMB"], transit = 50, menu_right, menu_left, currentcontrol_api, currentpage, totalpages, current_state, oncatprogress, production_stage, cat_menu, wsm_product_iso_settings = {
	animationOptions : {
		duration : 750,
		easing : 'linear',
		queue : false
	},
	masonry : {
		//cornerStampSelector: '.fixedwood',
		//columnWidth: contain.width() / 3 },
		containerStyle : {
			position : 'absolute',
			overflow : 'hidden'
			//top:'110px'
		},
		layoutMode : 'fitRows'
	}
};

function add_cdcase(data) {
	var d = jQuery.extend({
		image_src : 'http://wsm.imusictech.com/wp-content/uploads/2012/11/no-cover.png',
		title : 'N/A',
		price : 'N/A',
		attr_singer_type : -1,
		id : -1
	}, data);
	var active = "";
	if (_.indexOf(mycart, parseInt(d.id)) != -1) {
		active = " active";
	};
	var a_item = jQuery("<a>", {
		class : "album" + active,
		pid : d.id,
		singer : d.attr_singer_type
	}).html('<div class="case"><div class="overlay"></div><img class="cover" src="' + d.image_src + '"><div class="slotwrapper"><div class="slot"></div></div><div class="vinyl"></div></div><div class="label"><div></div>' + d.title + '</div>');
	if (_.indexOf(mycart, d.id) > -1) {
		if (!a_item.hasClass("active"))
			a_item.addClass("active");
	};
	//var gr = '<a class="album" pid="' + d.id + '" singer="' + d.attr_singer_type + '"><div class="case"><div class="overlay"></div><img class="cover" src="' + d.image_src + '">';
	//gr += '<div class="slotwrapper"><div class="slot"></div></div><div class="vinyl"></div></div><div class="label"><div></div>' + d.title + '</div></a>';
	return a_item;
}

function jqlize(data) {
	return jQuery(data);
}

function ini_product_shopping(setup_data) {
	production_stage = jQuery("#stage");
	cat_menu = jQuery("#catmenu");
	menu_left = jQuery(".shopcmenu a");
	menu_right = jQuery(".shopemenu a");
	oncatprogress = false;
	currentpage = 0;
	totalpages = 0;
	production_stage.isotope(wsm_product_iso_settings);
	insert_item(jsonapi_album_data());
	setTimeout(function() {
		production_stage.isotope("reLayout");
	}, 2000);
	/* start maping the keys for the top menu bar*/
	jQuery("#backgd #list_dtopmenu a").click(top_menu_click_controller_product);
	mapkeys();
}

function insert_item(setup_data) {
	jQuery.ajax(wsm_base_obj.domainbasejson + "get_recent_posts&" + setup_data).done(function(jsonlocal) {
		totalpages = jsonlocal.pages;
		pages_control(currentpage, jsonlocal.pages);
		var data = jsonlocal.posts;
		for (var i = 0; i < data.length; i++) {
			//var image = data[i]["thumbnail"], title_bar = data[i]["title"], pid = data[i]["id"];
			//if (image == undefined) {
			//} else {
			production_stage.isotope('insert', jqlize(add_cdcase({
				image_src : data[i]["thumbnail"],
				title : data[i]["title"],
				id : data[i]["id"]
			})));
			//}
		}
		map_case_reactions();
	});
}

function control_pages(control) {
	var p = 9;
	if (oncatprogress)
		return false;
	else
		oncatprogress = true;
	if (control == 1) {
		currentpage = currentpage + 1;
		;
		p = currentpage % totalpages;
	} else if (control == 0) {
		p = currentpage - 1;
		if (currentpage - 1 < 0)
			p = 0;
	}
	currentpage = p;
	currentcontrol_api.page = p;
	production_stage.isotope('remove', jQuery(".album"));
	setTimeout(function() {
		insert_item(jQuery.param(currentcontrol_api));
	}, 1000);
}

function map_case_reactions() {
	production_stage.children(".album").click(function() {
		var i = jQuery(this).attr("pid");
		show_detail_album(i);
		console.log("album @" + i);
	});
	//console.log(production_stage);
	oncatprogress = false;
}

function pages_control(page, pages) {
	var control_b = jQuery("<a>", {
		onclick : "control_pages(1)",
		class : "nextp"
	}).html("下一頁");
	var control_c = jQuery("<a>", {
		onclick : "control_pages(0)",
		class : "prevp"
	}).html("上一頁");
	var pages = jQuery("<div>", {
		class : "pagenumber"
	}).html(page + "/" + pages);
	if (page == 0) {
		jQuery("#halfcircle>div").html("").append(control_b, pages);
	} else
		jQuery("#halfcircle>div").html("").append(control_c, control_b, pages);
	jQuery("#halfcircle>div").fadeIn();
	/*if (jQuery("#halfcircle>div").css("display") == "none") {
	 jQuery("#halfcircle>div").stop().fadeIn();
	 }*/
}

function gobackexe() {
	//console.log("current_state");
	//console.log(current_state);
	if (current_state == "viewcart") {
		unshow_form();
	}
	jQuery("#lowerbody>div").fadeOut(transit);
	jQuery("#halfcircle>div").fadeOut(transit);
	setTimeout(function() {
		production_stage.css("display", "block");
		insert_item(jQuery.param(currentcontrol_api));
		mapkeys();
		current_state = "shoppingarea";
		jQuery("#lowerbody>div").attr("class", current_state);
	}, transit);
}

function mapkeys() {
	cat_menu.find("li").click(function() {
		currentpage = 0;
		var index_click = jQuery(this).index();
		var taxonomy_a = jQuery(this).attr("tax");
		var term_a = jQuery(this).attr("slug");
		get_albums({
			taxonomy : taxonomy_a,
			term : term_a
		});
	});
	cat_menu.fadeIn();
	menu_left.click(function() {
		var index_click = jQuery(this).parent().index();
		//console.log(index_click);
		if (index_click == 3) {
			get_albums();
		} else if (index_click == 4) {
			console.log(index_click);
			get_albums({
				taxonomy : 'media_type',
				term : 'dvd'
			});
		}
	});
	menu_right.click(function() {
		var index_click = jQuery(this).parent().index();
		//console.log(index_click);
		if (index_click <= 1) {
			viewcart();
		}
	});
}

function get_albums(extraconfig) {
	if (oncatprogress)
		return false;
	oncatprogress = true;
	production_stage.isotope('remove', jQuery(".album"));
	setTimeout(function() {
		insert_item(jsonapi_album_data(extraconfig));
	}, 1000);
}

function jsonapi_album_data(setup) {
	currentcontrol_api = jQuery.extend({
		order_by : 'date',
		order : 'desc',
		post_type : 'hkmtype_album',
		count : 15,
		include : 'id,title,thumbnail,url',
		page : currentpage
	}, setup)
	//console.log(currentcontrol_api);
	return jQuery.param(currentcontrol_api);
}

function unbindbuttons() {
	//jQuery("#backgd .menu a").unbind("click");
	cat_menu.find("li").unbind("click");
	cat_menu.fadeOut();
	menu_left.unbind("click");
	menu_right.unbind("click");
	jQuery("#form").css("display", "none")
	//production_stage.find(".album").unbind("click");
}

//================================= show the album detail ===================
jQuery.fn.forex = function(val, from, to, indexer) {
	//var that = jQuery(obj);
	//console.log('app.album.js 219 '+that.attr("class"));
	//alert('app.album.js 219 http://rate-exchange.appspot.com/currency?from=' + from + '&to=' + to + '&q=' + val);
	jQuery.ajax({
		url : 'http://rate-exchange.appspot.com/currency?from=' + from + '&to=' + to + '&q=' + val,
		type : 'GET',
		dataType : "jsonp",
		success : function(data) {
			var f = data.v.toPrecision(3);
			jQuery(".dollar" + indexer).html("<div class=\"currency\">" + to + "</div><div class=\"money\">" + f + "</div>");
			//console.log('app.album.js 228 '+indexer+":"+jQuery(".dollar"+indexer).attr('class')+":"+jQuery(".dollar"+indexer).html());
		},
		error : function(jsonp) {
			//var json = eval("(" + jsonp + ")");
		}
	});
}
function forex_dollar(val) {
	for (var i = 0; i < currencies.length; i++) {
		jQuery(".the_album_pricetag li").eq(i + 1).forex(val, "HKD", currencies[i], i);
	}
}

function add_drop_menu(val, label) {
	var imagewrap = jQuery("<div>", {
		"class" : "glossy-selectbox the_album_pricetag"
	});
	var checkbox = jQuery("<input>", {
		"type" : "checkbox"
	});
	var label = jQuery("<label>", {
		"data-default" : label + ":HKD " + val,
		"data-focus" : "請參考其中一種貨幣"
	});
	var ul = jQuery("<ul>");
	for (var i = 0; i < currencies.length; i++) {
		var curr = jQuery("<li>", {
			"faceval" : val,
			"class" : "dollar" + i
		}).html("---");
		ul.append(curr);
	}
	return imagewrap.append(checkbox, label, ul);
}

function show_detail_album(id) {
	if (current_state != "show_detail_album") {
		current_state = "show_detail_album";
		jQuery("#lowerbody>div").attr("class", current_state);
	} else
		return;
	unbindbuttons();
	//=================================================
	var setup_data = jQuery.param({
		post_type : 'hkmtype_album',
		post_id : id,
		include : 'id,title,thumbnail,url,content,custom_fields',
		custom_fields : 'ss_al_longdesc,wsm_retail_p'
	});
	production_stage.isotope('remove', jQuery(".album"), function() {
		production_stage.css("display", "none")
	});
	jQuery.ajax(wsm_base_obj.domainbasejson + "get_post&" + setup_data).done(function(jsonlocal) {
		var imagewrap = jQuery("<div>", {
			"class" : "the_album"
		});
		var image = jQuery("<img>", {
			"src" : jsonlocal.post.thumbnail
		});
		var content = jQuery("<div>", {
			"class" : "the_album_content"
		}).html(jsonlocal.post.content);
		var title = jQuery("<div>", {
			"class" : "the_album_title"
		}).html(jsonlocal.post.title);
		var butback = jQuery("<a>", {
			"onclick" : "gobackexe()",
			"class" : "pagegoback"
		}).html("返回");
		var button_addcart = jQuery("<a>", {
			"onclick" : "addcart(" + id + ")",
			"class" : "addchart"
		});
		var button_viewcart = jQuery("<a>", {
			"onclick" : "viewcart()",
			"class" : "viewcart"
		});
		var songs_content = "";
		if ( typeof (jsonlocal.post.custom_fields.ss_al_longdesc) == "object") {
			songs_content = jsonlocal.post.custom_fields.ss_al_longdesc[0];
			var ar = songs_content.split("\r\n");
			songs_content = "<div class=\"songtab\">" + ar.join("</div><div class=\"songtab\">") + "</div>";
		}
		var price = "售價 : HK$";
		var pricetag = "";
		if ( typeof (jsonlocal.post.custom_fields.wsm_retail_p) == "object") {
			price = jsonlocal.post.custom_fields.wsm_retail_p[0];
			//price = "售價 : HK$" + price + ".";
			pricetag = add_drop_menu(price, "售價");
		}
		var content_songs = jQuery("<div>", {
			"class" : "the_album_songs"
		}).html(songs_content);
		//jQuery("<div>", {class : "the_album_pricetag"}).html(price);
		var fbshare_content = "好歌分享";
		var view_single ='';
		// '<span class="share"><a href="'+jsonlocal.post.url+'">View</a></span>';
		//'<span class="share"><a href="javascript:shareCD(\''+jsonlocal.post.title+'\',\''+jsonlocal.post.thumbnail+'\',\''+fbshare_content+'\',\'facebook\');\">分享到facebook</a></span>';
		var button = '<div class="blackbottom"></div>';
		jQuery("#lowerbody>div").html("");
		jQuery("#halfcircle>div").html("").append(butback);
		setTimeout(function() {
			jQuery("#lowerbody>div").append(imagewrap.append(image), content, title, pricetag,view_single, button, button_addcart, button_viewcart, content_songs).fadeIn(transit);
			jQuery(".the_album_pricetag").click(function() {
				forex_dollar(jsonlocal.post.custom_fields.wsm_retail_p[0]);
			});

		}, transit);

	});

}

//=================== using jStroage to record the data interacts from the users
// read https://github.com/andris9/jStorage   originated by http://diveintohtml5.info/storage.html
var mycart = [];
function addcart(id) {
	mycart.push(id);
	mycart = _.uniq(mycart);
	//console.log(mycart);
	gobackexe();
}

function viewcart() {
	if (current_state != "viewcart") {
		current_state = "viewcart";
		jQuery("#lowerbody>div").attr("class", current_state);
	} else
		return;
	unbindbuttons();
	//=================== unbindbuttons
	jQuery("#lowerbody>div").fadeOut(transit);
	jQuery("#halfcircle>div").fadeOut(transit);
	if (production_stage.find(".album").size() > 0) {
		production_stage.isotope('remove', jQuery(".album"), function() {
			production_stage.css("display", "none");
		});
	}
	setTimeout(function() {
		jQuery.ajax({
			type : 'POST',
			url : wsm_base_obj.ajaxurl,
			data : {
				"action" : "mycart",
				"ids" : mycart,
				"type" : "hkmtype_album"
			},
			success : function(json) {
				json_view_cart(eval("(" + json + ")"));
				jQuery("#lowerbody>div").fadeIn(transit);
			},
			error : function(json) {
				console.log("error");
			}
		});

	}, transit);
}

function json_view_cart(data) {
	var butback = jQuery("<a>", {
		"onclick" : "gobackexe()",
		"class" : "pagegoback"
	}).html("返回");
	var title = jQuery("<div>", {
		"class" : "the_album_title"
	}).html("title");
	var quality = jQuery("<div>", {
		//"onclick" : "gobackexe()",
		"class" : "quality"
	}).html("number");
	var price = jQuery("<div>", {
		//"onclick" : "addcart(" + id + ")",
		"class" : "price"
	}).html("price");
	var total_price = jQuery("<div>", {
		//"onclick" : "viewcart()",
		"class" : "total_price_row"
	});
	var no_item_selected = jQuery("<div>", {
		//"onclick" : "viewcart()",
		"class" : "no_item_selected"
	}).html("there is no selected.");
	var total = data.counts;
	//imagewrap.append(title.html(data.posts.title),quality.html(data.posts.title),price.html(data.posts.price));
	var imagewrap = jQuery("<div>", {
		"class" : "album_in_cart"
	});
	var innerstage = jQuery("#lowerbody>div");
	if (total > 0) {
		innerstage.html("");
		var html = "", totalprice = 0;
		for (var i = 0; i < total; i++) {
			imagewrap.append(title.attr("onclick", "show_detail_album(" + data.posts[i].id + ")").html(data.posts[i].title));
			imagewrap.append(quality.html(1));
			imagewrap.append(price.html(data.posts[i].price));
			html += jQuery('<div>').append(imagewrap.clone()).remove().html();
			totalprice += parseInt(data.posts[i].price) > 0 ? parseInt(data.posts[i].price) : 0;
		}
		jQuery("#lowerbody>div").append(imagewrap.append(title.html("Product"), quality.html("Quantity"), price.html("Price")));
		jQuery("#lowerbody>div").append(html + "<div class=\"blackbottom\"></div><a class=\"checkout\" href=\"javascript:show_form();\"></a>");
		jQuery("#lowerbody>div").append(add_drop_menu(totalprice, "總額 : "));
		jQuery(".the_album_pricetag").click(function() {
			forex_dollar(totalprice);
		});
	} else {
		innerstage.html("").append(no_item_selected);
	}
	jQuery("#halfcircle>div").html("").append(butback).css("display", "block");
}

function show_form() {
	jQuery("#form").css("opacity", "0").css("display", "block").animate({
		"opacity" : "1",
		"right" : "110px",
		"bottom" : "250px"
	}, 1000);
}

function unshow_form() {
	jQuery("#form").animate({
		"opacity" : "0",
		"bottom" : "350px"
	}, 1000, function() {
		jQuery(this).css("display", "none");
	});
}
