<?php
register_widget('tweet_Widget');
class tweet_Widget extends WP_Widget {
    function tweet_Widget(){parent::WP_Widget(false, 'Tweet Widget');}
    

    function form($instance)
    {
        $id = $tp_twitter;
        // $id = isset( $instance['id']) && $instance['id']!= '' ? esc_attr( $instance['id'] ) : $tp_twitter;
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
?>
    <p>
        <!-- <label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php _e( 'Nom du compte : ' ); ?></label> -->
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" type="hidden" value="<?php echo get_option('tp_twitter') ?>" />
    </p>

	<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Nombre de tweets à afficher : ' ); ?></label>
	   <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
    </p>
<?php
    }
    
    function update($new_instance, $old_instance) 
    {
        return $new_instance;
        
    }
    
    function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="widget widget-tweet">';
       ?>
    
        <h3>Mes derniers tweets</h3>
            <ul id="tweet"><?php getTweets($instance['id'], $instance['number']); ?></ul>       
        
        <?php
        echo '</div>';
        echo $args['after_widget'];
    }

}
