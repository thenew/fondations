<?php
register_widget('social_Widget');
class social_Widget extends WP_Widget {
    function social_Widget(){parent::WP_Widget(false, 'Social Widget');}
    function form($instance){}
    function update($new_instance, $old_instance) {return $new_instance;}
    function widget($args, $instance) {
        
        echo $args['before_widget'];
        echo '<div class="widget widget-social">';
        ?>

        <h3>Suivez moi !</h3>
        <ul>
            <?php 
            if (get_option('tp_twitter'))
                echo '<li><a href="http://www.twitter.com/'.get_option('tp_twitter').'">Twitter</a></li>';
            if (get_option('tp_viadeo')) 
                echo'<li><a href="'.get_option('tp_viadeo').'">Viadeo</a></li>';
            if (get_option('tp_linkedin'))
                echo'<li><a href="'.get_option('tp_linkedin').'">LinkedIn</a></li>';
            if (get_option('tp_googleplus'))
                echo'<li><a href="'.get_option('tp_googleplus').'">Google +</a></li>';
            if (get_option('tp_facebook'))
                echo'<li><a href="'.get_option('tp_facebook').'">Facebook</a></li>';
            if (get_option('tp_youtube'))
                echo'<li><a href="'.get_option('tp_youtube').'">Youtube</a></li>'; ?>
            <li><a href="<?php bloginfo('url') ?>/feed">Flux RSS</a></li>
            <?php if (get_option('tp_myspace'))
                echo'<li><a href="'.get_option('tp_myspace').'">Myspace</a></li>'; ?>
        </ul>

        <?php
        echo '</div>';
        echo $args['after_widget'];
    }

}
