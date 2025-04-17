<?php
// functions.php

// Prevent direct access
defined('ABSPATH') || exit;

// Theme setup
define('LATAM_CAPITALS_VERSION', '1.0.0');

function latam_capitals_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-style');
}
add_action('after_setup_theme', 'latam_capitals_theme_setup');

// Autoload required includes
$includes = [
  'inc/custom-post-type.php',
  'inc/meta-boxes.php',
  'inc/api-endpoint.php',
  'inc/assets.php',
];

foreach ($includes as $file) {
  $filepath = get_template_directory() . '/' . $file;
  if (file_exists($filepath)) {
    require_once $filepath;
  } else {
    error_log(sprintf('LatAm Capitals Theme: Missing required file %s', $file));
  }
}

