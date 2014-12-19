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
global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query,$content_grid;// call globals
/* Header call. */
response_sidebar_init();
get_header();

$post_type = get_post_type_object(get_post_type());
$pink_bar_display=$post_type->labels->singular_name;
$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'))==null?"":get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'));

if(is_object($post_type))
 $pink_bar_display=$post_type->labels->singular_name;

if(is_object($term))
 $pink_bar_display=$term->name;

/* End header. */

if ($options->get($ec_themeslug.'_archive_breadcrumbs') == "1") {
    response_breadcrumbs();
}

response_archive_object_main();

get_footer(); ?>