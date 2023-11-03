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




if ($custom_query->have_posts()) {
    echo '<ul>';
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        echo '<li><a style="color:black;" ref="' . get_permalink() . '">' . get_the_title() . '</a>' . get_field('calendar-date') . '</li>';
    }
    echo '</ul>';
} else {
    echo 'No posts found.';
}

wp_reset_postdata();
?>


<div style="height: 1000px"></div>
<?php get_footer();?>
