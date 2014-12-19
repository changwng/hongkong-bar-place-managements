<?php
/**
* HKM HESKEMO response Core Functions loading javascripts and CSS
*
* @Author: HESKEYO KAM
* @Copyright: © DEVHKM 2012
* 
* {@link http://hkmdev.wordpress.com/}
* {@link http://imusictech.com/}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response
* @since 2.0
*/
/* a faster way to sort out the path condition*/
if (!function_exists('hkm_single_type')) {
    function hkm_single_type($post_type) {
        global $post;
        if (is_single()) {
            $post_type_in = $post -> post_type;
            if ($post_type == $post_type_in) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
if (!function_exists('is_ecdrinknative')) {
function is_ecdrinknative() {
    if (is_native_app() == 'ecdrink/1.0')
        return TRUE;
    else
        return FALSE;
}
}
if (!function_exists('is_native_app')) {
function is_native_app() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $gent = explode(" ", $agent);
    $last = end($gent);
    //ecdrink/1.0
    return $last;
  // return $_SERVER['HTTP_USER_AGENT'];
}
}
/**
* Load styles.
*/ 

function eclipse_styles() {
	global $options, $ec_themeslug, $wp_styles;

	// register stylesheets
	wp_register_style( 'colorboxc', HKM_LIBCSS.'colorboxc.css' );
	wp_register_style( 'slider', HKM_LIBCSS.'slider.css');
	wp_register_style( 'foundation', HKM_LIBCSS.'foundation.css' );
	wp_register_style( 'foundation_apps', HKM_LIBCSS.'app.css', array( 'foundation' ) );
    wp_register_style( 'menu', HKM_LIBCSS.'menu.css' );
	wp_register_style( 'shortcode', HKM_LIBCSS.'shortcode.css' );
    wp_register_style( 'foundation2', HKM_LIBCSS.'listing.css' );
	wp_register_style( 'eclipse_style', HKM_LIBCSS.'style.css', array( 'foundation' ) );
	wp_register_style( 'elements', HKM_LIBCSS.'elements.css', array( 'foundation', 'eclipse_style', 'foundation2' ) );
	wp_register_style( 'pagnation', HKM_LIBCSS.'simplepagination.css', array( 'foundation' ) );
	// ie conditional stylesheet
	wp_register_style( 'eclipse_ie', HKM_LIBCSS.'ie.css' );
	//$wp_styles->add_data( 'eclipse_ie', 'conditional', 'IE' );
   
	wp_register_style( 'android', HKM_LIBCSS.'droidstyle.css');
    
	// child theme support
	wp_register_style( 'child_theme', get_stylesheet_directory_uri().'/style.css', array( 'eclipse_style' ) );
	if( is_child_theme() ) {
		wp_enqueue_style( 'child_theme' );
	}
	
	// get fonts
	if ($options->get($ec_themeslug.'_font') == "" AND $options->get($ec_themeslug.'_custom_font') == "") {
		$font = apply_filters( 'synapse_default_font', 'Arial' );
	}		
	elseif ($options->get($ec_themeslug.'_custom_font') != "" && $options->get($ec_themeslug.'_font') == 'custom') {
		$font = $options->get($ec_themeslug.'_custom_font');	
	}	
	else {
		$font = $options->get($ec_themeslug.'_font'); 
	} 
	
	// register font stylesheet
	if( $font == 'Actor' ||
		$font == 'Coda' ||
		$font == 'Maven Pro' ||
		$font == 'Metrophobic' ||
		$font == 'News Cycle' ||
		$font == 'Nobile' ||
		$font == 'Tenor Sans' ||
		$font == 'Quicksand' ||
		$font == 'Ubuntu') {
		wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family='.$font, array( 'eclipse_style' ) );
        wp_register_style( 'fonts2', 'http://fonts.googleapis.com/css?family=Fjalla+One'.$font, array( 'eclipse_style' ) ); 		
	}
	
    
  
	// enqueue stylesheets
	wp_enqueue_style( 'foundation' );
	wp_enqueue_style( 'foundation_apps' );
	wp_enqueue_style( 'shortcode' );
    wp_enqueue_style( 'menu' );
	wp_enqueue_style( 'eclipse_style' );
	wp_enqueue_style( 'elements' );
	wp_enqueue_style( 'fonts' );
    wp_enqueue_style( 'fonts2' );
    //--------------------------------
   // if(is_ie8()){
          wp_enqueue_style('eclipse_ie');
     //   echo "jijsodijf ijsoid joisj iojsdioj osijdisojfisojfiosjdfiojsiofj isojdfoisjdf o";
   // }
      
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    if(stripos($ua,'android') !== false)  // && stripos($ua,'mobile') !== false) {
      wp_enqueue_style('android');
    
    if(hkm_single_type(HKM_PASTEVENT)){
        wp_enqueue_style('colorboxc');
    }
}
add_action("admin_head", "enqueue_form_editor_style");

function enqueue_form_editor_style(){
	if(class_exists('RGForms')):
    if(RGForms::is_gravity_page()){
        //enqueing my style on gravity form pages
        wp_enqueue_style("my_style", plugins_url("my-style.css", "my-plugin"));
    }
	endif;
}

add_filter("gform_noconflict_styles", "gregister_style");
function gregister_style($styles){
    //registering my style with Gravity Forms so that it gets enqueued when running on no-conflict mode
    $styles[] = "my_style";
    return $styles;
}
add_action( 'wp_enqueue_scripts', 'eclipse_styles' );
/**
* Load jQuery and register additional scripts.
*/ 
function response_scripts() {
	global $options, $ec_themeslug;
    wp_register_script('isotope' ,HKM_LIBJS.'jquery.isotope.min.js',null,'1.5.2',true);
    wp_register_script('isotope-handler' ,HKM_LIBJS.'app.ecalbum.js',array('isotope'));
    wp_register_style("ealbum", HKM_LIBCSS.'photowall.css');
	wp_register_script('easytab' ,HKM_LIBJS.'jquery.easytabs.min.js');
	wp_register_script('single_controller' ,HKM_LIBJS.'jq.app.single.js');
    wp_register_script('coupon_page' ,HKM_LIBJS.'app.coupon.js',array('pagnation'));
    wp_register_script('montage_engine' ,HKM_LIBJS.'jquery.montage.min.js');
    wp_register_script('colorbox' ,HKM_LIBJS.'jquery.colorbox.min.js');
	wp_register_script('eventlisting',HKM_LIBJS.'jq.eventlist.js',array('isotope'));
    wp_register_script( 'pagnation', HKM_LIBJS.'jquery.simplepagination.js',array('jquery') );
    wp_register_script('loc_controller' , HKM_LIBJS.'jq.locations.js','jquery',FALSE,FALSE);
    
    $site_configuration = array(
        //this is the initation for all the ajax requests from the frontend
        'ajaxurl' => admin_url('admin-ajax.php'),
        //this is the website domain for all the applications that is built for this website
        'domainbase' => site_url(), 
        //this is the initations for all the JSON API requests
        'domainbasejson' => site_url() . "?json=", 
        //this is indications if the website is rendered in home
        'ishome' => is_home(),
        //to find this directory this is the folder for the theme directory
        'theme' => get_template_directory_uri(), 'plugin'=>plugins_url(),
        //js library
        'jbin' => HKM_LIBJS,
        //to find this directory this is the folder for the theme directory
        'bin'=>HKM_IMG_PATH,
        //get_template_directory_uri + images
        'imagebin'=>get_template_directory_uri().'/images/',
        //the website general loading content
        'loading'=>"<div class='loadingcontent'><div class='circle'></div><div class='circle1'></div></div>",
        'ismobile'=>detect_mobile(),
        'isNowMobile' =>FALSE,
        'ismobileDropMenuResponsive' =>FALSE,
        'ismobileUseResponsiveInterface' =>TRUE,
        'rslideConfiguration'=>array(
         'autoScaleSlider'=> TRUE,
         'loop' =>TRUE,
         'loopRewind' => TRUE,
         'sliderDrag'=> TRUE,
         'sliderTouch' => TRUE,
         'fullscreen'=>array(
            // fullscreen options go gere
            'enabled'=> TRUE,
            'native'=> TRUE
         ),
         'autoPlay'=>array(
                    // autoplay options go gere
            'enabled'=> TRUE,
            'pauseOnHover'=> TRUE),
            )
        );
	if(function_exists('get_browser_name')){
	     $additional = array('browser'=>array(
	        //this is the from the external plugin frame work @link http://wordpress.org/extend/plugins/php-browser-detection/
	            'vendor'=>get_browser_name(),
	            'version'=>get_browser_version(),
	            'isIE8'=>is_ie8(),
	            'info'=>php_browser_info()
	       ));
		   $site_configuration =array_merge($site_configuration,$additional);
	}
    
    
	if ( !is_admin() ) {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-tabs');
	}
	
	$path =  get_template_directory_uri() ."/core/library";
    $script_list = array(
        array('headjs',$path.'/js/head.load.min.js'),
        array('orbit' ,$path.'/js/foundation/jquery.orbit.js'),
        array('apps' ,$path.'/js/foundation/app.js'),
        array('placeholder' ,$path.'/js/foundation/jquery.placeholder.min.js'),
        array('reveal' ,$path.'/js/foundation/jquery.reveal.js'),
        array('tooltips' ,$path.'/js/foundation/jquery.tooltips.js'),
        array('modernizr' ,$path.'/js/foundation/modernizr.foundation.js'),
        array('menu' ,$path.'/js/menu.js'),
        //slim box is not working anymore.. now we use colorbox
        //array('slimbox' ,$path.'/js/jquery.slimbox.js'),
        array('plusone' ,$path.'/js/plusone.js'),
        array('mobilemenu' ,$path.'/js/mobilemenu.js'),
        array('oembed' ,$path.'/js/oembed-twitter.js'),
        array('rslider' ,$path.'/js/jquery.royalslider.js'),
        array('wheelmenu' ,HKM_LIBJS.'wheelmenu.js')
    );
    

/** embeds the script list now */
	foreach($script_list as $key=>$value){
	    wp_register_script($value[0],$value[1]);
        wp_enqueue_script($value[0]);
	}
    wp_localize_script('headjs', 'wsm_base_obj', $site_configuration);
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	if ($options->get($ec_themeslug.'_responsive_video') == '1' ) {
		wp_register_script('video' ,$path.'/js/video.js');
		wp_enqueue_script ('video');	
	}

    if ($options->get($ec_themeslug.'_responsive_video') == '1' ) {
        wp_register_script('video' ,$path.'/js/video.js');
        wp_enqueue_script ('video');    
    }
    if(hkm_single_type(HKM_PASTEVENT)){
        wp_enqueue_script('colorbox');
    }
}

add_action('wp_enqueue_scripts', 'response_scripts');	
function inlineStyleIE_displayNone_fix($invert=FALSE){
    //this will require the plugin from 
    $returnvar="";
    if(is_ie8()){
        if($invert==false){
            //is IE will hide
            $returnvar="style=\"visibility: hidden; display: none;\"";
        }else{
            //is IE will show
            $returnvar="style=\"visibility: visible; display: block;\"";
        }
    }
    echo $returnvar;
}
function inClassName_IEDisplayNone($invert=FALSE){
    $returnvar="";
    if(is_ie8()){
        if($invert==false){
            $returnvar="hideDisplay";
        }
    }else{
        if($invert==true){
            $returnvar="hideDisplay";
        }
    }
    return $returnvar;
}
function ieTab(){
    $returnvar="";
     if(is_ie8()){
        $returnvar="ieTab";
    }else{
        $returnvar="hideDisplay";
    }
    return $returnvar;
}
function addClassifIE8($connect=false){
    //this line will require plugin code from 
    if(is_ie8()){
        if($connect){
           $ie8="_ie8";
           // $ie8=" ";
        }else{
            $ie8=" ie8";
        }
    }else{
        $ie8="";
    }
    return $ie8;
}
/**
* Custom pagination.
*
* @since 1.0
*/
function response_custom_pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if($pages>1)
     {
         echo '<div class="pagination"><span>'.__( 'Page', 'core' ).' '.$paged.' of '.$pages.'</span>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'">'.__( '&laquo; First', 'response' ).'</a>';
         if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'">'.__( '&lsaquo; Previous', 'response' ).'</a>';
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'"">'.__( 'Next &rsaquo;', 'response').'</a>';
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'">'.__( 'Last &raquo;', 'response' ).'</a>';
         echo "</div>\n";
     }
}

/**
* Truncate next/previous post link text for post pagination.
*
* @since 1.0
*/
function response_shorten_linktext($linkstring,$link) {
	$characters = 33;
	$matches = preg_match('/<a.*?>(.*?)<\/a>/is',$linkstring,$matches);
	$displayedTitle = $matches[1];
	$newTitle = shorten_with_ellipsis($displayedTitle,$characters);
	return str_replace('>'.$displayedTitle.'<','>'.$newTitle.'<',$linkstring);
}

function shorten_with_ellipsis($inputstring,$characters) {
  return (strlen($inputstring) >= $characters) ? substr($inputstring,0,($characters-3)) . '...' : $inputstring;
}

add_filter('previous_post_link','response_shorten_linktext',10,2);
add_filter('next_post_link','response_shorten_linktext',10,2);

/**
* Comment function
*
* @since 1.0
*/
function response_comment($comment, $args, $depth) {
    global $ec_root;
   $GLOBALS['comment'] = $comment;
}
/**
* Breadcrumbs function
*
* @since 1.0
*/
function response_breadcrumbs() {
global $ec_root;

$delimiter = "<div class='delimiter_breadcrumbs'></div>";
$home = 'ECDRINK'; // text for the 'Home' link
$before = '<span class="current">'; // tag before the current crumb
$after = '</span>'; // tag after the current crumb

if ( !is_home() && !is_front_page() || is_paged() ) {

echo '<div class="row"><div id="crumbs" class="'.inClassName_IEDisplayNone().' twelve columns"><div class="crumbs_text">';

global $post;
$homeLink = home_url();
echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

if ( is_category() ) {
global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$thisCat = $cat_obj->term_id;
$thisCat = get_category($thisCat);
$parentCat = get_category($thisCat->parent);
if ($thisCat->parent != 0) echo(get_category_parents($parentCat, false, ' ' . $delimiter . ' '));
echo $before . 'Archive for category "' . single_cat_title('', false) . '"' . $after;

} elseif ( is_day() ) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('d') . $after;

} elseif ( is_month() ) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('F') . $after;

} elseif ( is_year() ) {
echo $before . get_the_time('Y') . $after;

} elseif ( is_single() && !is_attachment() ) {
if ( get_post_type() != 'post' ) {
$post_type = get_post_type_object(get_post_type());
$slug = $post_type->rewrite;
echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
echo $before . get_the_title() . $after;
} else {
$cat = get_the_category(); $cat = $cat[0];
echo is_wp_error( $cat_parents = get_category_parents($cat, FALSE, ' ' . $delimiter . ' ') ) ? '' : $cat_parents;
echo $before . get_the_title() . $after;
}

} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

$post_type = get_post_type_object(get_post_type());
echo $before . $post_type->labels->singular_name . $after;

} elseif ( is_attachment() ) {
$parent = get_post($post->post_parent);
$cat = get_the_category($parent->ID); $cat = $cat[0];
echo is_wp_error( $cat_parents = get_category_parents($cat, FALSE, ' ' . $delimiter . ' ') ) ? '' : $cat_parents;
echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
echo $before . get_the_title() . $after;

} elseif ( is_page() && !$post->post_parent ) {
echo $before . get_the_title() . $after;

} elseif ( is_page() && $post->post_parent ) {
$parent_id  = $post->post_parent;
$breadcrumbs = array();
while ($parent_id) {
$page = get_page($parent_id);
$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
$parent_id  = $page->post_parent;
}
$breadcrumbs = array_reverse($breadcrumbs);
foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
echo $before . get_the_title() . $after;

} elseif ( is_search() ) {
echo $before . 'Search results for "' . get_search_query() . '"' . $after;

} elseif ( is_tag() ) {
echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

} elseif ( is_author() ) {
global $author;
$userdata = get_userdata($author);
echo $before . 'Articles posted by ' . $userdata->display_name . $after;

} elseif ( is_404() ) {
echo $before . 'Error 404' . $after;
}

if ( get_query_var('paged') ) {
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
echo __('Page', 'response') . ' ' . get_query_var('paged');
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}

echo '</div></div></div>';

}
}

function response_title_tag_filter( $old_title ) {
global $options, $themeslug, $query, $post;

$blogtitle = ($options->get($themeslug.'_home_title'));
if (!is_404()) {
$title = get_post_meta($post->ID, 'seo_title' , true);
}else {
$title = '';
}

if (function_exists('is_tag') && is_tag()) { /*Title for tags */
$title_tag = get_bloginfo('name').' - Tag Archive for &quot;'.single_tag_title("", FALSE).'&quot;  ';
}
elseif( is_feed() ) {
$title_tag = '';
}
elseif (is_archive()) { /*Title for archives */
$title_tag = get_bloginfo('name').$old_title.' Archive ';
}
elseif (is_search()) { /*Title for search */
$title_tag = get_bloginfo('name').' - Search for &quot;'.get_search_query().'&quot;  ';
}
elseif (is_404()) { /*Title for 404 */
$title_tag = get_bloginfo('name').' - Not Found ';
}
elseif (is_front_page() AND !is_page() AND $blogtitle == '') { /*Title if front page is latest posts and no custom title */
$title_tag = get_bloginfo('name').' - '.get_bloginfo('description');
}
elseif (is_front_page() AND !is_page() AND $blogtitle != '') { /*Title if front page is latest posts with custom title */
$title_tag = get_bloginfo('name').' - '.$blogtitle ;
}
elseif (is_front_page() AND is_page() AND $title == '') { /*Title if front page is static page and no custom title */
$title_tag = get_bloginfo('name').' - '.get_bloginfo('description');
}
elseif (is_front_page() AND is_page() AND $title != '') { /*Title if front page is static page with custom title */
$title_tag = get_bloginfo('name').' - '.$title ;
}
elseif (is_page() AND $title == '') { /*Title if static page is static page with no custom title */
$title_tag = get_bloginfo('name').$old_title;
}
elseif (is_page() AND $title != '') { /*Title if static page is static page with custom title */
$title_tag = get_bloginfo('name').' - '.$title ;
}
elseif (is_page() AND is_front_page() AND $blogtitle == '') { /*Title if blog page with no custom title */
$title_tag = get_bloginfo('name').$old_title;
}
elseif ($blogtitle != '') { /*Title if blog page with custom title */
$title_tag = get_bloginfo('name').' - '.$blogtitle ;
}
else { /*Title if blog page without custom title */
$title_tag = get_bloginfo('name').$old_title;
}

return $title_tag;
}

add_filter( 'wp_title', 'response_title_tag_filter', 10, 3 );

/**
* End
*/
?>