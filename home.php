<?php
$i = 1;
get_header(); ?>

	<div id="primary" class="content-area">
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
