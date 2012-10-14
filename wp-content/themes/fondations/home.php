<?php get_header(); ?>
<div class="home-view">
    <div class="grid grid-3-1">
        <div>
            <div class="posts-box">
                <?php
                $hargs = array(
                    'post_type'      => 'post',
                    'posts_per_page' => '3',
                    'paged'          => $paged
                    );
                query_posts($hargs);
                if(have_posts()): ?>
                <ul>
                    <?php while(have_posts()): the_post(); ?>
                    <li class="item">
                        <?php get_template_part('loop', 'short'); ?>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php 
                fon_pagination();
                endif;
                wp_reset_query(); ?>
            </div>  
        </div>
        <div>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>
<?php 
get_footer();