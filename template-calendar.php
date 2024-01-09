<?php
/**
 *  Template Name: Calendar
 */
?>

<?php get_header();?>

<?php $page_hero_img = get_field('page_hero_img'); ?>

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $page_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<!-- -------------------- Filter functions -------------- -->
<!-- ------------------- Calendar_taxonomy checkboxes ------------ -->
<?php
    $selected_categories = array(); // Default value is an empty array if no categories are selected in the filter

    if (isset($_GET['calendar_taxonomy'])) {
        $selected_categories = (array)$_GET['calendar_taxonomy']; 
    } // If categories are selected in the filter, the value of $selected_categories is set to the selected categories in the filter (array) 

    $current_date = date('Y-m-d'); // Gets the current date from the server and saves it in the variable $current_date
    $args_upcoming = array( // Arguments for the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) 
        'post_type' => 'kalender', // Post type is kalender (custom post type) 
        'posts_per_page' => -1, // Shows all posts 
        'meta_key' => 'calendar-date', // Sorts the posts by the meta key calendar-date (custom field)
        'orderby' => 'meta_value', // Sorts the posts by the value of the meta key calendar-date (custom field) 
        'order' => 'ASC', // Sorts the posts in ascending order 
        'meta_query' => array( // Meta query for the WP_Query
            array( // Array for the meta query
                'key' => 'calendar-date', // The meta key is calendar-date (custom field) 
                'value' => $current_date, // The value of the meta key is the current date 
                'compare' => '>=', // The comparison operator is greater than or equal to 
                'type' => 'DATE', // The type of the meta key is DATE 
            ), 
        ), 
    ); // The WP_Query for upcoming events (events with a date that is greater than or equal to the current date)

    $args_past = array( // Arguments for the WP_Query for past events (events with a date that is less than the current date) 
        'post_type' => 'kalender', // Post type is kalender (custom post type) 
        'posts_per_page' => -1, // Shows all posts 
        'meta_key' => 'calendar-date', // Sorts the posts by the meta key calendar-date (custom field)
        'orderby' => 'meta_value', // Sorts the posts by the value of the meta key calendar-date (custom field) 
        'order' => 'DESC', // Sorts the posts in descending order
        'meta_query' => array( // Meta query for the WP_Query 
            array( // Array for the meta query 
                'key' => 'calendar-date', // The meta key is calendar-date (custom field) 
                'value' => $current_date, // The value of the meta key is the current date 
                'compare' => '<', // The comparison operator is less than 
                'type' => 'DATE', // The type of the meta key is DATE 
            ),
        ),
    ); // The WP_Query for past events (events with a date that is less than the current date)

    if (!empty($selected_categories)) { // If the array $selected_categories is not empty (if categories are selected in the filter)
        $args_upcoming['tax_query'] = array( // Tax query for the WP_Query for upcoming events (events with a date that is greater than or equal to the current date)
            array( // Array for the tax query
                'taxonomy' => 'calendar_taxonomy', // The taxonomy is calendar_taxonomy (custom taxonomy)
                'field'    => 'slug', // The field is slug
                'terms'    => $selected_categories, // The terms are the selected categories in the filter
            ),
        ); // The tax query for the WP_Query for upcoming events (events with a date that is greater than or equal to the current date)

        $args_past['tax_query'] = array( // Tax query for the WP_Query for past events (events with a date that is less than the current date)
            array( // Array for the tax query
                'taxonomy' => 'calendar_taxonomy', // The taxonomy is calendar_taxonomy (custom taxonomy)
                'field'    => 'slug', // The field is slug 
                'terms'    => $selected_categories, // The terms are the selected categories in the filter
            ),
        );
    } // If the array $selected_categories is not empty (if categories are selected in the filter), the tax query for the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) and the tax query for the WP_Query for past events (events with a date that is less than the current date) are set to the selected categories in the filter

    // ------------------- Event search ----------------------- //
    if (isset($_GET['event_search'])) { // If the event search input field is not empty (if the user has searched for an event) 
        $search_term = sanitize_text_field($_GET['event_search']); // Sanitizes the search term and saves it in the variable $search_term 
        $args_upcoming['s'] = $search_term; // The search term is set to the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) 
        $args_past['s'] = $search_term; // The search term is set to the WP_Query for past events (events with a date that is less than the current date)
    } // If the event search input field is not empty (if the user has searched for an event), the search term is set to the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) and the search term is set to the WP_Query for past events (events with a date that is less than the current date)

    $custom_query_upcoming = new WP_Query($args_upcoming); // The WP_Query for upcoming events (events with a date that is greater than or equal to the current date)
    $custom_query_past = new WP_Query($args_past); // The WP_Query for past events (events with a date that is less than the current date)

    $categories = get_terms(array( // Gets all the categories from the custom taxonomy calendar_taxonomy
        'taxonomy' => 'calendar_taxonomy', // The taxonomy is calendar_taxonomy (custom taxonomy)
        'hide_empty' => false, // Shows all categories (even if they are empty)
    )); // Gets all the categories from the custom taxonomy calendar_taxonomy
    $categories = array_filter($categories, function ($calendar_taxonomy) { // Filters the categories from the custom taxonomy calendar_taxonomy
        $hidden_calendar_taxonomy_ids = array(10); // The IDs of the categories that should be hidden in the filter
        return !in_array($calendar_taxonomy->term_id, $hidden_calendar_taxonomy_ids); // Returns the categories that should not be hidden in the filter
    }); // Filters the categories from the custom taxonomy calendar_taxonomy
?>
<!-- ------------------- Calendar_taxonomy checkboxes UI ------------- -->
<div class="calendar-filter-section">
    <form class="calendar-select-form" method="get" action="<?= esc_url(get_permalink()) ?>">
        <!-- Form for the filter -->
        <div class="calendar-select-section">

            <?php foreach ($categories as $calendar_taxonomy) { // Loops through the categories from the custom taxonomy calendar_taxonomy
                echo '<label class="calendar-select-checkbox">'; // Label for the checkbox
                echo '<input class="calendar-checkbox" type="checkbox" name="calendar_taxonomy[]" value="' . $calendar_taxonomy->slug . '"'; // Checkbox for the category 
                if (in_array($calendar_taxonomy->slug, $selected_categories)) { // If the category is selected in the filter 
                    echo ' checked'; // The checkbox is checked 
                } // If the category is selected in the filter 
                echo '>'; // Checkbox for the category 
                echo $calendar_taxonomy->name; // Name of the category 
                echo '</label>'; // Label for the checkbox
            } ?>
            <!-- Loops through the categories from the custom taxonomy calendar_taxonomy -->

        </div>
        <div class="select-btn-container">
            <input type="submit" value="" class="secondary-btn-border filter-btn">
            <button class="filter-btn-inner readMore_multi secondary-btn btn-text-secondary">Filtrér valgte<img
                    class="arrow-icon" alt="Pil ikon til højre"
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" /></button>
        </div>
    </form>
    <a href="<?= esc_url(get_permalink()) ?>" class="calendar-clear">Nulstil filtrering</a>
    <!-- Link to reset the filter -->
</div>

<!-- ------------------- Event search UI ------------------ -->
<div class="calendar-filter-section-secondary">
    <div class="calendar-search-section">
        <form class="calendar-search-form" method="get" action="<?= esc_url(get_permalink()) ?>">
            <!-- Form for the event search -->
            <input type="text" class="calendar-search-input" name="event_search" placeholder="Søg efter begivenhed"
                value="<?php echo isset($_GET['event_search']) ? esc_attr($_GET['event_search']) : ''; ?>">
            <!-- Input field for the event search -->
            <div class="search-btn-container">
                <input type="submit" value="" class="search-btn-border"></input>
                <button class="search-btn">
                    <img class="search-icon" alt="Søge ikon"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/search-icon.svg" />
                </button>
            </div>
        </form>
    </div>
    <a href="<?= esc_url(get_permalink()) ?>" class="calendar-clear-secondary">Nulstil søgning</a>
    <!-- Link to reset the event search -->
</div>
<div class="page-margin">
    <div class="secondary-gradient-border"></div>
</div>

<!-- ------------- Event Cards Upcoming Section ------------- -->
<?php
if ($custom_query_upcoming->have_posts()) { // If the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) has posts
    echo '<h2 class="calendar-header">Kommende begivenheder</h2>'; // Header for the upcoming events section
    echo '<div class="page-margin event-cards-container upcoming-container">'; // Container for the upcoming events section
    while ($custom_query_upcoming->have_posts()) { // Loops through the posts from the WP_Query for upcoming events (events with a date that is greater than or equal to the current date)
        $custom_query_upcoming->the_post();?>
<!-- Loops through the posts from the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) -->

<?php display_event_card(); // Displays the event card
    }
    echo '</div>'; // Container for the upcoming events section
}
// ----------------- Event Cards Past Section ---------------- //
if ($custom_query_past->have_posts()) { // If the WP_Query for past events (events with a date that is less than the current date) has posts
    echo '<div class="past-container">'; // Container for the past events section
    echo '<h2 class="calendar-header">Afviklede begivenheder</h2>'; // Header for the past events section
    echo '<div class="page-margin event-cards-container">'; // Container for the past events section
    while ($custom_query_past->have_posts()) { // Loops through the posts from the WP_Query for past events (events with a date that is less than the current date)
        $custom_query_past->the_post();?>
<!-- Loops through the posts from the WP_Query for past events (events with a date that is less than the current date) -->
<div class="past-event-card">
    <?php display_event_card();?>
    <!-- Displays the event card -->
</div>
<?php
    }
    echo '</div>';?>
<!-- Container for the past events section -->
<div class="secondary-btn-border" id="showAllPastEventsButton" onclick="showAllPastEvents()">
    <!-- Button to show all past events -->
    <button class="readMore_multi secondary-btn btn-text-secondary">Vis alle<img class="arrow-icon"
            alt="Pil ikon til højre" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
    </button>
</div>
<?php
    echo '</div>'; // Container for the past events section
}

if (!$custom_query_upcoming->have_posts() && !$custom_query_past->have_posts()) { 
    echo 'Der er ingen begivenheder i denne kategori.'; 
} // If the WP_Query for upcoming events (events with a date that is greater than or equal to the current date) and the WP_Query for past events (events with a date that is less than the current date) do not have posts, a message is displayed

// ---------------------- Event Cards --------------------- //
function display_event_card() { // Function to display the event card
    $sporti_link_validation = get_field('calendar-sporti-link-validation'); // Gets the value of the custom field calendar-sporti-link-validation and saves it in the variable $sporti_link_validation
    $fb_text = get_field('fb_text'); // Gets the value of the custom field fb_text and saves it in the variable $fb_text
    $calendar_date = strtotime(get_field('calendar-date')); // Gets the value of the custom field calendar-date and saves it in the variable $calendar_date
    $day = wp_date('j', $calendar_date); // Gets the day from the variable $calendar_date and saves it in the variable $day
    $mon = wp_date('M', $calendar_date); // Gets the month from the variable $calendar_date and saves it in the variable $mon
    $year = wp_date('Y', $calendar_date); // Gets the year from the variable $calendar_date and saves it in the variable $year
    
    ?>
<div class="membership-benefits-card event-card">
    <div class="benefits-icon-border event-card-border">
        <div class="benefits-icon-bg">
            <div class="event-date">
                <p class="event-dag"><?= $day ?></p> <!-- Displays the day -->
                <p class="event-maaned"><?= $mon ?></p> <!-- Displays the month -->
                <p class="event-aar"><?= $year ?></p> <!-- Displays the year -->
            </div>
        </div>
    </div>

    <div class="benefits-card-bg event-card-bg">
        <h4><?= get_the_title() ?></h4>
        <div class="benefits-btn event-btn">
            <?php if ($sporti_link_validation === 'Nej') { ?>
            <!-- If the value of the custom field calendar-sporti-link-validation is Nej -->
            <p class="calendar-fb-text"><?= $fb_text ?></p> <!-- Displays the value of the custom field fb_text -->
            <?php } else { ?>
            <!-- If the value of the custom field calendar-sporti-link-validation is not Nej -->
            <div class="secondary-btn-border">
                <a href="<?= get_field('calendar-sporti-link') ?>" target="_blank">
                    <button class="readMore_multi secondary-btn btn-text-secondary">Læs mere<img class="arrow-icon"
                            alt="Pil ikon til højre"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                    </button> <!-- Displays the value of the custom field calendar-sporti-link -->
                </a>
            </div>
            <?php } ?>
            <!-- If the value of the custom field calendar-sporti-link-validation is Nej -->
        </div>
    </div>
</div>
<?php
    
    wp_reset_postdata();
} // Function to display the event card 



get_footer(); ?>