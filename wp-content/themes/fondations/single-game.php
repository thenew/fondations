<?php
get_header();
the_post();
$post_id = get_the_id();
$cover_id = (int) get_post_meta( $post_id, 'fon_cover_fr', 1 );
$cover = wp_get_attachment_url( $cover_id );
?>
<div class="single-game-view single-box">

    <ul class="cf">
        <?php
        $medias = fon_get_attachments( $post_id, array('thumbnail', 'full'), array($cover_id) );
        foreach ($medias as $media) {
            ?>
            <div class="wove" style="float: left; width:<?php echo $media['thumbnail']['width']; ?>px; height:<?php echo $media['thumbnail']['height']; ?>px;">
                <img src="<?php echo $media['thumbnail']['src']; ?>" alt="<?php echo $media['alt']; ?>" />
            </div>
            <?php
        }
        ?>
    </ul>

    <h1 class="post-title"><?php the_title(); ?></h1>
    <div class="thumb wove cover"><img src="<?php echo $cover; ?>" /></div>
    <div class="thumb wove"><img src="<?php echo fon_get_thumb_url( 'full' ); ?>" /></div>
    <div class="blabla post-content">
        <?php the_content(); ?>
    </div>


</div>
<?php
get_footer();