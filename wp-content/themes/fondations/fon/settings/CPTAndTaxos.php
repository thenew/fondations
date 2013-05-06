<?php

/* Custom taxonomies
   ----------------------------- */

$post = new Custom_Post_Type( 'Post' );
$post->add_taxonomy( 'support' );

/* Custom post types
   ----------------------------- */

$game = new Custom_Post_Type( 'Game' );
$game->add_taxonomy( 'genre' );
$game->add_taxonomy( 'support' );


$people = new Custom_Post_Type( 'People' );
$people->add_taxonomy( 'role' );
