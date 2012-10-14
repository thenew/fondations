<?php
if(have_posts()):
?>
    <ul>
        <?php
        while(have_posts()): the_post();
            echo '<li>';
                get_template_part('loop','short');
            echo '</li>';
        endwhile;
        wp_reset_query();
        ?>
    </ul>
<?php 
else:

endif;