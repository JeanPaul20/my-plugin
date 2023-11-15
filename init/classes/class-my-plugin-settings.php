<?php

namespace My_Plugin\Init\Classes;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	die('Forbidden');
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
 * Class MYPLUGIN_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		MYPLUGIN
 * @subpackage	Classes/MYPLUGIN_Settings
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Settings
{

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
	 * Get plugin information header
	 * 
	 * @access private
	 * @return array Plugin header information
	 * @var $plugin_info
	 */
	private $plugin_info;

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
	 * Our MYPLUGIN_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{
		$this->plugin_info = Init()->get_plugin_header_info();
		$this->plugin_name = $this->plugin_info['Name'];
		$this->plugin_version = $this->plugin_info['Version'];

		$this->option_slug = $this->plugin_info['Option Slug'];
		$this->plugin_db_prefix = $this->plugin_info['DB Table Prefix'];
		$this->table_name = $this->plugin_db_prefix . '_options';
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
	public function get_plugin_name()
	{
		return apply_filters('MYPLUGIN/settings/get_plugin_name', $this->plugin_name);
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
	public function get_plugin_version()
	{
		return apply_filters('MYPLUGIN/settings/get_plugin_versio', $this->plugin_version);
	}

	/**
	 * Return the option slug used to store plugin settings options
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string The option slug used to store plugin settings options
	 * 
	 * @dev MYPLUGIN()->settings->get_option_slug();
	 */
	public function get_option_slug()
	{
		return apply_filters('MYPLUGIN/settings/get_option_slug', $this->option_slug . '_current_language');
	}

	/**
	 * Return the plugin databse table prefix
	 * 
	 * @access public
	 * @since 1.0.0 
	 * @return string the plugin databse table prefix
	 * 
	 * @dev MYPLUGIN()->settings->get_table_name();
	 */
	public function get_plugin_db_prefix()
	{
		return apply_filters('MYPLUGIN/settings/get_plugin_db_prefix', $this->plugin_db_prefix);
	}


	/**
	 * Retrieve the table name.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return string The table name.
	 * 
	 * @dev MYPLUGIN()->settings->get_table_name();
	 */
	public function get_table_name()
	{
		return apply_filters('MYPLUGIN/settings/get_table_name', $this->table_name);
	}
}
