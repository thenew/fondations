<?php 
function fon_widgets_init() {

	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'sidebar-blog',
		'before_widget' => '<div id="sidebar-blog">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name'=>'Footer Sidebar',
		'id' => 'sidebar-footer',
		'before_widget' => '<div id="sidebar-footer">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

}
add_action( 'widgets_init', 'fon_widgets_init' );
