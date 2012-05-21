<?php
$fon_metas = array();

if(is_singular()) {
    global $post;

    $meta_description = '';
    $meta_description = strip_tags(strip_shortcodes($post->post_content));
    $meta_description = substr(str_replace(array("\n", "\r", "\t"), ' ', $meta_description ), 0, 125);
    $fon_metas[] = array('name' => 'description', 'content' => $meta_description);

    $fon_metas[] = array('name' => 'title', 'content' => strip_tags(get_the_title($post->ID)));

    $fon_metas[] = array('property'=>'og:title','content'=> strip_tags(get_the_title()));

    $fon_metas[] = array('property'=>'og:type','content'=> 'article');

    $fon_metas[] = array('property'=>'og:url','content'=> get_permalink());

    $fon_metas[] = array('property'=>'og:site_name','content'=> get_bloginfo('name'));
} else {
    $fon_metas[] = array('name' => 'description', 'content' => get_bloginfo('name').' - '.get_bloginfo('description'));
}


echo "\n";
foreach($fon_metas as $name => $attributs){
    $meta = "\t".'<meta';
    foreach($attributs as $id => $value)
        $meta .= ' '.$id.'="'.$value.'"';
    $meta .= ' />'."\n";
    echo $meta;
}