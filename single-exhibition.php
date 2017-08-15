<?php
get_header();
?>

<main id="main-content">
  <section id="exhibition">
    <div class="container">
      <div class="grid-row margin-bottom-large margin-top-small">
        <div class="grid-item item-s-12">
          <h1 class="font-logo font-size-small">Exhibition</h1>
        </div>
      </div>

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $exhibition_text = get_post_meta($post->ID, '_igv_exhibition_text', true);
    $documentation = get_post_meta($post->ID, '_igv_exhibition_images', true);
    $sponsors = get_post_meta($post->ID, '_igv_exhibition_sponsors', true);
?>

      <article <?php post_class('grid-row masonry-holder'); ?> id="post-<?php the_ID(); ?>">

        <div class="grid-item masonry-item item-s-12 item-m-6 margin-bottom-mid grid-row">
          <div class="item-s-12 item-m-10">

            <div class="margin-bottom-mid">
              <?php echo render_exhibition_details($post->ID);?>
            </div>

            <div class="margin-bottom-basic font-sans font-size-small font-light">
              <?php the_content();?>
            </div>

<?php
    if (!empty($exhibition_text)) {
?>
            <div class="margin-bottom-basic font-serif">
              <?php echo apply_filters('the_content', $exhibition_text); ?>
            </div>
<?php
    }

    if (!empty($sponsors)) {
?>
            <div class="margin-bottom-basic grid-row align-items-center">
              <?php
                foreach ($sponsors as $id => $url) {
                  echo wp_get_attachment_image($id, 'sponsor', false, 'class=grid-item');
                }
              ?>
            </div>
<?php
    }
?>
          </div>
        </div>

<?php
    if (!empty($documentation)) {
      foreach ($documentation as $id => $url) {
        $caption = wp_get_attachment_caption($id);
?>

        <div class="grid-item masonry-item item-s-12 item-m-6 text-align-right margin-bottom-mid">
          <div>
            <?php echo wp_get_attachment_image($id, 'item-l-6', false, 'data-no-lazysizes'); ?>
            <div class="text-align-left font-size-small font-sans font-light margin-top-micro"><?php echo $caption; ?></div>
          </div>
        </div>

<?php
      }
    }
?>

      </article>

<?php
  }
} else {
?>
      <div class="grid-row">
        <div class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></div>
      </div>
<?php
} ?>

    </div>
  </section>
</main>

<?php
get_footer();
?>
