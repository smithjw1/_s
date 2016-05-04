<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package piketopine
 */

if ( ! function_exists( 'piketopine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function piketopine_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'piketopine' ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'piketopine' ),
		esc_html( get_the_author() )
	);
  $postedOn = '<span class="byline"> ' . $byline . '</span> / <span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
  if(is_single()) {
    $postedOn .= piketopine_social_links();
  }
	echo  $postedOn;
}
endif;

function piketopine_social_links() {
  $pageURL = urlencode(get_permalink());
  $tweet = urlencode(get_post_meta ( get_the_ID(),'_yoast_wpseo_twitter-description',true ));

  $html = '<span class="social-links">Share: <a target="_blank" href="https://twitter.com/intent/tweet?via=piketopine&text='.$tweet.'&url='.$pageURL.'"><span class="icon-twitter"></span></a> <a href="javascript:FB.ui({method: \'share\',href:window.location.href}, function(response){});"><span class="icon-facebook"></span></a> <a href="https://www.pinterest.com/pin/create/button/" data-pin-custom="true"><span class="icon-pinterest"></span></a></span>';
  return $html;
}

function piketopine_combined_tags() {
  $tags = wp_get_post_terms( get_the_ID(), array('post_tag', 'location','ingredient'));
  $html = '';
  foreach($tags as $tag) {
    if($tag->taxonomy === 'post_tag') {
      $tag->taxonomy = 'tag';
    }
    $html .= '<a class="'.$tag->taxonomy.'" href="/'.$tag->taxonomy.'/'.$tag->slug.'">'.$tag->name.'</a>, ';
  }
  $html = rtrim($html, ', ');
  return $html;
}

if ( ! function_exists( 'piketopine_entry_header' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function piketopine_entry_header() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'piketopine' ) );
		if ( $categories_list && piketopine_categorized_blog() ) {
			printf( '<img class="mark" src="'.get_template_directory_uri() .'/images/ptp-mark.jpg"><span class="cat-links">' . esc_html__( 'Posted in: %1$s', 'piketopine' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'piketopine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function piketopine_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */

		/* translators: used between list items, there is a space after the comma */

    $tags_list = piketopine_combined_tags();
    print  piketopine_social_links();
		if ( $tags_list ) {
			printf('<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'piketopine' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'piketopine' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<p class="edit-link">',
		'</p>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function piketopine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'piketopine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'piketopine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so piketopine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so piketopine_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in piketopine_categorized_blog.
 */
function piketopine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'piketopine_categories' );
}
add_action( 'edit_category', 'piketopine_category_transient_flusher' );
add_action( 'save_post',     'piketopine_category_transient_flusher' );
