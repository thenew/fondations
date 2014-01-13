<?php
/*
 * Fondations Filou
 *
 * import and handle medias from URL
 *
 */

add_action( 'fon_menu_filou_hook', 'fon_filou_page' );

function fon_filou_page() {
    ?>

    <form id="fon_filou_form" class="cssn_form float_form" action="" method="POST">
        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">URL</label></th>
                <td><input type="url" name="fon_filou[url]" /></td>
            </tr>
        </tbody></table>
    </form>
    <?php
}
