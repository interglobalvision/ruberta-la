<?php
get_header();
?>

<main id="main-content">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $address = get_post_meta($post->ID, '_igv_about_address', true);
    $phone = get_post_meta($post->ID, '_igv_about_phone', true);
    $email = get_post_meta($post->ID, '_igv_about_email', true);
    $mailchimp = get_post_meta($post->ID, '_igv_about_mailchimp', true);
    $map_link = get_post_meta($post->ID, '_igv_about_map_link', true);
    $map_embed = get_post_meta($post->ID, '_igv_about_map_embed', true);

    $galleries = get_terms( array(
      'taxonomy'    => 'gallery',
      'hide_empty'  => false,
      'meta_key'    => '_igv_gallery_resident',
      'meta_value'  => 'on',
    ) );
?>

  <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">
    <div class="grid-row margin-bottom-large">
      <div class="grid-item item-s-12">
        <h1 class="font-logo font-size-small">About</h1>
      </div>
    </div>

    <div class="grid-row margin-bottom-basic">
      <div class="grid-item item-s-12 item-m-8 font-size-large font-serif margin-bottom-basic">
        <?php the_content(); ?>
      </div>

      <div class="grid-item item-s-12 item-m-3 offset-m-1 font-size-mid font-sans margin-bottom-basic">
<?php
    if (!empty($address)) {
      if (!empty($map_link)) {
?>
        <div class="grid-row justify-between">
          <?php echo apply_filters('the_content', $address); ?>
          <a class="font-bold mobile-only" target="_blank" href="<?php echo esc_url($map_link); ?>">MAP <?php echo url_get_contents(get_template_directory_uri() . '/dist/img/jump_arrow.svg'); ?></a>
        </div>
<?php
      } else {
?>
        <?php echo apply_filters('the_content', $address); ?>
<?php
      }
    }

    if (!empty($email) || !empty($phone)) {
?>
        <?php echo !empty($email) ? '<span class="u-block"><a class="link-underline" href="mailto:' . $email . '">' . $email . '</a></span>' : ''; ?>
        <?php echo !empty($phone) ? '<span class="u-block"><a class="link-underline" href="tel:' . $email . '">' . $phone . '</a></span>' : ''; ?>
<?php
    }
?>
      </div>
    </div>

<?php
    if (!empty($galleries)) {
?>

    <div id="about-galleries" class="grid-row margin-bottom-basic">

<?php
      foreach($galleries as $gallery) {
        $website = get_term_meta($gallery->term_id, '_igv_gallery_url', true);
?>

      <div class="grid-item flex-grow font-size-small font-sans margin-bottom-basic">

        <h3 class="font-size-mid font-sans margin-bottom-small"><?php echo $gallery->name; ?></h3>

        <?php
          echo apply_filters('the_content', $gallery->description);

          if (!empty($website)) {
            echo '<a class="link-underline" href="' . esc_url($website) . '">' . esc_url($website) . '</a>';
          }
        ?>

      </div>

<?php
      }
?>

    </div>

<?php
    }

    if (!empty($mailchimp) || !empty($map_embed)) {
?>

    <div class="grid-row margin-bottom-basic">

<?php
      if (!empty($mailchimp)) {
?>

      <div class="grid-item item-s-12 item-m-6 margin-bottom-basic">
        <div id="mailing-list-holder">

          <div class="font-sans font-size-small margin-bottom-small">Mailing List</div>

          <?php echo $mailchimp; ?>

        </div>
      </div>

<?php
      }

      if (!empty($map_embed)) {
?>

      <div class="grid-item item-s-12 item-m-6 desktop-only margin-bottom-basic">

          <?php echo $map_embed; ?>

      </div>

<?php
      }
?>

    </div>

<?php
    }
?>

  </article>

<?php
  }
}
?>

</main>

<?php
get_footer();
?>
