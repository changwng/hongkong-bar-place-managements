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
jQuery(".detailstory").append(wsm_base_obj.loading);
jQuery(".detailstory .loadingcontent").css("position", "absolute");
var _ad_imgs = jQuery(".row").find('img.rsImg').hide(), _ad_totalImgs = _ad_imgs.length, cnt = 0;
var _adcontainer_nav = jQuery('#detailstory');
var _adcontainer_mobile = jQuery('#detailstorymobile');
var configuration_slider_desktop = wsm_base_obj.rslideConfiguration;
configuration_slider_desktop.thumbs = {
	// thumbnails options go gere
	spacing : 10,
	arrowsAutoHide : true
};
configuration_slider_desktop.controlNavigation = 'thumbnails';
configuration_slider_desktop.thumbs = {
	orientation : 'vertical',
	paddingBottom : 4,
	appendSpan : true
};
configuration_slider_desktop.autoScaleSlider = true;
configuration_slider_desktop.autoScaleSliderWidth = 800;
configuration_slider_desktop.autoScaleSliderHeight = 400;
//console.log(configuration_slider_desktop);
var configuration_slider_mobile = wsm_base_obj.rslideConfiguration;
configuration_slider_mobile.autoScaleSliderHeight = 300;
configuration_slider_mobile.autoScaleSlider = true;
configuration_slider_mobile.orientation = 'horizontal', _ad_imgs.each(function(i) {
	var _thisimg = jQuery(this);
	jQuery('<img/>').load(function() {++cnt;
		if (cnt === _ad_totalImgs) {
			//start the slider now
			jQuery(".detailstory .loadingcontent").fadeOut(1000, function() {
				_ad_imgs.fadeIn();
				_adcontainer_nav.royalSlider(configuration_slider_desktop);
				_adcontainer_mobile.royalSlider(configuration_slider_mobile);
				//   jQuery(".rsNav.rsBullets .rsNavItem:last-child").remove();
			});
			//  console.log(_adcontainer_mobile);
		}
	}).attr('src', _thisimg.attr('src'));
});

//alert("is IE:"+wsm_base_obj.browser.isIE8);
jQuery(function($) {
	// $('.partyarrangement .tabs a:first-child').trigger('click');
	$(".row.partyarrangement table").css("width", "100%");
	$(".row.partyarrangement table span").removeAttr("style");
	$('.partyarrangement .tabs a').on('click', function() {
		var self = $(this).parent();
		var index = self.index();
		var active = null;
		/*
		 if (wsm_base_obj.browser.isIE8) {
		 active=$('.partyarrangement .tab.showDisplay').index();
		 }else{
		 */
		active = $('.partyarrangement .tab.active').index();
		/*}*/
		var activeEle = $('.partyarrangement .tab').eq(active);
		/* if a tab other than the current active
		 tab is clicked
		 */
		if ($('.partyarrangement .tabs a').index(active) !== index) {
			// Remove/add active class on tabs
			/*
			 if (wsm_base_obj.browser.isIE8) {
			 activeEle.removeClass('showDisplay');
			 self.addClass('showDisplay');
			 $('#tabcontent>div.showDisplay').hide().removeClass('showDisplay');
			 $('#tabcontent>div:eq(' + index + ')').fadeIn().addClass('showDisplay');
			 } else {
			 */
			activeEle.removeClass('active');
			self.addClass('active');
			// Remove/add active class on panes
			$('#tabcontent>div.active').hide().removeClass('active');
			$('#tabcontent>div:eq(' + index + ')').fadeIn().addClass('active');
			// we can also add some quick fading effects
			// now that's awesome! you got
			// fancy stylish css3 tabs for your
			// next project ;)
			/*}*/
		}
	});
	$("#tabcontent .innerwrap a").each(process_a);
	/*$(".selectionbar select").change(function() {
	 console.log("there is a change");
	 var str = $(this).attr("class");
	 $('#tabcontent>div').removeClass('active');
	 var tabname = $(".selectionbar select option:selected").val();
	 console.log("tab name = " + tabname);
	 $('#tabcontent>div.' + tabname).addClass('active');
	 }).change();*/
	$("#single_bar_detail_menu_mobile .sub-menu a").on("touchend click", tab_action_view_content);
	scanSlimBox();
	tab_action_view_content(false);
});
function tab_action_view_content(e) {
	var $ = jQuery;
	// in request from Sindy to show the first tab after the page has loaded.
	if ( typeof (e) == "boolean") {
		$('#metatab').addClass('active');
	} else {
		var n = $(this);
		if (e.type == "click")
			n.unbind("touchend");
		if (e.type == "touchend")
			n.unbind("click");
		var target = $(this).attr("href").substring(1);
		var active = $('#tabcontent>.active');
		active.removeClass('active');
		$("#" + target).addClass('active');
		//console.log("m tab");
	}
	return false;
}
function process_a() {
	var self = jQuery(this);
	var ends = self.attr("href").substr(-3, 3);
	//console.log(ends.toLowerCase());
	if (ends.toLowerCase() == 'jpg') {
		self.attr("rel", "lightbox-table");
	}
	//console.log(ends);
}