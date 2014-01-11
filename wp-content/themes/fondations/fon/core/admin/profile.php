<?php
add_action( 'fon_menu_profile_hook', 'fon_profile_page' );

function fon_profile_page() {

    $fields = apply_filters( 'fon_profile_fields', array() );

    // $updated_fields = array();
    if( isset( $_POST ) ) {
        foreach( $fields as $field_id => $field ) {
            if( isset( $_POST[$field_id] ) ) {
                // if($field['type'] == 'url' && filter_var($_POST[$field_id], FILTER_VALIDATE_URL) === FALSE)

                // update_option( $field_id, stripslashes( $_POST[$field_id] ) );
                update_option( $field_id, $_POST[$field_id] );
                // $updated_fields[] = $field['label'];
            }
        }
    }

    ?>

    <form id="fon_profile_form" class="cssn_form float_form" action="" method="POST">
        <table class="form-table">
            <tbody>
                <?php foreach ($fields as $field_id => $field) {

                    $type = ( isset( $field['type'] ) && ! empty ( $field['type'] ) ) ? $field['type'] : 'text';
                    $value = get_option($field_id);
                    if( ! is_array( $value ) ) {
                        $values = array( $value );
                    } else {
                        $values = $value;
                    }
                    $is_dynamic = ( ! isset( $field['dynamic'] ) || ! $field['dynamic'] ) ? false : $field['dynamic'];

                    echo '<tr valign="top">';

                        //label
                        echo '<th scope="row"><label for="'.$field_id.'">'.$field['label'].'</label></th>';
                        echo '<td>';

                            $field_name = ( count($values) > 1 ) ? $field_id . '[]' : $field_id;
                            $field_count = 0;
                            foreach ($values as $value) {
                                $value = ( empty( $value ) && isset( $field['default'] ) && ! empty( $field['default'] ) ) ? $field['default'] : $value;
                                $field_count++;
                                $field_id = ( $field_count < 2 ) ? $field_id : $field_id . '_' . $field_count;
                                // echo '<input id="'.$field_id.'" type="'.$type.'" name="'.$field_name.'" value="'.$value.'" placeholder="'.$field['default'].'" class="regular-text dynamic-input" />';

                                if( ! $is_dynamic ) {
                                    if ( $type == 'textarea'):
                                        echo'<textarea id="'.$field_id.'" name="'.$field_name.'" rows="'.$field['rows'].'" class="large-text">'.$value.'</textarea>';
                                    else:
                                        echo '<input id="'.$field_id.'" type="'.$type.'" name="'.$field_name.'" value="'.$value.'" placeholder="'.$field['default'].'" class="regular-text" />';
                                    endif;
                                } else {


                                    // Dynamic input
                                    if ( $type == 'textarea'):
                                        echo'<textarea id="'.$field_id.'" name="'.$field_name.'" rows="'.$field['rows'].'" class="large-text dynamic-input">'.$value.'</textarea>';
                                    else:
                                        echo '<input id="'.$field_id.'" type="'.$type.'" name="'.$field_name.'" value="'.$value.'" placeholder="'.$field['default'].'" class="regular-text dynamic-input" />';
                                    endif;
                                }
                            }

                            if( $is_dynamic ) {
                                $data_max = ( is_int( $is_dynamic ) && $is_dynamic > 0 ) ? 'data-max="'.$is_dynamic.'"' : '';
                                echo '<button type="button" class="button fon-dynamic-add-button" data-target="'.$field_id.'" '.$data_max.' >+</button>';
                            }

                        // help
                        if (isset($field['help'])) {
                            echo '<p class="description">'.$field['help'].'</p>';
                        }
                    echo '</td>';

                    // if type color : add blocs for the colorpicker in js
                    /*if ($field['type'] == 'color') { ?>
                        <input type="button" class="hide-if-no-js pickcolor button-secondary" value="Choisir" />
                        <div id="colorpicker"></div>
                    <?php }*/

                    echo '</tr>';
                } ?>
            </tbody>
        </table>
        <p class="submit">
            <button name="fon-form-submit" id="fon-form-submit" class="button-primary"><?php echo __('Enregistrer les modifications', 'fon'); ?></button>
        </p>
    </form>

    <?php

}



add_action( 'fon_profile_fields', 'fon_profile_set_fields' );
function fon_profile_set_fields( $fields ) {

    $fields = array(
        'fon_analytics' => array(
            'label' => 'Code Google Analytics',
            'type' => 'text',
            'default' => 'UA-XXXXX-X'
        ),
        'fon_email' => array(
            'label'   => 'Email de contact',
            'type'    => 'email',
            'help'    => '',
            'default' => ''
        ),
        // TODO add multiple fields
        'fon_fav_color' => array(
            'label' => 'Couleur préférée',
            'type' => 'color',
            'default' => '#BADA55',
            'dynamic' => true
        )
    );
    return $fields;
}