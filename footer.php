<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
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

<?php wp_footer(); ?>

</body>
</html>
