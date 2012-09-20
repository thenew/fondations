<?php
global $fon_widgets;
$widget_args = array(
    'before_widget' => '<li class="widget">',
    'after_widget' => '</li>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
);
// TODO dynamic sidebar
?>
<aside class="main-sidebar">
    <ul>
        <?php
        foreach ($fon_widgets as $wdg) {
            the_widget($wdg, '', $widget_args);
        }
        ?>
    </ul>
</aside>