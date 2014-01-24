<?php

add_filter('jpeg_quality', 'fon_jpeg_quality');
function fon_jpeg_quality($arg) {
    return FON_JPEG_QUALITY;
}

// use WP automatic updates despite version control
// http://make.wordpress.org/core/2013/10/25/the-definitive-guide-to-disabling-auto-updates-in-wordpress-3-7/
function fon_automatic_update_vcs( $checkout, $context ) {
    // if ( $context == ABSPATH )
        return false;
    // return $checkout;
}
add_filter( 'automatic_updates_is_vcs_checkout', 'fon_automatic_update_vcs', 10, 2 );