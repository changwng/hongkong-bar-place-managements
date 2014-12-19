<?php
/**
* BING MAP FROM MICROSOFT element actions used by response Pro.
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
* response Portfolio Section actions
 * capmomo@hotmail.com
*/
add_action( 'response_bartype', 'bartypeapi_html' );
function bartypeapi_html_old(){
    
}
function bartypeapi_html() {
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey,$ec_themename; 
//bar_features
?><div class="container">
    <div class="row">
        <div class="leftside_ads hide-on-phones">
        <?php leftside_ads_html(); ?>
        </div><!--leftside end-->
        <div class="nine columns maincontentright">
                <!--<div class="fixwrapcontent">-->
                    <div class="innerwrapper">
                    <?php 
                        section_tab_walker_bar_types();
                     ?>
                </div>
                <!--</div>-->
                <div class='clear'>&nbsp;</div>
                <!--Begin @response link pages hook-->
                <?php response_link_pages(); ?>
                <!--End @response link pages hook-->
        </div><!--end entry-->
        <div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_lower_m');?>
    </div>
    <div class="advertisement_400 nine columns centered hide-on-phones">
    <?php echo ad_bar_400x100(); ?>
    </div>
        <div class="rightside_ads hide-on-phones">
           <?php rightside_ads_html(); ?>
        </div>
    </div><!--end row-->
    </div><!--end container--><?php
}
?>