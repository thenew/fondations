<?php
// Remplacer toutes les occurrences "Inception" par le nom du plugin
// Remplacer le "*" entre Plugin et Name pour activer le plugin

/*
Plugin *Name: Inception
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
define('INCEPTION_PLUGIN_NAME', basename(dirname(__FILE__)) );
// plugin path
define('INCEPTION_BASENAME_PLUGIN_PATH', plugins_url( INCEPTION_PLUGIN_NAME ));
// capabilities
define('INCEPTION_CURRENT_USER_CAN','manage_options');
// plugin id
define('INCEPTION_PLUGIN_ID', 'XXXX');


if ( is_admin() ) {
  
  add_action('admin_menu', 'inception_create_menu');
  function inception_create_menu() {
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

  function inception_scripts() {
    // wp_enqueue_script( 'scripts', INCEPTION_BASENAME_PLUGIN_PATH.'/includes/js/scripts.js', array( 'farbtastic', 'jquery' ) ); 
  }

  function inception_CSS() {
      // $url = INCEPTION_BASENAME_PLUGIN_PATH.'/includes/css/the-profile.css';
      // echo "<link href='$url' rel='stylesheet' type='text/css' />";
  } 

}

function inception_main() {
}
