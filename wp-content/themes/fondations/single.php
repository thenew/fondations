<?php
get_header();
the_post();
?>
<div class="single-box">
    <h1 class="post-title"><?php the_title(); ?></h1>
    <div class="blabla post-content">
        <?php the_content(); ?>
    </div>
</div>
<?php
get_footer();