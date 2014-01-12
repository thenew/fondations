<?php // Chargement des JS

add_action('init', 'fon_script_init');
function fon_script_init() {
    if ( is_admin() ) return;

    wp_enqueue_script( 'mootools', ASSETS_URL.'/js/lib/mootools-core-1.3.2-full-compat-yc.js', '', '1.3.2', true );
    wp_enqueue_script( 'mootoolsmore', ASSETS_URL.'/js/lib/mootools-more-1.4.0.1.js', '', '1.4.0.1', true );
    // wp_enqueue_script('fonslider', ASSETS_URL.'/js/dk-jsu-slider_cloneedition.js', '', '1.0', true );
    wp_enqueue_script( 'slider', ASSETS_URL.'/js/dk-jsu-slider.js', '', '1.0', true );
    wp_enqueue_script( 'fonsearch', ASSETS_URL.'/js/Fon_search.js', '', '1.0', true );
    wp_enqueue_script( 'functions', ASSETS_URL.'/js/functions.js', '', '1.0', true );
    wp_enqueue_script( 'wove', ASSETS_URL.'/js/wove.js', '', '1.0', true );
    wp_enqueue_script( 'events', ASSETS_URL.'/js/events.js', '', '1.0', true );
}

// TODO replace admin_init
add_action('admin_enqueue_scripts', 'fon_admin_script_init');
function fon_admin_script_init() {
    wp_enqueue_script( 'admin', ASSETS_URL.'/js/admin.js', '', '1.0', true );
}