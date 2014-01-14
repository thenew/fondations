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

    $url = $_POST['fon_filou']['url'];
    ?>

    <form id="fon_filou_form" class="cssn_form float_form" action="" method="POST">
        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">URL</label></th>
                <td><input type="url" name="fon_filou[url]" value="<?php echo $url; ?>" /></td>
            </tr>
        </tbody></table>
    </form>
    <?php

    fon_filou_parsing( $url );

}

function fon_filou_parsing( $url = '' ) {

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

    $nodes = $xpath->query("//a[contains(@href, 'http') and ( contains(@href, '.jpg') or contains(@href, '.png') )]");
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
    }

    // foreach ($dom->getElementsByTagName('img') as $node) {
    $nodes = $xpath->query("//img[contains(@src, '.jpg') or contains(@src, '.png')]");
    foreach ($nodes as $node) {
        // $href = $node->parentNode->getAttribute( 'href' );
        // if( strpos( $href, '.png' ) || strpos( $href, '.jpg' )  || strpos( $href, '.jpeg' )  || strpos( $href, '.gif' ) ) {
        //     if( ! in_array( $href, $imgs ) ) {
        //         $imgs[] = $href;
        //     }
        // }

        $src = $node->getAttribute( 'src' );
        if( ! in_array( $src, $imgs ) ) {
            $infos = getimagesize($src);
            // if( strpos( $src, '.png' ) || strpos( $src, '.jpg' )  || strpos( $src, '.jpeg' )  || strpos( $src, '.gif' ) ) {
                if( $infos[0] > 300 && $infos[1] > 300 ) {
                    $img_array = array(
                        'url' => $src,
                        'width' => $infos[0],
                        'height' => $infos[1]
                    );
                    $imgs[] = $img_array;
                }
            // }
        }
    }

    asort($imgs);
    ?>
    <div id="js-packery">
        <?php foreach ($imgs as $img) { ?>
            <div class="item">
                <?php
                echo '<img width="250" src="'.$img['url'].'" alt="" />';
                // echo $img['width'].'x'.$img['height'];
                echo '<input type="hidden" name="fon_filou[img_url][]" value="'.$img['url'].'" class="filou-img-input" />';
                ?>
            </div>
        <?php } ?>
    </div>
    <?php
}