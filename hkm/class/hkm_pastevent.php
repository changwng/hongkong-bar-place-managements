<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
if (!class_exists('hkm_pastevent')) {
    class hkm_pastevent {
        private $post_type = HKM_PASTEVENT;
        private $custom_fields;
        private $setup;
        public $result = array();
        private $config_default = array('post_type' => HKM_PASTEVENT, 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'desc', 'meta_query' => array('relation' => 'OR', array('key' => 'linkr_pe_dj', 'value' => "", 'compare' => '!='), array('key' => 'linkr_pe_sg', 'value' => "", 'compare' => '!=')));
        /*
         *
         $post = array(
         'ID'             => [ <post id> ] //Are you updating an existing post?
         'menu_order'     => [ <order> ] //If new post is a page, it sets the order in which it should appear in the tabs.
         'comment_status' => [ 'closed' | 'open' ] // 'closed' means no comments.
         'ping_status'    => [ 'closed' | 'open' ] // 'closed' means pingbacks or trackbacks turned off
         'pinged'         => [ ? ] //?
         'post_author'    => [ <user ID> ] //The user ID number of the author.
         'post_category'  => [ array(<category id>, <...>) ] //post_category no longer exists, try wp_set_post_terms() for setting a post's categories
         'post_content'   => [ <the text of the post> ] //The full text of the post.
         'post_date'      => [ Y-m-d H:i:s ] //The time post was made.
         'post_date_gmt'  => [ Y-m-d H:i:s ] //The time post was made, in GMT.
         'post_excerpt'   => [ <an excerpt> ] //For all your post excerpt needs.
         'post_name'      => [ <the name> ] // The name (slug) for your post
         'post_parent'    => [ <post ID> ] //Sets the parent of the new post.
         'post_password'  => [ ? ] //password for post?
         'post_status'    => [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] //Set the status of the new post.
         'post_title'     => [ <the title> ] //The title of your post.
         'post_type'      => [ 'post' | 'page' | 'link' | 'nav_menu_item' | custom post type ] //You may want to insert a regular post, page, link, a menu item or some custom post type
         'tags_input'     => [ '<tag>, <tag>, <...>' ] //For tags.
         'to_ping'        => [ ? ] //?
         'tax_input'      => [ array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ) ] // support for custom taxonomies.
         );
         */
        private $config_default_models = array('post_type' => HKM_PASTEVENT, 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'desc', 'meta_query' => array( array('key' => 'linkr_pe_sg', 'value' => "", 'compare' => '!=')));
        function __construct() {
            if (!defined('HKM_PASTEVENT')) {
                return false;
            }
        }

        private function getdetail($imglist) {
            //$imglist this is supposed to be an array that contains a list of post IDs of the post with the pictures.
            $img_output = array();
            foreach ($imglist as $key => $value) {
                $a = wp_get_attachment_image_src($value, 'medium');
                $b = wp_get_attachment_image_src($value, 'full');
                if (!empty($b[0]))
                    $img_output[] = array_filter(array(
                    // 'attachmentID'=>$value,
                    'mid' => $a[0], 'full' => $b[0]));
            }
            return $img_output;
        }

        public function get_photowall_list_model() {
            $dj_img = array();
            $model_img = array();
            $customer_wp_query = new WP_Query($this -> config_default_models);
            if ($customer_wp_query -> have_posts()) :
                while ($customer_wp_query -> have_posts()) : $customer_wp_query -> the_post();
                    $_id = $customer_wp_query -> post -> ID;
                    $list = get_post_meta($_id, 'linkr_pe_sg', false);
                    if (count($list) > 0) {
                        $dj_img[$_id] = $this -> getdetail($list);
                    }
                endwhile;
            endif;
            wp_reset_query();
            return $dj_img;
        }

        public function get_past_photo_album_listID_callback($callback) {
            $html = '';
            $customer_wp_query = new WP_Query($this -> config_default_models);
            if ($customer_wp_query -> have_posts()) :
                while ($customer_wp_query -> have_posts()) : $customer_wp_query -> the_post();
                    $_id = $customer_wp_query -> post -> ID;

                    if (function_exists($callback))
                        $html .= call_user_func($callback, $_id);
                endwhile;
            endif;

            return $html;
        }

    }

}
?>