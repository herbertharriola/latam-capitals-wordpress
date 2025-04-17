<?php
// inc/custom-post-type.php

// Prevent direct access
defined('ABSPATH') || exit;

/**
 * Register the 'country' custom post type
 */
function latam_capitals_register_country_post_type() {
  $labels = [
    'name'               => __('Countries', 'latam-capitals'),
    'singular_name'      => __('Country', 'latam-capitals'),
    'add_new'            => __('Add New', 'latam-capitals'),
    'add_new_item'       => __('Add New Country', 'latam-capitals'),
    'edit_item'          => __('Edit Country', 'latam-capitals'),
    'new_item'           => __('New Country', 'latam-capitals'),
    'view_item'          => __('View Country', 'latam-capitals'),
    'search_items'       => __('Search Countries', 'latam-capitals'),
    'not_found'          => __('No countries found', 'latam-capitals'),
    'not_found_in_trash' => __('No countries found in Trash', 'latam-capitals'),
    'menu_name'          => __('Countries', 'latam-capitals'),
  ];

  $args = [
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => ['slug' => 'countries'],
    'supports'           => ['title'],
    'show_in_rest'       => true,
    'menu_icon'          => 'dashicons-flag',
  ];

  register_post_type('country', $args);
}
add_action('init', 'latam_capitals_register_country_post_type');
