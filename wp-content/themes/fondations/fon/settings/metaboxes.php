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
        array(
            'name' => 'Pochette originale',
            'id'   => "{$prefix}cover_original",
            'type' => 'image',
        ),
        array(
            'name' => 'Pochette',
            'id'   => "{$prefix}cover_fr",
            'type' => 'image_advanced',
        ),
    )
);



