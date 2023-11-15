<?php

namespace My_Plugin\Includes\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}

/**
 * HELPER COMMENT START
 * 
 * This class is used to bring your plugin to life. 
 * All the other registered classed bring features which are
 * controlled and managed by this class.
 * 
 * Within the add_hooks() function, you can register all of 
 * your WordPress related actions and filters as followed:
 * 
 * add_action( 'my_action_hook_to_call', array( $this, 'the_action_hook_callback', 10, 1 ) );
 * or
 * add_filter( 'my_filter_hook_to_call', array( $this, 'the_filter_hook_callback', 10, 1 ) );
 * or
 * add_shortcode( 'my_shortcode_tag', array( $this, 'the_shortcode_callback', 10 ) );
 * 
 * Once added, you can create the callback function, within this class, as followed: 
 * 
 * public function the_action_hook_callback( $some_variable ){}
 * or
 * public function the_filter_hook_callback( $some_variable ){}
 * or
 * public function the_shortcode_callback( $attributes = array(), $content = '' ){}
 * 
 * 
 * HELPER COMMENT END
 */


/**
 * Class My_Plugin_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		My_Plugin
 * @subpackage	Core/Includes/Classes/My_Plugin_Run
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Run{

	/**
	 * Our My_Plugin_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	
		add_action( 'plugin_action_links_' . MY_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts_and_styles' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_public_scripts_and_styles' ), 20 );
	
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	* Adds action links to the plugin list table
	*
	* @access	public
	* @since	1.0.0
	*
	* @param	array	$links An array of plugin action links.
	*
	* @return	array	An array of plugin action links.
	*/
	public function add_plugin_action_link( $links ) {

		$links['our_shop'] = sprintf( '<a href="%s" title="Custom Link" style="font-weight:700;">%s</a>', 'https://test.test', __( 'Custom Link', 'my-plugin' ) );

		return $links;
	}

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_public_scripts_and_styles() {
		wp_enqueue_style( 'my-plugin-public', MY_PLUGIN_URL . 'public/assets/css/my-plugin-public.css', array(), MY_PLUGIN_VERSION, 'all' );

		wp_enqueue_script( 'my-plugin-public-scripts', MY_PLUGIN_URL . 'public/assets/css/my-plugin-public.js', array(), MY_PLUGIN_VERSION, false );
	}

	public function enqueue_admin_scripts_and_styles() {
		wp_enqueue_style( 'bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array( ), '5.3.2', 'all' );
	    wp_style_add_data( 'bootstrap-5', array( 'integrity', 'crossorigin' ),  array( 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN', 'anonymous' ) );
		wp_enqueue_style( 'my-plugin-admin', MY_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), MY_PLUGIN_VERSION, 'all' );
		
		
		wp_enqueue_script( 'my-plugin-admin-scripts', MY_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), MY_PLUGIN_VERSION, false );
		wp_localize_script( 'my-plugin-admin-scripts', 'my-plugin', array('plugin_name' => __( MY_PLUGIN_NAME, 'plugin_name' )));

		wp_enqueue_script( 'bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', false );
		wp_script_add_data( 'bootstrap-5', array( 'integrity', 'crossorigin' ) , array( 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL', 'anonymous' ) );
	}



}
