<?php
// Check des mots clés contenus dans l'url, et lancement d'une recherche sur ce terme.
$requete_recherche = str_replace(array('?', '/', '=', '-'), ' ', strip_tags($_SERVER['REQUEST_URI']));

get_header();
echo '<div id="content">';
echo '<h2>' . __('Page non trouv&eacute;e', 'fon_lang') . '</h2>';
if (!empty($requete_recherche)) {
    query_posts(array(
        'posts_per_page' => '5',
        'post_type' => 'any',
        's' => $requete_recherche
    ));
    if (have_posts()) :
        echo '<p>' . __('Voici quelques résultats de recherche pour :', 'fon_lang') . $requete_recherche . '</p>';
        while (have_posts()) : the_post();
            get_template_part('loop', 'short');
        endwhile;
    endif;
    wp_reset_query();
}

echo '</div>';
get_sidebar();
get_footer();