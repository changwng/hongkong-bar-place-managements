<?php
$labels = array(
    'name' => _x( '地區目錄', 'taxonomy general name' ),
    'singular_name' => _x( '地區', 'taxonomy singular name' ),
    'search_items' =>  __('搜查地區',HKM_LANGUAGE_PACK),
    'all_items' => __( '所有地區',HKM_LANGUAGE_PACK),
    'parent_item' => __( '地區範疇',HKM_LANGUAGE_PACK),
    'parent_item_colon' => __( '地區範疇 :',HKM_LANGUAGE_PACK),
    'edit_item' => __( '修改地區',HKM_LANGUAGE_PACK), 
    'update_item' => __( '更新地區' ,HKM_LANGUAGE_PACK),
    'add_new_item' => __( '追加地區' ,HKM_LANGUAGE_PACK),
    'new_item_name' => __( '追加地區名稱' ,HKM_LANGUAGE_PACK),
    'menu_name' => __( '地區目錄',HKM_LANGUAGE_PACK ),
);
register_taxonomy(
"linkrarea",array(HKM_BAR),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'area' )
));
/*
$labels = array(
    'name' => _x('標籤', 'taxonomy general name'),
    'singular_name' => _x('標籤', 'taxonomy singular name'),
    'search_items' =>  __('搜查標籤',HKM_LANGUAGE_PACK),
    'all_items' => __('所有標籤',HKM_LANGUAGE_PACK),
    'parent_item' => __('標籤範疇',HKM_LANGUAGE_PACK),
    'parent_item_colon' => __('標籤範疇 :',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改標籤',HKM_LANGUAGE_PACK), 
    'update_item' => __('更新標籤' ,HKM_LANGUAGE_PACK),
    'add_new_item' => __('追加標籤' ,HKM_LANGUAGE_PACK),
    'new_item_name' => __('追加標籤名稱' ,HKM_LANGUAGE_PACK),
    'menu_name' => __('TAG',HKM_LANGUAGE_PACK),
);
register_taxonomy(
//HKM_EVENT,HKM_SPONSOR,HKM_COUPON
"linkrtag",array(HKM_BAR),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag' )
));	*/
$labels = array(
    'name' => _x('酒吧特色目錄', 'taxonomy general name'),
    //酒吧
    'singular_name' => _x('酒吧特色', 'taxonomy singular name'),
    'search_items' =>  __('搜查酒吧特色',HKM_LANGUAGE_PACK),
    'all_items' => __('所有酒吧特色',HKM_LANGUAGE_PACK),
    'parent_item' => __('酒吧特色',HKM_LANGUAGE_PACK),
    'parent_item_colon' => __('酒吧特色:',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改酒吧特色',HKM_LANGUAGE_PACK), 
    'update_item' => __('更新酒吧特色' ,HKM_LANGUAGE_PACK),
    'add_new_item' => __('追加酒吧特色' ,HKM_LANGUAGE_PACK),
    'new_item_name' => __('追加酒吧特色名稱' ,HKM_LANGUAGE_PACK),
    'menu_name' => __('酒吧特色',HKM_LANGUAGE_PACK),
);
register_taxonomy(
	"linkrbarfeat",array(HKM_BAR),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'feat' )
));	
$labels = array(
    'name' => _x('酒吧提供的酒類', 'taxonomy general name'),
    //酒吧
    'singular_name' => _x('酒類', 'taxonomy singular name'),
    'search_items' =>  __('搜查酒類',HKM_LANGUAGE_PACK),
    'all_items' => __('所有酒類',HKM_LANGUAGE_PACK),
    'parent_item' => __('酒類特色',HKM_LANGUAGE_PACK),
    'parent_item_colon' => __('酒類特色:',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改酒類',HKM_LANGUAGE_PACK), 
    'update_item' => __('更新酒類' ,HKM_LANGUAGE_PACK),
    'add_new_item' => __('追加酒類' ,HKM_LANGUAGE_PACK),
    'new_item_name' => __('追加酒類名稱' ,HKM_LANGUAGE_PACK),
    'menu_name' => __('提供的酒類',HKM_LANGUAGE_PACK),
);
register_taxonomy(
	"linkrdrinks",array(HKM_BAR),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'drinks' )
));	



?>