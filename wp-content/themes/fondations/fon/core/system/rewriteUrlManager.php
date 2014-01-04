<?php
// Dédicace https://github.com/lesintegristes/wp-github-sync/blob/master/github-sync.php

// Add a new rewrite rule.
// This new rewrite rule should redirect to an existing file.
// We use index.php with a query var.
add_filter( 'rewrite_rules_array', function($rules) use($wp_rewrite) {
    global $fon_routes;
    $new_routes = array();
    foreach ( $fon_routes as $route => $action ) {
        $new_routes['^'.$route.'\/?$'] = 'index.php?fon_route=' . $route .'&fon_action=' . $action;
    }
    return $new_routes + $rules;
} );

// But this query var is not valid, we need to add it manually.
add_filter( 'query_vars', function($qvars) {
    $qvars[] = 'fon_route';
    $qvars[] = 'fon_action';
    return $qvars;
});

// And we finally intercept the request, based on the query.
add_action( 'template_redirect', function(){
    global $fon_routes;
    $fon_query_action = get_query_var( 'fon_action' );
    if( empty( $fon_query_action ) || ! array_key_exists( $fon_query_action, $fon_routes ) )
        return;

    require_once( FON_PATH . '/views/' . $fon_routes[$fon_query_action] . '.php' );
    die();
} );





// Menu

add_action( 'fon_menu_hook', 'fon_menu_rewrite_rules' );

function fon_menu_rewrite_rules() {
    ?>
    <h3>Permaliens</h3>
    <?php
    global $fon_routes;
    $routes = '';
    foreach ($fon_routes as $route => $action) {
        // $routes .= $route . ' => ' . $action . "\n" ;
        $routes .= $route . ' => views/' . $route . '.php' . "\n" ;
    }
    ?>
    <textarea cols="30" rows="3"><?php echo $routes; ?></textarea>
    <?php

}
