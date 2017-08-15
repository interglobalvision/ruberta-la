<?php
get_header();
?>

<main id="main-content">
  <section id="exhibitions">
    <div class="container">
      <div class="grid-row margin-bottom-large margin-top-small">
        <div class="grid-item item-s-12">
          <h1 class="font-logo font-size-small">Exhibitions</h1>
        </div>
      </div>
    </div>

<?php
$args = array(
  'post_type'       => array('exhibition'),
  'posts_per_page'  => '-1',
  'meta_key'        => '_igv_exhibition_start_date',
  'orderby'         => 'meta_value_num',
  'order'           => 'DESC',
  'meta_query'      => array(
    'relation'      => 'OR',
    array(
      'key'         => '_igv_exhibition_start_date',
      'value'       => time(),
      'compare'     => '<',
    ),
    array(
      'key'     => '_igv_exhibition_current',
      'value'   => 'on',
    ),
  ),
);

$query = new WP_Query( $args );

if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();

    $galleries = wp_get_object_terms( $post->ID,  'gallery' );
    $artists = get_post_meta($post->ID, '_igv_exhibition_artists', true);
    $start_date = get_post_meta($post->ID, '_igv_exhibition_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_exhibition_end_date', true);

    $background_color = get_post_meta($post->ID, '_igv_exhibition_background_color', true);
    $font_color = get_post_meta($post->ID, '_igv_exhibition_font_color', true);
?>

        <article <?php post_class('padding-top-basic padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>" style="background-color: <?php echo $background_color; ?>; color: <?php echo $font_color; ?>;">
          <div class="container">
            <div class="grid-row">
              <div class="grid-item item-s-4 item-m-2">
                <?php the_post_thumbnail('item-l-2'); ?>
              </div>
              <div class="grid-item item-s-8 item-m-10 item-l-8 no-gutter grid-row">
                <div class="grid-item item-s-12 item-m-6">
<?php
    if (!empty($galleries)) {
      $gallery_list = return_gallery_list($galleries);
?>

                  <div class="font-sans font-size-small font-light margin-bottom-tiny">
                    <?php echo $gallery_list; ?>
                  </div>

<?php
    }
?>
                  <h2 class="font-serif font-size-large"><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h2>
                </div>
                <div class="grid-item item-s-12 item-m-6">
<?php
    if (!empty($start_date)) {
      $exhibition_dates = return_exhibition_dates($start_date, $end_date);
?>
                  <div class="font-sans font-size-small font-light margin-bottom-small">
                    <?php echo $exhibition_dates; ?>
                  </div>
<?php
    }

    if (!empty($artists)) {
  ?>
                  <ul class="font-sans font-size-mid">
  <?php
      foreach ($artists as $name) {
  ?>
                    <li><?php echo $name ?></li>
  <?php
      }
  ?>
                  </ul>
  <?php
    }
?>
                </div>
              </div>
            </div>
          </div>
        </article>

<?php
  }
} else {
?>
    <div class="container">
      <div class="grid-row">
        <div class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></div>
      </div>
    </div>
<?php
}

wp_reset_postdata();
?>

  </section>
</main>

<?php
get_footer();
?>
