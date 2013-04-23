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
        $css_content = '';
        $public_dir = PUBLIC_PATH;
        // Inclusion des fichiers dans l'ordre
        foreach( $files as $file )
            $css_content .= file_get_contents($file);
        // Compression du CSS
        $css_content = compress_css($css_content);
        // version
        $css_filename = 'min.css';
        if(!get_option('fon_min_css_version')) {
            if(!is_dir($public_dir))
                @mkdir($public_dir);
            @chmod($public_dir, 0777);
            file_put_contents(PUBLIC_PATH.'/'.$css_filename, $css_content);
            $css_version = time();
            update_option('fon_min_css_version', $css_version);
        } else {
            $css_version = get_option('fon_min_css_version');
        }
        wp_enqueue_style('fon-min', PUBLIC_URL.'/'.$css_filename, array(), $css_version, 'all');
    }
}
