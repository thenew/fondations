<?php

function fon_register_connections() {
    if(!function_exists('p2p_register_connection_type')) return;



    // Connexions
    $fon_connections = array(
        // Post -> Users
        array(
            'name' => 'multiple_authors',
            'from' => 'post',
            'to' => 'user'
            // 'to_query_vars' => array( 'role' => 'editor' )
        )
    );



    foreach ($fon_connections as $args) {
        p2p_register_connection_type($args);
    }




   /* $terms = get_terms( 'role', array('hide_empty'=> false) );
    $values = array();
    foreach ($terms as $term) {
        array_push($values, $term->name);
    }*/

    p2p_register_connection_type( array(
        'name' => 'people_games',
        'from' => 'people',
        'to' => 'game',
        'reciprocal' => true,

        'fields' => array(
            // 'role' => array(
            //     'title' => 'Rôle',
            //     'type' => 'select',
            //     'values' => $values
            // ),

            // TODO create a table to link a p2p to a taxonomy
            // and display the terms in the p2p admin

            // 'role' => array(
                // 'title' => 'Rôle',
                // 'type' => 'taxonomy',
                // 'values' => 'role'
            // ),
        )
    ) );

}

add_action('p2p_init', 'fon_register_connections');