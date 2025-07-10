<?php
/**
 * regiter hierarchical categories
 */
function register_service_category_taxonomy() {
    register_taxonomy('service-category', 'service', [
        'labels' => [
            'name' => 'Service Categories',
            'singular_name' => 'Service Category',
            'all_items' => 'All Categories',
            'add_new_item' => 'Add New Category',
            'edit_item' => 'Edit Category',
        ],
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'services', // this gives category archive URLs like /services/cosmetic-dentistry/
            'with_front' => false,
        ],
    ]);
}
add_action('init', 'register_service_category_taxonomy');
/**
 * regiter service post type
 */
function register_service_post_type() {
    register_post_type('service', [
        'labels' => [
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'all_items' => 'All Services',
        ],
        'public' => true,
        'has_archive' => true, // enables /services/ archive
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-smiley',
        'taxonomies' => ['service-category'],
        'rewrite' => [
            'slug' => 'services/%service-category%', 
            'with_front' => false,
        ],
    ]);
}
add_action('init', 'register_service_post_type');
/**
 * add service category URL to single service
 */
function inject_service_category_slug($link, $post) {
    if ($post->post_type === 'service') {
        $terms = wp_get_post_terms($post->ID, 'service-category');
        if (!empty($terms) && !is_wp_error($terms)) {
            return str_replace('%service-category%', $terms[0]->slug, $link);
        }
        return str_replace('%service-category%', 'general', $link); // fallback slug
    }
    return $link;
}
add_filter('post_type_link', 'inject_service_category_slug', 10, 2);
/**
 * handle parent and archive services URL
 */
function register_service_custom_rewrites() {
    add_rewrite_rule(
        '^services/([^/]+)/?$',
        'index.php?service-category=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^services/?$',
        'index.php?post_type=service',
        'top'
    );
}
add_action('init', 'register_service_custom_rewrites');
/**
 * register team member post type
 */
function register_team_member_post_type() {
    $labels = array(
        'name'               => 'Dentists',
        'singular_name'      => 'Dentist',
        'menu_name'          => 'Our Dentists',
        'name_admin_bar'     => 'Dentist',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Dentist',
        'new_item'           => 'New Dentist',
        'edit_item'          => 'Edit Dentis',
        'view_item'          => 'View Dentist',
        'all_items'          => 'All Dentists',
        'search_items'       => 'Search Dentists',
        'not_found'          => 'No dentists found.',
        'not_found_in_trash' => 'No dentists in trash.',
    );

    $args = array(
        'label'               => 'Dentists',
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'our-dentists'),
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-groups',
    );

    register_post_type('team_member', $args);
}
add_action('init', 'register_team_member_post_type');
/**
 * register FAQ post type
 */
function register_faq_post_type() {
    register_post_type('faq', [
        'labels' => [
            'name'          => 'FAQs',
            'singular_name' => 'FAQ',
            'add_new'       => 'Add New FAQ',
            'add_new_item'  => 'Add New FAQ',
            'edit_item'     => 'Edit FAQ',
            'new_item'      => 'New FAQ',
            'view_item'     => 'View FAQ',
            'search_items'  => 'Search FAQs',
        ],
        'public'          => true,
        'show_in_rest'    => true,
        'supports'        => ['title', 'editor'],
        'rewrite'         => ['slug' => 'faq'],
        'has_archive'     => true,
        'menu_icon'       => 'dashicons-editor-help',
    ]);
}
add_action('init', 'register_faq_post_type');