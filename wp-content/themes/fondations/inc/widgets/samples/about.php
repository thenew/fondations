<?php
// TODO BUG
// [19-Sep-2012 09:34:41] PHP Fatal error:  Class 'about_widget' not found in /wp-includes/widgets.php on line 324

class about_widget extends WP_Widget {
    function about_widget(){parent::WP_Widget(false, 'About Widget');}
    function form($instance){}
    function update($new_instance, $old_instance) {return $new_instance;}
    function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="widget">';
        ?>
        <h3>Pr&eacute;sentation</h3>
        <?php 
        $photo = fon_get_attachment(FORMATION_PAGEID, 'portrait');
        ?>
        <div class="cf">
            <div id="photo_profile">
                <img src="http://findicons.com/files/icons/2109/inside/128/icontexto_inside_google.png" </img>
            </div>

            <div>
                <div>
                    <strong><?php echo get_option('tp_firstname').' '.get_option('tp_name'); ?></strong>
                </div>
                <div>
                    <a href="<?php echo get_option('tp_website'); ?>"><?php echo get_option('tp_website'); ?></a>
                </div>
                <strong>Quelques mots</strong>
                <p>
                    <?php echo get_option('tp_description'); ?>
                </p>
            </div>
        </div>
        <?php //TODO non fonctionnel ?>
        <a class="big-button-reseau" href="http://www.cifacom-reseau.com/membre/<?php echo get_option('tp_firstname').'-'.get_option('tp_name'); ?>">
            <strong>Voir mon profil</strong>
            sur cifacom-reseau.com
        </a>
        <?php if (get_option('tp_email') != ''): ?>
            <a class="big-button-mail" href="#">
                <strong>Contactez-moi</strong>
                <?php echo get_option('tp_email'); ?>
            </a>
        <?php endif; ?>

        <?php
        echo '</div>';
        echo $args['after_widget'];
    }
}