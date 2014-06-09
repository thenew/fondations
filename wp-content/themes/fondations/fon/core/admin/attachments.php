<?php


/**
 * Add custom media metadata fields
 *
 * Be sure to sanitize your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $form_fields An array of fields included in the attachment form
 * @param $post The attachment record in the database
 * @return $form_fields The final array of form fields to use
 */
function add_image_attachment_fields_to_edit( $form_fields, $post ) {

    $fon_attachment_custom_fields = apply_filters( 'fon_attachment_fields', array() );

    foreach ( $fon_attachment_custom_fields as $key => $custom_field ) {

        // checkbox trick
        if( isset( $custom_field['input'] ) && 'checkbox' == $custom_field['input']  ) {
            $custom_field['input'] = 'html';
            $custom_field['html'] = '<input type="checkbox" value="1" id="attachments-'.$post->ID.'-'.$key.'" name="attachments['.$post->ID.']['.$key.']" />';
        }

        // Default
        if( ! array_key_exists('value', $custom_field) ) {
            $custom_field['value'] = esc_attr( get_post_meta( $post->ID, $key, true ) );
        }

        $form_fields[$key] = $custom_field;
    }
    // error_log(print_r($form_fields, 1));

    return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

/**
 * Save custom media metadata fields
 *
 * Be sure to validate your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $post The $post data for the attachment
 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
 * @return $post
 */
function add_image_attachment_fields_to_save( $post, $attachment ) {

    // error_log(print_r($attachment, 1));
    // error_log(print_r($post, 1));
    $fon_attachment_custom_fields = apply_filters( 'fon_attachment_fields', array() );

    foreach ( $fon_attachment_custom_fields as $key => $custom_field ) {

        if ( isset( $attachment[$key] ) ) {
            update_post_meta( $post['ID'], $key, esc_attr($attachment[$key]) );
        }
    }

    return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);




