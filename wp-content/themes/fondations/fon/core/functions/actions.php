<?php
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