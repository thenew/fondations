<?php
global $fon_routes;

foreach (glob(FON_PATH.'/views/*.php') as $file) {
    // $fonBase = new Fon_Base_Class();
    // $fon_views_routes[$filename] = $fonBase->beautify($filename);
    $filename = basename($file, '.php');
    $fon_views_routes[$filename] = $filename;
}

$fon_custom_routes = array(
    // URL => views
    'art/artworks' => 'art',
    'art/videos' => 'art'
);

$fon_routes = $fon_views_routes + $fon_custom_routes;