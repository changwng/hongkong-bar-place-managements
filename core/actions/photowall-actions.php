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
add_action('response_photowall', 'photowall_html' );
function photowall_html() {	
global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey;
$tmp_query = $wp_query; 
  
?><div id="mainwall" class="row"><?php
$wallph = new hkm_pastevent();
$wallpharray = $wallph -> get_photowall_list_model();
//print_r($wallpharray);
echo "<div id='photowall' style='width:100%;float:right;'><!-- These are our grid blocks -->";
foreach ($wallpharray as $id => $arraylist) {
    foreach ($arraylist as $n => $url) {
        echo "<a rel='lightbox-portfolio' href='".$url[1]."'><img src='".$url[0]."'/></a>";
    }
}
echo "<!-- End of grid blocks--></div>";
?></div><script>
	head.js(wsm_base_obj.jbin + "jquery.montage.min.js", function() {
		// initialize the plugin
		var _container = jQuery('#photowall'), 
		_imgs = _container.find('img').hide(), 
		totalImgs = _imgs.length, 
		cnt = 0;
		_imgs.each(function(i) {
			var _thisimg = jQuery(this);
			jQuery('<img/>').load(function() {
			    ++cnt;
				if (cnt === totalImgs) {
					_imgs.fadeIn();
					console.log("done and load montage");
					_container.montage({
						minsize : true,
						margin : 2,
						fixedHeight : 100
					});

				}
			}).attr('src', _thisimg.attr('src'));
		});
	}); 
</script><div id="events" class="row">
<?php 
//$events = $wallph->

?></div><?php
}


function section_picture_listing_iso(){
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey;
    $wallph = new hkm_pastevent();
    wp_enqueue_script('isotope');
    wp_enqueue_script('isotope-handler');
    wp_enqueue_style('ealbum');
    $html ='<!-- start section --><section class="middlepart photowall"><div class="title_tab linkerphotos"></div><div id="photowall">';
    $html.= $wallph -> get_past_photo_album_listID_callback('ec_get_item');
    $html.='<!-- End of grid blocks --></div></section><!-- End section -->';
    
    return $html;
}
function ec_get_item($post_id){
    $var ='<a class="ecdrinkcc" href="%1$s">%2$s<span>%3$s</span></a>';
   // $img_id = get_post_meta($post_id, 'linkr_pe_sg', false);
    //$img_id= wp_get_attachment_image_src($img_id[0],'medium');
    return sprintf($var, get_permalink($post_id),get_the_post_thumbnail($post_id,'medium'),get_the_title($post_id));
}
function response_only_single_pastevent(){
    global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query;
    $id = $post->ID;
    
    $var_2='<a class="ecdrink_bar_icon" href="%1$s"><span class="namespace">%3$s</span>%2$s</a>';
    $var_3='<div class="title_party">%1$s</div><div class="partycomment">%2$s</div>';
    $var_4='<a rel="lightboxportfolio2" class="ecdrink_photo cboxe" href="%1$s"><img src="%2$s"/></a>';
    $bar_id=get_post_meta($id, 'linkr_pe_place', TRUE);
    $party_id=get_post_meta($id, 'linkr_pe_party', TRUE);
    $img_ids= get_post_meta($id, 'linkr_pe_sg', false);
    $photo = '';
    // --- ---
    foreach ($img_ids as $key => $value) {
        $img_m=wp_get_attachment_image_src($value,'medium');
        $img_m=$img_m[0];
        $img_l=wp_get_attachment_image_src($value,'large');
        $img_l=$img_l[0];
        $photo.=sprintf($var_4, $img_l, $img_m);
    }
    // --- --- --- --- --- --- --- --- --- --- --- ---
    wp_enqueue_style('ealbum');
    wp_enqueue_script('montage_engine');
    wp_enqueue_script('isotope-handler');
    // --- --- --- --- --- --- --- --- --- --- --- ---
    $event_comments = get_post_meta($id, 'linkr_pe_comment', TRUE);
    $bar_icon = get_the_post_thumbnail($bar_id,'full');
    // --- --- --- --- --- --- --- --- --- --- --- ---
    $bar_link = get_permalink($bar_id);
    $bar_title = get_the_title($bar_id);
    $party_title = get_the_title($party_id);
    // --- --- --- --- --- --- --- --- --- --- --- ---
    $html_img=sprintf($var_2, $bar_link, $bar_icon, $bar_title);
    $html_comments=sprintf($var_3, $party_title,$event_comments);
    // --- --- --- --- --- --- --- --- --- --- --- ---
    //if(empty(trim($bar_link))||empty(trim($bar_title))){
    if(strtolower($bar_title) == "others" || strtolower($bar_title)=="other" || $bar_id==1378){
        $is_vari="hide";
    }else{
        $is_vari="";
    }
    $var_1='
       <div class="container nine columns centered"><div class="row ecdrinkphotowall ' . $is_vari . '">
            <div class="six column">%1$s</div>
            <div class="six column">%2$s</div>
       </div><div class="title_tab linkerphotos"></div>
       <div class="row gallery" id="photowallec">%3$s</div>
       </div>
       ';
    echo sprintf($var_1, $html_img, $html_comments, $photo);
}
function sectoin_tab_photo(){
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey;
    $wallph = new hkm_pastevent();
    $wallpharray = $wallph -> get_photowall_list_model();
    $counts = 0;
//$tmp_query = $wp_query; 
//ob_start();
   // $html = ob_get_clean();
?><!-- start section --><section class="middlepart photowall"><div class="title_tab linkerphotos"></div>
<div id="photowall">
<!-- These are our grid blocks --><?php
$wallph = new hkm_pastevent();
$wallpharray = $wallph -> get_photowall_list_model('linkr_pe_dj');
//print_r($wallpharray);
$counts = 0;
foreach ($wallpharray as $id => $arraylist) {
    foreach ($arraylist as $n => $url) {
        if($counts>20)break;
        echo "<a rel='lightbox-portfolio' href='".$url['full']."'><img style='display:none' src='".$url['mid']."'/></a>";
        $counts++;
    }
    if($counts>20)break;
}
?><!-- End of grid blocks -->
</div>
</section><!-- End section -->
<script>
    head.js(wsm_base_obj.jbin + "jquery.montage.min.js", function() {
        // initialize the plugin
        var _container = jQuery('#photowall'), 
        _imgs = _container.find('img').hide(), 
        totalImgs = _imgs.length, 
        cnt = 0;
        _imgs.each(function(i) {
            var _thisimg = jQuery(this);
            jQuery('<img/>').load(function() {
                ++cnt;
                if (cnt === totalImgs) {
                    _imgs.fadeIn();
                  //  console.log("done and load montage");
                    _container.montage({
                        minsize : true,
                        margin : 2,
                        fixedHeight : 100
                    });
                }
            }).attr('src', _thisimg.attr('src'));
        });
    }); 
</script><?
}



?>