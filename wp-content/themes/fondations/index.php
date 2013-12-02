<?php get_header(); ?>
<div class="home-view">
    <div class="fon-slider-wrapper">
        <ul id="fon-slider" class="cf fon-slider">
            <!-- <ul class="cf fon-slider-list"> -->
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder1.png" alt=""></li>
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder2.png" alt=""></li>
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder3.png" alt=""></li>
            <!-- </ul> -->
        </ul>
        <!-- <div class="fon-slider-gallery">
            <ul class="cf fon-slider-list">
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder1.png" alt=""></li>
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder2.png" alt=""></li>
                <li><img src="<?php echo ASSETS_URL; ?>/img/temp/placeholder3.png" alt=""></li>
            </ul>
        </div> -->
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