<?php

// paste this in a (new) file, wp-content/db.php
// http://codex.wordpress.org/Running_a_Development_Copy_of_WordPress

add_filter ( 'pre_option_home', 'fon_set_dev_url' );
add_filter ( 'pre_option_siteurl', 'fon_set_dev_url' );
function fon_set_dev_url( ) {
    // some sample logic to determine if we're on the dev site
    $fon_dev_url = get_option('fon_dev_url');
    $url_extension = pathinfo( $_SERVER['HTTP_HOST'], PATHINFO_EXTENSION );
    if ( filter_var($fon_dev_url, FILTER_VALIDATE_URL) && ( $url_extension == "dev" || $url_extension == "local" ) ) {
        return $fon_dev_url;
    } else {
        return false; // act as normal; will pull main site info from db
    }
}