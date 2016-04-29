<?php

add_filter( 'rwmb_meta_boxes', 'ptp_home_meta_boxes' );
function ptp_home_meta_boxes( $meta_boxes ) {
  $meta_boxes[] = array(
    'title'      => __( 'Author Intro', 'piketopine' ),
    'post_types' => 'page',
    'include' => array('slug' => 'home'),
    'fields' => array(
      array(
        'id' => 'author_intro_headline',
        'name'    => __( 'Headline', 'piketopine' ),
        'type' => 'text',
      ),
      array(
        'id' => 'author_intro_content',
        'name'    => __( 'Content', 'piketopine' ),
        'type' => 'wysiwyg',
      ),
    ),
  );
  return $meta_boxes;
}
?>
