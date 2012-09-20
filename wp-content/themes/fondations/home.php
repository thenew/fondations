<?php get_header(); ?>
<div class="home-view">
    <div class="logo">
        <h1>Fondations</h1>
    </div>
</div>
<div class="span9">
    <input type="text">
    <?php
    $args = array(
        'post_type'     => 'post',
        'paged'         => $paged
    );
    query_posts($args);
    if(have_posts()) : ?>
        <ul>
            <?php $i = 0;
            while (have_posts()) : the_post(); ?>
                <li class="item-<?php echo $i; ?>">
                    <?php get_template_part('loop', 'short'); ?>
                </li>
                <?php $i++;
            endwhile; ?>
        </ul>
        <?php 
        fon_pagination();
    endif;
    wp_reset_query(); ?>
</div>
<div class="span3">
    <?php get_sidebar(); ?>
</div>
<?php 
get_footer();