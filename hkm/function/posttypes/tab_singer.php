<?php 

global $meta_boxes;
$meta_boxes[]= array(
	'pages'=>array(HKM_STAR),
    //This is the id applied to the meta box
    'id' => 'post_album_meta',
    //This is the title that appears on the meta box container
    'title' => __('歌手數據',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        array(
			'name'             => '歌手相簿',
			'desc'             => '歌手第一張相 , 專輯封面, 相簿封面 (30 pictures maximum)',
			'id'               => 'ss_data_album_gallery',
			'type'             => 'thickbox_image',
			'max_file_uploads' => 30,
		),
		array(
			'name'             => 'Schedule Feature Images',
			'desc'             => 'This image will be displayed on the schedule tab when this person is selected for the event. Dimensions: <strong style="color:red;">80 × 80 pixels</strong>. Only ONE picture for this field.',
			'id'               => "data_singer_sche_thumb",
			'type'             => 'thickbox_image',
			'max_file_uploads' => 1,
		),
		array(
			'name'             => 'Web Single Signature',
			'desc'             => '歌手專輯封面/相簿封面/Dimensions: <strong style="color:red;">210 × 210</strong> pixels. Only ONE picture for this field.',
			'id'               => 'ss_image_src_sign',
			'type'             => 'thickbox_image',
			'max_file_uploads' => 1,
		),
		array(
			'name'             => 'Web Top Circle',
			'desc'             => '歌手專輯封面/相簿封面 /Dimensions: <strong style="color:red;">850 × 350</strong> pixels. Only ONE picture for this field.',
			'id'               => 'ss_image_src_half_sphere',
			'type'             => 'thickbox_image',
			'max_file_uploads' => 1,
		),
));
$meta_boxes[]= array(
	'pages'=>array(HKM_STAR),
    //This is the id applied to the meta box
    'id' => 'post_star_bio',
    //This is the title that appears on the meta box container
    'title' => __('歌手傳記',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
array(
'name' => '歌手類型 (*)', 'id' => "ss_singer_type",
// ID for this field
'type' => 'taxonomy', 'options' => array(
// Taxonomy name
'taxonomy' => 'singa',
// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
'type' => 'select_tree',
// Additional arguments for get_terms() function. Optional
'args' => array()), 'desc' => 'What kind of singer is he/she?', 
),
 	/*	array(
            'name' => __('歌手類型',HKM_LANGUAGE_PACK),
            'desc' => 'What kind of singer is he/she?',
            'id' => DATATYPE_PREFIX.'singer_type',
            'type' => 'radio',
            	'options'	=> array(
				'f' => '女歌手',
				'm'	=> '男歌手',
				'g'	=> '組合',
			),
            'std' => ''
        ),*/
        array(
			'name'             => '姓名',
			'id'               => "ss_star_name",
			'type'             => 'text',
		
		),
		array(
			'name'             => '出生日期',
			'id'               => 'ss_star_dob',
			'type'             => 'date',
			'format' => 'm月d日', 'std' => ''
		),
		array(
			'name'             => '身高',
			'id'               => 'ss_star_tall',
			'type'             => 'text',
			
		),
		 array(
			'name'             => '體重',
			'id'               => "ss_star_weight",
			'type'             => 'text',
		
		),
		array(
			'name'             => '星座',
			'id'               => 'ss_star_scoro',
			'type'             => 'text',
		),
		 array(
			'name'             => '語言',
			'id'               => "ss_star_language",
			'type'             => 'text',
	
		),
		array(
			'name'             => '傳記精粹  (Highlights)',
			'id'               => "ss_star_bio",
			'type'             => 'textarea',
	 'desc' => '(max 100 words)',
		),
		));
	// this is the demo post type plese open a new one
  $labels = array(
    'name' => _x('歌手', 'post type general name'),
    'singular_name' => _x('歌手', 'post type singular name'),
    'add_new' => _x('追加歌手', HKM_LANGUAGE_PACK),
    'add_new_item' => __('追加歌手',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改歌手',HKM_LANGUAGE_PACK),
    'new_item' => __('追加歌手',HKM_LANGUAGE_PACK),
    'all_items' => __('所有歌手',HKM_LANGUAGE_PACK),
    'view_item' => __('看覽歌手',HKM_LANGUAGE_PACK),
    'search_items' => __('搜查歌手',HKM_LANGUAGE_PACK),
    'not_found' =>  __('沒有發現歌手',HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('在垃圾中沒有發現歌手',HKM_LANGUAGE_PACK), 
    'parent_item_colon' => '',
    'menu_name' => __('歌手',HKM_LANGUAGE_PACK)
  );
  // to learn more 
  // http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
  $args = array(
    'labels' => $labels,
    'description' => __( 'Manage the ablums in the backend.' ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    //'rewrite' => array('slug'=>'stars','with_front'=>false),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
    'menu_icon' => HKM_ART_PATH.'1346161202_sofa2.png',
    'hierarchical' => false,
  ); 
register_post_type(HKM_STAR,$args);
?>