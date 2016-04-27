<?php
/**
 * _s functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! function_exists( 'piketopine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function piketopine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change piketopine to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'piketopine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'social' => esc_html__( 'Social', 'piketopine' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'video',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'piketopine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'piketopine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function piketopine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'piketopine_content_width', 640 );
}
add_action( 'after_setup_theme', 'piketopine_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function piketopine_scripts() {
  wp_enqueue_style( 'juicycafe-style', get_template_directory_uri() . '/style.min.css', array(), '1.0.2');
  wp_enqueue_script ('juicycafe-script', get_template_directory_uri() . '/js/dist/scripts.min.js',array(), '1.0.2', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'piketopine_scripts' );

// initialize theme plugins
foreach (array(
  'custom-header',
  'template-tags',
  'extras',
  'customizer',
  'jetpack',
  'abn_basic',
  'home',
  'short-codes'
) as $plugin) {
 require_once(get_template_directory().'/inc/'.$plugin.'.php');
}

function ptp_get_header_image() {
  if(has_post_thumbnail()) {
    $customHeader = wp_get_attachment_image_src( get_post_thumbnail_id(), array(2000, 500) );
    return $customHeader[0];
  }
  else {
    return false;
  }
}
