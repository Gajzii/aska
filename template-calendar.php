<?php   
/**
 *  Template Name: Calendar */
?>

<?php get_header();?>

<div class="secondary-hero">
    <h1 class="secondary-hero-content">Kalender</h1>
</div>

<!-- ---------------------- Filter Checkboxes --------------------- -->
<?php
$selected_categories = array();

if (isset($_GET['category'])) {
    $selected_categories = (array)$_GET['category'];
}

$args = array(
    'post_type' => 'kalender',
    'posts_per_page' => -1,
    'meta_key' => 'calendar-date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
);

if (!empty($selected_categories)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $selected_categories,
        ),
    );
}

$custom_query = new WP_Query($args);

$categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false,
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

// ---------------------- Event Cards --------------------- //
echo '<div class="page-margin event-cards-container">';
if ($custom_query->have_posts()) {
    
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        ?>

        <div class="membership-benefits-card event-card">

            <div class="benefits-icon-border event-card-border">
                <div class="benefits-icon-bg">

                    <?php $timestamp = strtotime(get_field('calendar-date'));
                        $day = wp_date('j', $timestamp);
                        $mon = wp_date('M', $timestamp);
                        $year = wp_date('Y', $timestamp);
                    ?>

                    <div class="event-date">
                        <p class="event-dag"><?= $day?></p>
                        <p class="event-maaned"><?=$mon?></p>
                        <p class="event-aar"><?=$year?></p>
                    </div>

                </div>
            </div>

            <div class="benefits-card-bg event-card-bg">
                <h4><?=get_the_title()?></h4>
                <div class="benefits-btn event-btn">
                    <div class="secondary-btn-border">
                        <button class="readMore_multi secondary-btn btn-text-secondary">Læs mere<img class="arrow-icon" alt="Pil ikon til højre"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" /></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------- Event Modal --------------------- -->
        <div class="modal modal_multi">
            <div class="modal-flex">

                <div class="benefits-icon-border modal-discount event-card-border">
                    <div class="benefits-icon-bg">
                        <div class="event-date">
                            <p class="event-dag"><?= $day?></p>
                            <p class="event-maaned"><?=$mon?></p>
                            <p class="event-aar"><?=$year?></p>
                        </div>
                    </div>
                </div>

                <div class="modal-content">
                    <div class="modal-padding">
                        <span class="close_multi">
                            <img class="close-icon" alt="Luk modal ikon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/close-icon.svg" />
                        </span>
                        <div class="modal-text">
                            <h4><?=get_the_title()?></h4>
                            <p><?=get_the_content()?></p>
                                
                            <a href="<?=get_field('calendar-sporti-link')?>">Gå til Sporti</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php
    }
        } else {
            echo 'Der er ingen begivenheder i denne kategori.';
        }
        echo '</div>';
        wp_reset_postdata();
    ?>
<div style="height: 1000px"></div>
<?php get_footer();?>