<?php

namespace My_Plugin\Init;

use My_Plugin\Init\Classes\{
	My_Plugin_Helpers,
	My_Plugin_Run,
	My_Plugin_Settings
};


/**
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up of all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the public static function instance()
 *    ( as e.g. self::$instance->helpers = new My_Plugin_Helpers();)
 * 4. Register the class you added to core/includes/classes 
 *     within the includes() function like so
 * 	   require_once MY_PLUGIN_URL . 'core/includes/classes/class-my-plugin-helpers.php';
 * 
 * The text domain should be passed as a string to the localization functions instead of a variable. 
 * It allows parsing tools to differentiate between text domains. 
 * Example of what not to do:
 * __( 'Translate me.' , $text_domain );
 * Eaxmple of what to do:
 * __( 'Translate me.', 'text-domain' );
 *
 */

if (!defined('ABSPATH')) {
	die('Forbidden');
}


/**
 * My_Plugin Class.
 *
 * @package		My_Plugin
 * @subpackage	init/My_Plugin
 * @since		1.0.0
 * @author		Jean Paul Jaspers
 */
final class My_Plugin_Main
{

	/**
	 * Define wpdb property in Table class
	 *
	 * @access     private
	 * @var object $wpdb WordPress database object
	 * @since      1.0.0
	 */
	private $wpdb;

	/**
	 * Retrieving the plugin main file itself.
	 * 
	 * @access     private
	 * @var object $plugin_file
	 * @since      1.0.0
	 */
	private $plugin_file = MY_PLUGIN_FILE;

	/**
	 * Retrieving the plugin main file name.
	 *
	 * @access private
	 * @var string $plugin_file_name = 'my-plugin'
	 * @since 1.0.0
	 */
	private $plugin_file_name = basename(MY_PLUGIN_FILE, '.php');

	/**
	 * Initialize the plugin header information.
	 * 
	 * @access     private
	 * @var object $plugin_data = array()
	 * @since 1.0.0
	 */
	private $plugin_data;

	/**
	 * The real instance
	 *
	 * @access	private
	 * @since	1.0.0
	 * @var		object|My_Plugin
	 */
	private static $instance;

	/**
	 * My_Plugin helpers object.
	 *
	 * @access	public
	 * @since	1.0.0
	 * @var		object|My_Plugin_Helpers
	 */
	public $helpers;

	/**
	 * My_Plugin settings object.
	 *
	 * @access	public
	 * @since	1.0.0
	 * @var		object|My_Plugin_Settings
	 */
	public $settings;
	public $plugin;

	/**
	 * Throw error on object clone.
	 *
	 * Cloning instances of the class is forbidden.
	 *
	 * @access	public
	 * @since	1.0.0
	 * @return	void
	 */
	public function __clone()
	{
		_doing_it_wrong(__FUNCTION__, __('You are not allowed to clone this class.', 'my-plugin'), '1.0.0');
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access	public
	 * @since	1.0.0
	 * @return	void
	 */
	public function __wakeup()
	{
		_doing_it_wrong(__FUNCTION__, __('You are not allowed to unserialize this class.', 'my-plugin'), '1.0.0');
	}


	/**
	 * Main My_Plugin Instance.
	 *
	 * Insures that only one instance of My_Plugin exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @access		public
	 * @since		1.0.0
	 * @static
	 * @return		object|My_Plugin	The one true My_Plugin
	 */
	public static function instance()
	{
		if (!isset(self::$instance) && !(self::$instance instanceof My_Plugin_Main)) {
			self::$instance	= new My_Plugin_Main;
			self::$instance->get_plugin_header_info();
			self::$instance->base_hooks();
			self::$instance->helpers = new My_Plugin_Helpers();
			self::$instance->settings = new My_Plugin_Settings();

			//Fire the plugin logic
			new My_Plugin_Run();

			/**
			 * Fire a custom action to allow dependencies
			 * after the successful plugin setup
			 */
			do_action('My_Plugin/plugin_loaded');
		}

		return self::$instance;
	}

	/**
	 * Add base hooks for the core functionality
	 *
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function base_hooks()
	{
		add_action('plugins_loaded', array(self::$instance, 'load_textdomain'));
	}

	/**
	 * Loads the plugin language files.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain('my-plugin', FALSE, dirname(plugin_basename(MY_PLUGIN_FILE)) . '/languages/');
	}

	public function get_plugin_header_info()
	{
		self::$instance->wpdb = $GLOBALS['wpdb'];
		$this->plugin_data = get_plugin_data($this->plugin_file);
		// Accessing plugin information
		$plugin_name = $this->plugin_data['Name'];
		$plugin_version = $this->plugin_data['Version'];
		$plugin_author = $this->plugin_data['Author'];
		$plugin_description = $this->plugin_data['Description'];
		$text_domain = $this->plugin_data['TextDomain'];
		$plugin_db_prefix = $this->wpdb->prefix . str_replace("-", "_", $this->plugin_file_name);
		$plugin_option_slug = str_replace("-", "_", $this->plugin_file_name);

		// Return the plugin header info as an array or use it as needed
		return array(
			'Name' => $plugin_name,
			'Version' => $plugin_version,
			'Author' => $plugin_author,
			'Description' => $plugin_description,
			'Text Domain' => $text_domain,
			'Plugin DB Prefix' => $plugin_db_prefix,
			'Option Slug' => $plugin_option_slug,
		);
	}
}
