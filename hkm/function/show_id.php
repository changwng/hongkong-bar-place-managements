<?php
/*

Author: Matt Martz
Author URI: http://sivel.net
Version: 1.3.3

	Copyright (c) 2009-2010 Matt Martz (http://sivel.net)
	Simply Show IDs is released under the GNU General Public License (GPL)
	http://www.gnu.org/licenses/gpl-2.0.txt
*/

// Prepend the new column to the columns array
function ssid_column($cols) {
	$cols['ssid'] = 'ID';
	return $cols;
}

// Echo the ID for the new column
function ssid_value($column_name, $id) {
	if ($column_name == 'ssid')
		echo $id;
}

function ssid_return_value($value, $column_name, $id) {
	if ($column_name == 'ssid')
		$value = $id;
	return $value;
}

// Output CSS for width of new column
function ssid_css() {
?>
<style type="text/css">
	#ssid { width: 50px; } /* Simply Show IDs */
</style>
<?php	
}
// Actions/Filters for various tables and the css output
function ssid_add() {
	add_action('admin_head', 'ssid_css');

	add_filter('manage_posts_columns', 'ssid_column');
	add_action('manage_posts_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_pages_columns', 'ssid_column');
	add_action('manage_pages_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_media_columns', 'ssid_column');
	add_action('manage_media_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_link-manager_columns', 'ssid_column');
	add_action('manage_link_custom_column', 'ssid_value', 10, 2);

	add_action('manage_edit-link-categories_columns', 'ssid_column');
	add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);

	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'ssid_column');			
		add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
	}
	add_action('manage_users_columns', 'ssid_column');
	add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);
	add_action('manage_edit-comments_columns', 'ssid_column');
	add_action('manage_comments_custom_column', 'ssid_value', 10, 2);
}
//add_action('admin_init', 'ssid_add');
//------------------------------------------------------------------------//
//---Remove permalinks from menu------------------------------------------//
//------------------------------------------------------------------------//
function remove_permalinks_menu_item()
{
    global $submenu;
    if(!is_site_admin()) $submenu['options-general.php'][35] = '';
}
//add_action( 'admin_menu', 'remove_permalinks_menu_item' );
//------------------------------------------------------------------------//
//---Modify the From and email used when sending emails from WPMU---------//
//------------------------------------------------------------------------//
function change_wp_mail_from($from_email){
	return $from_email; //return whatever you want as email, i just like it as default.
}
add_filter( 'wp_mail_from', 'change_wp_mail_from' );
function change_wp_mail_from_name($from_name){
	global $current_site;
	return $current_site->domain;
}
add_filter( 'wp_mail_from_name', 'change_wp_mail_from_name' );
add_filter('admin_title', 'my_admin_title', 10, 2);
function my_admin_title($admin_title, $title){
    return get_bloginfo('name').' &bull; '.$title;
}

?>