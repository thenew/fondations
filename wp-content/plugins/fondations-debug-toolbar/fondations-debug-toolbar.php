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


if ( is_admin() ) {
  
  add_action('admin_menu', 'fonbar_create_menu');
  function fonbar_create_menu() {
    // menu top level
    $page_title = 'Page Inception';
    $menu_title = 'Inception';
    $capability = INCEPTION_CURRENT_USER_CAN;
    $menu_slug = INCEPTION_PLUGIN_ID;
    $function = 'inception_main';
    // $icon = INCEPTION_BASENAME_PLUGIN_PATH.'/includes/images/icon.png';
    $rank = 3;
    $inception_plugin_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon, $rank);

    add_action('admin_head-'.$inception_plugin_page, 'inception_CSS' );
    add_action('admin_print_styles-'.$inception_plugin_page, 'inception_scripts' );
  }

  function fonbar_scripts() {
    // wp_enqueue_script( 'scripts', INCEPTION_BASENAME_PLUGIN_PATH.'/includes/js/scripts.js', array( 'farbtastic', 'jquery' ) ); 
  }

  function fonbar_CSS() {
      // $url = INCEPTION_BASENAME_PLUGIN_PATH.'/includes/css/the-profile.css';
      // echo "<link href='$url' rel='stylesheet' type='text/css' />";
  } 

}

function fonbar_main() {
}
