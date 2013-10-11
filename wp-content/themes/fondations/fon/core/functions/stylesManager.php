<?php
add_action( 'init', 'fon_deploy_actions' );

function fon_deploy_actions(){
    if( !isset($_GET['fon']) ||  $_GET['fon'] != 'deploy' ) return;
    $css_version = fon_update_css();
}

function fon_compress_css($css) {
    // remove comments, tabs, spaces, newlines, etc.
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', ' ', $css);
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $css);
    $css = str_replace(
         array(';}', ' {', '} ', ': ', ' !', ', ', ' >', '> '),
         array('}',  '{',  '}',  ':',  '!',  ',',  '>',  '>'), $css);
  return $css;
}

function fon_update_css(){
    // List CSS files
    $files = array();
    $dir = opendir(ASSETS_PATH.'/css/');
    while ( $file = readdir($dir) ) {
        if($file != "." && $file != "..")
            $files[] = ASSETS_URL . '/css/' . $file;
    }
    closedir($dir);
    asort($files);

    $css_content = '';
    // Inclusion des fichiers dans l'ordre
    foreach( $files as $file )
        $css_content .= file_get_contents($file);
    // Compression du CSS
    $css_content = fon_compress_css($css_content);

    // version
    if(!is_dir(PUBLIC_PATH))
        @mkdir(PUBLIC_PATH);
    @chmod(PUBLIC_PATH, 0777);
    file_put_contents(PUBLIC_PATH.'/min.css', $css_content);
    $css_version = time();
    update_option('fon_min_css_version', $css_version);
    return $css_version;
}

// Enqueue styles
add_action( 'wp_enqueue_scripts', 'fon_styles_init' );

function fon_styles_init() {

    if(is_admin()) return;

    // Enqueue each CSS files
    if(WP_DEBUG) {
        // List CSS files
        $files = array();
        $dir = opendir(ASSETS_PATH.'/css/');
        while ( $file = readdir($dir) ) {
            if($file != "." && $file != "..")
                $files[] = ASSETS_URL . '/css/' . $file;
        }
        closedir($dir);
        asort($files);
        foreach ($files as $file) {
            wp_enqueue_style(basename($file,'.css'),$file,array(),'1','all');
        }
    // Compress CSS
    }else {
        // update file and version of min.css
        if(!get_option('fon_min_css_version')) {
            $css_version = fon_update_css();
        // get version
        } else {
            $css_version = get_option('fon_min_css_version');
        }
        wp_enqueue_style('fon-min', PUBLIC_URL.'/min.css', array(), $css_version, 'all');
    }
}


add_action( 'fon_menu_hook', 'fon_menu_styleManager' );

function fon_menu_styleManager(){
    ?>
    <h3>CSS minifiés</h3>
    <?php
    if( isset($_POST) && isset($_POST['submit']) && $_POST['submit'] == 'ok' ) {
        $css_version = fon_update_css();
        if($css_version) {
            ?>
            <div class="updated">
                <p><strong>Styles CSS à jour.</strong> (version : <?php echo $css_version; ?>)</p>
            </div>
            <?php
        }
    }
    ?>
    <form name="fon-refresh-css" action="" method="POST" class="fon-form">
        <div class="form-field">
        </div>
        <p class="submit">
            <button type="submit" name="submit" id="submit" value="ok" class="button button-primary">Mettre à jour les styles CSS</button>
        </p>
    </form>
    <?php
}
