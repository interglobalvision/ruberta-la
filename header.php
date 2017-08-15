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
?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

<?php wp_head(); ?>

<?php

$current_args = array(
  'post_type'   => 'exhibition',
  'numberposts' => '1',
  'meta_key'    => '_igv_exhibition_start_date',
  'orderby'     => 'meta_value_num',
  'order'       => 'ASC',
  'meta_query'  => array(
    array(
      'key'    => '_igv_exhibition_current',
      'value'  => 'on',
    ),
  ),
);

$current_exhibition = get_posts($current_args);

if (!empty($current_exhibition)) {
  $background_color = get_post_meta($current_exhibition[0]->ID, '_igv_exhibition_background_color', true);
  $font_color = get_post_meta($current_exhibition[0]->ID, '_igv_exhibition_font_color', true);

?>
  <style>
<?php
  if (!empty($background_color)) {
?>
    html,
    body,
    #header {
      background-color: <?php echo $background_color; ?>;
    }

    ::selection {
      color: <?php echo $background_color; ?>;
    }
<?php
  }

  if (!empty($font_color)) {
?>
    html,
    body,
    .mc-field-group input,
    #mailing-list-holder input.button {
      color: <?php echo $font_color; ?>;
    }

    #mailing-list-holder,
    #mailing-list-holder #mc_embed_signup input.mce_inline_error {
      border-color: <?php echo $font_color; ?>;
    }

    svg path {
      fill: <?php echo $font_color; ?>;
    }

    ::selection {
      background-color: <?php echo $font_color; ?>;
    }
<?php
  }
?>



  </style>
<?php
}
?>
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

        <nav class="grid-item item-s-6 item-m-4 item-l-6">
          <ul id="nav-list" class="u-inline-list font-bold font-sans font-size-small margin-top-micro">
            <li><a href="<?php echo home_url('exhibitions'); ?>">Exhibitions</a></li>
            <li><a href="<?php echo home_url('about'); ?>">About</a></li>
          </ul>
        </nav>

        <div class="grid-item item-m-4 item-l-3 desktop-only font-sans font-size-small font-light">
          <?php echo get_bloginfo('description'); ?>
        </div>

    </div>
  </header>
