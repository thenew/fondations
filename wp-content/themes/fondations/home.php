<?php get_header(); ?>
<div class="span9">
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
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>		
                        <p><?php the_content(); ?></p>
                    </article>
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