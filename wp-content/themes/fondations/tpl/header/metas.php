<?php
global $post;
if(is_singular()) {
    $title = get_the_title();
    $description = strip_tags(strip_shortcodes($post->post_content));
    $url = get_permalink();
} else {
    $title = wp_title('-', 0);
    $description = get_bloginfo('description');
    $url = site_url();
}
$image = TEMPLATE_URL.'/screenshot.png';
$name = get_bloginfo('name');

?>

<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $description ?>" />

<?php // Twitter ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="<?php echo FON_TWITTER_SITE ?>">
<meta name="twitter:creator" content="<?php echo FON_TWITTER_CREATOR ?>">
<meta name="twitter:title" content="<?php echo $title ?>">
<meta name="twitter:description" content="<?php echo $description ?>">
<meta name="twitter:image" content="<?php echo $image ?>">

<?php // Open Graph ?>
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="<?php echo $name ?>" />
<meta property="og:url" content="<?php echo $url ?>" />
<meta property="og:image" content="<?php echo $image ?>" />
