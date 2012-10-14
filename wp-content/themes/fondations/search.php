<?php
if(isset($_GET["ajax"]) && "1" == $_GET["ajax"]) {
    if(have_posts()):
        $response = '{"posts": [';
        $i = 0;
        while(have_posts()): the_post();
            if($i > 0) $response .= ',';
            $response .= '{
                "title": "'.get_the_title().'",
                "permalink": "'.get_permalink().'"
            }';
            $i++;
        endwhile;
        $response .= ']}';
    else:
        $response = '{"error": "No posts"}';
    endif;
    echo $response;
} else {
    get_header();
    require_once TEMPLATE_PATH.'/tpl/posts.php';
    get_footer();
}
