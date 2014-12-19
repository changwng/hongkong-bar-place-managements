<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
function prefix_register_meta_boxes_89824234() {
    global $post, $meta_boxes, $pagenow;
    if ($pagenow == 'post.php') :
        $post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'];
        //if(!isset($_GET['post']) && !isset($_GET['post_ID']))return false;
        //$post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'] ;
        if ($post_id == HOME_PG) :
            $meta_boxes[] = array('pages' => array('page'),
            //pages
            'id' => 'rilwis_adimages',
            //================
            'title' => 'Advertisement box - 頭版安排',
            //================
            'context' => 'normal', 'priority' => 'high',
            //================
            'fields' => array( 
            array(
            'name'=>'置頂的廣告橫額，可隨機顯示，與贊助商的廣告混合 <strong style="color:red;">790 x 90px</strong>',
            'id' => 'linkrad_topb', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR, 'linkr_img_top_banner'),
            'clone' => true 
			), 
            
             array(
            'name'=>'Advertisment bar selection lower area <strong style="color:red;">400 x 100px</strong>',
            'id' => 'linkrad_lower', 
            'desc' => '<span class="bigdesc">You can select up to four items</span>', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_animated'), 
            'clone' => true),
            
            array(
            'name'=>'Advertisment bar selection upper area <strong style="color:red;">400 x 100px</strong>',
            'id' => 'linkrad_upper', 
            'desc' => '<span class="bigdesc">You can select up to four items</span>', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_animated'), 
            'clone' => true), 
            
			array(
            'name'=>'手機的置上廣告橫額 <strong style="color:red;">150 x 75px</strong>',
            'id' => 'linkrad_upper_m', 
            'desc' => '<span class="bigdesc">You can select up to three items</span>', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_animated'), 
            'clone' => true), 
            
			array(
			'name'=>'手機的置下廣告橫額 <strong style="color:red;">150 x 75px</strong>',
			'id' => 'linkrad_lower_m', 
            'desc' => '<span class="bigdesc">You can select up to three items</span>', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_animated'), 
            'clone' => true),
            
		    array(
			'name'=>'Advertisment bar selection on the left side - Show at [推介]',
			'id' => 'linkrad_lower_r', 
            'desc' => 'Please make your own adjustment accordingly', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_ad'), 
            'clone' => true),
            
			
			array(
			'name'=>'Advertisment bar selection on the right side - Show at [新店推介]',
			'id' => 'linkrad_lower_l', 
            'desc' => 'Please make your own adjustment accordingly', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle_if_customField_filled(HKM_BAR,'linkr_img_ad'), 
            'clone' => true),
            
            
            array(
            'name'=>'地區 - 顯示菜單的區域和前頁',
            'id' => 'linkrad_bar_collection', 
            'type' => 'select', 'options' => HKM_refernx::ls_PostTitle(HKM_BAR), 
            'clone' => true),
            ));
           



        endif;
        if ($post_id == EVENTS_PG) :
            $meta_boxes[] = array('pages' => array('page'),
            //pages
            'id' => 'metabox_comb_mission',
            //================
            'title' => 'Images Box',
            //================
            'context' => 'normal', 'priority' => 'high',
            //================
            'fields' => array(
            //================
            array('name' => 'mission_image_1', 'id' => 'mission_image_1', 'desc' => 'Right hand side the 3rd picture / Max 1 wallpaper with 640x500',
            //====starting to edit in here====
            'type' => 'plupload_image',
            //================
            'max_file_uploads' => 1, ), ));
        endif;
        if ($post_id == LOCATION_PG) :
            $meta_boxes[] = array('pages' => array('page'),
            //pages
            'id' => 'metabox_artist_section',
            //================
            'title' => 'Artist Orders',
            //================
            'context' => 'normal',
            //================
            'priority' => 'high',
            //================
            'fields' => array(
            //====starting to edit in here====
            array('id' => 'wsm_artist_order', 'desc' => 'Adding your artist in this order',
            //====starting to edit in here====
            'type' => 'select',
            //================
            'options' => HKM_refernx::ls_PostTitle(HKM_PASTEVENT),
            //================
            'clone' => true), ));
        endif;
    endif;
    $meta_boxes[] = array('pages' => array('post'),
    //pages
    'id' => 'metabox_postextras',
    //================
    'title' => 'Images Box', 'context' => 'normal', 'priority' => 'high',
    //================
    'fields' => array( array('id' => 'post_images', 'desc' => 'upto 3 images',
    //====starting to edit in here====
    'type' => 'plupload_image',
    //================
    'max_file_uploads' => 3, ), ));
}

add_action('admin_init', 'prefix_register_meta_boxes_89824234');

?>