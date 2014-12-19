<?php
require_once 'hkm_cross_reference.php';
defined('ABSPATH') || exit ;

if (!class_exists('Coupon')) {
    class Coupon extends hkm_cross_reference {
        function __construct() {
            parent::construct();
          //  return "start 9";
        }
        public function prepareData($limit = 0) {
            $args = array('post_type' => HKM_COUPON, 'posts_per_page' => $limit, 'post_status' => 'publish');
            $dataholder = array();
            $actionquery = new WP_query($args);
            $pack = array();
           // echo wpautop('start 15');
            if ($actionquery -> have_posts()) :
                while ($actionquery -> have_posts()) : $actionquery -> the_post();
                    $dataholder[] = $this->single_coupon_loop($actionquery -> post);
                endwhile;
            else :
            //echo wpautop('Sorry, no posts were found');
            return false;
            endif;
            // Reset Post Data
            wp_reset_postdata();
            return $dataholder;
        }

        private function single_coupon_loop($post_object) {
            $_id = $post_object -> ID;
            $datalist = array();
            $feature_image_m = wp_get_attachment_image_src(get_post_thumbnail_id($_id), 'medium');
            $datalist['thumb'] = $feature_image_m[0];
            $datalist['id'] = $_id;
            $datalist['link'] = get_permalink($_id);
            $datalist['coupontitle'] = get_the_title($_id);
            $datalist['couponcode'] = get_post_meta($_id, 'linkr_coupon_code', true);
            $datalist['detail'] = get_post_meta($_id, 'linkr_coupon_detail', true);
            $datalist['cap'] = get_post_meta($_id, 'linkr_coupon_cap', true);
            $datalist['phone'] = get_post_meta($_id, 'linkr_coupon_person', true);
            $datalist['linkr_coupon_conditions'] = get_post_meta($_id, 'linkr_coupon_conditions', true);
            //the post ID for the Coupon Event aka the party ID
            $eventcode = get_post_meta($_id, 'linkr_coupon_event', true);
            $club_hardcode = get_post_meta($_id, 'linkr_coupon_eventplace', true);
            $club_hardcode_obj = array(
            'title' => parent::meta_box_get_post_title($club_hardcode, HKM_BAR), 
            'link' => parent::meta_box_get_permlink($club_hardcode, HKM_BAR),
            );
            $datalist['linkr_coupon_event'] = $eventcode;
            //using the reference from one post type and search thru a key from that post type on the second level
            //$club = ($eventcode!=-1)?hkm_cross_reference::cross_reference_2step(HKM_EVENT,$eventcode,'linkr_eventplace' ,HKM_BAR):$club_hardcode;
            if ($eventcode != -1) {
                $club = parent::cross_reference_2step(HKM_EVENT, $eventcode, 'linkr_eventplace', HKM_BAR);
            } else {
                $club = $club_hardcode_obj;
            }
            if (!$club) {
                $datalist['club_attached'] = FALSE;
                $datalist['club'] = "-N/A-";
                $datalist['clublink'] = "#";
            } else {
                $datalist['club_attached'] = TRUE;
                $datalist['club'] = $club['title'];
                $datalist['clublink'] = $club['link'];
            }
            return $datalist;
        }

    }

}
