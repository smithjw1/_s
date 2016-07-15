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
$rawAuthors = get_users(array('include'=>array(2,3,4,5),'orderby'=>'id'));
$authors = array($rawAuthors[1],$rawAuthors[3],$rawAuthors[0],$rawAuthors[2]);
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

      <!-- Begin MailChimp Signup Form -->
      <div id="mc_embed_signup">
        <form action="//piketopine.us13.list-manage.com/subscribe/post?u=318c3a122fcceebc965012cc2&amp;id=8948a9edc0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div id="mc_embed_signup_scroll">
            <div class="mc-field-group">
              <label for="mce-EMAIL">Sign up to receive email updates</label>
              <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter your email address">
              <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
            </div>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_318c3a122fcceebc965012cc2_8948a9edc0" tabindex="-1" value=""></div>


        </div>
      </form>
    </div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
    <!--End mc_embed_signup-->
      <div class="post-listing">
        <?php echo do_shortcode( '[searchandfilter taxonomies="category,location,ingredient" post_types="posts" hide_empty="1,1,1"]' ); ?>
      <?php
      $i = 1;
      $myposts = get_posts( 'posts_per_page=10' );
      foreach ( $myposts as $post ) : setup_postdata( $post );

      get_template_part( 'template-parts/content', 'excerpt' );
      $i++;
      endforeach;
      wp_reset_postdata();
      ?>

        <a href="/posts/" class="button more-posts">Load More Posts</a>
      </div>
      <?php if ( is_active_sidebar( 'home_bottom_1' ) )  dynamic_sidebar( 'home_bottom_1' ); ?>

      <div class="authors">
        <h2><?php echo rwmb_meta( 'author_intro_headline'); ?></h2>
        <div class="content">
          <?php echo apply_filters('the_content', rwmb_meta( 'author_intro_content')); ?>
        </div>
        <?php foreach($authors as $author): ?>
        <div class="author">
          <a href="/bios/<?php echo $author->data->user_login ?>/"><img src="<?php echo get_cupp_meta($author->data->ID, 'medium'); ?>" alt=""></a>
          <a href="/bios/<?php echo $author->data->user_login ?>/"><?php echo $author->data->display_name; ?></a>
        </div>
        <?php endforeach; ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
