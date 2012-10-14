<?php
get_header(); the_post();
?>
<div class="main">
    <h1><?php the_title(); ?></h1>
    <?php get_template_part('loop','post') ?>
</div><!-- #main -->
<?php 
get_sidebar();
get_footer();