<?php

add_action( 'admin_menu', 'fon_register_menu' );

function fon_register_menu() {
    add_menu_page( 'Les Fondations', 'Fondations', 'manage_options', 'fondations_menu', 'fon_menu_actions', '', 1 );
    add_submenu_page( 'fondations_menu', 'Profil', 'Profil', 'manage_options', 'fon_menu_profile', 'fon_menu_profile_actions' );
}

function fon_menu_actions() {
    ?>
    <div class="wrap" id="">
        <h2>Les Fondations</h2>
        <?php do_action( 'fon_menu_hook' ); ?>
    </div>
    <?php
}

function fon_menu_profile_actions() {
    ?>
    <div class="wrap" id="the-profile-page">
        <h2>Profil</h2>
        <?php do_action( 'fon_menu_profile_hook' ); ?>
    </div>
    <?php
}