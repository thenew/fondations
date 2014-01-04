<?php get_header(); ?>

<!-- <div class="page-title">Archives</div> -->

    <?php if ( have_posts() ) : ?>
        <header class="archive-header">
            <h1 class="archive-title"><?php
                if ( is_day() ) :
                    printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
                elseif ( is_month() ) :
                    printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
                elseif ( is_year() ) :
                    printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
                else :
                    _e( 'Archives', 'twentythirteen' );
                endif;
            ?></h1>
        </header>

        <ul class="cf games-list">
            <?php while ( have_posts() ) : the_post();
                $thumb = fon_get_thumb();
                // width & height
                $thumb_url = $thumb[0];
                ?>
                <li class="item">
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-short' ); ?>>
                        <div class="thumb post-thumbnail">
                            <img src="<?php echo $thumb_url; ?>" alt="<?php the_title_attribute(); ?>" />
                        </div>
                        <!-- <div class="post-texts">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="post-metas">
                                <span class="post-author"><?php the_author(); ?></span>
                                <span class="post-date"><?php the_date(); ?></span>
                                <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div> -->
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php fon_pagination(); ?>

    <?php else : ?>
        <div class="no-content"><?php echo __('Aucun Contenu', 'fondations'); ?></div>
    <?php endif; ?>

<?php
get_footer();