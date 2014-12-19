(function($){
/*!
 * THIS CODE IS DEVELOPED BY HESKEMO KAM
 * 
 */
  //variable for storing the menu count when no ID is present
  //plugin code
jQuery.fn.interface_mobile = function(options){
    //plugin's default options
    var settings = {
      switchWidth: 400,
      topOptionText: 'Select a page',
      indentString: '&nbsp;&nbsp;&nbsp;'
    };
        //function to decide if mobile or not
    function isMobile(){
		return (jQuery(window).width() < settings.switchWidth);
    }
    //plugin functionality
    function run(self){
      //menu doesn't exist
      wsm_base_obj.isNowMobile=isMobile();
	}
return this.each(function() {
	//override the default settings if user provides some
	if (options) {
		jQuery.extend(settings, options);
	}
	//cache "this"
	var self = jQuery(this);
	//bind event to browser resize
	jQuery(window).resize(function() {
		run(self);
	});
	//run plugin
	run(self);
});
}
})(jQuery);