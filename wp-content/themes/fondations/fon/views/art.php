<?php get_header(); ?>
<?php
// TODO query

// Get current filter
$fon_query_route = str_replace( 'art/', '', get_query_var( 'fon_route' ) );
?>

<div class="filters-box">
    <ul class="filters">
        <?php
        $filters = array(
            'artworks' => 'Illustrations',
            'videos' => 'Vidéos'
        );
        foreach ($filters as $filter => $label) { ?>
            <li class="item <?php if( $fon_query_route == $filter ) echo 'current'; ?>"><a href="<?php echo site_url( 'art/' ) . $filter; ?>"><?php echo $label; ?></a></li>
        <?php } ?>
    </ul>
</div>

<?php if ( have_posts() ) : ?>
    <header class="archive-header">
        <h1 class="archive-title page-title"><?php
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