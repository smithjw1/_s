<?php

add_shortcode( 'intro', 'vwh_short_intro' );
function vwh_short_intro( $atts , $content = null){
	return '<p class="intro">' . $content . '</p>';
}

add_shortcode( 'tweet-this', 'vwh_short_tweetThis' );
function vwh_short_tweetThis( $atts , $content = null){
  $pageURL = urlencode(get_permalink());
  $tweet = urlencode($content);
  $tweetLink = '<a target="_blank" href="https://twitter.com/intent/tweet?via=piketopine&text='.$tweet.'&url='.$pageURL.'"><span class="icon-twitter"></span> Tweet This</a>';
	return '<blockquote class="tweet-this">' . $content . $tweetLink . '</blockquote>';
}


?>
