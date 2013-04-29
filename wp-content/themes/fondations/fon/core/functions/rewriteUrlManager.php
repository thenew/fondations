<?php
// Dédicace https://github.com/lesintegristes/wp-github-sync/blob/master/github-sync.php

global $fon_routes;

foreach (glob(FON_PATH.'/views/*.php') as $file) {
    $filename = basename($file, '.php');
    $fonBase = new Fon_Base_Class();
    $fon_routes[$filename] = $fonBase->beautify($filename);
}

/* Add a custom URL */

// First step: flush rewrite rules on activation!
register_activation_hook(__FILE__, function(){
    flush_rewrite_rules(FALSE);
});

// Second step: now we add a new rewrite rule.
// This new rewrite rule should redirect to an existing file.
// We use index.php with a query var.
add_filter('rewrite_rules_array', function($rules) use($wp_rewrite) {
    global $fon_routes;
    foreach ($fon_routes as $route => $action) {
    $new_routes = array('^'.$route.'\/?$' => 'index.php?fon_action='.$action);
    }
    return $new_routes + $rules;
});

// But this query var is not valid, we need to add it manually.
add_filter('query_vars', function($qvars) {
    $qvars[] = 'fon_action';
    return $qvars;
});

// And we finally intercept the request, based on the query.
add_action('template_redirect', function(){
    global $fon_routes;
    $fon_query_action = get_query_var('fon_action');
    if(empty($fon_query_action)) return;
    if(!array_key_exists(get_query_var('fon_action'), $fon_routes)) return;
    require_once(FON_PATH.'/views/'.$fon_routes[get_query_var('fon_action')].'.php');
    die();
});