<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
get_template_part('partials/globie');
get_template_part('partials/seo');
get_template_part('partials/favicon');
?>

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

<?php wp_head(); ?>

<?php get_template_part('partials/custom-color'); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header" class="padding-top-tiny padding-bottom-tiny">
    <div class="container">
      <div class="grid-row align-items-center">

        <div class="grid-item item-s-6 item-m-4 item-l-3">
          <h1 class="font-size-extra font-logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>

        <nav class="grid-item item-s-6 item-m-4 item-l-5 item-xl-6">
          <ul id="nav-list" class="u-inline-list font-bold font-sans font-size-small margin-top-micro">
            <li><a href="<?php echo home_url('exhibitions'); ?>">Exhibitions</a></li>
            <li><a href="<?php echo home_url('about'); ?>">About</a></li>
          </ul>
        </nav>

        <div id="header-tagline" class="grid-item item-m-4 item-l-4 item-xl-3 desktop-only font-sans font-light">
          <?php echo get_bloginfo('description'); ?>
        </div>

    </div>
  </header>
