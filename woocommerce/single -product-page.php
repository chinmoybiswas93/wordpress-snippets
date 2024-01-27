<?php

/**
 * https://www.businessbloomer.com/woocommerce-visual-hook-guide-single-product-page/
 * */
/**
 * Customizing Variable Price
 */

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price($price, $product)
{

    $price = 'από ';

    $price .= wc_price($product->get_price());

    return $price;
}


/**
 * Remove additional information and reviews
 */

add_filter('woocommerce_product_tabs', 'iggy_remove_product_tabs', 98);

function iggy_remove_product_tabs($tabs)
{
    unset($tabs['reviews']);          // Remove the reviews tab
    unset($tabs['additional_information']);   // Remove the additional information tab
    return $tabs;
}


/**
 * Review tab after related products
 */

add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
    unset($tabs['reviews']);  // Removes the reviews tab
    return $tabs;
}

add_action('woocommerce_after_single_product', 'comments_template', 50);
