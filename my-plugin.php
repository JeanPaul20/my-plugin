<?php

/**
 * My Plugin
 *
 * @package       My_Plugin
 * @author        JPE Jaspers
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   My Plugin
 * Plugin URI:    https://jeanpaulart.com/plugins/my-plugin/
 * Description:   Boilerplate
 * Version:       1.0.0
 * Author:        JPE Jaspers
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


function setup_constants(): void
{
  if (!defined('MY_PLUGIN_NAME')) {
    define('MY_PLUGIN_NAME', 'my-plugin');
  }

  if (!defined('MY_PLUGIN_VERSION')) {
    define('MY_PLUGIN_VERSION', '1.0.0');
  }

  if (!defined('MY_PLUGIN_FILE')) {
    define('MY_PLUGIN_FILE',  __FILE__);
  }

  if (!defined('')) {
    define('MY_PLUGIN_BASE',  plugin_basename(MY_PLUGIN_FILE));
  }

  if (!defined('MY_PLUGIN_DIR')) {
    define('MY_PLUGIN_DIR',  plugin_dir_path(MY_PLUGIN_FILE));
  }

  if (!defined('MY_PLUGIN_URL')) {
    define('MY_PLUGIN_URL',  plugin_dir_url(MY_PLUGIN_FILE));
  }
}

function activate_plugin(): void
{
  add_option('my_plugin_activated', true);
  Init\My_Plugin_Activator::activate();
}

function is_activated(): bool
{
  $just_activated = is_admin() && get_option('my_plugin_activated');

  if ($just_activated) {
    delete_option('my_plugin_activated');

    return true;
  }

  return false;
}

function deactivate_plugin(): void
{
  delete_option('my_plugin_activated');
  Init\My_Plugin_Deactivator::deactivate();
}

function init_plugin()
{

  require_once( plugin_dir_path(__FILE__) . '/lib/autoload.php');

  // Setup plugin constants
  setup_constants();

  // Instantiate the `Plugin` object
  $plugin = new Init\My_Plugin_Main();

  if (is_activated()) {
    // Mark the plugin as activated
    $plugin->mark_as_activated();
  }

  // Initialize the plugin
  $plugin->instance();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate_plugin' );
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\\deactivate_plugin');