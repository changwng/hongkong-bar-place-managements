<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @usage: please read document at project homepage and meta-box-usage.php file
 * @version: 3.0.1
 */

/********************* BEGIN DEFINITION OF META BOXES ***********************/

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global $ec_themename, $ec_themeslug, $ec_themenamefull, $options;
	// call globals.

	// Call taxonomies for select options

	$terms2 = get_terms('category', 'hide_empty=0');
	$blogoptions = array();
	$blogoptions['all'] = "All";
	foreach ($terms2 as $term) {
		$blogoptions[$term -> slug] = $term -> name;
	}

	// End taxonomy call
	$page_element = array(
	// response_page_section() -- call  this function.. .
	'page_section' => 'Page',
	//Breadcrumbs function      response_breadcrumbs()
	'breadcrumbs' => 'Breadcrumbs',
	//response_page_slider function()
	'page_slider' => 'Static Advertisement Slider - Orbit',
	//Static Event Photos
	'portfolio_element' => 'Static Event Photos',
	//Recent Posts
	'recent_posts_element' => 'Recent Posts',
	//Twitter Bar
	'twitterbar_section' => 'Twitter Bar',
	//hkm developed elements Past Events
	'eventlisting_element' => 'Events - Event For Parties',
	//Upcoming Events
	//'upcoming_events_element' => 'Upcoming Events - Event Party',
	//Google Map - Bar & Events
	'menubingmap' => 'Bing Map + Menu',
	//Bing Map - Bar & Events
	'bingmapapi_element' => 'Bing Map - Bar & Events',
	'locations_listing' =>'Bar Location Listing',
	//Photowall
	'photowall_element' => 'Photowall for the past events',
	//BAR TYPE
	'bartype'=>'Bar Types in the List',
	//THE CIRCLE MENU
	'circlemenu'=>'the circle menu for the places',
	'homepage'=>'home page part',
	'menu_events_rsilder'=>'Top Events Slider',
	'couponpage'=>'coupon index page',
	'navtop' => 'linker design top menu',
    'twobytwo_ad'=>"2 x 2 advertisement"
    );
	$meta_boxes = array();
	$mb = new Response_Metabox('pages', $ec_themenamefull . ' Page Options', array('pages' => array('page')));
    
	$mb 
	-> tab("Page Options") -> image_select($ec_themeslug . '_page_sidebar', 'Select Page Layout', '', array('options' => array(
	//========
	TEMPLATE_URL . '/images/options/right.png',
	//========
	TEMPLATE_URL . '/images/options/left.png',
	//========
	TEMPLATE_URL . '/images/options/rightleft.png',
	//========
	TEMPLATE_URL . '/images/options/tworight.png', TEMPLATE_URL . '/images/options/none.png'))) 
	//========
	-> checkbox($ec_themeslug . '_hide_page_title', 'Page Title', 'The title of page') 
	-> section_order($ec_themeslug . '_page_section_order', 'Page Elements', '', array('options' => $page_element, 'std' => 'page_section, breadcrumbs'))
	 -> pagehelp('', 'Need Help?', '')
	 //========
/*	 -> tab($ec_themenamefull." Static Advertisement Slider")
	 //========

	 ->single_image($ec_themeslug.'_page_slide_1_image', 'Slide 1 Image', '', array('std' =>  TEMPLATE_URL . '/images/sliderdefault.jpg'))
	 ->text($ec_themeslug.'_page_slide_1_url', 'Slide 1 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_2_image', 'Slide 2 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide2.jpg'))
	 ->text($ec_themeslug.'_page_slide_2_url', 'Slide 2 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_3_image', 'Slide 3 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_3_url', 'Slide 3 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_4_image', 'Slide 4 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_4_url', 'Slide 4 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_5_image', 'Slide 5 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_5_url', 'Slide 5 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_6_image', 'Slide 6 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_6_url', 'Slide 6 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_7_image', 'Slide 7 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_7_url', 'Slide 7 Link', '', array('std' => 'http://linker.imusictech.com'))
	 ->single_image($ec_themeslug.'_page_slide_8_image', 'Slide 8 Image', '', array('std' =>  TEMPLATE_URL . '/images/slide3.jpg'))
	 ->text($ec_themeslug.'_page_slide_8_url', 'Slide 8 Link', '', array('std' => 'http://linker.imusictech.com'))
*/
	 ->tab("Recent Posts")
	->checkbox($ec_themeslug.'_recent_posts_title_toggle', 'Title', '')
	 ->text($ec_themeslug.'_recent_posts_title', '', '')
	 ->select($ec_themeslug.'_recent_posts_category', 'Post Category', '', array('options' => $blogoptions, 'all') )
	 ->checkbox($ec_themeslug.'_recent_posts_images_toggle', 'Images', '')
	
	
	->tab("Static Photos")
	 ->single_image($ec_themeslug.'_page_portfolio_image_one', 'First Portfolio Image', '', array('std' =>  TEMPLATE_URL . '/images/portfolio.jpg'))
	 ->text($ec_themeslug.'_page_portfolio_image_one_caption', 'First Portfolio Image Caption', '', array('std' => 'Image 1'))
	 ->single_image($ec_themeslug.'_page_portfolio_image_two', 'Second Portfolio Image', '', array('std' =>  TEMPLATE_URL . '/images/portfolio.jpg'))
	 ->text($ec_themeslug.'_page_portfolio_image_two_caption', 'Second Portfolio Image Caption', '', array('std' => 'Image 2'))
	 ->single_image($ec_themeslug.'_page_portfolio_image_three', 'Third Portfolio Image', '', array('std' =>  TEMPLATE_URL . '/images/portfolio.jpg'))
	 ->text($ec_themeslug.'_page_portfolio_image_three_caption', 'Third Portfolio Image Caption', '', array('std' => 'Image 3'))
	 ->single_image($ec_themeslug.'_page_portfolio_image_four', 'Fourth Portfolio Image', '', array('std' =>  TEMPLATE_URL . '/images/portfolio.jpg'))
	 ->text($ec_themeslug.'_page_portfolio_image_four_caption', 'Fourth Portfolio Image Caption', '', array('std' => 'Image 4'))

	 ->checkbox($ec_themeslug.'_portfolio_title_toggle', 'Portfolio Title', '')
	 ->text($ec_themeslug.'_portfolio_title', 'Title', '', array('std' => 'Portfolio'))

	 ->tab("Twitter Options")
	 ->text($ec_themeslug.'_twitter_handle', 'Twitter Handle', '')
	 ->checkbox('twitter_reply', 'Show @ Replies', '')

	 ->tab("SEO Options")
	 ->text($ec_themeslug.'_seo_title', 'SEO Title', '')
	 ->textarea($ec_themeslug.'_seo_description', 'SEO Description', '')
	 ->textarea($ec_themeslug.'_seo_keywords', 'SEO Keywords', '')
	 ->pagehelp('', 'Need help?', '')

	-> end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
