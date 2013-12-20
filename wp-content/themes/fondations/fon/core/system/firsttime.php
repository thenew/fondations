<?php
// add_action('init', 'init_posts');

// install pages
function init_posts() {

	// Delete default post "Hello World" which ID is '1'
	// wp_delete_post( 1, true );

	  $page_contact = array(
	  	'post_type' => 'page',
		'post_title' => wp_strip_all_tags( 'Contact' ),
		'post_content' => '<p>Contactez-moi</p>',
	    'post_status' => 'publish',
	    'post_author' => 1,
	    'menu_order' => 4
	  );

	// Create Portfolio page
	  $page_portfolio = array(
	  	'post_type' => 'page',
		'post_title' => wp_strip_all_tags( 'Portfolio' ),
		'post_content' => '',
	    'post_status' => 'publish',
	    'post_author' => 1,
	    'menu_order' => 2
	  );

	// Create Formation page
	  $page_formation = array(
	  	'post_type' => 'page',
		'post_title' => wp_strip_all_tags( 'Formation' ),
		'post_content' => '',
	    'post_status' => 'publish',
	    'post_author' => 1,
	    'menu_order' => 3
	  );

	// Insert the post into the database
	$contact_id = wp_insert_post( $page_contact );
	// $portfolio_id = wp_insert_post( $page_portfolio );
	$formation_id = wp_insert_post( $page_formation );

	// Constantes de pages
	define('CONTACT_PAGEID',$contact_id);
	// define('PORTFOLIO_PAGEID',$portfolio_id);
	define('FORMATION_PAGEID',$formation_id);

	// Set templates
	update_post_meta(CONTACT_PAGEID, "_wp_page_template", "page-contact.php");
	update_post_meta(PORTFOLIO_PAGEID, "_wp_page_template", "page-portfolio.php");
	// update_post_meta(FORMATION_PAGEID, "_wp_page_template", "page-formation.php");


	//Define the categories
	global $fon_cats;

	foreach ($fon_cats as $cat) {

		$cat_01 = 
			array(
				'cat_name' => $cat
			);
		// Create the categories
		wp_insert_category($cat_01);
		// $cat_webdesign_id = 
		
	}

}