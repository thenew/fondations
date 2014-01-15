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
add_action( 'fon_menu_filou_hook', 'fon_filou_page_notice', 9 );

function fon_filou_page_notice(  ) {
    do_action( 'fon_filou_set_notice' );
}

function fon_filou_page() {

    fon_filou_save();

    $url = ( isset($_POST['filou']) && isset($_POST['filou']['url']) ) ? $_POST['filou']['url'] : '';
    $size_min = ( isset($_POST['filou']) && isset($_POST['filou']['size_min']) ) ? $_POST['filou']['size_min'] : 300;
    ?>

    <form id="filou_form" name="filou" class="" action="" method="POST">
        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="filou_size_min">Dimensions min.</label></th>
                <td><input type="range" name="filou[size_min]" min="0" max="1400" step="100" value="<?php echo $size_min; ?>" id="filou_size_min" class="input-range"/><span class="input-range-value"><span class="value"><?php echo $size_min; ?></span>px</span></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">URL</label></th>
                <td>
                    <input type="url" name="filou[url]" value="<?php echo $url; ?>" tabindex="1" />
                    <p class="description">http://www.kickstarter.com/projects/rain-world/project-rain-world</p>
                </td>
            </tr>
        </tbody></table>
        <p class="submit">
            <button name="fon-form-submit" id="fon-form-submit" class="button-primary"><?php echo __('Importe p’tit filou', 'fon'); ?></button>
        </p>
    </form>
    <?php

    fon_filou_parsing( $url, array( 'size_min' => (int) $size_min ) );

}

function fon_filou_parsing( $url = '', $args = array() ) {

    if( empty( $url ) ) return;
    // args
    if( ! isset( $args['size_min'] ) || ! is_int( $args['size_min'] ) ) {
        $args['size_min'] = 300;
    }
    $size_min = $args['size_min'];

    $imgs_url = array();
    $imgs = array();

    // curl
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($curl);
    curl_close($curl);

    // parsing
    $dom = new DOMDocument();
    libxml_use_internal_errors( true );
    $dom->loadHTML( $html );
    $xpath = new DOMXPath( $dom );

    $nodes = $xpath->query( "//img[contains(@src, '.jpg') or contains(@src, '.png') or contains(@src, '.gif')]" );

    foreach ($nodes as $node) {

        // get link wrapping img and check if its an img
        $href = $node->parentNode->getAttribute( 'href' );
            $href = rel2abs( $href, $url );
        if( ! empty( $href ) && ( strpos( $href, '.png' ) || strpos( $href, '.jpg' )  || strpos( $href, '.jpeg' )  || strpos( $href, '.gif' ) ) && ! in_array( $href, $imgs_url ) ) {
            $imgs_url[] = $href;

        // get img
        } else {

            $src = $node->getAttribute( 'src' );
            $src = rel2abs( $src, $url );
            if( ! in_array( $src, $imgs_url ) ) {
                $imgs_url[] = $src;
            }
        }
    }


    set_time_limit(30);



    // check size
    foreach ($imgs_url as $url) {
        list( $width, $height, $type, $attr ) = getimagesize( $url );

        if( $width && $height && $width > $size_min && $height > $size_min ) {
            $img_array = array(
                'url' => $url,
                'width' => $width,
                'height' => $height
            );
            $imgs[] = $img_array;
        }
    }

    asort($imgs);


    // FORM SAVE
    ?>
    <form class="" name="" action="" method="POST">
        <div id="js-packery" class="images-wall">
            <?php foreach ( $imgs as $img ) { ?>
                <div class="item" data-width="<?php echo $img['width']; ?>" data-height="<?php echo $img['height']; ?>">
                <!-- <div class="thumb js-dynamic-height" data-width="<?php echo $img['width']; ?>" data-width="<?php echo $img['width']; ?>"> -->
                    <?php
                    echo '<img src="'.$img['url'].'" alt="" />';
                    // echo '<input type="hidden" name="filou[img_url][]" value="'.$img['url'].'" class="filou-img-input" />';
                    ?>
                    <input type="checkbox" name="filou_imgs[]" value="<?php echo $img['url']; ?>" class="checkbox" />
                    <div class="overlay"></div>
                    <div class="infos">
                        <?php echo $img['width'].'x'.$img['height']; ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="filou[post_parent]">Jeu</label></th>
                <td>
                    <select name="filou[post_parent]" id="filou[post_parent]">
                        <option value="">Aucun</option>
                        <?php
                        $game_args = array(
                            'post_type' => 'game',
                            'posts_per_page' => 5
                        );
                        $games = get_posts( $game_args );
                        foreach ($games as $game) {
                            echo '<option value="'.$game->post_id.'">'.$game->post_title.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="filou[post_title]">Nouveau jeu : titre</label></th>
                <td><input type="text" name="filou[post_title]" id="filou[post_title]" value="" /></td>
            </tr>
        </tbody></table>
        <p class="submit">
            <button name="fon-form-submit" id="filou[submit]" class="button-primary"><?php echo __('Enregistrer', 'fon'); ?></button>
        </p>
    </form>
    <?php
}


function fon_filou_save() {

    if( ! isset( $_POST['filou_imgs'] ) || empty( $_POST['filou_imgs'] ) ) return;

    $imgs = $_POST[filou_imgs];
    var_dump($imgs);
    die;

}

function rel2abs($rel, $base) {
    /* return if already absolute URL */
    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;

    /* queries and anchors */
    if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;

    /* parse base URL and convert to local variables:
       $scheme, $host, $path */
    extract(parse_url($base));

    /* remove non-directory element from path */
    $path = preg_replace('#/[^/]*$#', '', $path);

    /* destroy path if relative url points to root */
    if ($rel[0] == '/') $path = '';

    /* dirty absolute URL */
    $abs = "$host$path/$rel";

    /* replace '//' or '/./' or '/foo/../' with '/' */
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

    /* absolute URL is ready! */
    return $scheme.'://'.$abs;
}