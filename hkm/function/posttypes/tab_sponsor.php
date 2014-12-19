<?php 
//sponsor built by HKM in the back end

global $meta_boxes;
$meta_boxes[]= array(
    'pages'=>array(HKM_SPONSOR),
    //This is the id applied to the meta box
    'id' => 'post_linkr_sp_list',
    //This is the title that appears on the meta box container
    'title' => __('贊助商廣告 - 酒吧',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
array(
  'name' => __('贊助之酒吧',HKM_LANGUAGE_PACK),
  'desc' => 'what bar does this sponsor have made to?',
  'id' => 'linkr_sp_bar',
  'type' => 'checkbox_list',
  'options' => HKM_refernx::ls_PostTitle(HKM_BAR),
),
    ));
$meta_boxes[]= array(
	'pages'=>array(HKM_SPONSOR),
    //This is the id applied to the meta box
    'id' => 'post_linkr_sponsor',
    //This is the title that appears on the meta box container
    'title' => __('贊助商廣告內容',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
array(
  'name' => __('贊助商 URL',HKM_LANGUAGE_PACK),
  'desc' => 'The official website of the sponsor.',
  'id' => 'linkr_sp_url',
  'type' => 'text',
  'std' => 'http://',
),
array(
  'name' => __('廣告 <strong style="color:red;">710 x 90px</strong>',HKM_LANGUAGE_PACK),
  'desc' => 'Up to 10 banners',
  'id' => 'linkr_ad_banner',
  'type' => 'plupload_image',
  'max_file_uploads' => 10,
),
array(
  'name' => __('高級之贊助商 - Top Listing Sponsor',HKM_LANGUAGE_PACK),
  'desc' => 'Is this sponser a premium? It will affact the placement of the ads managements',
  'id' => 'linkr_sp_premium',
  'type' => 'radio',
            'options'   => array(
                'p'         => 'Yes, it will be place on the top list',
                'n'         => 'No, it will show on the bar detail only.',
            ),
),
array(
  'name' => __('Banners 廣告價錢總額',HKM_LANGUAGE_PACK),
  'desc' => 'The value of this ad to be placed.',
  'id' => 'linkr_ad_banner_value',
  'type' => 'number',
  'std'=>0,
),
array(
  'name' => __('廣告 <strong style="color:red;">200 x 200px</strong>',HKM_LANGUAGE_PACK),
  'desc' => 'Up to 5 squares',
  'id' => 'linkr_ad_sq',
  'type' => 'plupload_image',
  'max_file_uploads' => 5,
),
array(
  'name' => __('Squares 廣告價錢總額',HKM_LANGUAGE_PACK),
  'desc' => 'The value of this ad to be placed.',
  'id' => 'linkr_ad_sq_value',
  'type' => 'number',
  'std'=>0,
),
array(
  'name' => __('廣告 <strong style="color:red;">421 x 90px</strong>',HKM_LANGUAGE_PACK),
  'desc' => 'Up to 3 strips',
  'id' => 'linkr_ad_strip',
  'type' => 'plupload_image',
  'max_file_uploads' => 3,
),
array(
  'name' => __('Strips 廣告價錢總額',HKM_LANGUAGE_PACK),
  'desc' => 'The value of this ad to be placed.',
  'id' => 'linkr_ad_strip_value',
  'type' => 'number',
  'std'=>0,
),	

//end fields
));

	// this is the demo post type plese open a new one
  $labels = array(
    'name' => _x('sponsorship', 'post type general name'),
    'singular_name' => _x('贊助商', 'post type singular name'),
    'add_new' => _x('贊助商註冊', HKM_LANGUAGE_PACK),
    'add_new_item' => __('贊助商註冊',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改贊助商',HKM_LANGUAGE_PACK),
    'new_item' => __('追加贊助商',HKM_LANGUAGE_PACK),
    'all_items' => __('所有贊助商',HKM_LANGUAGE_PACK),
    'view_item' => __('看覽贊助商',HKM_LANGUAGE_PACK),
    'search_items' => __('搜查贊助商',HKM_LANGUAGE_PACK),
    'not_found' =>  __('沒有發現贊助商',HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('在垃圾中沒有發現贊助商',HKM_LANGUAGE_PACK), 
    'parent_item_colon' => '',
    'menu_name' => __('Sponsor',HKM_LANGUAGE_PACK)
  );
  // to learn more 
  // http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
  $args = array(
    'labels' => $labels,
    'description' => __( 'Manage the hong kong bar in the backend.' ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','thumbnail'),
    'menu_icon' => HKM_ART_PATH. '1354881056_money.png',
  ); 
register_post_type(HKM_SPONSOR,$args);

?>