<?php
/*
 * Menus & MetasBoxes
 * Supprime des menus inutiles dans l'admin Wordpress
 */

add_action('admin_head', 'remove_menus');
function remove_menus () {
	global $menu;
	global $submenu;

   // delete dashboard menu (Tableau de bord)
   unset($menu[2]); 

	// delete comments menu
   if(!FONDATIONS_COMMENTS) 
	  unset($menu[25]); 
	
   // delete Pages sous-menu
	unset($submenu['edit.php?post_type=page'][5]); // toutes le pages
   // unset($submenu['edit.php?post_type=page'][10]); // ajouter 
	
   // delete categories link
	// unset($submenu['link-manager.php'][15]);

}

add_action('admin_menu','remove_box');
function remove_box() {
	// post
   remove_meta_box('postcustom','post','normal');
   remove_meta_box('postexcerpt','post','normal');
   remove_meta_box('trackbacksdiv','post','normal');
   remove_meta_box('authordiv','post','normal');
   remove_meta_box('slugdiv','post','normal');
   remove_meta_box('commentstatusdiv','post','normal');
   // page
   remove_meta_box('postcustom','page','normal');
   remove_meta_box('authordiv','page','normal');
   remove_meta_box('commentsdiv','page','normal');
   remove_meta_box('commentstatusdiv','page','normal');
   remove_meta_box('slugdiv','page','normal');
   // link
   remove_meta_box('linkcategorydiv','link','normal');
   remove_meta_box('linktargetdiv','link','normal');
   remove_meta_box('linkxfndiv','link','normal');
   remove_meta_box('linkadvanceddiv','link','normal');

}