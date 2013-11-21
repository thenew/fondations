<?php

// Theme the TinyMCE editor
function fon_add_editor_styles(){
    add_editor_style( 'assets/css/fon-content.css' );
}
add_action( 'admin_init', 'fon_add_editor_styles' );


/* Add custom buttons in admin TinyMCE */

function fon_mce_buttons_init(){

    //Abort early if the user will never see TinyMCE
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
       return;

    // Add a callback to regiser our tinymce plugin
    add_filter('mce_external_plugins', 'fon_mce_register_plugin');

    // Add a callback to add our button to the TinyMCE toolbar
    add_filter('mce_buttons', 'fon_mce_add_button');

}
add_action('admin_init', 'fon_mce_buttons_init');

// This callback adds our button to the toolbar
function fon_mce_add_button($buttons) {
    array_push($buttons, 'separator', 'fonCode', 'fonCol2');
    return $buttons;
}

// This callback registers our plug-in
function fon_mce_register_plugin($plugin_array) {
    $plugin_array['fon_mce']  =  ASSETS_URL.'/js/admin_mce.js';
    return $plugin_array;
}
