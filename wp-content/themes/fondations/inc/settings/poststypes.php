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



// add_action('init', 'custom_posts_types');
 	
function custom_posts_types() {

	/**
	 * Portfolio
	 */

	$portfolioLabels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Projet',
		'add_new' => 'Ajouter un projet',
		'add_new_item' => 'Ajouter un projet',
		'edit_item' => 'Modifier un projet',
		'new_item' => 'Nouveau projet',
		'view_item' => 'Afficher un projet',
		'search_items' => 'Chercher un projet',
		'not_found' =>  'Rien trouvé',
		'not_found_in_trash' => 'Rien trouvé dans la corbeille'
	);

	$portfolioArgs = array(
		'labels' => $portfolioLabels,
    'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		//'menu_icon' => get_stylesheet_directory_uri() . '/icon_projet.png',
		'rewrite' => true,
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail'),
		'taxonomies' => array('categories')
	); 

	register_post_type('portfolio', $portfolioArgs);

}