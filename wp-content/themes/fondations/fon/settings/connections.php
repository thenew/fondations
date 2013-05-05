<?php
p2p_register_connection_type( array(
    'name' => 'posts_to_pages',
    'from' => 'people',
    'to' => 'game',

    'fields' => array(
        'role' => array(
            'title' => 'Role',
            'type' => 'select',
            'values' => array( 'engineer', 'support', 'manager' )
        ),
    )
) );