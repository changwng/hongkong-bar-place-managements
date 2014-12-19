<?php
/**
* Header actions used by response. 
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
* @package response
* @since 1.0
*/

/***
* response header actions
*/

add_action( 'response_after_head_tag', 'response_font');
add_action( 'response_head_tag', 'response_html_attributes');
add_action( 'response_head_tag', 'response_meta_tags');
add_action( 'response_head_tag', 'response_title_tag');
add_action( 'response_head_tag', 'response_link_rel');

add_action( 'response_header_sitename', 'response_header_sitename_content');
add_action( 'response_header_site_description', 'response_header_site_description_content');
add_action( 'response_header_social_icons', 'response_header_social_icons_content');

add_action( 'response_logo_menu', 'response_logo_menu_content');
add_action( 'response_description_icons', 'response_description_icons_content');

add_action( 'response_navigation', 'response_nav');
add_action( 'response_404_content', 'response_404_content_handler' );
add_action('response_logo_for_linker', 'response_logo_for_linker_html');
add_action('response_mobileapps','mobileapps_html');

/**
* Slider actions used by the HKMDEV Response Core Framework
*
* Author: Heskeyo Kam
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0
*/

/*
* Response slider actions
*/

add_action('response_blog_slider', 'response_slider_lite_content');
add_action('response_page_slider', 'response_slider_lite_content');
add_action('response_navarhive_result', 'menu_rsilder_html');
add_action('response_menu_events_rsilder','menu_events_rsilder_html');

/**
* Establishes the theme font family.
*
* @since 1.0
*/

function response_font() {
	global $ec_themeslug, $options; //Call global variables
	$family = apply_filters( 'response_default_font_family', 'Helvetica, serif' );
	
	if ($options->get($ec_themeslug.'_font') == "" ) {
		$font = apply_filters( 'response_default_font', 'Arial' );
	}		
	else {
		$font = $options->get($ec_themeslug.'_font'); 
	} ?>
	<body style="font-family:'<?php echo ereg_replace("[^A-Za-z0-9]", " ", $font ); ?>', <?php echo $family; ?>" <?php body_class(); ?> > <?php
}

/**
* Establishes the theme HTML attributes
*
* @since 1.0
*/
function response_html_attributes() { ?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8]>
<style type="text/css">
/* css for IE 8 */
.showDisplay {
  display: block;
  display: table;
}
.hideDisplay {
  display: none;
  visibility: hidden;
}
</style>
<![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11"> <?php 
}

/**
* Establishes the theme META tags (including SEO options)
*
* @since 1.0
*/
function response_meta_tags() { ?>
<!--[if (gt IE 9)]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--<![endif]--><?php
	global $ec_themeslug, $options, $post; //Call global variables
	if(!$post) return; // in case of 404 page or something
	$title = get_post_meta($post->ID, 'seo_title' , true);
	$pagedescription = get_post_meta($post->ID, 'seo_description' , true);
	$keywords = get_post_meta($post->ID, 'seo_keywords' , true);  ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="language" content="<?php bloginfo( 'language' ); ?>" /> 
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="initial-scale=1.0, maximum-scale=3.0, width=device-width"/><?php
if ($options->get($ec_themeslug.'_home_title') != '' AND is_front_page()) { ?>
<meta name='title' content='<?php echo ($options->get($ec_themeslug.'_home_title')) ;?>'/> <?php
}
	if ($options->get($ec_themeslug.'_home_description') != '' AND is_front_page()) { ?>
<meta name='description' content='<?php echo ($options->get($ec_themeslug.'_home_description')) ;?>' /> <?php
	}
	if ($options->get($ec_themeslug.'_home_keywords') != '' AND is_front_page()) { ?>
<meta name='keywords' content=' <?php echo ($options->get($ec_themeslug.'_home_keywords')) ; ?>' /> <?php
	}
	
	if ($title != '' AND !is_front_page()) {
		echo "<meta name='title' content='$title' />";
	}
	if ($pagedescription != '' AND !is_front_page()) {
		echo "<meta name='description' content='echo $pagedescription'/>";
	}
	if ($keywords != '' AND !is_front_page()) {
		echo "<meta name='keywords' content='$keywords'/>";
	} 
}

/**
* Establishes the theme title tags.
*
* @since 1.0
*/
function response_title_tag() {
	echo '<title>'; 
	wp_title( ' - ' );
	echo '</title>';   
}

/**
* Sets the header link rel attributes
*
* @since 1.0
*/
function response_link_rel() {
	global $ec_themeslug, $options; //Call global variables
	$favicon = $options->get($ec_themeslug.'_favicon'); //Calls the favicon URL from the theme options 
 if( $options->get($ec_themeslug.'_favicon_toggle') == true ): ?>	
	<link rel="shortcut icon" href="<?php echo stripslashes($favicon['url']); ?>" type="image/x-icon" />
<?php endif; ?>
<?php if( $options->get($ec_themeslug.'_apple_touch_toggle') == true && is_array( $options->get($ec_themeslug.'_apple_touch') ) ): ?>
<!--  For apple touch icon -->
<?php $apple_icon = $options->get($ec_themeslug.'_apple_touch'); ?>
<link rel="apple-touch-icon" href="<?php echo $apple_icon['url']; ?>"/>
<?php endif; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if( $options->get($ec_themeslug.'_font') == "" ):
		$font = apply_filters( 'response_default_font', 'Arial' );
	else:
		$font = $options->get( $ec_themeslug.'_font' ); 
	endif;

if( $font == 'Actor' ||
	$font == 'Coda' ||
	$font == 'Maven Pro' ||
	$font == 'Metrophobic' ||
	$font == 'News Cycle' ||
	$font == 'Nobile' ||
	$font == 'Tenor Sans' ||
	$font == 'Quicksand' ||
	$font == 'Ubuntu') :	
?><link href='http://fonts.googleapis.com/css?family=<?php echo $font ; ?>' rel='stylesheet' type='text/css' /><?php endif;
}


/**
* Header left content (sitename or logo)
*
* @since 1.0
*/

function mobileapps_html(){
    global $ec_themeslug, $options; //Call global variables
    $android = $options->get($ec_themeslug.'_android_app_url');
    $IOS = $options->get($ec_themeslug.'_ios_app_url');
    $var_qr = $options->get($ec_themeslug.'_qrcode_url');
	$bar_id = get_post_meta(HOME_PG, 'linkrad_topb', false);
    $bar_id = $bar_id[0][0];
	$linkr_img_top_banner = get_post_meta($bar_id, 'linkr_img_top_banner', true);
	$img_url = wp_get_attachment_image_src($linkr_img_top_banner,'full');
    $android=sprintf($var_qr,urldecode($android));
    $IOS=sprintf($var_qr,urldecode($IOS));
	$var_1 = '<a id="linker_ad_top" class="hide-level2-under" href="%1$s"><img src="%2$s"/></a>';
	$var_2='<div class="mobilesection hide-level1-under">
	           <div class="installandroid"><a rel="lightbox-mobile" title="install android apps" href="%1$s">Android Download</a></div>
	           <div class="installios"><a rel="lightbox-mobile" title="install IOS apps" href="%2$s">iphone Download</a></div>
	      </div>';
	$image_top_banner=sprintf($var_1, get_permalink($bar_id),$img_url[0]);
	$mobile_banner = sprintf($var_2, $android, $IOS);
	echo ($bar_id>-1)?$image_top_banner.$mobile_banner:'';
}

function response_header_sitename_content() {
	global $ec_themeslug, $options; //Call global variables
	$logo = $options->get($ec_themeslug.'_logo'); //Calls the logo URL from the theme options
	if( $url = $options->get($ec_themeslug.'_logo_url_toggle' ) == 1 ){
		$url = $options->get($ec_themeslug.'_logo_url') != '' ? $options->get($ec_themeslug.'_logo_url') : get_home_url();
	}else{
		$url = get_home_url();
	}

if ($options->get($ec_themeslug.'_custom_logo') == '1' && $logo['url'] != '') { ?>
	<div id="logo">
		<a href="<?php echo $url; ?>/"><img src="<?php echo stripslashes($logo['url']); ?>"></a>
	</div><?php
	}else{ ?>
		<h1 class="sitename"><a href="<?php echo $url; ?>/"><?php bloginfo('name'); ?></a></h1>
		<?php
	}
}



function response_header_site_description_content() {
	global $ec_themeslug, $options; ?>
	<div id="description">
		<h1 class="description"><?php bloginfo('description'); ?>&nbsp;</h1>
	</div>
<?php
}

/**
* Description/Icons
*
* @since 1.0
*/
function response_description_icons_content() { ?>
<div id="subheader">
	<div class="container">
		<div class="row">
			<div class="five columns">
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			</div>
			<div class="seven columns">
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->
			</div>
		</div><!--end row-->
	</div>
</div>
<?php
}

/**
* Logo ONLY
*
* @since 1.0
*/
function response_logo_for_linker_html() {
    global $ec_themename;
?>
<div id="loading" style="display:none"></div>
<div id="header">
    <div class="container">
        <div class="row">   
            <div class="logo left topfixed<?php echo addClassifIE8() ?>">
                <!-- Begin @Core header sitename hook -->
                    <?php response_header_sitename(); //echo ajaxy_search_form(); ?> 
                <!-- End @Core header sitename hook -->
                <div class="fb-like-box" data-href="https://www.facebook.com/ecdrink" data-width="180" data-height="70" data-show-faces="false" data-colorscheme="dark" data-stream="false" data-header="false"></div>
            </div>  
            <div class="topfixed right<?php echo addClassifIE8() ?>">
            	<?php mobileapps_html(); ?>
            	<div class="mobilesection hide-level1-under"><span style="display:block;margin:10px;">查詢電話 : 5408 6572</span></div>
            </div>
        </div><!--end row-->
        <?php web_element_menu(); ?>
    </div>
    <div id="smallmenubar" data-mobile="<?php echo is_mobile();?>" data-native="<?php echo is_native_app();?>" class="container <?php echo is_ecdrinknative()?"hide":"nonativeecdrink"; ?>"><?php mobile_element_menu(); ?></div>
</div>
<?php
}
/**
* Logo/Menu
*
* @since 1.0
*/
function response_logo_menu_content() {
	global $ec_themename; ?>
<div id="header">
	<div class="container">
		<div class="row">	
			<div class="three columns"">
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			</div>
			<div class="nine columns">
			<div id="nav">
			<?php wp_nav_menu(array(
			'items_wrap'      => '<ul id="nav_menu" class="topnavmenu">%3$s</ul>',
			'fallback_cb' => $ec_themename.'_menu_fallback',
		    'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
			));
	    	?>
			</div>
			</div>
		</div><!--end row-->
	</div>
</div>
<?php
}

/**
* Social icons
*
* @since 1.0
*/
function response_header_social_icons_content() { 
	global $options, $ec_themeslug; //call globals
	
	$facebook		= $options->get($ec_themeslug.'_facebook');
	$hidefacebook   = $options->get($ec_themeslug.'_hide_facebook_icon');
	$twitter		= $options->get($ec_themeslug.'_twitter');;
	$hidetwitter    = $options->get($ec_themeslug.'_hide_twitter_icon');;
	$gplus		    = $options->get($ec_themeslug.'_gplus');
	$hidegplus      = $options->get($ec_themeslug.'_hide_gplus_icon');
	$flickr		    = $options->get($ec_themeslug.'_flickr');
	$hideflickr     = $options->get($ec_themeslug.'_hide_flickr');
	$pinterest		= $options->get($ec_themeslug.'_pinterest');
	$hidepinterest	= $options->get($ec_themeslug.'_hide_pinterest');
	$linkedin		= $options->get($ec_themeslug.'_linkedin');
	$hidelinkedin   = $options->get($ec_themeslug.'_hide_linkedin');
	$youtube		= $options->get($ec_themeslug.'_youtube');
	$hideyoutube    = $options->get($ec_themeslug.'_hide_youtube');
	$googlemaps		= $options->get($ec_themeslug.'_googlemaps');
	$hidegooglemaps = $options->get($ec_themeslug.'_hide_googlemaps');
	$email			= $options->get($ec_themeslug.'_email');
	$hideemail      = $options->get($ec_themeslug.'_hide_email');
	$rss			= $options->get($ec_themeslug.'_rsslink');
	$hiderss   		= $options->get($ec_themeslug.'_hide_rss_icon');
	$folder = 'default';
	
	 ?>

	<div id="social">

		<div class="icons">
	
		<?php if ($hidefacebook == '1' AND $facebook != '' OR $hidefacebook == '' AND $facebook != '' ):?>
			<a href="<?php echo $facebook ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidefacebook == '1' AND $facebook == '' OR $hidefacebook == '' AND $facebook == '' ):?>
			<a href="http://facebook.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter != '' OR $hidetwitter == '' AND $twitter != '' ):?>
			<a href="<?php echo $twitter ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter == '' OR $hidetwitter == '' AND $twitter == '' ):?>
			<a href="http://twitter.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus != ''  OR $hidegplus == '' AND $gplus != '' ):?>
			<a href="<?php echo $gplus ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus == '' OR $hidegplus == '' AND $gplus == '' ):?>
			<a href="https://plus.google.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr != '' ):?>
			<a href="<?php echo $flickr ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr == '' ):?>
			<a href="https://flickr.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest != '' ):?>
			<a href="<?php echo $pinterest ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest == '' ):?>
			<a href="https://pinterest.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin != '' ):?>
			<a href="<?php echo $linkedin ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin == '' ):?>
			<a href="http://linkedin.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube != '' ):?>
			<a href="<?php echo $youtube ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube == '' ):?>
			<a href="http://youtube.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps != ''):?>
			<a href="<?php echo $googlemaps ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps == ''):?>
			<a href="http://google.com/maps" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email != ''):?>
			<a href="mailto:<?php echo $email ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email == ''):?>
			<a href="mailto:no@way.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss != '' OR $hiderss == '' and $rss != '' ):?>
			<a href="<?php echo $rss ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss == '' OR $hiderss == '' and $rss == '' ):?>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
	
		</div><!--end icons--> 
	</div><!--end social--> <?php
}

/**
* End
*/

?>