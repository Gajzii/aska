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
<!-- ------------------- Category checkboxes ------------ -->
<?php
    $selected_categories = array();

    if (isset($_GET['category'])) {
        $selected_categories = (array)$_GET['category'];
    }

    $current_date = date('Y-m-d');
    $args_upcoming = array(
        'post_type' => 'kalender',
        'posts_per_page' => -1,
        'meta_key' => 'calendar-date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'calendar-date',
                'value' => $current_date,
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );

    $args_past = array(
        'post_type' => 'kalender',
        'posts_per_page' => -1,
        'meta_key' => 'calendar-date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'calendar-date',
                'value' => $current_date,
                'compare' => '<',
                'type' => 'DATE',
            ),
        ),
    );

    if (!empty($selected_categories)) {
        $args_upcoming['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $selected_categories,
            ),
        );

        $args_past['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $selected_categories,
            ),
        );
    }

    // ------------------- Event search ----------------------- //
    if (isset($_GET['event_search'])) {
        $search_term = sanitize_text_field($_GET['event_search']);
        $args_upcoming['s'] = $search_term;
        $args_past['s'] = $search_term;
    }

    $custom_query_upcoming = new WP_Query($args_upcoming);
    $custom_query_past = new WP_Query($args_past);

    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    ));
    $categories = array_filter($categories, function ($category) {
        $hidden_category_ids = array(10);
        return !in_array($category->term_id, $hidden_category_ids);
    });
?>
<!-- ------------------- Category checkboxes UI ------------- -->
<div class="calendar-filter-section">
    <form class="calendar-select-form" method="get" action="<?= esc_url(get_permalink()) ?>">
        <div class="calendar-select-section">

            <?php foreach ($categories as $category) {
                echo '<label class="calendar-select-checkbox">';
                echo '<input class="calendar-checkbox" type="checkbox" name="category[]" value="' . $category->slug . '"';
                if (in_array($category->slug, $selected_categories)) {
                    echo ' checked';
                }
                echo '>';
                echo $category->name;
                echo '</label>';
            } ?>

        </div>
        <div class="select-btn-container">
            <input type="submit" value="" class="secondary-btn-border filter-btn">
            <button class="filter-btn-inner readMore_multi secondary-btn btn-text-secondary">Filtrér valgte<img
                    class="arrow-icon" alt="Pil ikon til højre"
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" /></button>
        </div>
    </form>
    <a href="<?= esc_url(get_permalink()) ?>" class="calendar-clear">Nulstil filtrering</a>
</div>

<!-- ------------------- Event search UI ------------------ -->
<div class="calendar-filter-section-secondary">
    <div class="calendar-search-section">
        <form class="calendar-search-form" method="get" action="<?= esc_url(get_permalink()) ?>">
            <input type="text" class="calendar-search-input" name="event_search" placeholder="Søg efter begivenhed"
                value="<?php echo isset($_GET['event_search']) ? esc_attr($_GET['event_search']) : ''; ?>">
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
</div>
<div class="page-margin">
    <div class="secondary-gradient-border"></div>
</div>

<!-- ------------- Event Cards Upcoming Section ------------- -->
<?php
if ($custom_query_upcoming->have_posts()) {
    echo '<h2 class="calendar-header">Kommende begivenheder</h2>';
    echo '<div class="page-margin event-cards-container upcoming-container">';
    while ($custom_query_upcoming->have_posts()) {
        $custom_query_upcoming->the_post();?>

<?php display_event_card();
    }
    echo '</div>';
}
// ----------------- Event Cards Past Section ---------------- //
if ($custom_query_past->have_posts()) {
    echo '<div class="past-container">';
    echo '<h2 class="calendar-header">Afviklede begivenheder</h2>';
    echo '<div class="page-margin event-cards-container">';
    while ($custom_query_past->have_posts()) {
        $custom_query_past->the_post();?>
<div class="past-event-card">
    <?php display_event_card();?>
</div>
<?php
    }
    echo '</div>';?>
<div class="secondary-btn-border" id="showAllPastEventsButton" onclick="showAllPastEvents()">
    <button class="readMore_multi secondary-btn btn-text-secondary">Vis alle<img class="arrow-icon"
            alt="Pil ikon til højre" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
    </button>
</div>
<?php
    echo '</div>';
}

if (!$custom_query_upcoming->have_posts() && !$custom_query_past->have_posts()) {
    echo 'Der er ingen begivenheder i denne kategori.';
}

// ---------------------- Event Cards --------------------- //
function display_event_card() {
    $sporti_link_validation = get_field('calendar-sporti-link-validation');
    $fb_text = get_field('fb_text');
    $calendar_date = strtotime(get_field('calendar-date'));
    $day = wp_date('j', $calendar_date);
    $mon = wp_date('M', $calendar_date);
    $year = wp_date('Y', $calendar_date);
    
    ?>
<div class="membership-benefits-card event-card">
    <div class="benefits-icon-border event-card-border">
        <div class="benefits-icon-bg">
            <div class="event-date">
                <p class="event-dag"><?= $day ?></p>
                <p class="event-maaned"><?= $mon ?></p>
                <p class="event-aar"><?= $year ?></p>
            </div>
        </div>
    </div>

    <div class="benefits-card-bg event-card-bg">
        <h4><?= get_the_title() ?></h4>
        <div class="benefits-btn event-btn">
            <?php if ($sporti_link_validation === 'Nej') { ?>
            <p class="calendar-fb-text"><?= $fb_text ?></p>
            <?php } else { ?>
            <div class="secondary-btn-border">
                <a href="<?= get_field('calendar-sporti-link') ?>" target="_blank">
                    <button class="readMore_multi secondary-btn btn-text-secondary">Læs mere<img class="arrow-icon"
                            alt="Pil ikon til højre"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                    </button>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
    
    wp_reset_postdata();
}



get_footer(); ?>