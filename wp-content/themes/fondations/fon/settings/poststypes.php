<?php
// Custom post types

$work = new Custom_Post_Type( 'Work' );
$work->add_taxonomy( 'category' );
$work->add_taxonomy( 'media' );

$work->add_meta_box(
  'Work Info',
  array(
    'Year' => 'text',
    'Genre' => 'text'
  )
);

$work->add_meta_box(
  'Client Info',
  array(
    'Name' => 'text',
    'Nationality' => 'text',
    'Birthday' => 'text'
  )
);


