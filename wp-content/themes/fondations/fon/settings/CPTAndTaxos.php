<?php
$post = new Custom_Post_Type( 'Post' );
$attachment = new Custom_Post_Type( 'attachment' );

// http://melchoyce.github.io/dashicons/

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
        'name' => 'tags image',
        'singular_name' => 'tag image'
    )
);


// Game
$game = new Custom_Post_Type( 'Game',
    array(
        'rewrite' => array( 'slug' => 'jeu' ),
        'menu_icon' => 'dashicons-art'
    ),
    array(
        'name' => 'Jeux vidéo',
        'singular_name' => 'Jeu vidéo'
    )
);

$game->add_taxonomy( 'genre' );
$game->add_taxonomy( 'theme' );
$game->add_taxonomy( 'support' );
$game->add_taxonomy( 'type' ); // adaptation, remake, réédition
$game->add_taxonomy( 'post_tag' );


// Person
$person = new Custom_Post_Type( 'Person',
    array(
        'menu_icon' => 'dashicons-admin-users'
    )
);

$person->add_taxonomy( 'role' );


// Companies
$company = new Custom_Post_Type( 'Company',
    array(
        'menu_icon' => 'dashicons-businessman'
    ),
    array(
        'name' => 'Entreprises',
        'singular_name' => 'Entreprise'
    )
);

$company->add_taxonomy( 'role' );

