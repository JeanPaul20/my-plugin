<?php

namespace My_Plugin\Core\Includes\Classes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This class contains all of the plugin related settings.
 * Everything that is relevant data and used multiple times throughout 
 * the plugin.
 * 
 * To define the actual values, we recommend adding them as shown above
 * within the __construct() function as a class-wide variable. 
 * This variable is then used by the callable functions down below. 
 * These callable functions can be called everywhere within the plugin 
 * as followed using the get_plugin_name() as an example: 
 * 
 * My_Plugin()->settings->get_plugin_name();
 * 
 * HELPER COMMENT END
 */

 if ( ! defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}
/**
 * Class My_Plugin_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		My_Plugin
 * @subpackage	Core/Includes/Classes/My_Plugin_Settings
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Settings{


	/**
	 * Get plugin information header
	 * 
	 * @access private
	 * @return array Plugin header information
	 * @var $plugin_info
	 */
	private $plugin_info;

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   1.0.0
	 */
	private $plugin_name;

	private $plugin_version;

	/**
	 * Retrieving the plugin option_slug.
	 * 
	 * @access private
	 * @return string  $option_slug
	 * @since      1.0.0
	 */
	private $option_slug;

	/**
	 * Retrieving the plugin database table prefix.
	 * 
	 * @access private
	 * @var string $plugin_db_prefix;
	 * @since 1.0.0
	 */
	private $plugin_db_prefix;

	/**
	 * Get plugin database table name
	 * 
	 * @access private
	 * @return string $table_name;
	 * @since 1.0.0
	 */
	private $table_name;
	/**
	 * Our My_Plugin_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct($plugin_header_info){

		$this->plugin_name = My_Plugin_NAME;
	}

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * Return the plugin name
	 *
	 * @access	public
	 * @since	1.0.0
	 * @return	string The plugin name
	 * 
	 * @dev My_Plugin()->settings->get_plugin_name();
	 */
	public function get_plugin_name(){
		return apply_filters( 'My_Plugin/settings/get_plugin_name', $this->plugin_name );
	}

	/**
	 * Return the plugin version
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string The plugin version
	 * 
	 * @dev My_Plugin()->settings->get_plugin_version();
	 */
	public function get_plugin_version(){
		return apply_filters( 'My_Plugin/settings/get_plugin_versio', $this->plugin_version );
	}


}
