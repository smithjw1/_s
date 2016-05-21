<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package piketopine
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <nav id="social-navigation" role="navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_id' => 'social' ) ); ?>
    </nav><!-- #social-navigation -->
    <p>&copy; <?php echo date('Y'); ?> Pike to Pine. All Rights Reserved.</p>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="holds-search">
  <a href="#close" class="close-search icon-close"></a>
  <?php get_search_form() ?>
</div>
<?php wp_footer(); ?>
<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>
</body>
</html>
