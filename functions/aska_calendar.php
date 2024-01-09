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
        'taxonomies' => array( 'calendar_taxonomy' ),
        'supports' => array('title')
    );

    register_post_type('kalender', $args);
}
add_action('init', 'custom_post_type');

// Register Custom Taxonomy for Custom Post Type 
function custom_taxonomy() {

	$labels = array(
		'name'                       => 'Kalender kategorier', // The plural name for your taxonomy 
		'singular_name'              => 'Kalender Kategori', // The singular name for your taxonomy 
		'menu_name'                  => 'Kalender kategori', // The name for the admin menu 
		'all_items'                  => 'Alle kalender kategorier', // Display the table on the taxonomy admin page 
	);

	$args = array(
		'labels'                     => $labels, // Set the labels
		'hierarchical'               => true, // Set whether this taxonomy is hierarchical like categories or not hierarchical like tags 
		'public'                     => true, // Make the taxonomy public (visible in admin and front-end) 
		'show_ui'                    => true, // Show the taxonomy admin page 
		'show_admin_column'          => true, // Show the taxonomy admin column in the post list page 
		'show_in_nav_menus'          => true, // Show the taxonomy in the navigation menus 
		'show_tagcloud'              => true, // Show the taxonomy in the tag cloud 
	);
    
	register_taxonomy( 'calendar_taxonomy', array( 'kalender' ), $args ); // Register the taxonomy with the post type 
}

// Hook into the 'init' action 
function calendar_taxonomy() {
    custom_taxonomy('calendar_taxonomy'); // Register Custom Taxonomy for Custom Post Type 
}

add_action('init', 'calendar_taxonomy', 0); // Add the taxonomy to the menu 

// Add default category to uncategorized posts 
function add_default_category() {
    $calendar_taxonomy = 'calendar_taxonomy'; // The name of the taxonomy to which you want to add the default term 

    $default_term = 'Ikke kategoriseret'; 

    $args = array(
        'post_type' => 'kalender', // The name of your custom post type 
        'posts_per_page' => -1, // How many posts to update 
        'tax_query' => array( // Only select posts which don't have the default term already
            array( 
                'taxonomy' => $calendar_taxonomy, // Your custom taxonomy
                'operator' => 'NOT EXISTS', // Select all that don't have the term 
            ),
        ),
    );

    // Get all posts which don't have the default term already 
    $posts_without_term = new WP_Query($args); // Run the query 

    if ($posts_without_term->have_posts()) { // Check if there are any posts to update
        while ($posts_without_term->have_posts()) { // Loop through the posts and add the default term
            $posts_without_term->the_post(); // Set up the post data

            wp_set_object_terms(get_the_ID(), $default_term, $calendar_taxonomy, true); // Add the default term to the post 
        }

        wp_reset_postdata(); // Reset the post data 
    }
}

add_action('init', 'add_default_category'); // Hook into the 'init' action 

// Remove default parent dropdown from custom taxonomy 
function remove_tax_parent_dropdown() { 
    $screen = get_current_screen(); // Get the current screen 

    if ( 'calendar_taxonomy' == $screen->taxonomy ) { // Check if the current taxonomy is the taxonomy you want to edit 
        if ( 'edit-tags' == $screen->base ) { // Check if you're on the edit tags page 
            $parent = "$('label[for=parent]').parent()"; // Get the parent dropdown 
        } elseif ( 'term' == $screen->base ) { // Check if you're on the edit term page 
            $parent = "$('label[for=parent]').parent().parent()"; // Get the parent dropdown 
        }
    } elseif ( 'post' == $screen->post_type ) { // Check if the current post type is the post type you want to edit 
        $parent = "$('#newcategory_parent')"; // Get the parent dropdown
    } else { // If the current screen isn't the taxonomy or post type you want to edit, stop the function 
        return; 
    }
    ?>

<!-- Remove default parent dropdown from custom taxonomy -->
<script type="text/javascript">
jQuery(document).ready(function($) { // Run the function when the document is ready 
    <?php echo $parent; ?>.remove(); // Remove the parent dropdown 
});
</script>

<?php 
}

add_action( 'admin_head-edit-tags.php', 'remove_tax_parent_dropdown' ); // Hook into the admin head on the edit tags page 
add_action( 'admin_head-term.php', 'remove_tax_parent_dropdown' ); // Hook into the admin head on the edit term page 
add_action( 'admin_head-post.php', 'remove_tax_parent_dropdown' ); // Hook into the admin head on the edit post page
add_action( 'admin_head-post-new.php', 'remove_tax_parent_dropdown' );  // Hook into the admin head on the new post page 

?>