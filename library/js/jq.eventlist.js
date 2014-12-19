$(function() {
	var img_container = jQuery('.maincontentright');
	var _container = jQuery('#pastevent_container');
	var _imgs = img_container.find('img').hide();
	var totalImgs = _imgs.length;
	var cnt = 0;
	_imgs.each(function(i) {
		var _thisimg = jQuery(this);
		jQuery('<img/>').load(function() {++cnt;
			if (cnt === totalImgs) {
				_imgs.fadeIn();
				_container.isotope({
					itemSelector : '.event',
					layoutMode : 'masonryColumnShift'
				});
			}
		}).attr('src', _thisimg.attr('src'));
	});

});

