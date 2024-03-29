<?php
// Add new tab 'Catalogue' to product page
function fanshop_custom_product_tab($tabs)
{
    // Add a new tab
    $tabs['custom_tab'] = array(
        'title'     => __('Catalogue', 'woocommerce'),
        'priority'  => 50,
        'callback'  => 'fanshop_custom_product_tab_content'
    );
    return $tabs;
}

add_filter('woocommerce_product_tabs', 'fanshop_custom_product_tab');

// Content of new tab with upsell products
function fanshop_custom_product_tab_content()
{
    global $product;
    // Get upsell products
    $upsell_ids = $product->get_upsells();

    if (!empty($upsell_ids)) {
        // show upsell products
        woocommerce_upsell_display();
    } else {
        echo '<h3>Nothing to Show</h3>';
    }
}
