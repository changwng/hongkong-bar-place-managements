<?php
/**
* Portfolio element actions used by response Pro.
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


add_action( 'response_googlemapapi_bar', 'response_locations_bar_map_html' );
function response_locations_bar_map_html() {	
	global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey;
	$tmp_query = $wp_query; 
    $googleapikey=$options->get($ec_themeslug.'_googleapi');
    if (!empty($googleapikey)) {
        $gmapv3="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=".$googleapikey;
    }
	if (is_page()) {
		

		
	}else{
		

		
	}


	?>
	<script type="text/javascript">
/* CDATA[[*/
<?php 
    $madata = new frontend_hkm_bar();
    $mapdata = json_encode($madata);
    echo "var bardata = eval(".$mapdata.");"; ?>
function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("google_mapcanvas"));
        map.setCenter(new GLatLng( 22.287873, 114.159225), 13);
        // Add 10 markers to the map at random locations
        var bounds = map.getBounds();
        var southWest = bounds.getSouthWest();
        var northEast = bounds.getNorthEast();
        var lngSpan = northEast.lng() - southWest.lng();
        var latSpan = northEast.lat() - southWest.lat();
       /* for (var i = 0; i < 10; i++) {
          var latlng = new GLatLng(
          	southWest.lat() + latSpan * Math.random(),
            southWest.lng() + lngSpan * Math.random());
            map.addOverlay(new GMarker(latlng));
        }*/
       for (var i = 0; i < bardata.result.length; i++){
            var latlng = new GLatLng(
               bardata.result[i].lng,
               bardata.result[i].lat
           );
           map.addOverlay(new GMarker(latlng));
       }
      }
}
function fill_bars(){
    if(typeof (bardata)=="undefined"){
        console.log("bardata : undefined");
        return;
    };
    for(var i=0;i<bardata.result.length;i++){
        
    }
    
}
//console.log(bardata);
<?php  if (!empty($googleapikey)) { ?>
head.js(
    "<?php echo $gmapv3; ?>",function(){
        if(typeof (GMap2)=="undefined"){
            jQuery("#google_mapcanvas").html("<img width='100%' src='<?php echo HKM_IMG_PATH; ?>googlemap_inactive.png'/>")
        }else{
            initialize();
        }
    }
)
<?php }else{ ?>
    jQuery("#google_mapcanvas").html("please provide google api key..");
<?php } ?>
//initialize();
 /* ]]*/
</script><div id="map_all_bars" class="container">
<div class="row">
<div id="google_mapcanvas">
<?php

if(function_exists('get_menu_ressembled')){
//echo "start get_menu_ressembled";
//echo get_menu_ressembled(array(125,125,125,125),100,"menutop",HKM_IMG_PATH."button_menu.png",true,false);
}else echo "no method for get_menu_ressembled";
/* END 
 * @google map: http://code.google.com/apis/ajax/playground/#icon_simple
 * @source: http://foundation.zurb.com/grid-example1.php
 * */ 
?>
</div>
</div><div class="row">
<div class="six columns" style="height:400px">
  <title>up coming events</title>up coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming events 
</div>
<div class="six columns" style="height:400px">
    <title>bars</title>up coming eventsup  coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup coming eventsup comingcoming eventsup coming eventsup coming events
    
</div>
</div>
</div><?php
}
?>