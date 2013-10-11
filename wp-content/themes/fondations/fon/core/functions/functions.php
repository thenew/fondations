<?php

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

function fon_get_thumb_url($format = 'post-thumbnail', $post_id = null ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $format, false);
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

