<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package piketopine
 */
$authors = get_users(array('include'=>array(2,3,4,5)));
delete_transient('ptp_back_link');
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <div class="home-features">
        <?php
        $myposts = get_posts( 'posts_per_page=3&meta_key=homepage_feature&meta_value=1' );
        foreach ( $myposts as $post ) : setup_postdata( $post );
        get_template_part( 'template-parts/content', 'feature' );
        endforeach;
        ?>
      </div>
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'home' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
      wp_reset_postdata();
			?>
      <div class="subscribe">

      </div>
      <div class="post-listing">
      <?php
      $i = 1;
      $myposts = get_posts( 'posts_per_page=10' );
      foreach ( $myposts as $post ) : setup_postdata( $post );

      get_template_part( 'template-parts/content', 'excerpt' );
      $i++;
      endforeach;
      wp_reset_postdata();
      ?>
      </div>
      <?php if ( is_active_sidebar( 'home_bottom_1' ) )  dynamic_sidebar( 'home_bottom_1' ); ?>

      <div class="authors">
        <h2><?php echo rwmb_meta( 'author_intro_headline'); ?></h2>
        <div class="content">
          <?php echo apply_filters('the_content', rwmb_meta( 'author_intro_content')); ?>
        </div>
        <?php foreach($authors as $author): ?>
        <div class="author">
          <a href="/author/<?php echo $author->data->user_login ?>"><img src="<?php echo get_cupp_meta($author->data->ID, 'medium'); ?>" alt=""></a>
          <a href="/author/<?php echo $author->data->user_login ?>"><?php echo $author->data->display_name; ?></a>
        </div>
        <?php endforeach; ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
