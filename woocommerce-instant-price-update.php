<?php
/**
 * Plugin Name: WooCommerce Instant Price Update
 * Description: Instantly updates the main price when a variation is selected.
 * Version: 1.0.0
 * Author: Your Name
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

// Handle the AJAX request to update the price
function wc_instant_price_update() {
    if (isset($_POST['variation_id']) && isset($_POST['product_id'])) {
        $variation_id = intval($_POST['variation_id']);
        $product_id = intval($_POST['product_id']);

        $variation = new WC_Product_Variation($variation_id);
        $price_html = $variation->get_price_html();

        wp_send_json_success(array('price_html' => $price_html));
    }

    wp_send_json_error();
}
add_action('wp_ajax_wc_instant_price_update', 'wc_instant_price_update');
add_action('wp_ajax_nopriv_wc_instant_price_update', 'wc_instant_price_update');
