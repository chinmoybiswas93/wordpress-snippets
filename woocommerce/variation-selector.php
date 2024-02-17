<?php

/**
 * Chemist Greenhouse Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Chemist Greenhouse
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_CHEMIST_GREENHOUSE_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

    wp_enqueue_style('chemist-greenhouse-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_CHEMIST_GREENHOUSE_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

// Create the Shortcode Function
function display_product_variations_as_radios()
{
    global $product;

    // Get the product ID
    $product_id = method_exists($product, 'get_id') ? $product->get_id() : 0;

    // Check if it's a variable product
    if (!$product || !is_a($product, 'WC_Product_Variable')) {
        return '';
    }

    // Get product variations
    $variations = $product->get_available_variations();

    // Start building HTML
    $output = '<div class="cg-product-variations-radios">';
    foreach ($variations as $variation) {
        $variation_id = $variation['variation_id'];
        $variation_attributes = $variation['attributes'];
        // Get the variation price
        $variation_obj = wc_get_product($variation_id);
        $variation_price = $variation_obj->get_price_html();


        // Modify the label format to remove the attribute name
        $variation_label = implode(', ', $variation_attributes);

        $output .= '<label>';
        $output .= '<input type="radio" name="variation_id" value="' . esc_attr($variation_id) . '">';
        $output .= '<div>' . esc_html($variation_label) . '</div>';
        $output .= '<div class="variation-price">' . $variation_price . '</div>'; // Display price below label
        $output .= '</label>';
    }
    $output .= '</div>';

    return $output;
}

add_shortcode('product_variations_radios', 'display_product_variations_as_radios');
