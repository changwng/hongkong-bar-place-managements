<?php
/*!
* LINKER EVENTS RESULT
* SLIDER WITH 4 ITEMS MENU
*/
function menu_events_rsilder_html($args=array()) {
    $defaults = array('id' => null, 'rslider' => TRUE, 'class' => null, 'html' => null, );
    $args = wp_parse_args($args, $defaults);
    /*!
     * OPTIONAL: Declare each item in $args as its own variable i.e. $type, $before.
     */
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $ec_themename;
    extract( $args, EXTR_SKIP );
    $eventdata = new hkm_event();
    $dataof_event = $eventdata->get_bar_data();
    //print_r($dataof_event);
    $howmanyevents_in_one_slide=3;
    $item_slide="";
    $item_at = 0;
?><div id="top_section_with_menu" class="container">
<div id="topmenu" class="hide-on-phones row">
<div id="adsecion" class="ten columns">
<div id="ds" class="adSlider rSilder rsDefault"><?php

foreach ($dataof_event as $key => $value) {
$item_slide.='<section class="piece"><img class="rsImg" src="'.$value['feature_image'].'" alt="Slider" /><a href="'.$value['barlink'].'" class="text_from_evet">'.$value['linkr_eventdetails_custom'].'</a></section>';
if($item_at===$howmanyevents_in_one_slide || count($dataof_event)-1==$item_at){
?><div class="rsContent"><?php  echo $item_slide; ?></div><?php
    $item_slide = ""; $item_at = 0;
}

$item_at++;

}
?></div>
</div>
<div id="nav"><?php
    wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'header-menu', ));
   ?></div></div></div><?php
topsection_script();
}
/*!
* LINKER SEARCH ON THE BAR
* SLIDER WITH 4 ITEMS MENU
*/
function menu_rsilder_html($args=array()) {
$defaults = array('id' => null, 'rslider' => TRUE, 'class' => null, 'html' => null, );
$args = wp_parse_args($args, $defaults);
/*!
* OPTIONAL: Declare each item in $args as its own variable i.e. $type, $before.
*/
global $options, $post, $ec_themeslug, $ec_root, $wp_query, $ec_themename;
extract( $args, EXTR_SKIP );
?>
<div id="top_section_with_menu" class="container">
<div id="topmenu" class="hide-on-phones row">
<div id="adsecion" class="ten columns">
<div id="ds" class="adSlider rSilder rsDefault"><?php
//foreach ($variable as $key => $value) {
if (have_posts()) :while (have_posts()) : the_post();
     $large= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
     $large = empty($large[0])?get_template_directory_uri()."/images/logo_600x200.png":$large[0];
     $barname=get_the_title();
?><a class="rsContent" href="<?php  echo $permlink = get_permalink(); ?>"><img class="rsImg" src="<?php
    echo $large;
    ?>" alt="Slider" /><div class="text_from_arhive"><?php echo $barname; ?></div></a><?php
endwhile; else :
?><h2>Nothing found</h2><?php
endif;
//}
?></div></div><div id="nav"><?php
    wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'header-menu', ));
   ?></div></div></div><?php
topsection_script();
}

/*
* Lite slider function
*/
function response_slider_lite_content() {
global $ec_themename, $ec_themeslug, $options, $wp_query, $post, $slider_default, $ec_root;

$i=1;
while($i<=8){
$predefined_slide = 'slide'.$i;
$predefined_slidersource = 'slider'.$i.'source';
$predefined_link='link'.$i;
if (is_page()) {
$$predefined_slide=get_post_meta($post->ID, $ec_themeslug.'_page_slide_'.$i.'_image' , true);
$$predefined_link=get_post_meta($post->ID, $ec_themeslug.'_page_slide_'.$i.'_url' , true);
}else{
$$predefined_slidersource = $options->get($ec_themeslug.'_blog_slide_'.$i.'_image');
$$predefined_slide = $$predefined_slidersource['url'];
$$predefined_link = $options->get($ec_themeslug.'_blog_slide_'.$i.'_url');
}
$i++;

}
?>
<div class="container">
    <div class="row">
        <div id="orbitDemo">
<?php
$i=1;
while($i<=8){
$predefined_slide = 'slide'.$i;
$predefined_link='link'.$i;
?><div class="rsContent" href="<?php echo $$predefined_link; ?>"><img src="<?php echo $$predefined_slide; ?>" alt="Slider" /></div><?php
$i++;
}
?>
        </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery(window).load(function() {
			jQuery('#orbitDemo').orbit({
				bullets : true,
				directionalNav : false,

			});
		});
	});
</script>
<?php

}



/* gear slider for content single bar slider show - royalslider */
function gear_rslider_html($beta_id){
    global $options, $ec_themeslug, $post; 
	$tpl_1 = '<div id="%1$s" class="detailstory rSilder rsDefault">%2$s</div>';
	$tpl_2 = '<div class="rsContent">%3$s%4$s<img class="rsImg" data-rsTmb="%1$s" width="700px" src="%2$s"/></div>';
	$html="";
    $is_text_on=gear_contentfilter_cf_boolean('linkr_textonpic');
   // print_r($is_text_on);
           // $images = hkm_cross_reference::metabox_get_listimgurls(HKM_BAR,$post->ID, 'linkr_sliders_bar','large',false);
     $images = hkm_cross_reference::meta_box_get_list_all_images_src($post->ID, 'linkr_sliders_bar');
            //print_r($images); 
            //$images_small = hkm_cross_reference::metabox_get_listimgurls(HKM_BAR,$post->ID, 'linkr_sliders_bar','small',false);
     $list = gear_autop_array('linkr_detail');
             //   print_r($images);
                $step = 0;
                foreach ($images as $key => $value) {
                    $imageURL_medium=$value['medium'];
                    $imageURL_large=$value['large'];
                    //adding the title on the first slider
                        if($step===0){
                            $k3 = '<h2 class="posts_title">'.get_the_title().'</h2>';
                            }else $k3='';
                            //adding text and comments on each slide if that is running
                            if(!empty($list[$step]) && $is_text_on==true){
                                   $k4 = '<span class="story">'.$list[$step].'</span>';
                                }else{
                                	$k4='';
                                }

   $html.= sprintf($tpl_2,$imageURL_medium,$imageURL_large,$k3,$k4);
    $step++;
    }
				
				echo sprintf($tpl_1,$beta_id,$html);
    // $co = frontend_hkm_bar::get_coordinator($post);
    // $src = "https://maps.google.com.hk/?ie=UTF8&amp;t=m&amp;";
    // $src.="brcurrent=3,0x340400e82572c6b7:0x22fe68b2f10791c8,1&amp;";
    // $src.="ll=".$co['lng'].",".$co['lat']."&amp;spn=0.444482,0.585022&amp;z=18&amp;output=embed&amp;iwloc=A&amp;";
    // $src.="hnear=Century+House,+3-4+Hanoi+Rd";
    //

    /*
    $src = get_post_meta($post->ID, 'linkr_google_url', true);
    ?><div class="rsContent">
    <!-- <iframe width="870" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $src; ?>"></iframe>-->
    <a target="_blank" class="text_from_arhive center" href="<?php echo $src; ?>">View Map</a>
    </div><?php
    */
 
    }
/**
* End
*/
?>
