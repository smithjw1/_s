<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package piketopine
 */
 $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);
?>

<article id="feature-<?php the_ID(); ?>" <?php post_class(); ?> style="background-image: url(<?php echo $thumb_url[0]; ?>)">
	<div class="holds-mobile-image">
		<img src="<?php echo $thumb_url[0]; ?>">
	</div>
	<div class="entry-content home-feature">
    <h2><?php the_title() ?></h2>
    <p><?php echo rwmb_meta('homepage_copy'); ?></p>
    <a href="<?php the_permalink()?>" class="button">Read More</a>
      <?php piketopine_posted_on(); ?>
	</div><!-- .entry-content -->
  <div class="shade"></div>
</article><!-- #post-## -->
