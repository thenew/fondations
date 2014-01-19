<?php
$post = new Custom_Post_Type( 'Post' );
$attachment = new Custom_Post_Type( 'attachment' );

/* Custom post types & Custom taxonomies
   ----------------------------- */

// Post
$post->add_taxonomy( 'support' );

// Attachment
$attachment->add_taxonomy( 'attachment_tag',
    array(
        'hierarchical' => false
    ),
    array(
        'singular_name' => 'Image tag'
    )
);

// Game
$game = new Custom_Post_Type( 'Game', array(
    'rewrite' => array( 'slug' => 'jeu' )
) );
$game->add_taxonomy( 'genre' );
$game->add_taxonomy( 'theme' );
$game->add_taxonomy( 'support' );
$game->add_taxonomy( 'post_tag' );

// Person
$person = new Custom_Post_Type( 'Person' );
$person->add_taxonomy( 'role' );

