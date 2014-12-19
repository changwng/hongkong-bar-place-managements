<?php 
global $meta_boxes;
$meta_boxes[]= array(
	'pages'=>array(HKM_COUPON),
    //This is the id applied to the meta box
    'id' => 'post_linkr_coupon',
    //This is the title that appears on the meta box container
    'title' => __('優惠券',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
array(
  'name' => __('Coupon code',HKM_LANGUAGE_PACK),
  'desc' => 'the physical address of the bar, pub, club, or lounge',
  'id' => 'linkr_coupon_code',
  'type' => 'text',
  'std' => '',
),
/*
array(
  'name' => __('Expiration',HKM_LANGUAGE_PACK),
  'desc' => 'the phone number for the place',
  'id' => 'linkr_coupon_expiration',
 'type' => 'date',
'format' => 'yy年m月d日', 'std' => ''
),
*/
array(
  'name' => __('A. 活動名稱由已經註冊的名單中的事件選擇',HKM_LANGUAGE_PACK),
  'desc' => 'The coupon will benefit the party event',
  'id' => 'linkr_coupon_event',
	'type' => 'select',
	'options' => HKM_refernx::ls_PostTitle(HKM_EVENT),
),
array(
  'name' => __('B. 手動輸入的活動 名稱/地址',HKM_LANGUAGE_PACK),
  'desc' => '當你需要顯示這個字段，你需要清空[A.]的選擇',
  'id' => 'linkr_coupon_event_manual',
  'type' => 'text',
            'std'  => "",
),
array(
'name' => __('C. 手動選擇的酒吧',HKM_LANGUAGE_PACK),
'desc' => '當你需要顯示這個字段，你需要清空[A.]的選擇',
'id' => 'linkr_coupon_eventplace',
'type' => 'select',
'options' => HKM_refernx::ls_PostTitle(HKM_BAR),
),
array(
  'name' => __('名額',HKM_LANGUAGE_PACK),
  'desc' => 'the max amount of people can contain',
  'id' => 'linkr_coupon_cap',
  'type' => 'text',
  'std' => '',
),
array(
 'name' => __('有效日期', HKM_LANGUAGE_PACK), 
 'desc' => __('失效之日期', HKM_LANGUAGE_PACK), 
 'id' => 'linkr_eventdate', 
 'type' => 'date',
// Date format, default yy-mm-dd. Optional. See: http://goo.gl/po8vf
'format' => 'yy年m月d日', 'std' => ''
),
array(
  'name' => __('聯絡電話',HKM_LANGUAGE_PACK),
  'desc' => 'the person you want to reach',
  'id' => 'linkr_coupon_person',
  'type' => 'text',
  'std' => '',
),
array(
  'name' => __('推廣內容',HKM_LANGUAGE_PACK),
  'desc' => 'Benefits and highlights of this coupon - the good things',
  'id' => 'linkr_coupon_detail',
  'type' => 'textarea',
			'std'  => "",
			'cols' => '40',
			'rows' => '8',
),

array(
  'name' => __('約制條款',HKM_LANGUAGE_PACK),
  'desc' => 'Special terms and conditions - the bad things',
  'id' => 'linkr_coupon_conditions',
  'type' => 'wysiwyg',
            'std'  => "",
            'cols' => '40',
            'rows' => '8',
),

//end fields
));

	// this is the demo post type plese open a new one
  $labels = array(
    'name' => _x('Coupon', 'post type general name'),
    'singular_name' => _x('優惠券', 'post type singular name'),
    'add_new' => _x('優惠券註冊', HKM_LANGUAGE_PACK),
    'add_new_item' => __('優惠券註冊',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改優惠券',HKM_LANGUAGE_PACK),
    'new_item' => __('追加優惠券',HKM_LANGUAGE_PACK),
    'all_items' => __('所有優惠券',HKM_LANGUAGE_PACK),
    'view_item' => __('看覽優惠券',HKM_LANGUAGE_PACK),
    'search_items' => __('搜查優惠券',HKM_LANGUAGE_PACK),
    'not_found' =>  __('沒有發現優惠券',HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('在垃圾中沒有發現優惠券',HKM_LANGUAGE_PACK), 
    'parent_item_colon' => '',
    'menu_name' => __('Coupon',HKM_LANGUAGE_PACK)
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
    'menu_icon' => HKM_ART_PATH. '1354772622_coupon_tag-y.png',
  ); 
register_post_type(HKM_COUPON,$args);

?>