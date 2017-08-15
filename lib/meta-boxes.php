<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  // EXHIBITION

  $cmb_exhibition = new_cmb2_box( array(
    'id'            => $prefix . 'exhibition_metabox',
    'title'         => esc_html__( 'Details', 'cmb2' ),
    'object_types'  => array( 'exhibition' ), // Post type
  ) );

  $cmb_exhibition->add_field( array(
    'name' => esc_html__( 'Start date', 'cmb2' ),
    'id'   => $prefix . 'exhibition_start_date',
    'type' => 'text_date_timestamp',
  ) );

  $cmb_exhibition->add_field( array(
    'name' => esc_html__( 'End date', 'cmb2' ),
    'id'   => $prefix . 'exhibition_end_date',
    'type' => 'text_date_timestamp',
  ) );

  $cmb_exhibition->add_field( array(
    'name' => esc_html__( 'Current', 'cmb2' ),
    'desc'    => esc_html__( 'Displays on Home as current exhibition. Background & Font Colors are used.', 'cmb2' ),
    'id'   => $prefix . 'exhibition_current',
    'type' => 'checkbox',
    'column' => true,
  ) );

  $cmb_exhibition->add_field( array(
    'name' => esc_html__( 'Upcoming', 'cmb2' ),
    'desc'    => esc_html__( 'Displays on Home as upcoming exhibition. Hidden from exhibition archive.', 'cmb2' ),
    'id'   => $prefix . 'exhibition_upcoming',
    'type' => 'checkbox',
    'column' => true,
  ) );

  $cmb_exhibition->add_field( array(
    'name'       => esc_html__( 'Artist Name(s)', 'cmb2' ),
    'id'         => $prefix . 'exhibition_artists',
    'type'       => 'text',
    'repeatable'      => true,
  ) );

  $cmb_exhibition->add_field( array(
    'name'    => esc_html__( 'Background Color', 'cmb2' ),
    'id'      => $prefix . 'exhibition_background_color',
    'type'    => 'colorpicker',
    'default' => '#ffffff',
  ) );

  $cmb_exhibition->add_field( array(
    'name'    => esc_html__( 'Font Color', 'cmb2' ),
    'id'      => $prefix . 'exhibition_font_color',
    'type'    => 'colorpicker',
    'default' => '#000000',
  ) );

  $cmb_exhibition->add_field( array(
    'name'    => esc_html__( 'Exhibition Text', 'cmb2' ),
    'desc'    => esc_html__( 'not Press Text. Enter the Press text in top text entry field', 'cmb2' ),
    'id'      => $prefix . 'exhibition_text',
    'type'    => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 15,
    ),
  ) );

  $cmb_exhibition->add_field( array(
    'name'         => esc_html__( 'Documentation', 'cmb2' ),
    'id'           => $prefix . 'exhibition_images',
    'type'         => 'file_list',
    'preview_size' => array( 150, 150 ),
  ) );


  // ABOUT

  $about_page = get_page_by_path('about');

  if (!empty($about_page) ) {

    $cmb_about = new_cmb2_box( array(
      'id'            => $prefix . 'about_metabox',
      'title'         => esc_html__( 'Details', 'cmb2' ),
      'object_types'  => array( 'page' ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => array($about_page->ID) ),
    ) );

    $cmb_about->add_field( array(
      'name' => esc_html__( 'Address', 'cmb2' ),
      'id'   => $prefix . 'about_address',
      'type' => 'textarea',
    ) );

    $cmb_about->add_field( array(
      'name' => esc_html__( 'Phone', 'cmb2' ),
      'id'   => $prefix . 'about_phone',
      'type' => 'text',
    ) );

    $cmb_about->add_field( array(
      'name' => esc_html__( 'email', 'cmb2' ),
      'id'   => $prefix . 'about_email',
      'type' => 'text_email',
    ) );

    $cmb_about->add_field( array(
      'name' => esc_html__( 'Mailchimp list ID', 'cmb2' ),
      'id'   => $prefix . 'about_mailchimp',
      'type' => 'text_small',
    ) );

  }

  // GALLERY

  $cmb_gallery = new_cmb2_box( array(
    'id'               => $prefix . 'gallery_metabox',
    'title'            => esc_html__( 'Details', 'cmb2' ), // Doesn't output for term boxes
    'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
    'taxonomies'       => array( 'gallery' ), // Tells CMB2 which taxonomies should have these fields
  ) );

  $cmb_gallery->add_field( array(
    'name' => esc_html__( 'Website', 'cmb2' ),
    'id'   => $prefix . 'gallery_url',
    'type' => 'text_url',
    'column'          => true,
  ) );

}
?>
