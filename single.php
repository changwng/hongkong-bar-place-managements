<?php 
/**
* Single template used by Eclipse.for HKM LINKER
*
* Authors: Tyler Cunningham, Trent Lapinski, HESKEMO KAM
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
* {@link http://hkmdev.wordpress.com/ }
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Eclipse.
* @since 3.0
*/
global $options, $ec_themeslug, $post; // call globals
/* End variable definition. */
get_header(); 
if ($options->get($ec_themeslug.'_single_breadcrumbs') == "1"){
    response_breadcrumbs();} ?>
<!--Begin @Core post area-->
<?php response_post(); ?>
<!--End @Core post area-->
<?php get_footer(); ?>