<?php
global $fon_meta_boxes;
$fon_meta_boxes = array();

/* Meta box declarations
   ----------------------------- */

$prefix = 'fon_';

$fon_meta_boxes[] = array(
    'title' => 'Infos',
    'pages' => array( 'game' ),
    'fields' => array(
        array(
            'name'  => 'Titre original',
            'id'    => "{$prefix}title_original",
            'type'  => 'text',
        ),
        array(
            'name'  => 'Autre nom, on l’appelle aussi',
            'id'    => "{$prefix}title_variant",
            'type'  => 'text',
        ),
        array(
            'name' => 'Site officiel',
            'id'   => "{$prefix}website",
            'type' => 'url'
        ),
        array(
            'name' => 'Résumé',
            'id'   => "{$prefix}summary",
            'type' => 'textarea',
        ),
        array(
            'name' => 'Date de sortie française',
            'id'   => "{$prefix}release_date_fr",
            'type' => 'date',
        ),
        // array(
        //     'name' => 'Pochette originale',
        //     'id'   => "{$prefix}cover_original",
        //     'type' => 'image',
        // ),
        array(
            'name' => 'Pochette',
            'id'   => "{$prefix}cover_fr",
            'type' => 'image_advanced',
        ),
    )
);

$fon_meta_boxes[] = array(
    'title' => 'Détails',
    'pages' => array( 'post' ),
    'fields' => array(
        array(
            'name' => 'Durée de lecture',
            'id'   => "{$prefix}read_time",
            'type' => 'text',
        ),
        array(
            'name' => 'Source',
            'id'   => "{$prefix}source_name",
            'type' => 'text',
        ),
        array(
            'name' => 'Source URL',
            'id'   => "{$prefix}source_url",
            'type' => 'url',
        ),
        array(
            'name' => 'Via',
            'id'   => "{$prefix}via_name",
            'type' => 'text',
        ),
        array(
            'name' => 'Via URL',
            'id'   => "{$prefix}via_url",
            'type' => 'url',
        ),
    )
);


// Attachments custom fields
add_action( 'fon_attachment_fields', 'fon_attachment_custom_fields' );
function fon_attachment_custom_fields( $fields ) {

    $custom_fields = array(
        'credit_text' => array(
            'label' => __('Crédit'),
            'input' => 'text' // hidden, textarea or text
            // 'helps' => __('The owner of the image.'),
        ),
        'credit_url' => array(
            'label' => __('Crédit URL'),
            'input' => 'url'
        ),
        'author_name' => array(
            'label' => __('Auteur'),
            'input' => 'text'
        ),
        'author_url' => array(
            'label' => __('Auteur URL'),
            'input' => 'url'
        ),
    );

    $fields = array_merge( $fields, $custom_fields );
    return $fields;
}
