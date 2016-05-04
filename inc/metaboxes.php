<?php
add_filter( 'rwmb_meta_boxes', 'ptp_post_meta_boxes' );
function ptp_post_meta_boxes( $meta_boxes ) {
  $meta_boxes[] = array(
    'title'      => __( 'Homepage Feature', 'piketopine' ),
    'post_types' => 'post',
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(
      array(
        'id' => 'homepage_feature',
        'name'    => __( 'Feature on Homepage', 'piketopine' ),
        'type' => 'checkbox',
      ),
      array(
        'id' => 'homepage_copy',
        'name'    => __( 'Homepage Copy', 'piketopine' ),
        'type' => 'textarea',
      ),
    ),
  );
  return $meta_boxes;
}
 ?>
