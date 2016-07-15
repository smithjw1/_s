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
			'label' => __( 'Places' ),
			'rewrite' => array( 'slug' => 'places' ),
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

add_action('init', 'piketopine_renameCategory');
function piketopine_renameCategory() {
    global $wp_taxonomies;
		$labels = array(
        'name'                       => _x( 'Types', 'Taxonomy General Name', 'dc' ),
        'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'dc' ),
        'menu_name'                  => __( 'Types', 'dc' ),
        'all_items'                  => __( 'Types', 'dc' ),
        'parent_item'                => __( 'Parent Type', 'dc' ),
        'parent_item_colon'          => __( 'Parent Type:', 'dc' ),
        'new_item_name'              => __( 'New Type', 'dc' ),
        'add_new_item'               => __( 'Add New Type', 'dc' ),
        'edit_item'                  => __( 'Edit Type', 'dc' ),
        'update_item'                => __( 'Update Type', 'dc' ),
        'separate_items_with_commas' => __( 'Separate types with commas', 'dc' ),
        'search_items'               => __( 'Search Types', 'dc' ),
        'add_or_remove_items'        => __( 'Add or remove types', 'dc' ),
        'choose_from_most_used'      => __( 'Choose from the most used types', 'dc' ),
        'not_found'                  => __( 'Not Found', 'dc' ),
    );
		$labelObj = (object) $labels;
		$wp_taxonomies['category']->labels = $labelObj;
}
?>
