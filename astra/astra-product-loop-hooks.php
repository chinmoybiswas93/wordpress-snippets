<?php

/**
 * sucasaair Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sucasaair
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_SUCASAAIR_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

    wp_enqueue_style('sucasaair-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SUCASAAIR_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

// Removing Default Actions
add_action('wp_head', 'loop_function_override', 9999999999999);

function loop_function_override()
{
    remove_action('woocommerce_shop_loop_item_title', 'astra_woo_shop_out_of_stock', 8);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9);
}


// Custom wishlist and add to cart button
function sucassir_woo_shop_thumbnail_wrap_start()
{

    echo '
    <div class="sucasaair-cart-wishlist-controls">
    <a id="wishlist-icon" href="#">
      <img src="/wp-content/uploads/2024/02/Group-10367.png" />
    </a>
    <a id="cart-icon" href="#">
      <img src="/wp-content/uploads/2024/02/Group-10368.png" />
    </a>
  </div>
    ';
}
add_action('woocommerce_after_shop_loop_item', 'sucassir_woo_shop_thumbnail_wrap_start', 7);


// custom out of stock info
function sucassir_woo_shop_products_flash()
{
    $out_of_stock        = get_post_meta(get_the_ID(), '_stock_status', true);
    $out_of_stock_string = apply_filters('astra_woo_shop_out_of_stock_string', __('Sold', 'astra'));
    $meta = get_post_meta(get_the_ID(), '_sale_price', true);
    if ('outofstock' === $out_of_stock) {
?>

        <div class='sucasiaar-flash-boxes'>
            <span class="flash product-out-of-stock"><?php echo esc_html($out_of_stock_string); ?></span>
        </div>
    <?php
    } else if ('' !== $meta) {
    ?>
        <div class='sucasiaar-flash-boxes'>
            <span class="flash product-sale"><?php echo esc_html(__('Sale', 'astra')); ?></span>
            <span class="flash product-new"><?php echo esc_html(__('New', 'astra')); ?></span>
        </div>
<?php
    }
}

add_action('woocommerce_before_shop_loop_item', 'sucassir_woo_shop_products_flash', 9);
