<?php
$param_404 = str_replace(array('?', '/', '=', '-'), ' ', strip_tags($_SERVER['REQUEST_URI']));

get_header();
echo '<div class="page">';
    echo '<h1>' . __('404 Page not found', 'fon_lang') . '</h1>';
    if (!empty($param_404)) {
        $args_404 = array(
            // 'posts_per_page' => '5',
            // 'post_type' => 'any',
            's' => $param_404
        ));
        $q_404 = new WP_Query( $args_404 );
        if (have_posts()) :
            echo '<h2>'.$param_404.'</h2>';
            echo '<ul>';
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    echo '<li>';
                    get_template_part('loop', 'short');
                    echo '</li>';
                endwhile;
            echo '</ul>';
        endif;
        wp_reset_postdata();
    }
echo '</div>';
get_sidebar();
get_footer();