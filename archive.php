<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package piketopine
 */
global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
set_transient( 'ptp_back_link', '<a href="'.$current_url.'" class="back">Back to category</a>', 12 * HOUR_IN_SECONDS );
$i = 1;

get_header(); ?>

	<div id="primary" class="content-area">
    <?php if ( have_posts() ) : ?>
    <header class="page-header">
      <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    </header><!-- .page-header -->
    <?php endif; ?>
		<main id="main" class="site-main post-listing" role="main">

		<?php
		if ( have_posts() ) : ?>



			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', 'excerpt' );
      $i++;
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
