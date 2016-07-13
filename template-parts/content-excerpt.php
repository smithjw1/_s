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
   $imageSize = 'large';
 }
 else {
   $class = 'excerpt';
   $imageSize = 'medium';
 }

 if($i === 3) {
	 $class .= ' clear';
 }
?>

<a href="<?php echo the_permalink() ?>" class="<?php echo $class ?>"><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if(get_post_format() === 'video') {
    echo wp_oembed_get(get_the_content(''));
  }
  else {
    echo '<div class="holds-thumb">';
    the_post_thumbnail($imageSize, array( 'class' => 'post-thumbnail' ));
    echo '</div>';
  }
  ?>
  <h3><?php the_title() ?></h3>
  <p class="meta"><?php piketopine_posted_on(); ?></p>
</article></a><!-- #post-## -->
