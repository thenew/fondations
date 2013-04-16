<?php
global $fon_views;
$fon_views = array(
    'cv' => 'CV'
);

/* Add a custom URL */

// First step: flush rewrite rules on activation!
register_activation_hook(__FILE__, function(){
    flush_rewrite_rules(FALSE);
});

// Second step: now we add a new rewrite rule.
// This new rewrite rule should redirect to an existing file.
// We use index.php with a query var.
add_filter('rewrite_rules_array', function($rules) use($wp_rewrite) {
    global $fon_views;
    $new_rules = array();
    foreach ($fon_views as $slug => $value) {
        $new_rules['^'.$value.'\/?$'] = 'index.php?fon_view='.$slug;
    }
    return $new_rules + $rules;
});

// But this query var is not valid, we need to add it manually.
add_filter('query_vars', function($qvars) {
    $qvars[] = 'fon_view';
    return $qvars;
});

// And we finally intercept the request, based on the query.
add_action('template_redirect', function(){
    global $fon_views;
    foreach ($fon_views as $slug => $value) {
        if (get_query_var('fon_view') == $slug) {
            include FON_PATH.'/views/'.$slug.'.php';
            die;
        }
    }
});
