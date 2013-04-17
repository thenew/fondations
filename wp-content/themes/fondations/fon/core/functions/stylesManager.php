<?php
function compress_css($css) {
    // remove comments, tabs, spaces, newlines, etc.
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', ' ', $css);
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $css);
    $css = str_replace(
         array(';}', ' {', '} ', ': ', ' !', ', ', ' >', '> '),
         array('}',  '{',  '}',  ':',  '!',  ',',  '>',  '>'), $css);
  return $css;
}

// Enqueue styles
add_action( 'wp_enqueue_scripts', 'fon_styles_init' );

function fon_styles_init() {

    $files = array();
    $css_dir = ASSETS_PATH.'/css/';
    $dir = opendir($css_dir);

    while ( $file = readdir($dir) ) {
        if($file != "." && $file != "..")
            $files[] = ASSETS_URL . '/css/' . $file;
    }
    closedir($dir);
    asort($files);

    // Enqueue styles
    if(WP_DEBUG) {
        foreach ($files as $file) {
            wp_enqueue_style(basename($file,'.css'),$file,array(),'1','all');
        }
    }else {
        $css_min = '';
        // Inclusion des fichiers dans l'ordre
        foreach( $files as $file )
            $css_min .= file_get_contents($file);
        // Compression du CSS
        $css_min = compress_css($css_min);
        // Mis en cache fichier externe
        file_put_contents(PUBLIC_PATH.'/min.css', $css_min);

        wp_enqueue_style('min',PUBLIC_URL.'/min.css',array(),'1','all');
    }
}
