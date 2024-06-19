<?php
/**
 * Plugin Name: WooCommerce Instant Price Update
 * Description: Instantly updates the main price when a variation is selected.
 * Version: 1.0.0
 * Author: Mayank Kumar
 * Text Domain: wc-instant-price-update
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue the necessary scripts
function wc_instant_price_update_scripts() {
    if (is_product()) {
        wp_enqueue_script('wc-instant-price-update', plugin_dir_url(__FILE__) . 'assets/js/instant-price-update.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'wc_instant_price_update_scripts');
