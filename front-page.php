<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

      <div class="grid-row margin-top-small">

<?php

// Get soonest current exhibition
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

// Get upcoming exhibitions
$upcoming_args = array(
  'post_type'   => 'exhibition',
  'numberposts' => '2',
  'meta_key'    => '_igv_exhibition_start_date',
  'orderby'     => 'meta_value_num',
  'order'       => 'ASC',
  'meta_query'  => array(
    'relation'  => 'AND',
    array(
      'key'    => '_igv_exhibition_upcoming',
      'value'  => 'on',
    ),
    array(
      'key'      => '_igv_exhibition_current',
      'compare'  => 'NOT EXISTS',
    ),
  ),
);

$current = get_posts($current_args);

$upcoming = get_posts($upcoming_args);

if (!empty($current)) {
  // Is current exhibition also upcoming?
  // This is just to change the list headings "On now", "Coming up", "After that"

  $current_is_upcoming = get_post_meta($current[0]->ID, '_igv_exhibition_upcoming', true);
?>

        <div class="grid-item no-gutter item-s-12 item-m-8 grid-row align-content-start">

          <div class="grid-item item-s-12 margin-bottom-large font-logo font-size-small">
            <?php echo empty($current_is_upcoming) ? 'On now' : 'Coming up'; ?>
          </div>

        </div>

<?php
}

if (!empty($upcoming)) {
?>

        <div class="grid-item no-gutter item-s-12 item-m-4 item-l-3 offset-l-1 grid-row desktop-only">

          <div class="grid-item item-s-12 margin-bottom-large font-logo font-size-small">
            <?php echo $current_is_upcoming == 'on' ? 'After that' : 'Coming up'; ?>
          </div>

        </div>

<?php
}
?>
      </div>

      <div class="grid-row">

<?php

if (!empty($current)) {

?>

        <div class="grid-item item-s-12 item-m-4 item-l-3 margin-bottom-basic">
          <?php echo render_exhibition_details($current[0]->ID);?>
        </div>

        <div class="grid-item item-s-12 item-m-4 item-l-5 ratio-image-holder">
          <a href="<?php echo get_the_permalink($current[0]->ID); ?>">
            <?php echo wp_get_attachment_image(get_post_thumbnail_id($current[0]->ID), 'item-l-5', false,  'class=ratio-image'); ?>
          </a>
        </div>

<?php
}

if (!empty($upcoming)) {
?>

        <div class="grid-item item-s-12 item-m-4 item-l-3 offset-l-1 grid-row no-gutter">

          <div class="grid-item item-s-12 mobile-only font-logo font-size-small margin-bottom-large margin-top-large">
            <?php echo $current_is_upcoming == 'on' ? 'After that' : 'Coming up'; ?>
          </div>

<?php

  foreach ($upcoming as $post) {
?>

          <div class="grid-item item-s-12 margin-bottom-mid">
            <?php echo render_exhibition_details($post->ID);?>
          </div>

<?php
  }
?>

        </div>

<?php
}
?>

      </div>

    </div>
  </section>
</main>

<?php
get_footer();
?>
