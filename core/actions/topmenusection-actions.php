<?php

/**
* 
*
* Author: HESKEYO KAM
* Copyright: © 2012
* {@link http://hkmdev.wordpress.com/ HKMdev LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response Pro
* @since 1.0
*/
/**
*  client email
 * capmomo@hotmail.com
*/
add_action('response_archive_topsection','navtop_html_arhive');
function navtop_html_arhive(){
      global $ec_themename;
    ?>
    <div id="topmenu" class="hide-on-phones row">
<div id="adsecion" class="ten columns">
<div id="ds" class="adSlider rSilder rsDefault"><?php
$i=1;
while($i<=8){
//$predefined_slide = 'slide'.$i;
//$predefined_link='link'.$i;
?><a class="rsContent" href="<?php //echo $$predefined_link; ?>"><img class="rsImg" src="<?php //echo $$predefined_slide; ?>" alt="Slider" /></a><?php
$i++;
}
?></div></div><div id="nav"><?php wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu'.addClassifIE8(true).'">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'header-menu', 
// Setting up the location for the main-menu, Main Navigation.
            ));
   ?></div></div><?php topsection_script();
}
add_action( 'response_navtop', 'navtop_html');
function navtop_html() {
     global $ec_themename, $ec_themeslug, $options, $wp_query, $post, $slider_default, $ec_root;
?>
<div id="topmenu" class="hide-on-phones row">
<div id="adsecion" class="ten columns">
        <?php

        $i = 1;
        while ($i <= 8) {
            $predefined_slide = 'slide' . $i;
            $predefined_slidersource = 'slider' . $i . 'source';
            $predefined_link = 'link' . $i;
            if (is_page()) {
                $$predefined_slide = get_post_meta($post -> ID, $ec_themeslug . '_page_slide_' . $i . '_image', true);
                $$predefined_link = get_post_meta($post -> ID, $ec_themeslug . '_page_slide_' . $i . '_url', true);
            } else {
                $$predefined_slidersource = $options -> get($ec_themeslug . '_blog_slide_' . $i . '_image');
                $$predefined_slide = $$predefined_slidersource['url'];
                $$predefined_link = $options -> get($ec_themeslug . '_blog_slide_' . $i . '_url');
            }
            $i++;

        }
        ?><div id="ds" class="adSlider rSilder rsDefault"><?php
$i=1;
while($i<=8){
$predefined_slide = 'slide'.$i;
$predefined_link='link'.$i;
?><a class="rsContent" href="<?php echo $$predefined_link; ?>"><img class="rsImg" src="<?php echo $$predefined_slide; ?>" alt="Slider" /></a><?php
$i++;
}
?></div></div><div id="nav">
   <?php wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu'.addClassifIE8(true).'">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
            ));
   ?></div></div><?php
topsection_script();
}
function topsection_script(){
    ?><script>
//var detail='<div class="bar_name"></div><div class="upcoming_events"></div><div class="bar_place"></div><div class="bar_feature_images"></div><div class="bar_phone"></div><a href="#" class="reserv button"><span class="shine"></span><span class="text">Reserve Table Now</span></a>';
//jQuery('#mapcanvas').css({"height":h+"px" , "width":w+"px","clear":"both"});
//jQuery('#mapcanvas').html("<div class='loadingcontent'><div class='circle'></div><div class='circle1'></div></div>");
 //  setTimeout(function(){top_banner_initialize();},2000);
 jQuery(".adSlider").append(wsm_base_obj.loading);
 jQuery(".adSlider .loadingcontent").css("position","absolute");
var _adcontainer = jQuery('.adSlider'), 
    _ad_imgs = _adcontainer.find('img').hide(), 
    _ad_totalImgs = _ad_imgs.length, 
    cnt = 0;
    _ad_imgs.each(function(i) {
var _thisimg = jQuery(this);
   jQuery('<img/>').load(function() {
         ++cnt;
      if (cnt === _ad_totalImgs) {
          //start the slider now
            _ad_imgs.fadeIn();
            jQuery(".loadingcontent").remove();
  //           console.log("done and load rSlider");
            _adcontainer.royalSlider(wsm_base_obj.rslideConfiguration);
       }
     }).attr('src', _thisimg.attr('src'));
     });
     </script><?php
}
?>