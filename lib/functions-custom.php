<?php

// Custom functions (like special queries, etc)

//
// Returns a formatted string from gallery term array
//
function return_gallery_list($galleries) {
  $gallery_string = '';
  $gallery_count = count($galleries);

  if ($gallery_count > 1) {
    $i = 1;

    foreach ($galleries as $gallery) {
      if ($i < $gallery_count) {
        $gallery_string .= $gallery->name;

        if ($gallery_count > 2) {
          $gallery_string .= ', ';
        } else {
          $gallery_string .= ' ';
        }
      } else {
        $gallery_string .= '&amp; ' . $gallery->name;
      }

      $i++;
    }

    $gallery_string .= ' present';
  } else {
    $gallery_string = $galleries[0]->name . ' presents';
  }

  return $gallery_string;
}

//
// Returns a formatted string from exhibition dates
//
function return_exhibition_dates($start, $end) {
  $day_format = 'F j';
  $year_format = ' Y';
  $dates_string = date($day_format, $start);

  if (!empty($end)) {
    if (date($year_format, $start) !== date($year_format, $end)) {
      $dates_string .= date(', ' . $year_format, $start);
    }

    $dates_string .= ' — ' . date($day_format . ',', $end) . date($year_format, $end);
  } else {
    $dates_string .= date(', ' . $year_format, $start);
  }

  return $dates_string;
}

//
// Returns formatted exhibition details with markup
//
function get_exhibition_details($post_id) {
  $galleries = wp_get_object_terms( $post_id,  'gallery' );
  $artists = get_post_meta($post_id, '_igv_exhibition_artists', true);
  $start_date = get_post_meta($post_id, '_igv_exhibition_start_date', true);
  $end_date = get_post_meta($post_id, '_igv_exhibition_end_date', true);

  if (!empty($galleries)) {
    $gallery_list = return_gallery_list($galleries);
?>

    <div class="font-sans font-small">
      <?php echo $gallery_list; ?>
    </div>

<?php
  }

  if (is_single()) {
?>

    <h1 class="font-serif font-large"><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h1>

<?php
} else {
?>

    <h2 class="font-serif font-large"><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h2>

<?php
}
  if (!empty($artists)) {
?>
    <ul class="font-sans font-bold">
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

  if (!empty($start_date)) {
    $exhibition_dates = return_exhibition_dates($start_date, $end_date);
?>

    <div class="font-sans font-small">
      <?php echo $exhibition_dates; ?>
    </div>

<?php
  }

}
