var iso_settings = {
    animationOptions : {
        duration : 500,
        easing : 'linear',
        queue : false
    },
    masonry : {
        //cornerStampSelector: '.fixedwood',
        //columnWidth: contain.width() / 3 },
        containerStyle : {
            position : 'absolute',
            overflow : 'hidden',
        },
        layoutMode : 'fitRows'
    }
};
var montage_settings = {
    minsize : true,
    margin : 2,
    fixedHeight : 100
};
var colorbox_settings={
	transition:"fade",
	rel:'sexypicture'
}
var eb = {
    ini_listing : function() {
        var $ = jQuery, product_iso, dis = this;
        product_iso = $("#photowall");
        if (product_iso.size() > 0) {
            dis.ini_mono("#photowall");
           // alert("photowall")
        } else {
            dis.ini_mono("#photowallec");
            // alert("photowallec")
        }
    },
    ini_mono : function(c) {
        var _container = jQuery(c);
        var _imgs = _container.find('img').hide();
        var totalImgs = _imgs.length;
        var cnt = 0;
        _imgs.each(function(i) {
            var _thisimg = jQuery(this);
            jQuery('<img/>').load(function() {++cnt;
                if (cnt === totalImgs) {
                    _imgs.fadeIn();
                    //  console.log("done and load montage");
                    if (c == "#photowallec") {
                        _container.montage(montage_settings);
                        jQuery(".cboxe").colorbox(colorbox_settings);
                    } else {
                    	//this is not in use
                        _container.isotope(iso_settings);
                    }
                }
            }).attr('src', _thisimg.attr('src'));
        });
    }
}
jQuery(function($) {
    eb.ini_listing();
})
