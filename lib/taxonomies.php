<?php
add_action( 'init', 'create_gallery_tax' );

function create_gallery_tax() {
  $labels = array(
    'name'                       => _x( 'Galleries', 'taxonomy general name' ),
    'singular_name'              => _x( 'Gallery', 'taxonomy singular name' ),
    'search_items'               => __( 'Search Galleries' ),
    'popular_items'              => __( 'Popular Galleries' ),
    'all_items'                  => __( 'All Galleries' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Gallery' ),
    'update_item'                => __( 'Update Gallery' ),
    'add_new_item'               => __( 'Add New Gallery' ),
    'new_item_name'              => __( 'New Gallery Name' ),
    'separate_items_with_commas' => __( 'Separate Galleries with commas' ),
    'add_or_remove_items'        => __( 'Add or remove Gallery' ),
    'choose_from_most_used'      => __( 'Choose from the most used Galleries' ),
    'not_found'                  => __( 'No Galleries found.' ),
    'menu_name'                  => __( 'Galleries' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
  );

  register_taxonomy( 'gallery', array('exhibition'), $args );
}
