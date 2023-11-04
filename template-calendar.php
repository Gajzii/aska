<?php   
/**
 *  Template Name: Calendar */
?>

<?php get_header();?>

<div class="secondary-hero">
    <h1 class="secondary-hero-content">Kalender</h1>
</div>

<?php
$selected_categories = array(); // Initialize an array to store the selected categories

if (isset($_GET['category'])) {
    $selected_categories = (array)$_GET['category']; // Get the selected categories from the URL parameter
}

$args = array(
    'post_type' => 'kalender',
    'posts_per_page' => -1,
    'meta_key' => 'calendar-date', // Specify the custom field key for ordering
    'orderby' => 'meta_value',  // Order by the custom field value
    'order' => 'DESC',         // Order in descending order
);

if (!empty($selected_categories)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category', // Replace with the taxonomy you're using
            'field'    => 'slug',
            'terms'    => $selected_categories,
        ),
    );
}

$custom_query = new WP_Query($args);

// Display category filter checkboxes
$categories = get_terms(array(
    'taxonomy' => 'category', // Replace with your taxonomy name
    'hide_empty' => false, // Show even empty categories
));

echo '<div class="calendar-select-section">';
    echo '<div class="">';

        echo '<form method="get" action="' . esc_url(get_permalink()) . '">'; // Set the form action to the current page's URL
                echo '<div class="calendar-select-section-inner">';
                foreach ($categories as $category) {
                    echo '<label class="calendar-event-checkbox">';
                    echo '<input type="checkbox" name="category[]" value="' . $category->slug . '"';
                    if (in_array($category->slug, $selected_categories)) {
                        echo ' checked';
                    }
                    echo '>';
                    echo $category->name;
                    echo '</label>';
                }
                echo '</div>';
                    echo '<input type="submit" value="Filtrér">';

        echo '</form>'; 
    echo '</div>'; 
echo '</div>';

echo '<div class="page-margin event-cards-container">';
if ($custom_query->have_posts()) {
    
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        echo '<div class="membership-benefits-card event-card">';

            echo '<div class="benefits-icon-border event-card-border">';
                echo '<div class="benefits-icon-bg">';

                    $timestamp = strtotime(get_field('calendar-date'));

                    $day = wp_date('j', $timestamp);
                    $mon = wp_date('M', $timestamp);
                    $year = wp_date('Y', $timestamp);
                    echo '<div class="event-date">';
                        echo '<p class="event-dag">' . $day . '.</p>';
                        echo '<p class="event-maaned">' . $mon . '</p>';
                        echo '<p class="event-aar">' . $year . '</p>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';

        echo '<div class="benefits-card-bg event-card-bg">';
            echo '<h4>' . get_the_title() . '</h4>';
            echo '<div class="benefits-btn event-btn">';
                echo '<div class="secondary-btn-border">';
                    echo '<button class="readMore_multi secondary-btn btn-text-secondary">Læs mere</button>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
} else {
    echo 'No posts found.';
}

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


echo '</div>';
wp_reset_postdata();


 


?>


<div style="height: 1000px"></div>
<?php get_footer();?>