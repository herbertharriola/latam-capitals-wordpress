<?php
// inc/meta-boxes.php

// Prevent direct access
defined('ABSPATH') || exit;

/**
 * Register custom meta boxes for the 'country' post type.
 */
function latam_capitals_add_meta_boxes() {
  add_meta_box(
    'latam_capitals_country_fields',
    __('Country Details', 'latam-capitals'),
    'latam_capitals_render_meta_box',
    'country',
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'latam_capitals_add_meta_boxes');

/**
 * Render the custom fields inside the meta box.
 *
 * @param WP_Post $post
 */
function latam_capitals_render_meta_box($post) {
  $country = get_post_meta($post->ID, 'country_name', true);
  $capital = get_post_meta($post->ID, 'capital_name', true);

  wp_nonce_field('latam_capitals_save_meta_box', 'latam_capitals_meta_box_nonce');

  ?>
  <p>
    <label for="latam_capitals_country_name"><?php esc_html_e('Country Name:', 'latam-capitals'); ?></label><br />
    <input type="text" id="latam_capitals_country_name" name="latam_capitals_country_name" value="<?php echo esc_attr($country); ?>" class="widefat" />
  </p>
  <p>
    <label for="latam_capitals_capital_name"><?php esc_html_e('Capital Name:', 'latam-capitals'); ?></label><br />
    <input type="text" id="latam_capitals_capital_name" name="latam_capitals_capital_name" value="<?php echo esc_attr($capital); ?>" class="widefat" />
  </p>
  <?php
}

/**
 * Save the custom meta box data.
 *
 * @param int $post_id
 */
function latam_capitals_save_meta_box($post_id) {
  if (!isset($_POST['latam_capitals_meta_box_nonce']) ||
      !wp_verify_nonce($_POST['latam_capitals_meta_box_nonce'], 'latam_capitals_save_meta_box')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!current_user_can('edit_post', $post_id)) return;

  if (isset($_POST['latam_capitals_country_name'])) {
    update_post_meta($post_id, 'country_name', sanitize_text_field($_POST['latam_capitals_country_name']));
  }

  if (isset($_POST['latam_capitals_capital_name'])) {
    update_post_meta($post_id, 'capital_name', sanitize_text_field($_POST['latam_capitals_capital_name']));
  }
}
add_action('save_post', 'latam_capitals_save_meta_box');
