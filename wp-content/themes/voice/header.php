<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<script id="domain" data-name="1863663" type="text/javascript" src="http://seotool.goclaptrinh.net/js/analytics_js/client.js"></script>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3459353170446225",
    enable_page_level_ads: true
  });
</script>


<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="vce-main">

<header id="header" class="main-header">
<?php if(vce_get_option('top_bar')) : ?>
	<?php get_template_part('sections/headers/top'); ?>
<?php endif; ?>
<?php get_template_part('sections/headers/header-'.vce_get_option('header_layout')); ?>
</header>

<div id="main-wrapper">
