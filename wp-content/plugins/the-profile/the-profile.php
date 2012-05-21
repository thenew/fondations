<?php
/*
Plugin Name: The Profile
Plugin URI: http://thenew.fr
Description: Permet de remplir les informations de profil du propriétaire du site
Version: 0.2
Author: Rémy Barthez
Author URI: http://thenew.fr
License: WTFPL
*/

/**
 * Constants
 */

// plugin name
define('TP_PLUGIN_NAME', basename(dirname(__FILE__)) );
// plugin path
define('TP_BASENAME_PLUGIN_PATH', plugins_url( TP_PLUGIN_NAME ));
// plugin path in mu-plugins
// define('TP_BASENAME_PLUGIN_PATH', content_url( TP_PLUGIN_NAME ).'/the-profile');
// capabilities
define('TP_CURRENT_USER_CAN','manage_options');
// plugin id
define('TP_PLUGIN_ID', 'the_profile_plugin');

global $categories;


if ( is_admin() ) {

	// we're in wp-admin
	require_once( dirname(__FILE__).'/includes/fields.php');
	global $tp_fields;

	add_action('admin_menu', 'tp_create_menu');

	function tp_create_menu() {
	    // menu top level
	    $page_title = 'Page Profil';
	    $menu_title = 'Profil';
	    $capability = TP_CURRENT_USER_CAN;
	    $menu_slug = TP_PLUGIN_ID;
	    $function = 'tp_main';
	    $icon = TP_BASENAME_PLUGIN_PATH.'/includes/images/icon.png';
	    $rank = 3;
	    $tp_plugin_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon, $rank);

	    add_action('admin_head-'.$tp_plugin_page, 'tp_CSS' );
		add_action('admin_print_styles-'.$tp_plugin_page, 'tp_scripts' );
	}


	function tp_scripts() {
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script( 'scripts', TP_BASENAME_PLUGIN_PATH.'/includes/js/scripts.js', array( 'farbtastic', 'jquery' ) );	
	}

	function tp_CSS() {
	    $url = TP_BASENAME_PLUGIN_PATH.'/includes/css/the-profile.css';
	    echo "<link href='$url' rel='stylesheet' type='text/css' />";
	}
}

function tp_main() {
    if (!current_user_can(TP_CURRENT_USER_CAN)) 
        wp_die('You do not have sufficient permissions to access this page.'); 

	global $tp_fields;
    ?>
	<div class="wrap" id="the-profile-page">
		<?php screen_icon( 'users' ); ?>
		<h2>Page de profil</h2>
        <form id="tp_profil_form" class="cssn_form float_form" action="" method="POST">
        <ul>
    	    <fieldset>
    	    <legend>Infos</legend>

    	    	<?php foreach ($tp_fields as $field_id => $field) {
    	    		echo '<li class="box">';

    	    		//label
    	    		echo '<label for="'.$field_id.'">'.$field['label'].'</label>';
					// input
    	    		if ($field['type'] == 'textarea'):
    	    			echo'<textarea id="'.$field_id.'" name="'.$field_id.'" rows="'.$field['rows'].'">'.get_option($field_id).'</textarea>';
    	    		else:
    	    			echo '<input id="'.$field_id.'" type="'.$field['type'].'" name="'.$field_id.'" value="'.get_option($field_id).'" placeholder="'.$field['default'].'" />';
    	    		endif;
					
					// help
					if (isset($field['help']))
			        	echo '<small>'.$field['help'].'</small>';

    	    		// if type color : add blocs for the colorpicker in js
    	    		if ($field['type'] == 'color') { ?>	
						<input type="button" class="hide-if-no-js pickcolor button-secondary" value="Choisir" />
						<div id="colorpicker"></div>
    	    		<?php }

    	    		echo '</li>';
    	    	} ?>
        	</fieldset>

	        <li class="box">
				<button name="tp-form-submit" id="tp-form-submit" class="button-primary">Enregistrer les modifications</button>
			</li>
		</ul>
		</form>

	</div>

	<?php
}

add_action('admin_init', 'tp_update_the_profile');
function tp_update_the_profile(){

	global $tp_fields;
    $champs_modifies = array();
    foreach($tp_fields as $field_id => $field){
        if(isset($_POST[$field_id])) {
        	// if($field['type'] == 'url' && filter_var($_POST[$field_id], FILTER_VALIDATE_URL) === FALSE)

            update_option($field_id, stripslashes($_POST[$field_id]));
            $champs_modifies[]= $field['label'];
        }
    }

}