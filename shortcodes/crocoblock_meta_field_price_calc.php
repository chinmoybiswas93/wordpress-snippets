<?
// Register the shortcode for crocoblock price filed

function custom_crocoblock_meta_shortcode()
{
    $price = floatval(get_post_meta(get_the_ID(), 'price', true)); // Convert to float for proper addition
    $cost = floatval(get_post_meta(get_the_ID(), 'cost', true)); // Convert to float for proper addition
    $total = $price + $cost;
    $output = 'Price: ' . $total . '$'; // Concatenate properly

    return $output;
}
add_shortcode('crocoblock_meta_price', 'custom_crocoblock_meta_shortcode');
