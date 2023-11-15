<?php

namespace My_Plugin\Init\Classes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}


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
 * MYPLUGIN->settings->get_plugin_name();
 * 
 * HELPER COMMENT END
 */

/**
 * Class My_Plugin_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		MYPLUGIN
 * @subpackage	Classes/My_Plugin_Settings
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Settings{

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   1.0.0
	 */
	private $plugin_name;

	/**
	 * The plugin version
	 *
	 * @var		string
	 * @since   1.0.0
	 */
	private $plugin_version;

	/**
	 * Our My_Plugin_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){

		$this->plugin_name = MY_PLUGIN_NAME;
		$this->plugin_version = MY_PLUGIN_VERSION;
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
	 * @dev  MYPLUGIN()->settings->get_plugin_name();
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
	 * @dev  MYPLUGIN()->settings->get_plugin_version();
	 */
	public function get_plugin_version(){
		return apply_filters( 'My_Plugin/settings/get_plugin_versio', $this->plugin_version );
	}

}
