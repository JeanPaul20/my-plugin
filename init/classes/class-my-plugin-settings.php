<?php

namespace My_Plugin\Init\Classes;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	die('Forbidden');
}

/**
 * Class My_Plugin_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		My_Plugin
 * @subpackage	Classes/My_Plugin_Settings
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
	 * Our My_Plugin_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{
		$this->plugin_info = Plugin()->get_plugin_header_info();
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
	 * @dev  Init()->settings->get_plugin_name();
	 */
	public function get_plugin_name()
	{
		return apply_filters('Init/settings/get_plugin_name', $this->plugin_name);
	}

	/**
	 * Return the plugin version
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string The plugin version
	 * 
	 * @dev  Init()->settings->get_plugin_version();
	 */
	public function get_plugin_version()
	{
		return apply_filters('Init/settings/get_plugin_versio', $this->plugin_version);
	}

	/**
	 * Return the option slug used to store plugin settings options
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string The option slug used to store plugin settings options
	 * 
	 * @dev Init()->settings->get_option_slug();
	 */
	public function get_option_slug()
	{
		return apply_filters('Init/settings/get_option_slug', $this->option_slug . '_current_language');
	}

	/**
	 * Return the plugin databse table prefix
	 * 
	 * @access public
	 * @since 1.0.0 
	 * @return string the plugin databse table prefix
	 * 
	 * @dev Init()->settings->get_table_name();
	 */
	public function get_plugin_db_prefix()
	{
		return apply_filters('Init/settings/get_plugin_db_prefix', $this->plugin_db_prefix);
	}


	/**
	 * Retrieve the table name.
	 * 
	 * @access public
	 * @since 1.0.0
	 * @return string The table name.
	 * 
	 * @dev Init()->settings->get_table_name();
	 */
	public function get_table_name()
	{
		return apply_filters('Init/settings/get_table_name', $this->table_name);
	}
}
