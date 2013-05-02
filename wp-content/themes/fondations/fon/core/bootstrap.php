<?php
/*
 * CONSTANTS
 */

define('FONDATIONS_VERSION', '0.1');
define('TEMPLATE_URL',   get_bloginfo('template_directory')); // path with virtual hosts
define('TEMPLATE_PATH',  get_template_directory()); // the server-side path to folder

define('FON_PATH',       TEMPLATE_PATH.'/fon');

define('ASSETS_PATH',    TEMPLATE_PATH.'/assets');
define('ASSETS_URL',     TEMPLATE_URL.'/assets');

define('PUBLIC_PATH',    ASSETS_PATH.'/public');
define('PUBLIC_URL',     ASSETS_URL.'/public');

define('LIB_PATH',       TEMPLATE_PATH.'/fon/lib');
define('LIB_URL',        TEMPLATE_URL.'/fon/lib');

define('CLASSES_PATH',   TEMPLATE_PATH.'/fon/core/classes');
define('CLASSES_URL',    TEMPLATE_URL.'/fon/core/classes');

function fon_define_env_dev(){
    $url_extension = pathinfo($_SERVER['HTTP_HOST'],PATHINFO_EXTENSION);
    return (WP_DEBUG || $url_extension == "dev" || $url_extension == "local" || is_preview());
}
define('ENV_DEV', fon_define_env_dev());


/*
 * INCLUDES
 */

/* core */
foreach (glob(FON_PATH.'/core/admin/*.php') as $file) { if(!is_dir($file)) require_once $file; }
foreach (glob(FON_PATH.'/core/classes/*.php') as $file) { if(!is_dir($file)) require_once $file; }
foreach (glob(FON_PATH.'/core/functions/*.php') as $file) { if(!is_dir($file)) require_once $file; }

/* settings */
foreach (glob(FON_PATH.'/settings/*.php') as $file) { if(!is_dir($file)) require_once $file; }

/* widgets */
global $fon_widgets; $fon_widgets = array();
foreach (glob(FON_PATH.'/widgets/*.php') as $file) {
    if(!is_dir($file)) {
        require_once $file;
        // register widget
        array_push($fon_widgets, basename($file, '.php'));
    }
}

add_action('widgets_init', 'fon_register_widgets');
function fon_register_widgets(){
    global $fon_widgets;
    foreach ($fon_widgets as $widget) {
        register_widget($widget.'_widget');
    }
}
