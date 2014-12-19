<?php
/**
* Page actions used by response.
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
* response page actions
*/
add_action('response_page_section', 'response_page_section_content' );
/**
* Sets up the page content. 
*
* @since 1.0
*/
function response_page_section_content(){
    
global $ec_themename, $ec_themeslug;
    ?><div class="container">
    <div class="row">
        <div class="leftside_ads hide-on-phones">
        <?php leftside_ads_html(); ?>
        </div><!--leftside_ads end-->
    <div class="nine columns maincontentright">
    <?php 
//echo "start get_menu_ressembled";
//echo get_menu_ressembled(array(115,115,115,115,115,115,115,115,115),45,"topnavmenu",HKM_IMG_PATH."button_home_menu.png",true,false);
    ?>
    <!--<div class="fixwrapcontent bgwhite">-->
        <div class="innerwrapper">
        <?php
        reponse_justthepage_section();
        ?>
        </div>
    <!--</div>-->
    </div><!--entry end-->
    <div class="rightside_ads hide-on-phones">
       <?php 
       rightside_ads_html();
       //rightside_ads_single_column_html();?>
    </div><!--rightside_ads end-->
    </div><!--row end-->
    </div><?php
}
function reponse_justthepage_section(){
    global $ec_themename, $options, $ec_themeslug, $post, $sidebar, $content_grid;$hidetitle = get_post_meta($post->ID, $ec_themeslug.'_hide_page_title' , true); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if ($hidetitle == "on" OR $hidetitle == ''): ?>
            <h2 class="posts_title"><?php the_title(); ?></h2>
            <?php endif;?>
            <div class="entry">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
            <?php edit_post_link('Edit', '<p>', '</p>'); ?>
            </div><!--end entry-->
       <?php endwhile;
        endif; 
}

function response_page_section_content_no_in_use() {
    
	global $options, $ec_themeslug, $post, $sidebar, $content_grid;
	response_sidebar_init();
	$hidetitle = get_post_meta($post->ID, $ec_themeslug.'_hide_page_title' , true);
	?><div class="container">
<div class="row">
	<!--Begin @response before content sidebar hook-->
	<?php response_before_content_sidebar(); ?>
	<!--End @response before content sidebar hook-->
		<div id="content" class="<?php echo $content_grid; ?>">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post_container">
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php if ($hidetitle == "on" OR $hidetitle == ''): ?>
					<h2 class="posts_title"><?php the_title(); ?></h2>
						<?php endif;?>
					<div class="entry">
						<?php the_content(); ?>
					</div><!--end entry-->
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
				<?php edit_post_link('Edit', '<p>', '</p>'); ?>
				</div><!--end post-->
			<?php comments_template(); ?>
			<?php endwhile; endif; ?>
			</div><!--end post_container-->
	</div><!--end content_left-->
	<!--Begin @response after content sidebar hook-->
		<?php response_after_content_sidebar(); ?>
	<!--End @response after content sidebar hook-->
</div>
</div>
<?php
}

/**
* End
*/

?>