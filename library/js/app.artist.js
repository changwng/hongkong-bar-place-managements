var target = jQuery("#stage .leftside");
function request_artist(id) {
	/*jQuery(".leftside .imag").html("");
	 jQuery(".leftside .detailname").html("");
	 jQuery(".leftside .detailcontent").html("");*/
	var url = wsm_base_obj.domainbasejson + "get_post&" + jQuery.param(jsonapi({
		post_type : 'hkmtype_idolstar',
		count : 1,
		include : 'title,thumbnail,url,content',
		post_id : id
	}));
	jQuery.ajax(url).done(function(jsonlocal) {
		if (!statuschk(jsonlocal)) {
			return false;
		}
		result_data(jsonlocal);
		//console.log(jsonlocal);
		//}
	});
	return false;
}

function result_data(jsonlocal) {
	var data = jsonlocal.post, h = "", transit = 200;
	//alert(jsonlocal);
	if (data.thumbnail != "") {
		h = data.thumbnail;
		h = h.replace("-150x150", "");
	}
	jQuery(".leftside .imag").stop().animate({
		"opacity" : "0"
	}, transit, function() {
		jQuery(this).html('<img width="300" src="' + h + '">');
	}).animate({
		"opacity" : "1"
	}, transit);
	setTimeout(function() {
		jQuery(".leftside .detailname").stop().animate({
			"opacity" : "0"
		}, transit, function() {
			jQuery(this).html(data.title);
		}).animate({
			"opacity" : "1"
		}, transit);
	}, transit * 1.5);
	setTimeout(function() {
		jQuery(".leftside .detailcontent").stop().animate({
			"opacity" : "0"
		}, transit, function() {
			jQuery(this).html(data.content);
		}).animate({
			"opacity" : "1"
		}, transit);
	}, transit * 2);
	/*setTimeout(function() {
	 jQuery(".leftside .imag").html('<img width="300" src="' + h + '">').animate({"opacity":"1"},500);
	 jQuery(".leftside .detailname").html(data.title).animate({"opacity":"1"},500);
	 jQuery(".leftside .detailcontent").html(data.content).animate({"opacity":"1"},500);
	 }
	 ,1000);*/
}
