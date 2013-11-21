<?php get_header(); ?>
<div class="home-view">
    <div class="fon-slider-wrapper">
        <div id="fon-slider" class="cf fon-slider">
            <ul class="cf fon-slider-list">
                <li data="1"><img src="http://placehold.it/400x200/22B573/ffffff&amp;text=1 Cupcake+ipsum" alt=""></li>
                <li data="2"><img src="http://placehold.it/400x200/FF5D5D/ffffff&amp;text=2 dolor+sit" alt=""></li>
                <li data="3"><img src="http://placehold.it/400x200/BADA55/ffffff&amp;text=3 Oat+cake" alt=""></li>
                <li data="4"><img src="http://placehold.it/400x200/OFF1CE/ffffff&amp;text=4 Lipsum" alt=""></li>
            </ul>
        </div>
    </div>
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