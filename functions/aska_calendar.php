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

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => 'Kalender kategorier',
		'singular_name'              => 'Kalender Kategori',
		'menu_name'                  => 'Kalender kategori',
		'all_items'                  => 'Alle kalender kategorier',
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

// Remove default parent dropdown
function remove_tax_parent_dropdown() {
    $screen = get_current_screen();

    if ( 'calendar_taxonomy' == $screen->taxonomy ) {
        if ( 'edit-tags' == $screen->base ) {
            $parent = "$('label[for=parent]').parent()";
        } elseif ( 'term' == $screen->base ) {
            $parent = "$('label[for=parent]').parent().parent()";
        }
    } elseif ( 'post' == $screen->post_type ) {
        $parent = "$('#newcategory_parent')";
    } else {
        return;
    }
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function($) {     
            <?php echo $parent; ?>.remove();       
        });
    </script>

    <?php 
}

add_action( 'admin_head-edit-tags.php', 'remove_tax_parent_dropdown' );
add_action( 'admin_head-term.php', 'remove_tax_parent_dropdown' );
add_action( 'admin_head-post.php', 'remove_tax_parent_dropdown' );
add_action( 'admin_head-post-new.php', 'remove_tax_parent_dropdown' ); 

?>
