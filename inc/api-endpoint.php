<?php
// inc/api-endpoint.php

// Prevent direct access
defined('ABSPATH') || exit;

/**
 * Register custom REST API endpoint for listing countries and capitals.
 */
function latam_capitals_register_api_routes() {
  register_rest_route('capitals/v1', '/list', [
    'methods'             => 'GET',
    'callback'            => 'latam_capitals_handle_api_request',
    'permission_callback' => '__return_true',
  ]);
}
add_action('rest_api_init', 'latam_capitals_register_api_routes');

/**
 * Handle the API request and return formatted data.
 *
 * @param WP_REST_Request $request
 * @return array
 */
function latam_capitals_handle_api_request($request) {
  $params     = $request->get_params();
  $sort_by    = in_array($params['sort_by'] ?? '', ['country', 'capital']) ? $params['sort_by'] : 'country';
  $direction  = strtolower($params['direction'] ?? 'asc') === 'desc' ? 'DESC' : 'ASC';

  $query = new WP_Query([
    'post_type'      => 'country',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => $direction,
  ]);

  $results = [];

  foreach ($query->posts as $post) {
    $results[] = [
      'title'   => get_the_title($post),
      'country' => get_post_meta($post->ID, 'country_name', true),
      'capital' => get_post_meta($post->ID, 'capital_name', true),
    ];
  }

  usort($results, function ($a, $b) use ($sort_by, $direction) {
    $valA = strtolower($a[$sort_by] ?? '');
    $valB = strtolower($b[$sort_by] ?? '');
    return $direction === 'DESC' ? strcmp($valB, $valA) : strcmp($valA, $valB);
  });

  return $results;
}
