<?php
/**
 * HKM CMS CORE MANAGEMENT INIT
 *
 * Author: HESKEYO KAM
 * Copyright: &#169; 2011
 * {@link http://hkmdev.wordpress.com/ HKM LLC}
 *
 * Released under the terms of the GNU General Public License.
 * You should have received a copy of the GNU General Public License,
 * along with this software. In the main directory, see: /licensing/
 * If not, see: {@link http://www.gnu.org/licenses/}.
 *
 * @package Core
 * @since 1.4
 */
 //plugin_dir_url HKM_refernx
spl_autoload_register(function($className) {
	$p1 = array(get_template_directory() . DIRECTORY_SEPARATOR . 'hkm/class' . DIRECTORY_SEPARATOR . $className . '.php', $className . '.php');
	//$p2 = array(plugin_dir_path(__FILE__) .DIRECTORY_SEPARATOR.'inc/classes/' .$className . '.php');
	//print_r($p2); 
	$possibilities = array_merge($p1);
	foreach ($possibilities as $file) {
		if (file_exists($file)) {
			require_once (strtolower($file));
			return true;
		}
	}
	return false;
});
global $meta_boxes;
$meta_boxes = array();
$define_pages = array(
//==========
"HOME_PG" => 164,
//==========
"EVENTS_PG" => 65,
//==========
"LINKER_EVENTS_PG" => 59,
//==========
"LOCATION_PG" => 61,
//==========
"BAR_TYPE_PG" => 63);
$define_pages_keep_editor=array("RESERVE" => 444);
$define_types = array(
//==========
"HKM_PASTEVENT" => "linkr-pastevent",
//==========
"HKM_BAR" => "linker-bar",
//==========
"HKM_EVENT" => "linker-event",
//==========
"HKM_SPONSOR" => "linker-sponsor",
//==========
"HKM_COUPON" => "linker-coupon", );
$define_interface = array(
//the prefix for some functions
"HKMBACKEND_PATH" => get_template_directory_uri() . "/hkm/function/hkmbackend/",
//===========
"DATATYPE_PREFIX" => "hkm_",
//===========
"HKM_LANGUAGE_PACK" => "hkm_data_lan_pack",
//===========
"HKM_LIBCSS" => get_template_directory_uri() . "/library/css/",
//==========
"HKM_LIBJS" => get_template_directory_uri() . "/library/js/",
//===========
"HKM_IMG_PATH" => get_template_directory_uri() . "/images/",
//===========
"HKM_ART_PATH" => get_template_directory_uri() . "/hkm/art/",
//===========
"HKM_INCLUDE_FUNCTIONS_POST_TYPE" => get_template_directory() . "/hkm/function/posttypes/",
//===========
"HKM_INCLUDE_FUNCTIONS" => get_template_directory() . "/hkm/function/", );

$load_slots = array(
//===========
"/hkm/function/widgetlogic.php",
//===========
"/hkm/function/show_id.php",
//===========
"/hkm/function/menu.php",
//===========
"/hkm/rebrand/hkmBrandEXE.php",
//===========
"/hkm/function/common_functions.php",
//===========
"/hkm/function/hkmbackend/core.php",
//===========
"/hkm/function/posttypes/taxonomy.php",
//===========
"/hkm/function/posttypes/page.php",
//===========
);
$define_constant_values = array_merge($define_pages, $define_types, $define_interface,$define_pages_keep_editor);
foreach ($define_constant_values as $constant => $value) {
	if (!defined($constant)) {
		define($constant, $value);
	}
}
unset($define_constant_values);
foreach ($define_types as $constant => $value) {
	$component = explode("-", $value);
	if (count($component) == 2) {
		require_once get_template_directory() . '/hkm/function/posttypes/tab_' . $component[1] . '.php';
	}
}
foreach ($load_slots as $k => $value) {
	require_once get_template_directory() . $value;
}
$setup_feature_images_metabox = array(
//the customizations starts here
array("type" => HKM_BAR, "label" => 'SELECT BAR COVER IMAGE', "title" => '酒吧的特徵圖像 ',
//the reminder
"html" => "<br>Album size, we recommend <strong style='color:red;'>200 x 200px</strong>."),
//HKM_EVENT
array("type" => HKM_EVENT, "label" => 'Set as the Event Poster', "title" => 'Event Poster'),
//HKM_COUPON
array("type" => HKM_COUPON, "label" => 'PRINTING IMAGE', "title" => 'Feature Image - 優惠券打印圖像', ),
//
array("type" => HKM_SPONSOR, "label" => 'PLACE A SPONSOR IMAGE', "title" => 'SPONSOR IMAGE - 贊助商', "html" => "<br>The image must be less than <strong style='color:red;'>500 x 500px</strong>. This is strongly recommend you to place a <strong style='color:red;'>200 x 100px</strong> image with <strong style='color:red;'>alpha</strong> background."),
//ends here
);
foreach ($setup_feature_images_metabox as $k => $value) {
	new hkm_feat_img_customization($value);
}
//$hkmthemeoptions = new HKM_BACKEND_AG();
$hkmbrand = new hkmBrandEXE();
$disablewy = new disable_rich_text_editor();
$disablewy -> makeDisabled(array_values($define_pages));
/**
 * Register meta boxes
 *
 * @return void
 */

function hkm_core_boottrap() {
	global $meta_boxes;
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}else{
		echo('please install hkm-meta-box and have it be active first');
	}
}

remove_action('wp_head', 'wp_generator');
add_action('admin_init', 'hkm_core_boottrap');
//install firephp
//$wpfirephppath=get_template_directory() . DIRECTORY_SEPARATOR . 'hkm/class' . DIRECTORY_SEPARATOR .'wpfirephp.php';
//require_once $wpfirephppath;
/*
 $g = new MultiPostThumbnails(array(
 'label' => 'Thumbnail Image',
 'id' => 'featured-thumb-image',
 'post_type' => array(HKM_ALBUM)
 )
 );

 https://maps.google.com.hk/maps?q=%E6%BC%86%E5%92%B8%E9%81%93%E5%8D%9753%E8%87%B355%E8%99%9F%E5%98%89%E8%8A%99%E4%B8%AD%E5%BF%83&hl=zh-TW&ie=UTF8&sll=22.352734,114.1277&sspn=0.958914,1.234589&brcurrent=3,0x3403e2eda332980f:0xf08ab3badbeac97c,0&hq=%E6%BC%86%E5%92%B8%E9%81%93%E5%8D%9753%E8%87%B355%E8%99%9F%E5%98%89%E8%8A%99%E4%B8%AD%E5%BF%83&t=m&z=10&iwloc=B
 *
 *
 */
?>