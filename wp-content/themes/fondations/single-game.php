<?php
get_header();
the_post();
$post_id = get_the_id();
$cover = wp_get_attachment_url( get_post_meta( $post_id, 'fon_cover_fr', 1 ) );
?>
<div class="single-game-view single-box">
    <h1 class="post-title"><?php the_title(); ?></h1>
    <div class="thumb wove cover"><img src="<?php echo $cover; ?>" /></div>
    <div class="thumb wove"><img src="<?php echo fon_get_thumb_url( 'full' ); ?>" /></div>
    <div class="blabla post-content">
        <?php the_content(); ?>
    </div>
</div>
<?php
get_footer();