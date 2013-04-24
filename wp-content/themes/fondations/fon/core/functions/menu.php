<?php

add_action( 'admin_menu', 'fon_register_menu' );

function fon_register_menu(){
    add_menu_page( 'Les Fondations', 'Fondations', 'manage_options', 'fondations', 'fon_menu_actions', '', 1 );
}

function fon_menu_actions(){
    ?>
    <div class="wrap" id="the-profile-page">
        <?php screen_icon( 'options-general' ); ?>
        <h2>Les Fondations</h2>
        <?php do_action( 'fon_menu_hook' ); ?>
    </div>
    <?php
}