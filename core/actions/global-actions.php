<?php
/**
* Global actions used by response.
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
* response global actions
*/
add_action( 'response_loop', 'response_loop_content' );
add_action( 'response_post_byline', 'response_post_byline_content' );
add_action( 'response_mobile_post_byline', 'response_mobile_post_byline_content' );
add_action( 'response_edit_link', 'response_edit_link_content' );
add_action( 'response_post_tags', 'response_post_tags_content' );
add_action( 'response_post_bar', 'response_post_bar_content' );
add_action( 'response_fb_like_plus_one', 'response_fb_like_plus_one_content' );
/**
* Check for post format type, apply filter based on post format name for easy modification.
*
* @since 1.0
*/
function gear_contentfilter_cf_get($customfield,$show_boolean=FALSE){
                global $post; 
                //call globals
                $k = get_post_meta($post -> ID, $customfield, TRUE);
                if(!$show_boolean){
                     $k=!empty($k)?$k:__("不詳",'linker');
                }else{
                     $k=empty($k)?FALSE:TRUE;  
                }
                return $k;
}
function gear_contentfilter_cf_boolean($customfield){
                global $post; 
                return (intval(get_post_meta($post -> ID, $customfield, TRUE))===0)?FALSE:TRUE;
}
function gear_content_print_line($customfield){
            echo gear_contentfilter_cf_get($customfield);
}
function gear_autop_array($customfield){
                global $options, $ec_themeslug, $post; 
                //call globals
               $k = get_post_meta($post -> ID, $customfield, TRUE);
               $l = explode("\n", $k);
               $h = array();
               foreach ($l as $key => $link){
                   $test = trim($l[$key]);
                   if($test!=''){ $h[]=$l[$key];}
               }
               return $h;
}
function gear_autop_arrayd($customfield){
                global $options, $ec_themeslug, $post; 
                //call globals
               $k = get_post_meta($post -> ID, $customfield, TRUE);
               $l = explode("\n", $k);
               $h = array();
               foreach ($l as $key => $link){
                   $test = trim($l[$key]);
                   if($test!=''){ echo '<p>'.$l[$key].'</p>';}
               }
}
function gear_taxonomy_selected(){
                global $options, $ec_themeslug, $post; //call globals
               
                $terms = get_the_terms($post -> ID, 'linkrarea');
                if ( $terms && ! is_wp_error( $terms ) ) : 
                foreach ($terms as $term) {
                    $find = $term->name;
                    if(!empty($find)){
                    return $find;
                    }
                }
                endif;
}
function gear_html_meta_info($show=true){
    global $post;
    $metalist = array(
                array('phone',__('電話','linker'), 'linkr_phone' ),
                array('contactperson',__('聯絡人','linker'), 'linkr_phone_person' ),
                array('area',__('區域','linker') ),
                array('address',__('地址','linker'),'linkr_address'),
                array('weekday',__('平日營業時間','linker'), 'linkr_biz_hour' ),
                array('weekends',__('週末營業時間','linker'), 'linkr_biz_hrwkend' ),
                array('people',__('容納人數','linker'), 'linkr_cap' ),
                //array('population',__('Rating','linker'), 'linkr_cap' ),
    );
	if($show)$metalist[]=array('terms',__('酒吧特色','linker'), 'linkr_ft' );
    $buffer = "";
     foreach ($metalist as $key0 => $list) {
       $buffer_base='<li class="metaline ';
       if($list[0]=='area'){
         $buffer.=$buffer_base.$list[0].'"><div></div><span>'.$list[1].': '.gear_taxonomy_selected().'</span></li>';  
       }elseif($list[0]=='terms'){
           $buffer.=$buffer_base.$list[0].'"><div></div><span>'.$list[1].': </span><div class="termssys">'.hkm_cross_reference::terms_walker_from_post('linkrbarfeat',$post->ID,'linkrbarfeat').'</div></li>';  
       }elseif(gear_contentfilter_cf_get($list[2],TRUE)===TRUE){
         $buffer.=$buffer_base.$list[0].'"><div></div><span>'.$list[1].': '.gear_contentfilter_cf_get($list[2],FALSE).'</span></li>';
       }
     }
    echo $buffer;
}
    function response_actionscript_js(){
    //ob_start();
    wp_enqueue_script('easytab');
    wp_enqueue_script('single_controller');
    wp_enqueue_style('slider');
    //$content = ob_get_clean();
    //echo $content;
    }
    function response_only_for_arhive_events(){
    global $options, $ec_themeslug, $post;
 ?>
	<a class="barban" href="<?php the_permalink() ?>">
    <div class="bar" barid="<?php echo $post -> ID; ?>">
        <div class="image">
            <?php echo get_the_post_thumbnail($post -> ID); ?>
        </div>
     <div class="barname"><?php the_title(); ?></div>
    </div>
    </a><!--end row-->
    <?php
	}
	function response_only_for_arhive_bar(){
	global $options, $ec_themeslug, $post;
	$id = $post->ID;
    ?><a class="barban" href="<?php the_permalink() ?>">
    <div class="bar" barid="<?php echo $id; ?>"><div class="image"><?php
	echo get_the_post_thumbnail($id);
    ?></div><div class="barname"><?php the_title(); ?></div>
    <div class="info"><?php echo get_post_meta($id, 'linkr_stort_story', TRUE); ?></div>
    </div></a><!--end row-->
    <?php
	}
	function response_only_for_arhive(){
	global $options, $ec_themeslug, $post;
	//loop_bar_tap();
  ?><div class="datawrap" id="<?php echo $post -> ID; ?>">
    <div class="date list"></div>
    <div class="timeevent list"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
    <div class="partyname list"></div>
</div><?php
}

/**
* Sets the post byline information (author, date, category).
*
* @since 1.0
*/
function response_post_byline_content() {
global $options, $ec_themeslug ; //call globals.
$posttype = get_query_var('post_type');
if (is_single()) {
$featured_images = $options->get($ec_themeslug.'_single_show_featured_images');
$hidden = $options->get($ec_themeslug.'_single_hide_byline');
$post_formats = $options->get($ec_themeslug.'_single_post_formats');
} elseif (is_archive()) {
$featured_images = $options->get($ec_themeslug.'_archive_show_featured_images');
$hidden = $options->get($ec_themeslug.'_archive_hide_byline');
$post_formats = $options->get($ec_themeslug.'_archive_post_formats');
}else {
$featured_images = $options->get($ec_themeslug.'_show_featured_images');
$hidden = $options->get($ec_themeslug.'_hide_byline');
$post_formats = $options->get($ec_themeslug.'_post_formats');
}
if (get_post_format() == '') {
$format = "default";
}else {
$format = get_post_format();
}

if ($post_formats != '0') :
?>
<div class="postformats hide-on-phones"><!--begin format icon-->
<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format; ?>.png" alt="formats" />
</div><!--end format-icon-->
<?php endif; ?>
<div class="meta hide-on-phones">
<ul><?php
if ($posttype == HKM_BAR) {
	global $post;

	$var = '<li class="featured-image">%3$s<div class="wrap-meta-buttons">' .
	//=====
	'<a class="reservform" href="%1$s"></a>' .
	//=====
	'<a target="_blank" class="mapdirect" href="%2$s"></a>' .
	//=====
	'</div></li>';
	echo sprintf($var,
	//=====
	get_permalink(RESERVE),
	//=====
	get_post_meta($post -> ID, "linkr_google_url", true),
	//=====
	(has_post_thumbnail($post -> ID)) ? get_the_post_thumbnail($post -> ID, array(247, 247)) : '');
	//=====
	gear_html_meta_info(false);
}
?><!--Begin @response post edit link hook--><?php response_edit_link(); ?><!--End @response post edit link hook-->
</ul></div><?php
}

/**
* Sets the responsive post byline information (author, date, category).
*
* @since 1.0
*/
function response_mobile_post_byline_content() {
global $options, $ec_themeslug; //call globals.
if (is_single()) {
$hidden = $options->get($ec_themeslug.'_single_hide_byline');
$post_formats = $options->get($ec_themeslug.'_single_post_formats');
} elseif (is_archive()) {
$hidden = $options->get($ec_themeslug.'_archive_hide_byline');
$post_formats = $options->get($ec_themeslug.'_archive_post_formats');
}else {
$hidden = $options->get($ec_themeslug.'_hide_byline');
$post_formats = $options->get($ec_themeslug.'_post_formats');
} if (get_post_format() == '') {
$format = "default";
} else {
$format = get_post_format();
}

}
function gear_mobile(){
?><div class="meta-mobile show-on-phones"><ul><?php gear_html_meta_info();
	/*
	 if ($post_formats != '0') : ?>
	 <li class="postformats show-on-phones"><img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format; ?>.png" alt="formats" />
	 </li><?php endif; ?>
	 <li class="metadate"><?php if (($hidden[$ec_themeslug.'_hide_date']) != '0'):?><?php printf(__('', 'response')); ?><a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?></a><?php endif; ?></li>
	 <li class="metacomments"><?php if (($hidden[$ec_themeslug.'_hide_comments']) != '0'):?><?php comments_popup_link(__('No Comments', 'response'), __('1 Comment', 'response'), __('% Comments', 'response'));
	 //need a filer here
	 ?><?php endif; ?></li>
	 <li class="metaauthor"><?php if (($hidden[$ec_themeslug.'_hide_author']) != '0'):?><?php printf(__('', 'response')); ?><?php the_author_posts_link(); ?><?php endif; ?></li>
	 <li class="metacat"><?php if (($hidden[$ec_themeslug.'_hide_categories']) != '0'):?><?php printf(__('', 'response')); ?> <?php the_category(', ') ?><?php endif; ?></li>
	 <li class="metatags"><?php response_post_tags(); ?></li><?php
	 */
?></ul>
</div><?php
}
/**
* Sets up the WP edit link
*
* @since 1.0
*/
function response_edit_link_content() {
edit_post_link('管理', '<p>', '</p>');
}

/**
* Sets up the tag area
*
* @since 1.0
*/
function response_post_tags_content() {
global $options, $ec_themeslug;
if (is_single()) {
$hidden = $options->get($ec_themeslug.'_single_hide_byline');
}
elseif (is_archive()) {
$hidden = $options->get($ec_themeslug.'_archive_hide_byline');
}
else {
$hidden = $options->get($ec_themeslug.'_hide_byline');
}
if (has_tag() AND ($hidden[$ec_themeslug.'_hide_tags']) != '0'):
?>
<?php the_tags('', ', ', ''); ?>
<?php endif;
	}
	/**
	* End
	*/

	//this also called response_loop;;;;
	function response_loop_content($content) {
	global $options, $ec_themeslug, $post; //call globals
	$posttype = get_query_var('post_type');
	if (is_single()) {
	$post_formats = $options->get($ec_themeslug.'_single_post_formats');
	$featured_images = $options->get($ec_themeslug.'_single_show_featured_images');
	$excerpts = $options->get($ec_themeslug.'_single_show_excerpts');
	if($posttype==HKM_BAR){
	response_only_for_hkm_bar_single();
	response_actionscript_js();
	}else if($posttype==HKM_EVENT){
	response_only_for_hkm_event_single();
	}else if($posttype==HKM_COUPON){
	response_only_single_coupon();
	}else if($posttype==HKM_PASTEVENT){
	response_only_single_pastevent();
	}
	}elseif(is_archive()){
	//starting from archive events
	$post_formats = $options->get($ec_themeslug.'_archive_post_formats');
	$featured_images = $options->get($ec_themeslug.'_archive_show_featured_images');
	$excerpts = $options->get($ec_themeslug.'_archive_show_excerpts');
	if($posttype==HKM_EVENT){
	response_only_for_arhive_events();
	}else{
	response_only_for_arhive_bar();
	}

	}else{
	$post_formats = $options->get($ec_themeslug.'_post_formats');
	$featured_images = $options->get($ec_themeslug.'_show_featured_images');
	$excerpts = $options->get($ec_themeslug.'_show_excerpts');
	}
	if (get_post_format() == '') {
	$format = "default";
	} else {
	$format = get_post_format();
	}
	//ob_start();
 ?>
<!--Call @response Meta hook-->
<?php

//   $content = ob_get_clean();
//   $content = apply_filters('response_post_formats_' . $format . '_content', $content);
//    echo $content;
}
?>