<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
    <?php if(is_single()): ?>
      <div class="post-nav">
      <?php
        $nextPost = get_next_post(true);	//Gets next and previous posts and their URIs
  		  $nextURI = get_permalink($nextPost->ID);
        if(get_post_format($nextPost) === 'video') {
          $nextthumbnail = apply_filters('the_excerpt', get_post_field('post_excerpt', $nextPost->id));
        }
        else {
          $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'thumbnail');
        }

        $nextTitle = get_the_title($nextPost);
        $nextMeta =  get_the_author_meta('display_name', $nextPost->post_author) . ' / ' . get_the_date('F j, Y', $nextPost->ID);



        $prevPost = get_previous_post(true);
        if(get_post_format($prevPost) === 'video') {
          $prevthumbnail = wp_oembed_get( get_extended($prevPost->post_content)['main'] );

        }
        else {
            $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'thumbnail');
        }
  		  $prevURI = get_permalink($prevPost->ID);

        $prevTitle = get_the_title($prevPost);
        $prevMeta =  get_the_author_meta('display_name', $prevPost->post_author) . ' / ' . get_the_date('F j, Y', $prevPost->ID);
  	  ?>
      <?php if($prevPost): ?>
        <a href="<?php echo $prevURI ?>" class="excerpt"><div class="prev">
          <h4>Previous Post</h4>
          <?php echo $prevthumbnail; ?>
          <h3><?php echo $prevTitle ?></h3>
          <p class="meta"><?php echo $prevMeta ?></p>
        </div></a>
      <?php endif; ?>
      <?php if($nextPost): ?>
        <a href="<?php echo $nextURI ?>" class="excerpt"><div class="next">
          <h4>Next Post</h4>
          <?php echo $nextthumbnail; ?>
          <h3><?php echo $nextTitle ?></h3>
          <p class="meta"><?php echo $nextMeta ?></p>
        </div></a>
      <?php endif; ?>
      </div>
  	<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
