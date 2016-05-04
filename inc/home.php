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


add_action( 'init', 'piketopine_location_init' );
function piketopine_location_init() {
	register_taxonomy(
		'location',
		'post',
		array(
			'label' => __( 'Locations' ),
			'rewrite' => array( 'slug' => 'location' ),
		)
	);
}

add_action( 'init', 'piketopine_ingreient_init' );
function piketopine_ingreient_init() {
	register_taxonomy(
		'ingredient',
		'post',
		array(
			'label' => __( 'Ingredients' ),
			'rewrite' => array( 'slug' => 'ingredient' ),
		)
	);
}
?>
