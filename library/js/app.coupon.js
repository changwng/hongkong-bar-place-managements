jQuery(function($) {
	var removerslider = function() {
		jQuery("#couponslider").fadeOut(300, function() {
			jQuery("#couponslider").html("")
		});
	}
	jQuery(".coupon_no").click(function() {
		var thisbox = jQuery(this);
		var img = thisbox.children('.image');
		var ccode = thisbox.children('.couponcode');
		var detail = thisbox.children('.detail');
		var cap = thisbox.children('.cap');
		var club = thisbox.children('.club');
		var html = "";
		jQuery.each([img, ccode, detail, cap, club], function(i, val) {
			html += jQuery('<div class="rsContent">').append(val.clone()).remove().html()
		});
		console.log("conpon on click");
		jQuery("#couponslider").html("");
		jQuery("#couponslider").append(html).royalSlider(wsm_base_obj.rslideConfiguration);
	});
	jQuery("#couponslider").fadeIn();
	//================================================
	var total = $('#paging .coming_events').size();
	var itemsOnEachPage = 10;
	var showPage = function(page) {
		var $ = jQuery;
		$(".coming_events").hide();
		$(".coming_events").each(function(n) {
			if (n >= itemsOnEachPage * (page - 1) && n < itemsOnEachPage * page)
				$(this).show();
		});
	};
	var pageControlInit = function() {
		$('#coming_events').pagination('selectPage', 1);
	}
	//alert(total);
	var controlpages = $('#coming_events').pagination({
		items : total,
		itemsOnPage : itemsOnEachPage,
		cssStyle : 'dark-theme',
		currentPage : 1,
		onPageClick : function(pageNumber) {
			showPage(pageNumber);
		},
		onInit : pageControlInit
	});
	console.log(controlpages);
});
