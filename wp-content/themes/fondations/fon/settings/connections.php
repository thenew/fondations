<?php

function fon_register_connections() {
    if(!function_exists('p2p_register_connection_type')) return;

    $role_terms = get_terms( 'role', array('hide_empty'=> false) );
    $roles = array();
    foreach ($role_terms as $role) {
        $roles[] = $role->name;
    }

    // Connexions
    $fon_connections = array(
        // Post -> Users
        array(
            'name' => 'multiple_authors',
            'from' => 'post',
            'to' => 'user'
            // 'to_query_vars' => array( 'role' => 'editor' )
        ),

        // person -> Games
        array(
            'name' => 'people_games',
            'from' => 'person',
            'to' => 'game',
            'reciprocal' => true,
            'fields' => array(
                'role' => array(
                    'title' => 'Rôle',
                    'type' => 'select',
                    'values' => $roles
                )
            )
        ),
        array(
            'name' => 'saga',
            'from' => 'game',
            'to' => 'game',
            'reciprocal' => true,
            'fields' => array(
                'role' => array(
                    'title' => 'Nom',
                    'type' => 'text'
                )
            )
        )
    );

    foreach ($fon_connections as $args) {
        p2p_register_connection_type($args);
    }


}

add_action('p2p_init', 'fon_register_connections');




// function fon_mess_with_p2p($p2p_id) {
//     var_dump($p2p_id);
//     die;

// }
// add_action('p2p_created_connection', 'fon_mess_with_p2p');

function fon_mess_with_p2p( $post_id, $post ) {
    // Ordering
        if ( isset( $_POST['p2p_meta'] ) ) {
            foreach ( $_POST['p2p_meta'] as $p2p_id => $list ) {
                foreach ( $list as $key => $value ) {
                    var_dump($key);
                    var_dump($p2p_id);
                    die;
                    // p2p_update_meta( $p2p_id, $key, $value );
                }
            }
        }
}
// add_action( 'save_post', 'fon_mess_with_p2p', 10, 2 );