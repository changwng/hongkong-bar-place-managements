<?php
/**
* Global actions used by response.
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response
* @since 1.0
*/

/**
* response global actions
*/

add_action( 'response_homepage', 'top_homepage_html' );

function top_homepage_html(){
global $ec_themename, $ec_themeslug, $options, $wp_query, $post, $slider_default, $ec_root;
    ?><div class="container">
        <?php
        //echo get_menu_ressembled(array(160,120,170,170,145,170,205),50,"topnavmenu",HKM_IMG_PATH."button_home_menu.png",true,false);
        ?>
    <div class="row">
   <div class="leftside_ads hide-on-phones">
    <?php leftside_ads_html(); ?>
   </div><!--end leftside_ads-->
    <div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_upper_m');?>
    </div>
    <div class="nine columns maincontentright">
    <?php 
//echo "start get_menu_ressembled";
    ?><!--<div class="fixwrapcontent single">-->
        <div class="innerwrapper">
        <div class="row"><?php
        section_tab_otheracti();
        section_tab_events(); 
        ?></div><?php
        //sectoin_tab_photo();
        //section_tab_advertisement();
        echo section_picture_listing_iso(); ?>
        </div>
    <!--</div>-->
    </div>
    <div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_lower_m');?>
    </div>
    <div class="advertisement_400 nine columns centered hide-on-phones">
    <?php echo ad_bar_400x100(); ?>
    </div>
    <div class="rightside_ads hide-on-phones">
       <?php //rightside_ads_html() 
       rightside_ads_html();?>
    </div><!--end rightside_ads-->
    </div><!--end row-->
    </div><?php
}


?>