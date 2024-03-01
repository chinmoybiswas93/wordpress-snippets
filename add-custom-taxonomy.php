<?php
// ------------------------------
// Add custom taxonomy for Brands
//-----------------------------------

function custom_taxonomy_brands()
{
    $labels = array(
        'name'                       => _x('Brands', 'taxonomy general name', 'textdomain'),
        'singular_name'              => _x('Brand', 'taxonomy singular name', 'textdomain'),
        'search_items'               => __('Search Brands', 'textdomain'),
        'popular_items'              => __('Popular Brands', 'textdomain'),
        'all_items'                  => __('All Brands', 'textdomain'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Brand', 'textdomain'),
        'update_item'                => __('Update Brand', 'textdomain'),
        'add_new_item'               => __('Add New Brand', 'textdomain'),
        'new_item_name'              => __('New Brand Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate brands with commas', 'textdomain'),
        'add_or_remove_items'        => __('Add or remove brands', 'textdomain'),
        'choose_from_most_used'      => __('Choose from the most used brands', 'textdomain'),
        'not_found'                  => __('No brands found.', 'textdomain'),
        'menu_name'                  => __('Brands', 'textdomain'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'brands'), // Change the slug as needed
    );

    register_taxonomy('brands', 'product', $args); // 'products' is the custom post type slug
}
add_action('init', 'custom_taxonomy_brands', 0);
