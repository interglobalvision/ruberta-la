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

      <article <?php post_class('masonry-holder'); ?> id="post-<?php the_ID(); ?>">

        <div class="masonry-item margin-bottom-mid">

          <div class="margin-bottom-mid">
            <?php echo render_exhibition_details($post->ID);?>
          </div>

          <div class="margin-bottom-basic font-sans font-size-small font-light limit-paragraph">
            <?php the_content();?>
          </div>

<?php
    if (!empty($exhibition_text)) {
?>
          <div class="margin-bottom-basic font-serif limit-paragraph">
            <?php echo apply_filters('the_content', $exhibition_text); ?>
          </div>
<?php
    }

    if (!empty($sponsors)) {
?>
          <div class="margin-bottom-basic grid-row align-items-center">
            <?php
              foreach ($sponsors as $id => $url) {
                $link = wp_get_attachment_caption($id);

                echo !empty($link) ? '<a target="_blank" href="' . esc_url($link) . '">' : '';
                echo wp_get_attachment_image($id, 'sponsor', false, 'class=grid-item');
                echo !empty($link) ? '</a>' : '';
              }
            ?>
          </div>
<?php
    }
?>
        </div>

<?php
    if (!empty($documentation)) {
      foreach ($documentation as $id => $url) {
        $caption = wp_get_attachment_caption($id);
?>

        <div class="masonry-item text-align-right margin-bottom-mid ratio-image-holder">
          <?php echo wp_get_attachment_image($id, 'item-l-6', false, array('data-no-lazysizes' => ' ', 'class' => 'ratio-image')); ?>
          <div class="caption text-align-right font-size-small font-sans font-light margin-top-micro"><?php echo $caption; ?></div>
        </div>

<?php
      }
    } else {
?>
        <div class="masonry-item text-align-right margin-bottom-mid">
          <?php echo the_post_thumbnail('item-l-6', array('data-no-lazysizes' => ' ', 'class' => 'ratio-image')); ?>
          <div class="caption text-align-right font-size-small font-sans font-light margin-top-micro"><?php the_post_thumbnail_caption(); ?></div>
        </div>
<?php
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
