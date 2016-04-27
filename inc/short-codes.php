<?php

add_shortcode( 'intro', 'vwh_short_intro' );
function vwh_short_intro( $atts , $content = null){
	return '<div class="intro">' . $content . '</div>';
}



?>
