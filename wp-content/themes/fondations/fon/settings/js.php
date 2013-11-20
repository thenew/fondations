<?php // Chargement des JS
add_action('init', 'fon_script_init');
function fon_script_init() {
    if (!is_admin()){
        wp_deregister_script( 'jquery' ); // unregistered key jQuery
        // wp_enqueue_script('jquery',ASSETS_URL.'/js/lib/jquery-1.7.1.min.js','','1.7.1',false);
        wp_enqueue_script('mootools',ASSETS_URL.'/js/lib/mootools-core-1.3.2-full-compat-yc.js','','1.3.2',false);
        wp_enqueue_script('modernizr',ASSETS_URL.'/js/lib/modernizr-1.7.min.js','','1.7',false);
        wp_enqueue_script('functions',ASSETS_URL.'/js/functions.js','','1.0',false);
        // wp_enqueue_script('twitter',ASSETS_URL.'/js/lib/twitter.js','','1.0',false);
        // wp_enqueue_script('jbhslider',ASSETS_URL.'/js/jbh_slider.js','','1.0.5',false);
        // wp_enqueue_script('resizableBox',ASSETS_URL.'/js/resizableBox.js','','1.0',false);
        wp_enqueue_script('fonslider',ASSETS_URL.'/js/dk-jsu-slider.js','','1.0',false);
        wp_enqueue_script('fonsearch',ASSETS_URL.'/js/Fon_search.js','','1.0',false);
        wp_enqueue_script('events',ASSETS_URL.'/js/events.js','','1.0',false);
    }
    // Admin
    else {
        // wp_deregister_script( 'jquery' ); // unregistered key jQuery
        // wp_enqueue_script('jquery',ASSETS_URL.'/js/lib/jquery-1.7.1.min.js','','1.7.1',false);
        // wp_enqueue_script('mediaupload',ASSETS_URL.'/js/media-upload.js','','1.0',false);
        wp_enqueue_script('admin',ASSETS_URL.'/js/admin.js','','1.0',false);
    }
}