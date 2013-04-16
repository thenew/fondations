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
            'post_parent' => $post->ID 
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
