<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
if (!class_exists('frontend_hkm_bar')) {
	class frontend_hkm_bar {
		private $post_type;
		private $custom_fields=array(
            'linkr_address',
            'linkr_phone',
            'linkr_foneprs','linkr_biz_hour','linkr_cap',
            'linkr_promote',
            'linkr_detail',
            'linkr_sliders_bar',
            'linkr_yt_url',
            'linkr_promotion',
            'linkr_promote_new',
            'linkr_img_mb',
            'linkr_stort_story',
            );
        private $shortlist= array(
          'linkr_address','linkr_phone','linkr_stort_story','linkr_img_mb','coordinations'
        );
		private $setup;
        private $full_detail;
		public $result=array();
		function __construct() {
		    $this ->full_detail=FALSE;
			$this ->post_type = HKM_BAR;
			//return $this->get_bar_data();
		}
        public function prepare_map_data(){
            return $this->get_bar_data();
        }
		/*
		 * 
		 * QUERY IS OPERATING ON THE SINGLE POST LEVEL
		 * 
		 */
		private function finish_the_list_with_all_other_custom_fields($id) {
			$newarray=array();
            $newarray['barname']=is_null($this->barname)?"":$this->barname;
			$newarray['feature_image']=is_null($this->feature_image)?"":$this->feature_image;
            //$this->feature_image = wp_get_attachment_image_src(get_post_thumbnail_id($_id),'full');
            //$this->feature_image = $this->feature_image[0];
			//$newarray['youtube_id']=is_null($this->feature_image)?"":$this->feature_image;
            $newarray['barid']=$id;
			$newarray['permlink']=$this->permlink;
			$terms = get_the_terms($id, 'linkrarea');
            if ( $terms && ! is_wp_error( $terms ) ) : 
                foreach ($terms as $term ) {
                $option = $term->slug;
                $newarray['area']=$option;
                }
            endif;
			//$newarray['coordinations']=empty($this->coordinations)||is_null($this->coordinations)?"":$this->coordinations;
           
            if($this->full_detail==TRUE){
                $k_list=$this -> custom_fields;
            }else{
                $k_list=$this -> shortlist;
            }
            foreach($k_list as $custom_field_id){
					$field = get_post_meta($id, $custom_field_id, TRUE);
                    if($custom_field_id=='coordinations'){
                        $field=empty($this->coordinations)||is_null($this->coordinations)?"":$this->coordinations;
                    }
					if($custom_field_id=='linkr_yt_url'){
						$my_array_of_vars = array();
						$my_array_of_vars = parse_str(parse_url($field, PHP_URL_QUERY), $my_array_of_vars);
						$field= $my_array_of_vars['v'];
					}
                    if($custom_field_id=='linkr_img_mb'){
                        //because this is going to be only one pictures or image
                      //  $field = get_post_meta($id, $custom_field_id, TRUE);
                        $my_array_of_vars = wp_get_attachment_image_src($field,'full');
                        //print_r($my_array_of_vars);
                        $field= $my_array_of_vars[0];
                       
                    }
					$newarray[$custom_field_id]=$field;
            }
            
			$this->result[]=$newarray;
		}

        public function get_checked_posts_with_image($customfield,$limit=10){
            return $this -> get_post_image_data(
            array('post_type' => $this -> post_type,
            'posts_per_page' => $limit,
            'post_status' => 'publish',
            'meta_query' => array( 
            array(
                'key' => $customfield,
                'value' => "1",
            )
            )));
        }
        public function get_coordinator($post_obj){
            $_id = $post_obj -> ID;
            // get google map URL
            parse_str(parse_url(get_post_meta($_id, 'linkr_google_url', true), PHP_URL_QUERY), $url_break_down);
            if (!empty($url_break_down['ll'])){
                        $tmp_coordin = explode(",", $url_break_down['ll']);
                        $post_coordinator = array("lng"=>$tmp_coordin[0], "lat"=>$tmp_coordin[1]);
                    }else if (!empty($url_break_down['sll'])){
                        $tmp_coordin = explode(",", $url_break_down['sll']);
                        $post_coordinator = array("lng"=>$tmp_coordin[0], "lat"=>$tmp_coordin[1]);
                    }else if (!empty($url_break_down['lls'])){
                        $tmp_coordin = explode(",", $url_break_down['lls']);
                        $post_coordinator = array("lng"=>$tmp_coordin[0], "lat"=>$tmp_coordin[1]);
                        return $post_coordinator;
            }else{
               return array("lng"=>0, "lat"=>0);
            }
            
        }
        private function get_post_image_data($args = array()){
            $actionquery = new WP_query($args);
            $pack = array();
            if ($actionquery -> have_posts()) :
                while ($actionquery -> have_posts()) : $actionquery -> the_post();
                        $_id = $actionquery -> post -> ID;
                        $feature_image_full = wp_get_attachment_image_src(get_post_thumbnail_id($_id),'full');
                        $feature_image_full = $feature_image_full[0];
                        $feature_image_mid = wp_get_attachment_image_src(get_post_thumbnail_id($_id),'medium');
                        $feature_image_mid = $feature_image_mid[0];
                        $permlink = get_permalink();
                        $barname=get_the_title();
                        $pack[] = array($barname,$permlink,$feature_image_full,$feature_image_mid);
                endwhile;
            else :
            //echo wpautop('Sorry, no posts were found');
            endif;
            // Reset Post Data
            wp_reset_postdata();
            return $pack;
        }
		/*
		 * 
		 * QUERY IS OPERATING ON THE POST TYPE LEVEL
		 * 
		 */
		private function bar_data($args = array()) {
			$actionquery = new WP_query($args);
			$pack = array();
			if ($actionquery -> have_posts()) :
				while ($actionquery -> have_posts()) : $actionquery -> the_post();
					$_id = $actionquery -> post -> ID;
                    $this->coordinations = $this->get_coordinator($actionquery -> post);
						//getting the thumnail file url for this post
						$this->feature_image = wp_get_attachment_image_src(get_post_thumbnail_id($_id),'small');
						$this->feature_image = $this->feature_image[0];
                        $this->permlink = get_permalink();
                        //barname
                        $this->barname=get_the_title();
						//any other custom fields will be using this functions
						$this->finish_the_list_with_all_other_custom_fields($_id);
				endwhile;
			else :
			//echo wpautop('Sorry, no posts were found');
			endif;
			// Reset Post Data
			wp_reset_postdata();
		}
		public function get_bar_achived_loop($postobj){
		    $_id = $postobj -> ID;
            
            $co = $this->get_coordinator($actionquery -> post);
            $co1=wp_get_attachment_image_src(get_post_thumbnail_id($_id),'small');
            $co1=$co1[0];
            $out=array(
            'linkr_stort_story'=>get_post_meta($_id, 'linkr_stort_story', true),
            'image'=>$co1,
            'perm'=>get_permalink(),
            'co'=>$co
            );
            return $out;
		}
		public function get_bar_data_custom($args){
			$this -> result = array();
			$result = $this -> bar_data($args);
			return $this->result;
		}
		
		public function get_bar_data() {
			$this -> bar_data(
			//
			array('post_type' => $this -> post_type,
			//
			'posts_per_page' => -1,
			//
			'post_status' => 'publish'));
            return $this->result;
		}

	}

}
?>