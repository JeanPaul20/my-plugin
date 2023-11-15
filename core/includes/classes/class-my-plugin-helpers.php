<?php

namespace My_Plugin\Core\Includes\Classes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class My_Plugin_Helpers
 *
 * This class contains repetitive functions that
 * are used globally within the plugin.
 *
 * @package		MYPLUGIN
 * @subpackage	Classes/My_Plugin_Helpers
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Helpers{

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * HELPER COMMENT START
	 *
	 * Within this class, you can define common functions that you are 
	 * going to use throughout the whole plugin. 
	 * 
	 * Down below you will find a demo function called output_text()
	 * To access this function from any other class, you can call it as followed:
	 * 
	 * MY_PLUGIN()->helpers->output_text( 'my text' );
	 * 
	 */
	 
	/**
	 * Output some text
	 *
	 * @param	string	$text	The text to output
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	 public function output_text( $text = '' ){
		 echo $text;
	 }

	 /**
	  * HELPER COMMENT END
	  */

}
