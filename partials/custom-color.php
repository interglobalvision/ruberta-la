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
    #mailing-list-holder input.button,
    #mailing-list-holder #mc_embed_signup #mce-success-response,
    #mailing-list-holder #mc_embed_signup #mce-error-response,
    #mailing-list-holder #mc_embed_signup #mc-embedded-subscribe-form div.mce_inline_error {
      color: <?php echo $font_color; ?>;
    }

    #mailing-list-holder,
    #mailing-list-holder #mc_embed_signup #mc-embedded-subscribe-form input.mce_inline_error {
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
