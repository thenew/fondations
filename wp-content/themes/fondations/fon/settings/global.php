<?php
define('FONDATIONS_COMMENTS', false);
define('FON_JPEG_QUALITY', 98);

// Profile
add_action( 'fon_profile_fields', 'fon_profile_custom_fields' );
function fon_profile_custom_fields( $fields ) {

    $custom_fields = array(
        'fon_twitter_site' => array(
            'label'   => 'Compte Twitter du site'
        ),
        'fon_twitter_creator' => array(
            'label'   => 'Compte Twitter du créateur'
        ),
        // 'fon_tttt' => array(
        //     'label'   => 'Test dynarea',
        //     'type' => 'textarea',
        //     'dynamic' => 3
        // )
    );

    $fields = array_merge( $fields, $custom_fields );
    return $fields;
}