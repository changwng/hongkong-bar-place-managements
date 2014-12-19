<?php 
global $meta_boxes;
$meta_boxes[]= array(
'pages'=>array(HKM_BAR),
    //This is the id applied to the meta box
'id' => 'post_lkraddresses',
    //This is the title that appears on the meta box container
'title' => __('酒吧地址及相關資料',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
'context' => 'normal',
    //This sets the priority within the context where the boxes should show
'priority' => 'high',
    //Here we define all the fields we want in the meta box
'fields' => array(
// TAXONOMY
array(
'name' => '區域 ',
'id' => "linkr_area",
// ID for this field
'desc'=>'Choose One District in Hong Kong <strong style="color:red">(*)</strong> is required. It needs to be selected in order to be seen on the website.',
'type' => 'taxonomy',
'options' => array(
        // Taxonomy name
        'taxonomy' => 'linkrarea',
        // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
        'type' => 'select_tree',
        // Additional arguments for get_terms() function. Optional
        'args' => array(),
        //arguments
        ),
),
array(
  'name' => __('地址',HKM_LANGUAGE_PACK),
  'desc' => 'the physical address of the bar, pub, club, or lounge',
  'id' => 'linkr_address',
  'type' =>'text',
  'std' =>'',
  ),
array(
  'name'=>__('Google Map URL for the address',HKM_LANGUAGE_PACK),
  'desc'=>'Please copy and paste the google URL on this text field and the system will locate the bar/pub place on the frontend<br><img width="100%" src="'.HKM_ART_PATH.'instruction_googlemap_url.png">',
  'id'=>'linkr_google_url',
  'type'=>'text',
  'std'=>'',
  ),
array(
  'name' => __('電話',HKM_LANGUAGE_PACK),
  'desc' => 'the phone number for the place',
  'id' => 'linkr_phone',
  'type' => 'text',
  'std' => '54086571',
  ),
array(
  'name' => __('容納人數',HKM_LANGUAGE_PACK),
  'desc' => 'the max amount of people can contain',
  'id' => 'linkr_cap',
  'type' => 'number',
  'std' => '100',
  ),
array(
  'name' => __('聯絡人',HKM_LANGUAGE_PACK),
  'desc' => 'the person you want to reach',
  'id' => 'linkr_foneprs',
  'type' => 'text',
  'std' => '',
  ),
)
);
$meta_boxes[]= array(
	'pages'=>array(HKM_BAR),
    //This is the id applied to the meta box
    'id' => 'post_lkrboxr',
    //This is the title that appears on the meta box container
    'title' => __('酒吧介紹',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
array(
  'name'=>__('Detailed Story / 詳細介紹',HKM_LANGUAGE_PACK),
  'desc'=>'Try less than 1000 words / <strong style="color:red;">限1000個字</strong>',
  'id'=>'linkr_detail',
  'type'=>'textarea',
  'std'=>'',
  'cols'=>'40',
  'rows'=>'8',
),
array(
  'name' => __('Short Story / 介簡',HKM_LANGUAGE_PACK),
  'desc' => 'Try less than 10 words / <strong style="color:red;">限10字個字</strong>',
  'id' => 'linkr_stort_story',
  'type' => 'text',
  'std'  => "",
),
array(
  'name' => __('平日營業時間',HKM_LANGUAGE_PACK),
  'desc' => 'business hour during weekdays <strong style="color:red;">限10個字</strong>',
  'id' => 'linkr_biz_hour',
  'type' => 'text',
  'std' => '',
),
array(
  'name' => __('週末營業時間',HKM_LANGUAGE_PACK),
  'desc' => 'business hour in the weekends <strong style="color:red;">限10個字</strong>',
  'id' => 'linkr_biz_hrwkend',
  'type' => 'text',
  'std' => '',
),
array(
    'name' => __('特別推廣/Special',HKM_LANGUAGE_PACK),
    'desc' => '酒吧特別促銷活動的信息 <strong style="color:red;">限300個字</strong>',
    'id' => 'linkr_promote',
    'type' => 'textarea',
	'std'  => "",
	'cols' => '40',
	'rows' => '8',
),
/*array(
  'name' => __('任飲包括',HKM_LANGUAGE_PACK),
  'desc' => 'all your can drink during the party',
  'id' => 'linkr_allyourcandrink',
  'type' => 'taxonomy',
  'options' => array(
	// Taxonomy name
	'taxonomy' => 'linkrdrinks',
	// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
	'type' => 'checkbox_list',
	// Additional arguments for get_terms() function. Optional
	'args' => array()
	),
),*/
array(
  'name' => __('Happy Hour/收費',HKM_LANGUAGE_PACK),
  'desc' => 'The special arrangement for happy hour',
  'id' => 'linkr_happyhour',
  'type' => 'wysiwyg',
  'std' => '',
    /*
	'cols'=>'40',
	'rows'=>'8',
    */
),
array(
  'name' => __('Normal Hour/收費',HKM_LANGUAGE_PACK),
  'desc' => 'The arrangement in normal hour',
  'id' => 'linkr_normalhour',
  'type' => 'wysiwyg',
  'std' => '',
	/*	
	'cols' => '40',
	'rows' => '8',
    */
),
array(
  'name' => __('Weekend Hour/收費',HKM_LANGUAGE_PACK),
  'desc' => 'business hour during weekend hours',
  'id' => 'linkr_wend_hour',
  'type' => 'wysiwyg',
  'std' => '',
),
//end fields
));

$meta_boxes[]= array(
	'pages'=>array(HKM_BAR),
    //This is the id applied to the meta box
    'id' => 'lkr_barfoto',
    //This is the title that appears on the meta box container
    'title' => __('酒吧介紹圖像',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        array(
            'name' => __('Top banner - 這個酒吧的宣傳圖片 GIF or PNG <strong style="color:red">(*) 建議一張 790 x 90px</strong>',HKM_LANGUAGE_PACK),
            'desc' => '建議一張 <strong style="color:red;">790 x 90px</strong>.',
            'id' => 'linkr_img_top_banner',
            'type' => 'plupload_image',
            'max_file_uploads' => 1,
        ),
        array(
            'name' => __('Half Banner - 這個酒吧的宣傳圖片 GIF or PNG <strong style="color:red">(*) 建議一張</strong>',HKM_LANGUAGE_PACK),
            'desc' => '建議一張 <strong style="color:red;">400 x 100px</strong>.',
            'id' => 'linkr_img_animated',
            'type' => 'plupload_image',
            'max_file_uploads' => 1,
        ),
        array(
            'name' => __('mobile background on the button / 手機按鈕背景圖 <strong style="color:red">(*) 建議一張</strong>',HKM_LANGUAGE_PACK),
            'desc' => '建議一張 <strong style="color:red;">200 x 90px</strong>.',
            'id' => 'linkr_img_mb',
            'type' => 'plupload_image',
            'max_file_uploads' => 1,
        ),
        array(
            'name' => __('推介/新店推介 - 這個酒吧的宣傳圖片 <strong style="color:red">(*) 建議一張 150 x 75px</strong>',HKM_LANGUAGE_PACK),
            'id' => 'linkr_img_ad',
            'type' => 'plupload_image',
            'max_file_uploads' => 1,
        ),
        array(
            'name' => __('Slide show images <strong style="color:red">(*) 建議最多20張 870 x 500px</strong>',HKM_LANGUAGE_PACK),
            'desc' => 'This will be displayed on slide post on the front slide album page. 建議最多20張 <strong style="color:red;">870 x 500px</strong>.',
         	'id' => 'linkr_sliders_bar',
            'type' => 'plupload_image',
            'max_file_uploads' => 20,
        ),
        array(
              'name' => __('Show [Detail Story] over pictures <strong style="color:red">(*) 建議一張</strong>',HKM_LANGUAGE_PACK),
              'desc' => 'This switch will turn on and off of the discription according to [Detail Story] for the bar',
              'id' => 'linkr_textonpic',
              'type' => 'checkbox',
              'std'=>'0'
        ),
        array(
            'name' => __('Video shows',HKM_LANGUAGE_PACK),
            'desc' => 'get an URL from youtube<br><img width="100%" src="'.HKM_ART_PATH.'instruction_youtube.png">',
         	'id' => 'linkr_yt_url',
            'type' => 'text',
            'std' => '',
        ),
    )
);
//print_r($meta_boxes);
	// this is the demo post type plese open a new one
  $labels = array(
    'name' => _x('酒吧', 'post type general name'),
    'singular_name' => _x('酒吧', 'post type singular name'),
    'add_new' => _x('酒吧註冊', HKM_LANGUAGE_PACK),
    'add_new_item' => __('酒吧註冊',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改酒吧',HKM_LANGUAGE_PACK),
    'new_item' => __('追加酒吧註冊',HKM_LANGUAGE_PACK),
    'all_items' => __('酒吧目錄',HKM_LANGUAGE_PACK),
    'view_item' => __('看覽酒吧',HKM_LANGUAGE_PACK),
    'search_items' => __('搜查酒吧',HKM_LANGUAGE_PACK),
    'not_found' =>  __('沒有發現酒吧',HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('在垃圾中沒有發現酒吧',HKM_LANGUAGE_PACK), 
    'parent_item_colon' => '',
    'menu_name' => __('酒吧冊',HKM_LANGUAGE_PACK)
  );
  // to learn more 
  // http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
  $args = array(
    'labels' => $labels,
    'description' => __( 'Manage the Hong Kong bars nad pubs in the backend system.'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
   /*  'capability_type' => 'bar_editing',
   'capabilities'=>array(
                'publish_posts' => 'publish_bar',
                'edit_posts' => 'edit_bar',
                'edit_others_posts' => 'edit_others_bar',
                'delete_posts' => 'delete_bar',
                'delete_others_posts' => 'delete_others_bar',
                'read_private_posts' => 'read_private_bar',
                'edit_post' => 'edit_bar',
                'delete_post' => 'delete_bar',
                'read_post' => 'read_bar',
     ),*/
    'has_archive' =>true,
    'hierarchical' =>false,
    'menu_position' =>null,
    'supports' =>array('title','thumbnail','author'),
    'menu_icon' =>HKM_ART_PATH.'barwinery.png',
  ); 
register_post_type(HKM_BAR,$args);

?>