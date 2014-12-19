<?php
//add_action( 'init', 'hkm_post_types_a');
global $meta_boxes;

$meta_boxes[] = array('pages' => array(HKM_EVENT),
//This is the id applied to the meta box
'id' => 'post_event_meta',
//This is the title that appears on the meta box container
'title' => __('PARTY EVENT 日程安排', HKM_LANGUAGE_PACK),
//This defines the part of the page where the edit screen section should be shown
'context' => 'normal',
//This sets the priority within the context where the boxes should show
'priority' => 'high',
//Here we define all the fields we want in the meta box
'fields' => array( 
array('name' => __('這是 [ec 活動推介]', HKM_LANGUAGE_PACK), 'desc' => 'This is a part of the promotion on the homepage feature section', 'id' => 'linkr_event_promotion', 'type' => 'checkbox', 'std' => '0'), 
//============
array('name' => __('活動描述 - Short Description/Promotion', HKM_LANGUAGE_PACK), 'desc' => 'Put down your short promotion sentence in one line.', 'id' => 'linkr_e_short', 'type' => 'text',  ),
//==========
array('name' => '活動描述/Long Description of the event', 'desc' => "Try not to over 300 words / 盡量不超過300個字", 'id' => "linkr_eventdetails_custom", 'type' => 'wysiwyg', 'std' => "", 'cols' => '40', 'rows' => '4', ), 
//============
array('name' => '訂座電話/phone', 'desc' => "A Hong Kong phone number with 8 digits", 'id' => "linkr_booking_number", 'type' => 'text', 'std' => "", ), 
//============
array(
'name' => __('日期', HKM_LANGUAGE_PACK),
//'desc' => __('日期', HKM_LANGUAGE_PACK),
'id' => 'linkr_eventdate', 'type' => 'date',
// Date format, default yy-mm-dd. Optional. See: http://goo.gl/po8vf
'format' => 'yy年m月d日', 'std' => ''), array(
//==========
'name' => __('時間', HKM_LANGUAGE_PACK),
// 'desc' => '',
//linkr time
'id' => 'linkr_time',
// ID for this field
'type' => 'time', 'format' => 'hh:mm', 'std' => ''), 

array('name' => __('酒吧', HKM_LANGUAGE_PACK), 'desc' => '(where is the event taking place)', 'id' => 'linkr_eventplace', 'type' => 'select', 'options' => HKM_refernx::ls_PostTitle(HKM_BAR), ),


//end fields
));
/*
 $meta_boxes[] = array('pages' => array(HKM_EVENT),
 'id' => 'post_linkr_doorprice',
 'title' => __('門票  (門票以港元顯示)', HKM_LANGUAGE_PACK),
 'context' => 'normal',
 'priority' => 'high',
 'fields' => array(
 array('name' => __('GIRLS', HKM_LANGUAGE_PACK),
 'desc' => __('女性的門票', HKM_LANGUAGE_PACK),
 'id' => 'linkr_door_price_f',
 'type' => 'text', 'std' => '100'),
 array('name' => __('GUYS', HKM_LANGUAGE_PACK),
 'desc' => __('男性的門票', HKM_LANGUAGE_PACK),
 'id' => 'linkr_door_price_m',
 'type' => 'text', 'std' => '100'),
 array('name' => __('GROUP', HKM_LANGUAGE_PACK),
 'desc' => __('團體全包', HKM_LANGUAGE_PACK),
 'id' => 'linkr_door_price_g',
 'type' => 'text', 'std' => '100'),
 ));*/
$labels = array('name' => _x('活動', 'post type general name'),
//name
'singular_name' => _x('活動', 'post type singular name'),
//single
'add_new' => _x('追加活動', HKM_LANGUAGE_PACK),
//adding new
'add_new_item' => __('追加活動', HKM_LANGUAGE_PACK),
//adding new item
'edit_item' => __('修改活動', HKM_LANGUAGE_PACK),
//edit new item
'new_item' => __('追加活動', HKM_LANGUAGE_PACK),
// with all the new items
'all_items' => __('所有活動', HKM_LANGUAGE_PACK),
//with all the travel agenda
'view_item' => __('看覽活動', HKM_LANGUAGE_PACK), 'search_items' => __('搜查活動', HKM_LANGUAGE_PACK), 'not_found' => __('沒有發現活動', HKM_LANGUAGE_PACK), 'not_found_in_trash' => __('在垃圾中沒有發現活動', HKM_LANGUAGE_PACK), 'parent_item_colon' => '-',
// -- the menu
'menu_name' => __('活動', HKM_LANGUAGE_PACK),
// -- the menu
);
$args = array('labels' => $labels,
//this is the label
'description' => __('Event Detail description.'), 'public' => true, 'publicly_queryable' => true, 'show_ui' => true, 'show_in_menu' => true, 'query_var' => true, 'rewrite' => array('slug' => _x(HKM_EVENT, 'linker-events', HKM_LANGUAGE_PACK)), 'capability_type' => 'post', 'has_archive' => true, 'hierarchical' => false, 'menu_position' => null, 'supports' => array('title', 'author', 'thumbnail'), 'menu_icon' => HKM_ART_PATH . '1346159766_audio-input-microphone.png', 'hierarchical' => false, );
register_post_type(HKM_EVENT, $args);
?>