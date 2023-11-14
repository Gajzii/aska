<?php function custom_post_type() {
    $labels = array(
        'name' => 'ASKA kalender', // The plural name for your post type
        'singular_name' => 'Kalender opslag', // The singular name for your post type
    );

    $args = array(
        'labels' => $labels,
        'public' => true, // Make the post type public (visible in admin and front-end)
        'has_archive' => true, // Enable archives
        'rewrite' => array('slug' => 'aska_kalender'), // Custom permalink structure
        'menu_icon' => 'dashicons-calendar', // Icon for the admin menu (use dashicons classes)
        'taxonomies' => array( 'category' ),
        'supports' => array('title')
    );

    register_post_type('kalender', $args);
}
add_action('init', 'custom_post_type');
?>