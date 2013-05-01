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
            'id'    => "{$prefix}original_title",
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
            'cols' => 15,
            'rows' => 5,
        ),
        array(
            'name' => 'Date de sortie française',
            'id'   => "{$prefix}release_date_fr",
            'type' => 'date',
        ),
    )
);



