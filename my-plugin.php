<?php

/**
 * My Plugin
 *
 * @package       My_Plugin
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

namespace My_Plugin;

if (!defined('ABSPATH')) {
	die('Forbidden');
}

function setup_constants(): void {
    if ( ! defined( 'MY_PLUGIN_NAME' ) ) {
		define('MY_PLUGIN_NAME', 'my-plugin');
    }

    if ( ! defined( 'MY_PLUGIN_VERSION' ) ) {
        define('MY_PLUGIN_VERSION', '1.0.0');
    }

    if ( ! defined( 'MY_PLUGIN_FILE' ) ) {
        define('MY_PLUGIN_FILE',	__FILE__);
    }

    if ( ! defined( '' ) ) {
		define('MY_PLUGIN_BASE',	plugin_basename(MY_PLUGIN_FILE));
    }

	if ( ! defined( 'MY_PLUGIN_DIR' ) ) {
		define('MY_PLUGIN_DIR',	plugin_dir_path(MY_PLUGIN_FILE));
	}

	if ( ! defined( 'MY_PLUGIN_URL' ) ) {
		define('MY_PLUGIN_URL',	plugin_dir_url(MY_PLUGIN_FILE));
	}
}

function init_plugin(): void {
    // Composer autoload
    require_once plugin_dir_path(__FILE__) . 'autoloader.php';

    // Setup plugin constants
    setup_constants();

    // Instantiate the `Plugin` object
    $plugin = new My_Plugin_Main();

    // Initialize the plugin
    $plugin->init();
}