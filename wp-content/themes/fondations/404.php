<?php
get_header();
$param_404 = str_replace(array('?', '/', '=', '-'), ' ', strip_tags($_SERVER['REQUEST_URI']));
?>

<div class="page page-404">
    <?php if (!empty($param_404)) {
        echo '<h2 class="e404-title">'.$param_404.' ? </h2>';
        $args_404 = array(
            // 'posts_per_page' => '5',
            'post_type' => 'any',
            's' => $param_404
        );
        $q_404 = new WP_Query( $args_404 );
        if (have_posts()) : ?>
            <ul>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li>
                        <?php get_template_part('loop', 'short'); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php
        endif;
        wp_reset_postdata();
    }
    ?>
</div>

<?php
// get_sidebar();
get_footer();