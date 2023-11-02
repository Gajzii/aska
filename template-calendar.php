<?php   
/**
 *  Template Name: Calendar */
?>

<?php get_header();?>

<div class="secondary-hero">
    <h1 class="secondary-hero-content">Kalender</h1>
</div>
<div class="calendar-select-section">
    <div class="calendar-select-section-inner page-margin-inner">
        <div class="calendar-select-conatiner">
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Klubdage</h3>
                <input type="checkbox" name="categories[]" id="klubdage">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Stævner</h3>
                <input type="checkbox" name="categories[]" id="staevner">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Ungdom</h3>
                <input type="checkbox" name="categories[]" id="ungdom">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="calendar-select-conatiner">
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Ture</h3>
                <input type="checkbox" name="categories[]" id="ture">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Foredrag og kursus</h3>
                <input type="checkbox" name="categories[]" id="foredrag og kursus">
                <span class="checkmark"></span>
            </label>
            
        </div>
        <input type="submit" value="Filter">
    </div>
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

echo '<form method="get" action="' . esc_url(get_permalink()) . '">'; // Set the form action to the current page's URL

echo '<fieldset>';
echo '<legend>Filter by Category</legend>';

foreach ($categories as $category) {
    echo '<label>';
    echo '<input type="checkbox" name="category[]" value="' . $category->slug . '"';
    if (in_array($category->slug, $selected_categories)) {
        echo ' checked';
    }
    echo '>';
    echo $category->name;
    echo '</label><br>';
}

echo '<input type="submit" value="Apply Filter">';
echo '</fieldset>';
echo '</form>';

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
