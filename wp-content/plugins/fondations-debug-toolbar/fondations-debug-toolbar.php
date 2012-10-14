<?php
/*
Plugin Name: Fondations Debug Toolbar
Plugin URI: http://thenew.fr
Description: 
Version: 0.1
Author: Rémy Barthez
Author URI: http://thenew.fr
License: WTFPL
*/

/**
 * Constants
 */

// plugin name
define('FONBAR_PLUGIN_NAME', basename(dirname(__FILE__)) );
// plugin path
define('FONBAR_BASENAME_PLUGIN_PATH', plugins_url( FONBAR_PLUGIN_NAME ));
// capabilities
define('FONBAR_CURRENT_USER_CAN','manage_options');
// plugin id
define('FONBAR_PLUGIN_ID', 'fondations-debug-toolbar');

/**
 * Init
 */
if (!is_admin()) {
    require_once( dirname(__FILE__).'/functions.php');
    add_action('wp_enqueue_scripts', 'fonbar_CSS' );
    add_action('wp_enqueue_scripts', 'fonbar_scripts' );
}

function fonbar_CSS() {
    $url = FONBAR_BASENAME_PLUGIN_PATH.'/assets/css/fondations-debug-toolbar.css';
    // echo "<link href='$url' rel='stylesheet' type='text/css' />";
    wp_enqueue_style('fonbar_CSS', $url, '', '1.0');
} 

function fonbar_scripts() {
  wp_enqueue_script('resizableBox', FONBAR_BASENAME_PLUGIN_PATH.'/assets/js/resizableBox.js', '', 1.0, true);
  wp_enqueue_script('fondations-debug-toolbar', FONBAR_BASENAME_PLUGIN_PATH.'/assets/js/fondations-debug-toolbar.js', array('resizableBox'), 1.0, true);
}

function fonbar_main() {

}

add_action('wp_footer', 'fonbar_render');
function fonbar_render() {
  if (!is_admin() && WP_DEBUG){
    fon_debug_toolbar();
}
}
