<?php
/**
 * Template part for displaying post excertps.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package piketopine
 */
 global $i;
 if($i <= 2) {
   $class = 'excerpt large';
   $imageSize = 'medium';
 }
 else {
   $class = 'excerpt';
   $imageSize = 'thumbnail';
 }
?>

<a href="<?php echo the_permalink() ?>" class="<?php echo $class ?>"><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if(get_post_format() === 'video') {
    echo wp_oembed_get(get_the_content(''));
  }
  else {
    the_post_thumbnail($imageSize);
  }
  ?>
  <h3><?php the_title() ?></h3>
  <p class="meta"><?php piketopine_posted_on(); ?></p>
</article></a><!-- #post-## -->
