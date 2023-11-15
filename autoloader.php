<?php

/**
 * Autoloader Class File
 *
 * This file contains Autoloader class which can manage and handle using classes and
 * files by including them when they are needed.
 *
 * @package    My_Plugin
 * @author     Jean Paul Jaspers <jeanpauljaspers@gmail.com>
 * @link       https://jeanpaulart.com/plugins/easy-multilingual-wp/
 * @since      1.0.0
 */

 namespace My_Plugin;

 if ( ! defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}


class Autoloader {

    public function __construct() {
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($file_name) {
        if (strpos($file_name, MY_PLUGIN_NAME ) === false) {
            return;
        }

        $file_name = strtolower($file_name);
        $file_name = str_replace('_', '-', $file_name);

        $path = '';
        if (strpos($file_name, 'class-') === 0) {
            $path = 'Classes/';
        } elseif (strpos($file_name, 'interface-') === 0) {
            $path = 'Classes/';
        }

        // Detecting folder name
        $parts = explode('-', $file_name);
        if (in_array(strtolower($parts[1]), ['admin', 'public', 'includes', 'translate', 'init'])) {
            $path = ucfirst($parts[1]) . '/' . $path;
        }

        $file_path = plugin_dir_path(__FILE__) . $path . $file_name . '.php';

        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}

new Autoloader();
