<?php

/* Custom post types
   ----------------------------- */

$game = new Custom_Post_Type( 'Game' );
$game->add_taxonomy( 'genre' );
$game->add_taxonomy( 'support' );
