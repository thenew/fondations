<?php

// Thumbnails : active theme support
add_action( 'after_setup_theme', 'fon_add_theme_support' );
function fon_add_theme_support() {
    add_theme_support( 'post-thumbnails' );
}

// Désactive les widgets par défaut dans l'admin Wordpress
add_action( 'widgets_init', 'unregister_default_wp_widgets' );
function unregister_default_wp_widgets() {
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Text' );
    unregister_widget( 'WP_Nav_Menu_Widget' );
}

// Remove the admin bar from the front end
// add_filter( 'show_admin_bar', '__return_false' );

// Custom CSS for the login page
function fon_login_enqueue() {
    wp_enqueue_style('fon-login', ASSETS_URL.'/css-admin/wp-login.css', array(), '1', 'all');
}
add_action('login_enqueue_scripts', 'fon_login_enqueue');

// Custom CSS for the login page
function fon_admin_enqueue() {
    wp_enqueue_style('fon-admin', ASSETS_URL.'/css-admin/admin.css', array(), '1', 'all');
}
add_action('admin_enqueue_scripts', 'fon_admin_enqueue');

// Remove the version number of WP
remove_action('wp_head', 'wp_generator');

// Disable the theme / plugin text editor in Admin
define('DISALLOW_FILE_EDIT', true);

// function fon_set_permalink(){
//     $permalink_structure = '/%category%/%postname%/';
//     if ( $permalink_structure != get_option('permalink_structure') ) {
//         update_option('permalink_structure', $permalink_structure);
//     }
// }

// add_action('rewrite_rules_array', fon_set_permalink());
