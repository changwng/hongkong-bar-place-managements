<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
/*=======================================================================
 * multipleExplode HKM HESKEMO MOD. DEVELOPMENT
 *=======================================================================*/
if (!function_exists('multipleExplode')) :
    function multipleExplode($delimiters = array(), $string = '') {
        $mainDelim = $delimiters[count($delimiters) - 1];
        // dernier
        array_pop($delimiters);
        foreach ($delimiters as $delimiter) {
            $string = str_replace($delimiter, $mainDelim, $string);
        }
        $result = explode($mainDelim, $string);
        return $result;
    }

endif;
if (!class_exists('hkm_event.php')) {
    class hkm_event {
        private $post_type;
        private $custom_fields;
        private $setup;
		private $is_past_event=FALSE;
        public $result = array();
        function __construct() {
            //please call up the post type for this custom field
            $this -> post_reference_type = HKM_BAR;
            $this -> post_type = HKM_EVENT;
            $this -> custom_fields = array(
            //please list up all custom fields for this custom post type
            'linkr_eventdetails_custom', 'linkr_eventdate',
            //barlink
            'linkr_eventplace', 'linkr_time', 'linkr_event_promotion'
            //
            );
        }

        private function chinese_time_past_event($str = "2013年1月8日") {
            //given this time stamp - 2013年1月8日
            $timedate = multipleExplode(array("年", "月", "日"), $str);
            //the result will be
            //Array ( [0] => 2013 [1] => 1 [2] => 8 [3] => )
            $timedate = $timedate[0] . "-" . $timedate[1] . "-" . $timedate[2];
            $datetime1 = new DateTime("now");
            $datetime2 = new DateTime($timedate);
            
            //what is going on now here
            if ($datetime1 == $datetime2) {
                return 0;
            } else if ($datetime1 < $datetime2) {
                //what is going on the coming event
                return 1;
            } else if ($datetime1 > $datetime2) {
                //what has been happened in the past.
                return 2;
            }
            return FALSE;
        }

        private function single_event_loop($postobj) {
            $_id = $postobj -> ID;
            //getting the thumnail file url for this post
            $full = wp_get_attachment_image_src(get_post_thumbnail_id($_id), 'full');
            $full = $full[0];
            $large = wp_get_attachment_image_src(get_post_thumbnail_id($_id), 'large');
            $large = $large[0];
            $medium = wp_get_attachment_image_src(get_post_thumbnail_id($_id), 'medium');
            $medium = $medium[0];
            $small = wp_get_attachment_image_src(get_post_thumbnail_id($_id), 'small');
            $small = $small[0];
            $otherlist = $this -> get_all_other_custom_fields($_id);
            $permlink = get_permalink($_id);
            $eventtheme = get_the_title($_id);
            
            $tmparray = array('title' => $eventtheme, 'plink' => $permlink, 'full' => $full, 'large' => $large, 'mid' => $medium, 'small' => $small, 'listval' => $otherlist);
            return $tmparray;
        }

        private function get_data($args = array()) {
            $actionquery = new WP_query($args);
            $pack = array();
            if ($actionquery -> have_posts()) :
                while ($actionquery -> have_posts()) : $actionquery -> the_post();
                    $pack[] = $this->single_event_loop($actionquery -> post);
                endwhile;
            else :
            //echo wpautop('Sorry, no posts were found');
            endif;
            // Reset Post Data
            wp_reset_postdata();
            return $pack;
        }

        private function get_all_other_custom_fields($id) {
            $newarray = array();
            foreach ($this -> custom_fields as $custom_field_id) {
                $tmp = get_post_meta($id, $custom_field_id, true);
                if ($custom_field_id == 'linkr_eventplace' && $tmp > -1) {
                    $newarray['barlink'] = hkm_cross_reference::meta_box_get_permlink($tmp, $this -> post_reference_type);
                    $tmp = hkm_cross_reference::meta_box_get_post_title($tmp, $this -> post_reference_type);
                }
                if($custom_field_id == 'linkr_eventdate' && $tmp > -1) {
                    $newarray['order_time_event']=$this->chinese_time_past_event($tmp);
                }
                $newarray[$custom_field_id] = $tmp;
            }
            return $newarray;
        }

        public function show_barevents($limit = 10, $ecpromotion = false) {
            if (is_bool($ecpromotion)){
            	$ec = ($ecpromotion==TRUE) ? "1" : "0";
				$meta_q = array('key' => 'linkr_event_promotion', 'value' => $ec);
            }else if(is_string($ecpromotion)){
            	$ec = ($ecpromotion=='past') ? "1" : "0";
				//TODO fix this
				$meta_q = array('key' => 'linkr_event_promotion', 'value' => $ec);
            }
			$meta = array( 'meta_query' => array($meta_q));
            $query = array('post_type' => $this -> post_type, 'posts_per_page' => $limit, 'post_status' => 'publish');
			$query=array_merge($meta,$query);
            return $this -> get_data($query);
        }
		public function show_all_events(){
			$query = array('post_type' => $this -> post_type, 'posts_per_page' => -1, 'post_status' => 'publish');
			$actionquery = new WP_query($query);
            $pack = array();
            if ($actionquery -> have_posts()) :
                while ($actionquery -> have_posts()) : $actionquery -> the_post();
                    $pack[] = $this->single_event_loop($actionquery -> post);
                endwhile;
            else :
            //echo wpautop('Sorry, no posts were found');
            endif;
            // Reset Post Data
            wp_reset_postdata();
            return $pack;
		}
        public function ShowDisBarEvents($post_obj) {
			$meta_q = array('key' => 'linkr_eventplace', 'value' => $post_obj -> ID );
			$meta = array( 'meta_query' => array($meta_q));
            $query = array('post_type' => $this -> post_type, 'posts_per_page' => 50, 'post_status' => 'publish');
			$query=array_merge($meta,$query);
            return $this -> get_data($query);
        }

    }

}
?>