<?php

// Thumbnails : active theme support
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
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
// Create wp-login.css in your theme folder
function wpfme_loginCSS() {
    echo '<link rel="stylesheet" type="text/css" href="'.ASSETS_URL.'/stylesheets/wp-login.css"/>';
}
add_action('login_head', 'wpfme_loginCSS');

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
