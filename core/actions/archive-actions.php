<?php
/**
* Archive actions used by response.
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response 
* @since 1.0
*/

/**
* response archive actions
*/
add_action( 'response_archive_title', 'response_archive_page_title' );

/**
* Output archive page title based on archive type. 
*
* @since 1.0
*/
function response_archive_page_title() { 
	global $post; ?>
		<?php if (is_category()) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for the &#8216;', 'response' ); ?><?php single_cat_title(); ?><?php _e( '&#8217; Category:', 'response' ); ?></h2><br />
		<?php } elseif( is_tag() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Posts Tagged &#8216;', 'response' ); ?><?php single_tag_title(); ?><?php _e( '&#8217;:', 'response' ); ?></h2><br />
		<?php } elseif (is_day()) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for', 'response' ); ?> <?php the_time('F jS, Y'); ?>:</h2><br />
		<?php } elseif (is_month()) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for', 'response' ); ?> <?php the_time('F, Y'); ?>:</h2><br />
		<?php } elseif (is_year()) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for:', 'response' ); ?> <?php the_time('Y'); ?>:</h2><br />
		<?php } elseif (is_author()) { ?>
			<h2 class="archivetitle"><?php _e( 'Author Archive:', 'response' ); ?></h2><br />
		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="archivetitle"><?php _e('Blog Archives:', 'response' ); ?></h2><br />
		<?php } 
}
function response_analysis_archive_titlebar($display=-1){
    global $post_type, $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query,$content_grid,$term;
    if(is_object($post_type)){
       $slug = $post_type->rewrite;
    }
    if(is_object($post_type))
        $pink_bar_display=$post_type->labels->singular_name;
    if(is_object($term))
        $pink_bar_display=$term->name;
    $slugname=$slug['slug'];
    if('linker-bar'==$slugname){
        if($display==0){
            //ec activity
            $tagclass="linker_bar";
        }else if($display==1){  
             $tagclass=esc_url(home_url('/')).'locations/';
        }else if($display == 2){
            $tagclass=$pink_bar_display;
        }//退回
    }else if('linker-event'==$slugname){
        if($display==0){
            //linker_bar
            $tagclass="ecdrink_activity_coming";
        }else if($display==1){
             $tagclass=esc_url(home_url('/')).'locations/';
        }else if($display == 2){
            $tagclass="";
        }//退回
    }else{
         if($display==0){
            $tagclass="";
        }else if($display==1){
            $tagclass=esc_url(home_url('/')).'locations/';
        }else if($display == 2){
            $tagclass=$pink_bar_display;
        }
    }
    return $tagclass;
}
function archive_inside_loop(){
          if (have_posts()) : 
           response_before_archive(); 
           while (have_posts()) : the_post();
           response_loop();
           endwhile; 
           else : ?>
           <h2>Nothing found</h2>
           <?php endif; 
}
function response_archive_object_main(){
global $post_type, $options, $post, $ec_themename, $pink_bar_display, $ec_themeslug, $ec_root, $wp_query,$content_grid,$term;
?><div class="container" id="result">
    <!--Begin @response before content sidebar hook-->
    <?php response_before_content_sidebar(); ?>
    <!--End @response before content sidebar hook-->
<div class="row">
        <div class="leftside_ads hide-on-phones"><?php leftside_ads_html(); ?></div><!--leftside_ads end-->
        <div class="nine columns maincontentright <?php 
        $inlineclasses = response_analysis_archive_titlebar(0)."_wrap ".((!detect_mobile())?"":"");//listing
        echo $inlineclasses ?>"><?php
//call_user_func($_function_namespace);
                        //echo "start get_menu_ressembled";
                        //echo get_menu_ressembled(array(125,125,125,125,125,125),100,"topnavmenu",HKM_IMG_PATH."button_menu.png",true,false);
                        //< echo $content_grid." "; if(is_archive()){echo "bardetailthumb";}else{echo "post_container";} 
                       ?><!--<div class="fixwrapcontent">-->
                       <div class="innerwrapper">
                        <?php if(is_archive()){ ?>
                            <?php  res_paginate_navo(); ?>
                            <div class="row <?php echo $post->ID; ?> archive active">
                            <div class="archiveTitleBar">
                            <div class="title_tab <?php echo response_analysis_archive_titlebar(0); ?>">
                                <span>
                                    <div class="font_diact"><?php echo response_analysis_archive_titlebar(2); ?></div>
                                    <div id="gridbutton" class="butt">Switch View</div>
                                </span>
                            </div>
                        <?php } ?>
                        	<div><?php archive_inside_loop(); ?></div>
                            </div><!--end row-->
                        </div><!--end innerwrapper-->
                        <?php  res_paginate_navo(); ?>
</div><!--end entry-->
    
</div><!--end row-->
<div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_lower_m');?>
    </div>
    <div class="advertisement_400 nine columns centered hide-on-phones">
    <?php echo ad_bar_400x100(); ?>
    </div>
<div class="rightside_ads hide-on-phones"><?php rightside_ads_html();//rightside_ads_single_column_html();?></div><!--rightside_ads end-->
    <!--Begin @response after content sidebar hook-->
    <?php response_after_content_sidebar(); ?>
    <!--End @response after content sidebar hook-->
</div>
<?php
}
/**
* End
*/

?>