<?php

// Custom CSS for the login page
function fon_login_enqueue() {
    wp_enqueue_style('fon-login', FON_URL.'/core/assets/css/wp-login.css', array(), '1', 'all');
}
add_action('login_enqueue_scripts', 'fon_login_enqueue');

function fon_login_head() {
    $fav_color = get_option( 'fon_fav_color' );
    if( is_array( $fav_color ) ) {
        $fav_color = current( $fav_color );
    }
    ?>
    <style type="text/css">
        body.login {
            background-color: <?php echo $fav_color; ?> !important;
        }
    </style>
    <?php
}
add_action('login_head', 'fon_login_head');
