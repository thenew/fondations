<?php
if(isset($_GET["ajax"]) && "1" == $_GET["ajax"]) {
    $response = array();
    if(have_posts()):
        $i = 0;
        $response['posts'] = array();
        while(have_posts()): the_post();
            $response['posts'][$i]['title'] = get_the_title();
            $response['posts'][$i]['permalink'] = get_permalink();
            $i++;
        endwhile;
    else:
        $response['error'] = "no results";
    endif;
    echo json_encode($response);
} else {
    get_header();
    require_once TEMPLATE_PATH.'/tpl/posts.php';
    get_footer();
}
