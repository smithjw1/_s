<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package piketopine
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
<script>
  WebFont.load({
    google: {
      families: ["Rozha One:regular","Playfair Display:regular,italic,700,700italic,900,900italic"]
    }
  });
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1065953273450800',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'piketopine' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><img src="<?php echo get_template_directory_uri() ?>/images/ptp-logo.png"></a>
		</div><!-- .site-branding -->
    <?php if(is_single()) ptp_back_link(); ?>
		<a href="#" class="search"></a>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
