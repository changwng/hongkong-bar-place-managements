<?php
/**
 * Initializes the CyberChimps Response Core Framework
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
 * @package Response
 * @since 1.0
 */
//Define custom core functions
require_once (get_template_directory() . '/core/core-functions.php');
//Define the core hooks
require_once (get_template_directory() . '/core/core-hooks.php');
foreach (glob(TEMPLATEPATH . "/core/actions/*.php") as $filename){
  require_once $filename;
}
//Call metabox class file
require_once (get_template_directory() . '/core/metabox/meta-box-class.php');
//CyberChimps Themes Page - store theme for cyberchimps
//require_once ( get_template_directory() . '/core/classy-options/options-themes.php' );

/**
 * End
 */
?>
