<?php

/* Meta box registering
   ----------------------------- */

global $fon_meta_boxes;

function fon_register_meta_boxes() {
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

    global $fon_meta_boxes;
    foreach ( $fon_meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}

add_action( 'admin_init', 'fon_register_meta_boxes' );
