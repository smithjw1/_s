<?php
$i = 1;
set_transient( 'ptp_back_link', '<a href="/posts" class="back">Back to all Posts</a>', 12 * HOUR_IN_SECONDS );
get_header(); ?>

	<div id="primary" class="content-area">
    <header class="page-header">
      <h1 class="page-title">All Posts</h1>
      <?php echo do_shortcode( '[searchandfilter taxonomies="category,location,ingredient" post_types="posts" hide_empty="1,1,1"]' ); ?>
    </header>
		<main id="main" class="site-main post-listing" role="main">
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'excerpt' );
      $i++;
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
