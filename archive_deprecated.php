<?php 
/**
* Archive template used by Eclipse.
*
* Authors: Tyler Cunningham, Trent Lapinski
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Eclipse.
* @since 1.0
*/
	global $options, $ec_themeslug, $post, $content_grid; // call globals
/* Header call. */
response_sidebar_init();
get_header(); 
/* End header. */?>
<?php if ($options->get($ec_themeslug.'_archive_breadcrumbs') == "1") { response_breadcrumbs();}?>
<div class="container" id="result">
<div class="row">
<?php
/* Post-specific variables */   
$image = get_post_meta($post->ID, 'portfolio_image' , true);
$title = get_the_title() ;
$showat=0;
$showtoplimit=3;
$eventdata = new hkm_event();
$dataof_event = $eventdata->get_bar_data();
//print_r($dataof_event); --this is for checking
foreach ($dataof_event as $key => $value) {
        if($showat<$showtoplimit){
          ?><div class="bigevent"><?php
        }else{
          ?><div class="smallevent row"><?php
        }
            response_value_data($value);
              ?></div><?php
            $showat++;
}

if($showat<$showtoplimit){
    $adding = $showtoplimit-$showat;
    for($i = 0; $i<$adding;$i++){
         ?><div class="bigevent"><?php 
        
         ?></div><?php
    }
}
/* END */ 
?>
    </div>
</div>
</div>
<?php
//do_action('response_navarhive_result');
//navtop_html();
?>
<div class="container">
    <?php if(is_archive()){
        //$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'linkrbarfeat' ));
       //if(!is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          

            $post_type = get_post_type_object(get_post_type());
            $pink_bar_display=$post_type->labels->singular_name;
            $term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'))==null?"":get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'));
         
            if(is_object($post_type))
            $pink_bar_display=$post_type->labels->singular_name;
            
            if(is_object($term))
            $pink_bar_display=$term->name;
            
            
      // }
       // print_r(get_query_var( 'taxonomy' ));
       // get_query_var( 'term' );
       ?><div class="row"><div class="bar_name"><span><?php echo $pink_bar_display; 
       
           if(is_object($post_type)){
               $slug = $post_type->rewrite;
               if('linker-bar'==$slug['slug'])
               go_back('退回>>', esc_url(home_url('/')).'bar-types');
               
           }
          // print_r($post_type);

         // $debug=FirePHP::getInstance(true);
         // $debug->log($post_type, 'Iterators');

           ?></span></div></div>
        <?php
    }?>
	<div class="row">
	<!--Begin @response before content sidebar hook-->
		<?php response_before_content_sidebar(); ?>
	<!--End @response before content sidebar hook-->
	<div id="content" class="<?php echo $content_grid." "; if(is_archive()){echo "bardetailthumb";}else{echo "post_container";} ?>">
	<?php 
	//if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ): 
	if (have_posts()) : ?>
		<!--Begin @response before_archive hook-->
			<?php
			response_before_archive(); 
			?>
		<!--End @response before_archive hook-->
		<?php while (have_posts()) : the_post(); ?>
				<?php response_loop(); ?>
		 <?php endwhile; ?>
	 <?php else : ?>
		<h2>Nothing found</h2>
	<?php endif; ?>
		<!--Begin @response pagination hook-->
			<?php response_pagination(); ?>
		<!--End @response pagination hook-->
		<!--Begin @response after_archive hook-->
			<?php response_after_archive();    // endif;?>
			<!--End @response after_archive hook-->
		</div><!--end content_padding-->
	<!--Begin @response after content sidebar hook-->
		<?php response_after_content_sidebar(); 

		?>
	<!--End @response after content sidebar hook-->
		</div><!--end content-->
	</div><!--end row-->
		
</div><!--end container-->
<?php get_footer(); ?>