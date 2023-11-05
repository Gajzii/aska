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
    );

    register_post_type('kalender', $args);
}
add_action('init', 'custom_post_type');

// ----------------- Add category to post ------------------------
// first try
// Register a recurring check for past events
add_action('init', 'register_categorize_past_events');
function register_categorize_past_events()
{
    // Make sure this event hasn't already been scheduled
    if (!wp_next_scheduled('categorize_past_events')) {

        // Schedule the event
        wp_schedule_event(time(), 'hourly', 'categorize_past_events');
    }
}

// Apply past-event category to past events
add_action('categorize_past_events', 'categorize_past_events');
function categorize_past_events()
{
    error_log("Categorization process started"); // Debug statement

    // Search for events that aren't yet marked as past events but are in the past
    $args = array(
        'post_type' => 'kalender',
        'nopaging' => true,
        'category__not_in' => array(10), // Replace with your afholdt category ID
        'meta_key' => 'calendar-date', // Replace with your ACF Date Picker field key
        'meta_value' => date('m-d-Y'), // Compare with today in 'm-d-Y' format
        'meta_compare' => '<', // Less than means it's in the past
    );

    $events = get_posts($args);

    // Add the 'afholdt' category to each matching event
    if ($events) {
        error_log("Found " . count($events) . " events to categorize"); // Debug statement
        foreach ($events as $event) {
            wp_set_post_categories($event->ID, array(10), 'category', true); // Change '32' to your 'afholdt' category ID
            error_log("Categorized event ID " . $event->ID); // Debug statement
        }
    } else {
        error_log("No events found to categorize"); // Debug statement
    }
}

// second try

// schedule

 add_action('wp_insert_post', 'update_event_categories');

function update_event_categories($post_id)
{
    $post = get_post($post_id);

    if ($post->post_type != 'kalender') { // Change 'kalender' to your custom post type
        return;
    }

    // Check if it's a revision and get the parent post ID
    $parent = wp_is_post_revision($post_id);
    if ($parent) {
        $post_id = $parent;
    }

    // Get the date from your ACF Date Picker field (replace 'event-date' with your field key)
    $event_date = get_field('calendar-date', $post_id);

    if (!$event_date) {
        return; // No event date, so nothing to categorize
    }

    $today = current_time('m-d-Y'); // Get the current date in 'm-d-Y' format
    echo $today;

    if (strtotime($event_date) < strtotime($today)) {
        // The event date is in the past, so categorize it
        $categories = wp_get_post_categories($post_id);

        // Add the 'afholdt' category to the event
        $afholdt_category = get_term_by('name', 'afholdt', 'category');
        if ($afholdt_category) {
            array_push($categories, $afholdt_category->term_id);
            wp_set_post_categories($post_id, $categories);
        }
    }
}

?>
