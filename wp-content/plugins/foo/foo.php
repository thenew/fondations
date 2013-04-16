<?php
// Remplacer toutes les occurrences "Foo" par le nom du plugin
// Remplacer le "*" entre Plugin et Name pour activer le plugin

/*
Plugin *Name: Foo
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
define('FOO_PLUGIN_NAME', basename(dirname(__FILE__)) );
// plugin path
define('FOO_BASENAME_PLUGIN_PATH', plugins_url( FOO_PLUGIN_NAME ));
// capabilities
define('FOO_CURRENT_USER_CAN','manage_options');
// plugin id
define('FOO_PLUGIN_ID', 'XXXX');


if ( is_admin() ) {

  add_action('admin_menu', 'foo_create_menu');
  function foo_create_menu() {
    // menu top level
    $page_title = 'Page Foo';
    $menu_title = 'Foo';
    $capability = foo_CURRENT_USER_CAN;
    $menu_slug = foo_PLUGIN_ID;
    $function = 'foo_main';
    // $icon = foo_BASENAME_PLUGIN_PATH.'/includes/images/icon.png';
    $rank = 3;
    $foo_plugin_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon, $rank);

    add_action('admin_head-'.$foo_plugin_page, 'FOO_CSS' );
    add_action('admin_print_styles-'.$foo_plugin_page, 'FOO_SCRIPTS' );
  }

  function foo_scripts() {
    // wp_enqueue_script( 'scripts', foo_BASENAME_PLUGIN_PATH.'/includes/js/scripts.js', array( 'farbtastic', 'jquery' ) );
  }

  function foo_CSS() {
      // $url = foo_BASENAME_PLUGIN_PATH.'/includes/css/the-profile.css';
      // echo "<link href='$url' rel='stylesheet' type='text/css' />";
  }

}

function foo_main() {
}
