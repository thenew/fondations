<?php
// Permet de rendre les liens cliquables
function getTwitterLinks($text)
{
    $search = array('|(http://[^ ]+)|', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i','/(^|[^a-z0-9_])#([a-z0-9_]+)/i');
    $replace = array('<a href="$1" class="lienvrai">$1</a>', '$1@<a href="http://twitter.com/$2">$2</a>','$1<a href="http://twitter.com/#search?q=%23$2">#$2</a>');
    $text = preg_replace($search, $replace, $text);
    return $text;
}

function getTweets($login, $nbTweets)
{    
    $data = file_get_contents('http://www.twitter.com/statuses/user_timeline.json?screen_name='.$login.'&count='.$nbTweets);   
    $tweets = json_decode($data);
    foreach ($tweets as $status)
    {
        echo '<li><img src="'.$status->user->profile_image_url.'" /> - ' . getTwitterLinks($status->text) .' - '.$status->created_at.' <a href="https://twitter.com/intent/retweet?tweet_id='.$status->id_str.'">Retwitter</a></li>';
    }
}

add_action('wp_footer', 'getTwitterLinks');
