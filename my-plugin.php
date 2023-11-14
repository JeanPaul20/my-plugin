<?php
/**
 * My Plugin
 *
 * @package       MYPLUGIN
 * @author        Jean Paul Jaspers
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   My Plugin
 * Plugin URI:    https://jeanpaulart.com/plugins/my-plugin/
 * Description:   Boilerplate
 * Version:       1.0.0
 * Author:        Jean Paul Jaspers
 * Author URI:    https://jeanpaulart.com/about/
 * Text Domain:   my-plugin
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with My Plugin. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function MYPLUGIN() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'MYPLUGIN_NAME',			'My Plugin' );

// Plugin version
define( 'MYPLUGIN_VERSION',		'1.0.0' );

// Plugin Root File
define( 'MYPLUGIN_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'MYPLUGIN_PLUGIN_BASE',	plugin_basename( MYPLUGIN_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'MYPLUGIN_PLUGIN_DIR',	plugin_dir_path( MYPLUGIN_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'MYPLUGIN_PLUGIN_URL',	plugin_dir_url( MYPLUGIN_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once MYPLUGIN_PLUGIN_DIR . 'core/class-my-plugin.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Jean Paul Jaspers
 * @since   1.0.0
 * @return  object|My_Plugin
 */
function MYPLUGIN() {
	return My_Plugin::instance();
}

MYPLUGIN();
