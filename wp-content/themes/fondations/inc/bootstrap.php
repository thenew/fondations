<?php 
// Constants
define('FONDATIONS_VERSION', '0.1');
define('TEMPLATE_URL',   get_bloginfo('template_directory')); // path with virtual hosts
define('TEMPLATE_PATH',  get_template_directory()); // the server-side path to folder

define('INC_PATH',       TEMPLATE_PATH.'/inc');

define('ASSETS_PATH',    TEMPLATE_PATH.'/assets');
define('ASSETS_URL',     TEMPLATE_URL.'/assets');

define('LIB_PATH',       TEMPLATE_PATH.'/lib');
define('LIB_URL',        TEMPLATE_URL.'/lib');

define('BOOTSTRAP_PATH', TEMPLATE_PATH.'/lib/bootstrap');
define('BOOTSTRAP_URL',  TEMPLATE_URL.'/lib/bootstrap');

define('CLASSES_PATH',   TEMPLATE_PATH.'/inc/classes');
define('CLASSES_URL',    TEMPLATE_URL.'/inc/classes');

global $fon_widgets; $fon_widgets = array();

// Auto includes
// Inclure les fichiers dans le dossier inc/ et inc/*/
foreach (glob(INC_PATH.'/*') as $inc_lvl1)
{
  if(is_dir($inc_lvl1)){
    foreach (glob($inc_lvl1.'/*') as $inc_lvl2){
      if(!is_dir($inc_lvl2)){
          require_once $inc_lvl2;
          // widgets
          if(strpos($inc_lvl1, 'widgets')) {
            preg_match('/widgets\/(\w*)/', $inc_lvl2, $widget_name);
            array_push($fon_widgets, $widget_name[1]);
          }
      }
    }
  } else {
      require_once $inc_lvl1;
  }
}

// register widgets
add_action('widgets_init', 'fon_register_widgets');
function fon_register_widgets(){
    global $fon_widgets;
    foreach ($fon_widgets as $widget) {
        register_widget($widget.'_widget');
    }
}
