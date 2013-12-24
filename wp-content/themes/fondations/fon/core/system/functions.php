<?php

function fon_slugify( $text ) {
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if ( empty( $text) ) {
    return 'n-a';
  }

  return $text;
}

// AJAX search TEST non utilisé parce que le retour ne s'affiche pas
function fon_toto($query){
    if(is_admin() || !$query->is_main_query() || !$query->get('s'))
        return $query;
    // var_dump($query->get('s'));
    // var_dump($_GET);
    $posts = query_posts($query);
    $response = array();
    foreach ($posts as $post) {
        array_push($response, $post->post_title);
    }
    // var_dump($response);
    echo $reponse;
    die;
}
// add_action('pre_get_posts', 'fon_toto');


function fon_pagination(){
  global $wp_query;
  $total_pages = $wp_query->max_num_pages;
  if($total_pages > 1){
    $current_page = max(1, get_query_var('paged'));

    echo '<div class="cssn_pagination fon-pagination">';
      echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'current' => $current_page,
        'total' => $total_pages,
        'type' => 'list',
        'prev_text' => __('Prev'),
        'next_text' => __('Next')
      ));
    echo '</div>';
  }
}

function fon_get_attachment($page_id, $format) {
    query_posts('post_type=page&p='.$page_id);
    while (have_posts()) : the_post();
        $args = array(
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_status' => null,
            'post_parent' => get_the_ID()
        );
        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $attachment) {
                return wp_get_attachment_image($attachment->ID, $format);
            }
        }
    endwhile;
    wp_reset_query();
}

/**
 * Get thumbnail
 * @param  string $format
 * @param  int    $post_id
 * @return array
 */
function fon_get_thumb( $format = 'post-thumbnail', $post_id = null ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $format, false );
    return $thumb;
}

/**
 * Get thumbnail url
 * @param  string $format
 * @param  int    $post_id
 * @return string
 */
function fon_get_thumb_url( $format = 'post-thumbnail', $post_id = null ) {
    $thumb = fon_get_thumb( $format, $post_id );
    return $thumb[0];
}


function fon_upload_files($imgs) {
    if(!is_array($imgs)) return;
    foreach ($imgs as $img) {
        if(!isset($img['tmp_name'])) return;
        $file = trim($img['tmp_name']);
        $img_content = file_get_contents($file);

        if (isset($img['name']))
            $img_name = uniqid().'_'.$img['name'];
        else
            $img_name = basename($file);

        $img_name_info = pathinfo($img['name']);
        $img_title = str_replace( array("-", "_"), " ", $img_name_info['filename'] );

        $upload_dir = wp_upload_dir();
        $upload_dir = $upload_dir["basedir"]."/fon/";

        // uploads directory
        if(!is_dir($upload_dir))
            @mkdir($upload_dir);
        @chmod($upload_dir, 0777);
        $filename = $upload_dir.$img_name;
        if(!file_exists($filename)) {
            if(file_put_contents($filename, $img_content)) {

                // insert attachment
                $wp_filetype = wp_check_filetype( basename($filename), null );
                $wp_upload_dir = wp_upload_dir();
                $img_guid = $wp_upload_dir['baseurl'] . '/fon/' . basename( $filename );
                $attachment = array(
                    'guid' => $img_guid,
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => $img_title,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $filename);
                // you must first include the image.php file
                // for the function wp_generate_attachment_metadata() to work
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                wp_update_attachment_metadata($attach_id, $attach_data);

                return $img_guid;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

/**
 * Get post by slug or id
 * @param  string|int $post_name slug or id
 * @return post
 */
function fon_get_post_by_postname( $post_name ) {
    if( !is_numeric( $post_name ) ) {
        $postname_args = array(
            'name'           => $post_name,
            'post_type'      => 'any',
            'post_status'    => 'any',
            'posts_per_page' => 1
        );
        $postname_posts = get_posts( $postname_args );
        if( $postname_posts ) {
            $post = $postname_posts[0];
        }

    }
    elseif( is_numeric($post_name) ) {
        $post = get_post( (int)$post_name );
    }

    return $post;
}


// WP Menu

/**
 * get WP Menu
 * @param  string $location
 * @return [type] $menu
 */
function fon_get_wp_menu( $location ) {
    if(!$location) return;

    $locations = get_nav_menu_locations();
    if(empty($locations[$location])) return;

    $menu_id = $locations[$location];

    $menu = wp_get_nav_menu_items($menu_id);

    return $menu;
}

/**
 * display WP Menu in HTML list
 * @param  string $location
 * @param  boolean $echo echo or return
 * @return string HTML template
 */
function fon_wp_menu( $location, $echo = true ) {
    $tpl = '<ul>';
    $menu = fon_get_wp_menu( $location );
    foreach ($menu as $item) {
        $tpl .= '<li><a href="'.$item->url.'" >'.$item->title.'</a></li>';
    }
    $tpl .= '</ul>';

    if ( $echo ) {
        echo $tpl;
    } else {
        return $tpl;
    }
}

function fon_get_wp_menu_title( $menu_item ){
    switch( $menu_item->type ){
        case 'taxonomy':
            $title = $menu_item->title;
            break;

        case 'post_type':
            $title = get_the_title( $menu_item->object_id );
            break;

        default :
            $title = $menu_item->title;
            break;
    }
    return $title;
}

/**
 * Get WP Menu(s) by id
 * @param  int|array $ids
 * @return object
 */
function fon_get_wp_menu_by_id( $ids ) {
    if ( ! is_array( $ids ) ) {
        $ids = array( $ids );
    }

    foreach ( $ids as $id ) {
        $menu = array();
        $menu_id = get_post_meta( $id, '_menu_item_object_id', 1 );
        $menu_object = get_post_meta( $id, '_menu_item_object', 1 );
        $menu_type = get_post_meta( $id, '_menu_item_type', 1 );
        if ( 'taxonomy' == $menu_type ) {
            $menu_object = get_term_by( 'id', $menu_id, $menu_object );
            $menu['id'] = $menu_object->term_id;
            $menu['title'] = $menu_object->name;
        } else if ( 'post_type' == $menu_type || 'custom' == $menu_type ) {
            $menu_object = get_post( $menu_id );
            $menu['id'] = $menu_object->ID;
            $menu['title'] = get_the_title( $menu_object->ID );
        } else {
            continue;
        }
        $menu['object'] = $menu_object;
        $menus[] = $menu;
    }
    if ( count( $menus ) < 2 ) {
        return $menus[0];
    } else {
        return $menus;
    }
}
