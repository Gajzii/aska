<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load function partials
require 'functions/navigation.php';
require 'functions/scripts.php';
require 'functions/utilities.php';
require 'functions/aska_calendar.php';



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



?>

