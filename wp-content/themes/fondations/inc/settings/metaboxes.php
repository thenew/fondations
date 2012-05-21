<?php
// create custom meta box
add_action( 'add_meta_boxes', 'fon_mb_add_meta_box' );
function fon_mb_add_meta_box() {
	// "Slider color" custom meta box
	add_meta_box( 
		'fon-slider-color-meta', // id
		'Modifier la couleur de fond', // title 
		'fon_mb_slider_color', // callback
		'portfolio', // post_type
		'normal' // context
		// priority
	);
}

function fon_mb_slider_color( $post ){
	$fon_mb_slider_color = get_post_meta( $post -> ID, '_fon_mb_slider_color', true );

	// Post meta default value
	if ($fon_mb_slider_color == '' || is_null($fon_mb_slider_color)):
		$fon_mb_slider_color = get_option('tp_fav_color');
	endif;

	// render form
	?>
	<ul>
<!-- 		<li>
			<label for="fon_mb_slider_color">Couleur de fond</label>
			<input id="fon_mb_slider_color" type="text" size="25" name="fon_mb_slider_color" value="<?php echo stripslashes($fon_mb_slider_color); ?>" placeholder="#EFEFEF" />
			<input type='button' class='hide-if-no-js pickcolor button-secondary' value='Choisir' />
			<div id='colorpicker' style="position:absolute;display:none;z-index: 100;left:103px;background-color: #fff;border:1px solid #ccc;"></div>
		</li> -->
		<li>
			<label for="fon_mb_slider_img">Image du slider</label>
			<input type="text" id="fon_mb_slider_img" name="fon_mb_slider_img" />
			<button id="fon_mb_slider_img_button" class="hide-if-no-js button-secondary" >Ajouter</button>
		</li>
		<li>
			<button id="update_slider_color" class="button-primary" />Modifier</button>
		</li>
	</ul>
	<?php
}

// hook to save the meta box data
add_action( 'save_post', 'fon_mb_slider_color_save' );
function fon_mb_slider_color_save( $post_id ) {
	// verify the metadata is set
	if ( isset( $_POST['fon_mb_slider_color'] ) ) {
		// save the metadata
		update_post_meta( $post_id, '_fon_mb_slider_color',
		esc_url_raw( $_POST['fon_mb_slider_color'] ) );
	}
}

function fon_mb_image_function( $post ) {
	//retrieve the metadata value if it exists
	$fon_mb_image = get_post_meta( $post -> ID, '_fon_mb_image', true );
	?>
	Image <input id="fon_mb_image" type="text" size="75" name="fon_mb_image" value="<?php echo esc_url($fon_mb_image ); ?>" />
	<input id="upload_image_button" type="button" value="Media Library Image" class="button-secondary" />
	<br /> Enter an image URL or use an image from the Media Library
<?php
}

// hook to save the meta box data
add_action( 'save_post', 'fon_mb_image_save_meta' );
function fon_mb_image_save_meta( $post_id ) {
	//verify the metadata is set
	if ( isset( $_POST['fon_mb_image'] ) ) {
		//save the metadata
		update_post_meta( $post_id, '_fon_mb_image',
		esc_url_raw( $_POST['fon_mb_image'] ) );
	}
}