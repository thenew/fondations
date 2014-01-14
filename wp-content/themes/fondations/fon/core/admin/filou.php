<?php
/*
 * Fondations Filou
 *
 * import and handle medias from URL
 *
 * TODO
 * Module de pillage des images : depuis une URL lister toutes les <img>
 * (chercher si un lien les entourent pour chercher l'image en grande résolution),
 * cocher les images à importer, les renommer (pour SEO et cacher pillage) + associer à un post
 *
 */

add_action( 'fon_menu_filou_hook', 'fon_filou_page' );

function fon_filou_page() {


    $url = ( isset($_POST['fon_filou']) && isset($_POST['fon_filou']['url']) ) ? $_POST['fon_filou']['url'] : '';
    $size_min = ( isset($_POST['fon_filou']) && isset($_POST['fon_filou']['size_min']) ) ? $_POST['fon_filou']['size_min'] : 300;
    ?>

    <form id="fon_filou_form" class="cssn_form float_form" action="" method="POST">
        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">Dimensions min.</label></th>
                <td><input type="range" name="fon_filou[size_min]" min="0" max="1400" step="100" value="<?php echo $size_min; ?>" id="filou_size_min" class="input-range"/><span class="input-range-value"><span class="value"><?php echo $size_min; ?></span>px</span></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">URL</label></th>
                <td>
                    <input type="url" name="fon_filou[url]" value="<?php echo $url; ?>" />
                    <p class="description">http://www.kickstarter.com/projects/rain-world/project-rain-world</p>
                </td>
            </tr>
        </tbody></table>
        <p class="submit">
            <button name="fon-form-submit" id="fon-form-submit" class="button-primary"><?php echo __('Importe p’tit filou', 'fon'); ?></button>
        </p>
    </form>
    <?php

    fon_filou_parsing( $url, array( 'size_min' => $size_min ) );

}

function fon_filou_parsing( $url = '', $args = array() ) {

    if( empty( $url ) ) return;

    // args
    if( ! full( $args['size_min'] ) ) {
        $args['size_min'] = 300;
    }
    $size_min = $args['size_min'];

    $imgs = array();

    // curl
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($curl);
    curl_close($curl);

    // parsing
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html); // loads your HTML
    $xpath = new DOMXPath($dom);
    // returns a list of all links with rel=nofollow
    // $nlist = $xpath->query("//a");

    /*$nodes = $xpath->query("//a[contains(@href, 'http') and ( contains(@href, '.jpg') or contains(@href, '.png') )]");
    foreach ($nodes as $node) {
    // foreach ($dom->getElementsByTagName('a') as $node) {
        $href = $node->getAttribute( 'href' );
        // if( strpos( $href, '.png' ) || strpos( $href, '.jpg' )  || strpos( $href, '.jpeg' )  || strpos( $href, '.gif' ) ) {
            $infos = getimagesize( $href );
            if( $infos[0] > 300 && $infos[1] > 300 ) {
                $img_array = array(
                    'url' => $href,
                    'width' => $infos[0],
                    'height' => $infos[1]
                );
                $imgs[] = $img_array;
            }
        // }
    }*/

    // foreach ($dom->getElementsByTagName('img') as $node) {
    $nodes = $xpath->query("//img[contains(@src, '.jpg') or contains(@src, '.png') or contains(@src, '.gif')]");
    foreach ($nodes as $node) {

        // get link wrapping img and check if its an img
        $href = $node->parentNode->getAttribute( 'href' );
        if( ! empty( $href ) && ( strpos( $href, '.png' ) || strpos( $href, '.jpg' )  || strpos( $href, '.jpeg' )  || strpos( $href, '.gif' ) ) && ! in_array( $href, $imgs ) ) {
            $imgs[] = $href;

        // get img
        } else {

            $src = $node->getAttribute( 'src' );
            if( ! in_array( $src, $imgs ) ) {
                $infos = getimagesize($src);

                // check size
                if( $infos[0] > $size_min && $infos[1] > $size_min ) {
                    $img_array = array(
                        'url' => $src,
                        'width' => $infos[0],
                        'height' => $infos[1]
                    );
                    $imgs[] = $img_array;
                }
            }
        }
    }

    asort($imgs);
    ?>
    <div id="js-packery" class="images-wall">
        <?php foreach ($imgs as $img) { ?>
            <div class="item" data-width="<?php echo $img['width']; ?>" data-height="<?php echo $img['height']; ?>">
            <!-- <div class="thumb js-dynamic-height" data-width="<?php echo $img['width']; ?>" data-width="<?php echo $img['width']; ?>"> -->
                <?php
                echo '<img src="'.$img['url'].'" alt="" />';
                // echo '<input type="hidden" name="fon_filou[img_url][]" value="'.$img['url'].'" class="filou-img-input" />';
                ?>
                <input type="checkbox" name="fon_filou[img_url][]" value="'.$img['url'].'" class="checkbox" />
                <div class="overlay"></div>
                <div class="infos">
                    <?php echo $img['width'].'x'.$img['height']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}