<?php
register_widget('coupsdecoeur_Widget');
class coupsdecoeur_Widget extends WP_Widget {
    function coupsdecoeur_Widget(){parent::WP_Widget(false, 'Coups de Coeur Widget');}
    function form($instance){}
    function update($new_instance, $old_instance) {return $new_instance;}
    function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="widget widget-coupsdecoeur">';
        ?>
<h3>Mes coups de coeur</h3> 
        
<?php
    $bookmarks = get_bookmarks( array(
     'orderby'        => 'name',
     'order'          => 'ASC'
     ));

     // Loop through each bookmark and print formatted output
     //var_dump($bookmarks);
     foreach ( $bookmarks as $bm ) {
     echo '<a href="'.$bm->link_url.'"';
     echo $bm->link_target == '_blank' ? ' target="_blank"' : '';
     echo '>'.$bm->link_name.'</a>';
     if($bm->link_rss) echo '&nbsp;<a href="'.$bm->link_rss.'">[Flux Rss]</a>';  //si le flux rss est renseigné
     echo '<br/>';
     }
?>
      

        <?php
        echo '</div>';
        echo $args['after_widget'];
    }

}
