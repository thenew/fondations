<?php

// Add fonThemeUrl JS variable
add_action('admin_head', 'fon_syntax_buttons_plus');

function fon_syntax_buttons_plus(){
    echo '<script type="text/javascript">var fonThemeUrl = \''.get_template_directory_uri().'\';</script>';
}


function fon_add_cpt_to_tags_archives( $query ) {
    if( ( is_search() || is_tag() ) && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post',
            'CHANGETHISTOotherPostType'
        ));
        return $query;
    }
}
// add_filter( 'pre_get_posts', 'fon_add_cpt_to_tags_archives' );

// TODO add tags (ou categories) and credits fields to media