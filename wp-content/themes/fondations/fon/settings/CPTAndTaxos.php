<?php
$post = new Custom_Post_Type( 'Post' );

/* Custom post types & Custom taxonomies
   ----------------------------- */

$game = new Custom_Post_Type( 'Game', array(
    'rewrite' => array( 'slug' => 'jeu' )
) );
$game->add_taxonomy( 'genre' );
$game->add_taxonomy( 'theme' );
$game->add_taxonomy( 'support' );


$person = new Custom_Post_Type( 'Person' );
$person->add_taxonomy( 'role' );

$post->add_taxonomy( 'support' );
