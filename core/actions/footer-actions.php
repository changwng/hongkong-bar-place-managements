<?php
/**
* Footer actions used by response.
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
* response footer actions
*/
add_action ( 'response_footer', 'response_footer_gen' );
add_action ( 'response_secondary_footer', 'response_secondary_footer_credit' );
//add_action ( 'response_secondary_footer', 'response_secondary_footer_copyright' );
function in_sponsor_loop($objectpost){
    $_id = $objectpost -> ID;
    $linkr_ad_sq = get_post_meta($_id, 'linkr_ad_sq' , false); //a list of images ID
    if(count($linkr_ad_sq)==0){
        return;
    }else{
        $possibility=count($linkr_ad_sq);
        $possibility=rand(0,$possibility-1);
        $linkr_ad_sq=$linkr_ad_sq[$possibility];
    }
    $feature_image_m =wp_get_attachment_image_src($linkr_ad_sq,'medium');
    $feature_image_m= $feature_image_m[0];
    $link = get_post_meta($_id, 'linkr_sp_url' , true); //a list of images ID
    ?><div class="sideadsponser"><a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $feature_image_m; ?>"/></a></div><?php
}
/**
 * @param
 * @since 1.0
 * @link
 */
function response_footer_gen(){
     $args = array(
     //param
     'post_type' => HKM_SPONSOR,
     //totally shows 6 pieces of the pictures for this
     'posts_per_page' => 6,
     'post_status' => 'publish');
     $dataholder=array();
     $actionquery = new WP_query($args);
     $pack = array();
     if ($actionquery -> have_posts()) :
     while ($actionquery -> have_posts()) : $actionquery -> the_post();
        in_sponsor_loop($actionquery -> post);
     endwhile;
     else :
     //echo wpautop('Sorry, no posts were found');
     endif;
     // Reset Post Data
     wp_reset_postdata();
}
/**
* Set the footer widgetized area.
* //this is the zone of the original banner
* @since 1.0
*/
function response_footer_widgets() { 
   	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) { 
		?><div class="three columns footer-widgets">
			<h3 class="footer-widget-title"><?php _e( 'Footer Widgets', 'response' ); ?></h3>
			<p class="footer-text">To customize this widget area login to your admin account, go to Appearance, then Widgets and drag new widgets into Footer Widgets</p>
		</div>
		<div class="three columns footer-widgets">
			<h3 class="footer-widget-title"><?php _e( 'Recent Posts', 'response' ); ?></h3>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=4'); ?>
			</ul>
		</div>
		<div class="three columns footer-widgets">
			<h3 class="footer-widget-title"><?php _e( 'WordPress', 'response' ); ?></h3>
			<ul><?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="<?php 
    				echo esc_url( __('http://wordpress.org/', 'response' )); 
    		?>" target="_blank" title="<?php esc_attr_e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'response'); ?>"> <?php _e('WordPress', 'response' ); ?></a></li>
    		<?php wp_meta(); ?>
    		</ul>
		</div>
		<div class="three columns footer-widgets">
			<h3 class="footer-widget-title"><?php _e( 'Search', 'response' ); ?></h3>
			<?php get_search_form(); ?>
		</div><?php }
			echo "<div class='clear'></div> ";

}

/**
* Adds the afterfooter copyright area. 
*
* @since 1.0
*/
function response_secondary_footer_copyright() {
	global $options, $ec_themeslug; //call globals
		
	if ($options->get($ec_themeslug.'_footer_text') == "") {
		$copyright =  get_bloginfo('name');
	}
	else {
		$copyright = $options->get($ec_themeslug.'_footer_text');
	}

	echo "<div id='afterfootercopyright' class='six columns'>";
	//echo "<div class='mobilesection'><div></div><div></div></div>";
	echo "&copy; $copyright";
    echo " <a href='https://www.facebook.com/ecdrink?ref=hl'>facebook</a>";
	echo "</div>";
}

/**
* Adds the CyberChimps credit.
*
* @since 1.0
*/
function response_secondary_footer_credit() { 
	global $options, $ec_themeslug; //call globals
	$credit = $options->get($ec_themeslug.'_credit');
?><div id="credit" class="twelve columns">
   <a target="_blank" href='https://www.facebook.com/ecdrink?ref=hl'>Facebook</a> | <?php echo "&copy;".$credit; ?> | <a href='<?php echo site_url('/contact-us/'); ?>'><?php
    _e("聯繫我們",'response')
    ?></a>
   
  
</div>
<?php
}

/**
* End
*/

?>