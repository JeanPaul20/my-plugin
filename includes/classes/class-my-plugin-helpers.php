<?php

namespace My_Plugin\Includes\Classes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}


/**
 * Class My_Plugin_Helpers
 *
 * This class contains repetitive functions that
 * are used globally within the plugin.
 *
 * @package		My_Plugin
 * @subpackage	Classes/My_Plugin_Helpers
 * @author		Jean Paul Jaspers
 * @since		1.0.0
 */
class My_Plugin_Helpers
{

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


	public function __construct()
	{
		$this->option_slug =  MYPLUGIN()->settings->get_option_slug();
		$this->plugin_db_prefix =  MYPLUGIN()->settings->get_table_name();
		$this->table_name =  MYPLUGIN()->settings->get_table_name();
	}


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
	 *  MYPLUGIN()->helpers->output_text( 'my text' );
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
	public function output_text($text = '')
	{
		echo $text;
	}


	/**
	 * HELPER COMMENT END
	 */

	/**
	 * Prepares and sets language-specific texts.
	 *
	 * @param string $name The name of the option to store the texts.
	 * @param array $texts An associative array of language codes and texts.
	 * @return bool Whether the texts were set successfully.
	 * @dev Usage example
	 * 
	 * $texts = [
	 *     'en_EN' => 'Welcome to my website',
	 *     'nl_NL' => 'Welkom op mijn website'
	 * ];
	 *  MYPLUGIN()->helpers->set_language_texts('welcome_texts', $texts);
	 */
	public function set_language_texts($name, $texts)
	{
		// Prepare the array for language texts
		$language_texts = [];
		foreach ($texts as $lang_code => $text) {
			$language_texts[$lang_code] = $text;
		}
		return $this->set_language_texts($name, $language_texts);
	}

	/**
	 * Retrieves the current language from the Easy Multilingual WordPress plugin options.
	 *
	 * @return string The current language.
	 */
	public function get_current_language()
	{
		return get_option($this->option_slug);
	}

	/**
	 * Set the current language.
	 *
	 * @param string $language The language code to set.
	 */
	public function set_current_language($language)
	{
		update_option($this->option_slug, $language);
	}

	public function set_language_text(string $name, array $values): bool
	{
		global $wpdb;
		// Sanitize and validate the input
		$sanitized_values = array();
		foreach ($values as $lang => $text) {
			$sanitized_lang = sanitize_key($lang); // Sanitize the language code
			$sanitized_text = sanitize_text_field($text); // Sanitize the text
			$sanitized_values[$sanitized_lang] = $sanitized_text;
		}

		// Serialize the sanitized values
		$serialized_values = maybe_serialize($sanitized_values);

		// Insert or update the row in the custom option table
		$result = $wpdb->replace(
			$this->table_name,
			array(
				'option_name' => $name,
				'option_value' => $serialized_values,
			),
			array('%s', '%s')
		);

		return $result !== false;
	}

	public function get_language_text(string $name, string $defaultLang = 'en_UK')
	{
		global $wpdb;

		// Retrieve the row from the custom option table
		$result = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT option_value FROM $this->table_name WHERE option_name = %s",
				$name
			)
		);

		if ($result !== null) {
			$options = maybe_unserialize($result);
			$currentLang = get_locale(); // Get the current WordPress language setting

			// Check if $options is an array and the language key exists
			if (is_array($options)) {
				return $options[$currentLang] ?? $options[$defaultLang] ?? null;
			}
		}

		// Return null or a default value if $options is not an array
		return null;
	}
}
