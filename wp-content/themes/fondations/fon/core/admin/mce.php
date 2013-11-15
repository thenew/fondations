<?php

/* Add custom buttons in admin TinyMCE */

if(is_admin()){
    add_action('init', 'fon_syntax_buttons');
    add_action('admin_head', 'fon_syntax_buttons_plus');
}

function fon_syntax_buttons_plus(){
    echo '<input type="hidden" id="fon-syntax-template-uri" value="'.get_template_directory_uri().'" />';
}

function fon_syntax_buttons(){
    global $fon_syntax_buttons;
    $fon_syntax_buttons = new fon_syntax_buttons();
}

class fon_syntax_buttons
{
    function fon_syntax_buttons(){
        if ( current_user_can('edit_posts') && current_user_can('edit_pages') && get_user_option('rich_editing') == 'true') {
            add_filter("mce_external_plugins", array(&$this, "mce_external_plugins"));
            add_filter('mce_buttons', array(&$this, 'mce_buttons'));
        }
    }
    function mce_buttons($buttons) {
        array_push($buttons, "separator", "fonCode", "fonCol2");
        return $buttons;
    }
    function mce_external_plugins($plugin_array) {
        $plugin_array['admin_mce']  =  ASSETS_URL.'/js/admin_mce.js';
        return $plugin_array;
    }
}



