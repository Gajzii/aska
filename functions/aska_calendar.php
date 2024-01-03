<?php 
// Register Custom Post Type
function custom_post_type() {
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
        'taxonomies' => array( 'category', 'calendar_taxonomy' ),
        'supports' => array('title')
    );

    register_post_type('kalender', $args);
}
add_action('init', 'custom_post_type');

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Kalender kategorier', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Kalender Kategori', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Kalender kategori', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
    
	register_taxonomy( 'calendar_taxonomy', array( 'kalender' ), $args );

}

function calendar_taxonomy() {
    custom_taxonomy('calendar_taxonomy');
}

add_action('init', 'calendar_taxonomy', 0);

// Add default category to uncategorized posts
function add_default_category() {
    $calendar_taxonomy = 'calendar_taxonomy';

    $default_term = 'Ikke kategoriseret';

    $args = array(
        'post_type' => 'kalender',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $calendar_taxonomy,
                'operator' => 'NOT EXISTS',
            ),
        ),
    );

    $posts_without_term = new WP_Query($args);

    if ($posts_without_term->have_posts()) {
        while ($posts_without_term->have_posts()) {
            $posts_without_term->the_post();

            wp_set_object_terms(get_the_ID(), $default_term, $calendar_taxonomy, true);
        }

        wp_reset_postdata();
    }
}

add_action('init', 'add_default_category');
?>
