<?php 
global $meta_boxes;
$meta_boxes[]= array(
	'pages'=>array(HKM_PASTEVENT),
    //This is the id applied to the meta box
    'id' => 'metapost_linkr_pastevent',
    //This is the title that appears on the meta box container
    'title' => __('The Past Event Archive / 存檔的過去活動',HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
         array(
            'name' => __('Bar Place / 哪个酒吧',HKM_LANGUAGE_PACK),
            'desc' => 'The event that was taken place in the past',
         	'id' => 'linkr_pe_place',
            'type' => 'select',
            'options' => HKM_refernx::ls_PostTitle(HKM_BAR),
        ),array(
            'name' => __('From which party in the past? / 在過去的特定方事件',HKM_LANGUAGE_PACK),
            'desc' => '(Optional)',
         	'id' => 'linkr_pe_party',
            'type' => 'select',
            'options' => HKM_refernx::ls_PostTitle_BeforePastDate(HKM_EVENT, 'linkr_eventdate'),
        ),array(
            'name' => __('Additional Comment? / 附加的註釋說明關於這一件的過去活動',HKM_LANGUAGE_PACK),
            'desc' => '(Optional)',
            'id' => 'linkr_pe_comment',
            'type' => 'textarea',
        ), 
        array(
            'name' => __('Please dump your pictures in here. Any movie stars, singers, celebraties, DJ, models, drinks... max number of pic is 100',HKM_LANGUAGE_PACK),
         	'id' => 'linkr_pe_sg',
            'type' => 'plupload_image',
            'max_file_uploads' => 100,
        )
		)
		);
  // this is the demo post type plese open a new one
  $labels = array(
    'name' => _x('過去活動', 'post type general name'),
    'singular_name' => _x('過去活動', 'post type singular name'),
    'add_new' => _x('追加過去活動', HKM_LANGUAGE_PACK),
    'add_new_item' => __('追加過去活動',HKM_LANGUAGE_PACK),
    'edit_item' => __('修改過去活動',HKM_LANGUAGE_PACK),
    'new_item' => __('追加過去活動',HKM_LANGUAGE_PACK),
    'all_items' => __('所有過去活動',HKM_LANGUAGE_PACK),
    'view_item' => __('看覽過去活動',HKM_LANGUAGE_PACK),
    'search_items' => __('搜查過去活動',HKM_LANGUAGE_PACK),
    'not_found' =>  __('沒有發現過去活動',HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('在垃圾中沒有發現過去活動',HKM_LANGUAGE_PACK), 
    'parent_item_colon' => '',
    'menu_name' => __('過去活動',HKM_LANGUAGE_PACK)
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
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'author', 'thumbnail' ),
    'menu_icon' =>  HKM_ART_PATH.'/1355154252_application_view_gallery.png',
    'hierarchical' => false,
  ); 
register_post_type(HKM_PASTEVENT,$args);


?>