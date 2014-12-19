<?php
/**
* BING MAP FROM MICROSOFT element actions used by response Pro.
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
/**
* response Portfolio Section actions
 * capmomo@hotmail.com
*/

//if(function_exists('get_menu_ressembled'))
//echo get_menu_ressembled(125,100,"menutop",HKM_IMG_PATH."button_menu.png",true,false);
//else echo "no method for get_menu_ressembled";
/* END
 * @google map: http://code.google.com/apis/ajax/playground/#icon_simple
 * @source: http://foundation.zurb.com/grid-example1.php
 * */
 
add_action( 'response_bingmapapi_element', 'msbingmapapi_html' );
add_action( 'response_menubingmap', 'menubingmap_html' );
add_action( 'response_locations_listing', 'loc_listing_html' ); //used
function backgroundimage($show=null){
    return 'style="background-image:url('.$show.')"';
}
function loop_bar_tap($arraylist_bar_data){
$default_icon_image = HKM_IMG_PATH."logo_128x128.png";
$default_bg_image = "http://www.ecdrink.com.hk/wp-content/uploads/2013/01/598405_300833996692863_1153269144_n2-300x178.jpg";
if (isset($arraylist_bar_data['feature_image'])) {
	//show the icon here
	$local_1 = trim($arraylist_bar_data['feature_image']);
	$icon_image = empty($local_1) ? $default_icon_image : $local_1;
} else {
	$icon_image = $default_icon_image;
}

if (isset($arraylist_bar_data['linkr_img_mb'])) {
	//show the feature image here
	$local_1 = trim($arraylist_bar_data['linkr_img_mb']);
	$feature_image = empty($local_1) ? $default_bg_image : $local_1;
} else {
	$feature_image = $default_bg_image;
}
ob_start();
get_template_part("tpl/loop","bartap");
$tpl=ob_get_clean();
return sprintf($tpl, 
//-----------------------
$arraylist_bar_data['barid'],$arraylist_bar_data['area'],$arraylist_bar_data['permlink'],
//-----------------------
backgroundimage($icon_image),$arraylist_bar_data['barname'],$arraylist_bar_data['linkr_stort_story'],
//-----------------------
backgroundimage($feature_image, $default_bg_image)
//-----------------------
);
}
function bar_tab_construction(&$mapdata){
//print_r($madata->result);
$b="";
foreach ($mapdata as $key => $value) {
    $b.=loop_bar_tap($value);
}
$var = '<div id="storeddata" class="hide bardata">%s</div>';
echo sprintf($var, $b);
}
function loc_listing_js(){
//$loadscript=get_template_directory_uri()."/library/js/jq.locations.js";
//wp_register_script('loc_controller' , $loadscript,'jquery',FALSE,FALSE);
//wp_localize_script('loc_controller', 'wsm_base_obj', $site_configuration);
//wp_enqueue_script ('loc_controller');
//did not use
}
function loc_listing_html_new(){
global $options, $post, $ec_themename,$ec_themeslug, $ec_root, $wp_query, $googleapikey;
$madata = new frontend_hkm_bar();
$mapdata=$madata->prepare_map_data();
$button='<div class="row buttonlinkr"><a class="reserv button"><span class="shine"></span><span class="text"><span>立即訂座</span><br><span class="phonenumber"></span></span></a><a target="_blank" href="#" class="reserv button"><span class="shine"></span><span class="text"><div class="map"></div><span class="maptext">地圖</span></span></a></div>';
$level1='<div class="container"><div class="columns nine">%s</div></div>';
}
function loc_listing_html() {
global $options, $post, $ec_themename,$ec_themeslug, $ec_root, $wp_query, $googleapikey;
wp_enqueue_script ('loc_controller');
$madata = new frontend_hkm_bar();
$mapdata=$madata->prepare_map_data();
$detail='<div class="row buttonlinkr"><a class="reserv button"><span class="shine"></span><span class="text"><span>立即訂座</span><br><span class="phonenumber"></span></span></a><a target="_blank" href="#" class="reserv button"><span class="shine"></span><span class="text"><div class="map"></div><span class="maptext">地圖</span></span></a></div>';
?><script>

var detail =    '<?php echo $detail; ?>';<?php echo "var bardata = eval(" . json_encode($mapdata) . ");"; ?>
  /*  head.js(wsm_base_obj.jbin + "/jq.locations.js", function() {
        init_menu()
    });*/
   jQuery(function($){
       init_menu();
   });
    
</script>
<div class="container">
<div class="row">
    <div class="leftside_ads hide-on-phones">
        <?php leftside_ads_html(); ?>
    </div>
    <div class="nine columns maincontenright">
    	<div id="pagenav_mobile" class=""></div>
    </div>
    <div id="location_pie" class="nine columns">
        <div class="container centered"><?php get_template_part("tpl/menu","pie"); ?></div>
    </div>
    <div class="nine columns maincontentright">
            <?php bar_tab_construction($mapdata); ?><!-- bardata end -->
            <!--<div class="fixwrapcontent locations">-->
            <div class="innerwrapper">
            <div class="row">
            <div class="locations columns eight">
                <div class="row <?php echo inClassName_IEDisplayNone(); ?>">
                    <ul class="loactions_filter full" id="list_loactions_filter">
                        <li></li><li></li><li></li><li></li><li></li><li></li>
                    </ul>
                </div>
                <div class="row <?php echo inClassName_IEDisplayNone(TRUE); ?>">
                    <div class="submegaLocations MegaSub"><?php
                    $submegaLocations = hkm_cross_reference::custom_taxonomy_walker_level_1('linkrarea', 0, TRUE);
                    echo $submegaLocations;
                ?></div>
                </div>
                <div id="quickview_allbars" class="row active"></div>
                <div id="pagenav" class="row" style="display:none">
                	<nav class="pages">
                		<a id="lbPrevLink" href="javascript:page(-1);"></a>
                		<div id="pageReport" area="">0/1</div>
                		<a id="lbNextLink" href="javascript:page(1);"></a>
                	</nav>
                </div>
                <div id="page" class="row" style="display:none"></div>
                <div id="barstage" class="hidden-asset row bardetailthumb">
                	<section id="pages_content" style="display:none"></section>
                	<section id="sorry" style="display:none">對不起，沒有結果<div class="backbutton_pie"><img src="<?php echo HKM_IMG_PATH."button_ring.png"; ?>"/></div></section>
                </div>
            </div>
            </div>
            <div class="rightside_media_widget hide-on-phones">
                <div id="mobile_bar_slider_small" class="bardetail <?php echo inClassName_IEDisplayNone(); ?>">
                    <div class="bar_name"></div>
                    <div class="upcoming_events"></div>
                    <div class="bar_feature_images"></div>
                    <?php echo $detail; ?>
                    <div class="bar_place"></div>
                </div>
            </div><!-- rightside_ads end -->
            </div><!-- row end -->
            <!-- innerwrapper </div> end -->
        </div><!-- fixwrapcontent locations end -->
        <div class="rightside_ads hide-on-phones">
           <?php rightside_ads_html(); ?>
        </div>
</div><!--end entry-->
</div><!--end container--><style>
    .bardetail {
        width: 308px;
        margin-top: 130px;
        position: relative;
    }
    .reserv.button .bar_name, .upcoming_events, .bar_place, .bar_feature_images, .bar_phone {
        clear: both;
        width: 100%;
    }
    .metatab .reserv.button {
        float: none;
    }
    .bar_name {
        /*background: url(http://www.ecdrink.com.hk/wp-content/themes/linkr/images/bg_bar_title.png) 0 0 no-repeat;*/
        box-shadow: inset 3px 3px 5px 4px #720033;
        background-color: #da2a74;
        height: 50px;
        z-index: 99;
    }
    .bar_name a, .bar_name span {
        font-size: 60px;
        line-height: 58px;
        color: #424242;
        font-weight: bold;
        padding-left: 15px;
        text-align: left;
        text-shadow: 0 -3px 6px #54002A;
    }
    .bar_name span {
        font-size: 40px
    }
    .bar_place {
        color: white;
        font-weight: bold;
        position: relative;
        top: 34px;
        text-align: center;
        text-shadow: 0 0 6px black;
    }
    .bar_feature_images {
        height: 330px;
        -moz-box-shadow: inset 0px 0px 0px 10px #424242;
        -webkit-box-shadow: inset 0px 0px 0px 10px #424242;
        box-shadow: inset 0px 0px 0px 10px #424242;
        background: black url(http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_20x20.png) 50% 50% no-repeat;
    }
    .enter {
        bottom: 90px;
        display: block;
        float: right;
        font-size: 36px !important;
        position: absolute;
        z-index: 99;
    }
    .rAppBar {
        position: relative;
        /* set width and height of slider here, in px, % or em*/
        width: 288px !important;
        /*width:auto;*/
        height: 320px !important;
        margin-left: 10px;
        padding-top: 10px;
        /* height:300px; */
        /* Used to prevent content "jumping" on page load. this property is removed when javascript is loaded and slider is instanciated */
        overflow: hidden;
    }
</style>
<?php

}
?>