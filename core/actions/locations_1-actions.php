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

//if(function_exists('get_menu_ressembled'))
//echo get_menu_ressembled(125,100,"menutop",HKM_IMG_PATH."button_menu.png",true,false);
//else echo "no method for get_menu_ressembled";
/* END
 * @google map: http://code.google.com/apis/ajax/playground/#icon_simple
 * @source: http://foundation.zurb.com/grid-example1.php
*/


function msbingmapapi_html() {
global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey;
$tmp_query = $wp_query;

if(function_exists('get_menu_ressembled')){
//echo "start get_menu_ressembled";
//echo get_menu_ressembled(array(125,125,125,125),100,"topnavmenu",HKM_IMG_PATH."button_menu.png",true,false);
}else echo "no method for get_menu_ressembled";
//if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
css_original_design();
?><div id="map_all_bars" class="container">
     <div class="row hide-on-phones">
       <div id="mapcanvas"></div>
    </div>
<div class="row"><?php
//if(function_exists('get_menu_ressembled'))
//echo get_menu_ressembled(array(150,150,180,150,150,180,150),60,"loactions_filter",HKM_IMG_PATH."button_location.png",true,false);
//else echo "no method for get_menu_ressembled";
?><ul class="loactions_filter full" id="list_loactions_filter"><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li></ul>
</div>
<div class="row">
<div class="bardetailthumb">
<?php

$madata = new frontend_hkm_bar();
$mapdata=$madata->prepare_map_data();
//$mapdata = json_encode($madata);
print_r($mapdata);
foreach($mapdata as $key=>$value){
?><div class="bar" barid="<?php echo $value['barid']; ?>" area="<?php echo $value['area']; ?>"><?php
if (!empty($value['feature_image'])) {
    echo "<img src='" . $value['feature_image'] . "'/>";
} else {
    //echo $default_220['url'];
    echo "";
}
?><div class="barname"><?php echo $value['barname']; ?></div><div class="gradient"></div></div><?php
}
?></div><div class="bardetail"><?php
// this will be under controlled by JQ and ajax
// jquery.royalslider
 ?></div></div></div><?php 
 mbingmap_js(1140, 450, json_encode($mapdata)); 
}

function mbingmap_js($w=1140, $h=450, $data){
    global $options, $wp_query,  $ec_themeslug, $googleapikey;
  //  $tmp_query = $wp_query; 
    $bingmapapi=$options->get($ec_themeslug.'_bingmapapi');
    $bingmapreal=$options->get($ec_themeslug.'_bingmapreal');
    //print_r($bingmapreal);
    $default_220=$options->get( $ec_themeslug."_logo220");
    $msmap="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0";
    $msmap_hesk=get_template_directory_uri()."/library/js/jq.bingmap.js";
?>
<script type="text/javascript" src="<?php echo $msmap_hesk; ?>"></script>
<script type="text/javascript" src="<?php echo $msmap; ?>"></script>
<script type="text/javascript">/* CDATA[[*/<?php
   // $madata = new frontend_hkm_bar();
   // $mapdata=$madata->prepare_map_data();
    //$mapdata = json_encode($data);
    echo "var bardata = eval(" . $data . ");";
    echo "var msbingapikey = '" . $bingmapapi . "';";
    if ($bingmapreal == 1) {
        echo "var msMapTypeId = Microsoft.Maps.MapTypeId.aerial";
    } else {
        echo "var msMapTypeId = Microsoft.Maps.MapTypeId.road";
    }
 ?>/* ]]*/</script><script>
    var detail = '<div class="bar_name"></div><div class="upcoming_events"></div><div class="bar_feature_images"></div><div class="bar_phone"></div><a href="#" class="reserv button"><span class="shine"></span><span class="text">立即訂座</span></a><div class="bar_place"></div>';
    jQuery('#mapcanvas').css({
        "height" : <?=$h ?> + "px",
        "width" : <?=$w ?> + "px",
        "clear" : "both"
    });
    jQuery('#mapcanvas').html(wsm_base_obj.loading);
    //head.js(wsm_base_obj.jbin+"jquery.royalslider.js",function(){
    setTimeout(function() {
        init_bing(<?=$w ?>,<?=$h ?>);
        init_menu();
    }, 1000);
    jQuery('a').click(function() {
        var g = jQuery(this).attr("href");
        if (g == "#")
            return false;
    })
    //});
</script><?php
}

function css_original_design(){
    ?><style>
        /* -----------------------------------------
 Page Name 1
 ----------------------------------------- */
.bardetail, .bardetailthumb {
    min-height: 50px;
    float: left;
    position: relative;
}
.bardetailthumb {
    width: 660px;
}
.bardetail {
    width: 480px;
}
.bardetailthumb .bar {
    width: 220px;
    height: 100px;
    overflow: hidden;
    float: left;
    position: relative;
    cursor: pointer;
}
.archive .bardetailthumb .bar {
    width: 20%;
}
.bardetailthumb .bar .barname {
    -webkit-transition: all 0.21s ease-in-out;
    -moz-transition: all 0.21s ease-in-out;
    -o-transition: all 0.21s ease-in-out;
    transition: all 0.21s ease-in-out;
    background: -moz-linear-gradient(top,  rgba(191,0,35,0) 0%, rgba(208,0,60,1) 10%, rgba(252,0,126,1) 36%, rgba(252,0,126,1) 63%, rgba(207,0,60,1) 90%, rgba(191,0,35,0) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(191,0,35,0)), color-stop(10%,rgba(208,0,60,1)), color-stop(36%,rgba(252,0,126,1)), color-stop(63%,rgba(252,0,126,1)), color-stop(90%,rgba(207,0,60,1)), color-stop(100%,rgba(191,0,35,0)));
    background: -webkit-linear-gradient(top,  rgba(191,0,35,0) 0%,rgba(208,0,60,1) 10%,rgba(252,0,126,1) 36%,rgba(252,0,126,1) 63%,rgba(207,0,60,1) 90%,rgba(191,0,35,0) 100%);
    background: -o-linear-gradient(top,  rgba(191,0,35,0) 0%,rgba(208,0,60,1) 10%,rgba(252,0,126,1) 36%,rgba(252,0,126,1) 63%,rgba(207,0,60,1) 90%,rgba(191,0,35,0) 100%);
    background: -ms-linear-gradient(top,  rgba(191,0,35,0) 0%,rgba(208,0,60,1) 10%,rgba(252,0,126,1) 36%,rgba(252,0,126,1) 63%,rgba(207,0,60,1) 90%,rgba(191,0,35,0) 100%);
    background: linear-gradient(to bottom,  rgba(191,0,35,0) 0%,rgba(208,0,60,1) 10%,rgba(252,0,126,1) 36%,rgba(252,0,126,1) 63%,rgba(207,0,60,1) 90%,rgba(191,0,35,0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00bf0023', endColorstr='#00bf0023',GradientType=0 );
    font-size: 0px;
    height: 0px;
    line-height: 27px;
    position: absolute;
    text-align: center;
    top: 75px;
    width: 100%;
    z-index: 30;
}
.bardetailthumb .bar {
    background: url(http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png) 0 0 no-repeat;
}
.bardetailthumb .bar img {
    position: relative;
    -webkit-transition: all 1s ease-in-out;
    -moz-transition: all 1s ease-in-out;
    -o-transition: all 1s ease-in-out;
    transition: all 1s ease-in-out;
    top: 0%;
}
.bar:hover .barname {
    height: 27px;
    font-size: 20px;
    top: 60px;
}
.bar:hover img {
    top: -40%;
}
.barname a {
    display: block;
    width: 100%;
    height: 100%;
}
.reserv.button .bar_name, .upcoming_events, .bar_place, .bar_feature_images, .bar_phone {
    clear: both;
    width: 100%;
}
.metatab .reserv.button {
    float: none;
}
.bar .gradient {
    position: absolute;
    top: 0px;
    z-index: 29;
    width: 100%;
    height: 100%;
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
    position: absolute;
    top: 34px;
    padding-left: 70px;
    text-shadow: 0 0 6px black;
}
.bar_feature_images {
    height: 330px;
    -moz-box-shadow: inset 0px 0px 0px 10px #424242;
    -webkit-box-shadow: inset 0px 0px 0px 10px #424242;
    box-shadow: inset 0px 0px 0px 10px #424242;
    background: black url(http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_20x20.png) 50% 50% no-repeat;
}
    </style><?php
}
?>