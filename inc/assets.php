<?php
// inc/assets.php

// Prevent direct access
defined('ABSPATH') || exit;

/**
 * Enqueue styles and scripts for the Vue app only on the Capitals Page template.
 */
function latam_capitals_enqueue_assets() {
  if (is_page_template('page-capitals.php')) {
    $theme_uri = get_template_directory_uri();
    $version   = defined('LATAM_CAPITALS_VERSION') ? LATAM_CAPITALS_VERSION : time();

    wp_enqueue_style(
      'latam-capitals-style',
      $theme_uri . '/dist/styles.css',
      [],
      $version
    );

    wp_enqueue_script(
      'latam-capitals-app',
      $theme_uri . '/dist/app.bundle.js',
      [],
      $version,
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'latam_capitals_enqueue_assets');
