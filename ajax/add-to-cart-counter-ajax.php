<?php
//-------------------------------
// Custom add to cart counter
//-------------------------------
add_action('wp_ajax_add_to_cart', 'custom_add_to_cart_callback');
add_action('wp_ajax_nopriv_add_to_cart', 'custom_add_to_cart_callback');

function custom_add_to_cart_callback()
{
    if (isset($_POST['product_id'])) {
        $product_id = absint($_POST['product_id']);
        // Add product to cart
        WC()->cart->add_to_cart($product_id);
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

add_action('wp_ajax_get_cart_count', 'get_cart_count_callback');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_callback');

function get_cart_count_callback()
{
    $cart_count = WC()->cart->get_cart_contents_count();
    wp_send_json(array('cart_count' => $cart_count));
    wp_die();
}
