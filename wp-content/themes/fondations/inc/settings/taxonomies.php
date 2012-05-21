<?php
// Custom taxonomies : Catégories, monts clés
add_action('init', 'custom_taxonomies');
 	
function custom_taxonomies() {

	$labels = array(
		'name' => 'Catégories',
		'singular_name' => 'Catégorie',
		'edit_item' => 'Modifier une catégorie',
		'update_item' => 'Mettre à jour une catégorie',
		'add_new_item' => 'Ajouter une catégorie',
		'new_item_name' => 'Nouvelle catégorie',
		'all_items' => 'Toutes les catégories',
		'search_items' => 'Chercher une catégorie',
		'popular_items' => 'Catégories populaires',
		'separate_items_with_commas' => 'Séparer les catégories par des virgules',
		'add_or_remove_items' => 'Ajoute ou supprime des catégories',
		'choose_from_most_used' => 'Choisissez parmi les catégories populaires'
	);

	$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'query_var' => true,
			'rewrite' => true
		  ); 

	register_taxonomy('catégorie', 'portfolio', $args);

}