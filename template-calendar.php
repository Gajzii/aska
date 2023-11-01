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
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Stævner</h3>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Ungdom</h3>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="calendar-select-conatiner">
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Ture</h3>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container calender-select-item">
                <h3 class="calendar-select-text">Stævner</h3>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>

<div class="calendar-event-section">
    <?php if ( have_rows('calendar_item') ) : ?>
    <div class="event-card">
        <?php while ( have_rows('calendar_item') ) : the_row(); ?>
            
        <?php
            $calendar_title = get_sub_field('calendar-title');
            $calendar_subtitle = get_sub_field('calendar-subtitle');
            $calendar_description = get_sub_field('calendar-description');
            $calendar_event_category = get_sub_field('calendar-event-category');
            $calendar_date_day = get_sub_field('calendar-date-day');
            $calendar_date_month = get_sub_field('calendar-date-month');
            $calendar_date_year = get_sub_field('calendar-date-year');
        ?>
        <!-- <div class="event-card-inner">
            
        </div> -->
         <div class="membership-benefits-card">
                <div class="benefits-icon-border event-card-border">
                    <div class="benefits-icon-bg event-card-date">
                        <p class="calendar_date_day"><?= $calendar_date_day;?></p>
                        <p class="calendar_date_month"><?= $calendar_date_month;?></p>
                        <p class="calendar_date_year"><?= $calendar_date_year;?></p>
                    </div>
                </div>
                <div class="benefits-card-bg event-card-bg">
                    <h4><?= $calendar_title;?></h4>
                    <div class="benefits-btn">
                        <div class="secondary-btn-border">
                            <button class="readMore_multi secondary-btn btn-text-secondary">
                                Læs mere
                                <img class="arrow-icon" alt="Pil ikon til højre"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
    <?php endif; ?>
</div>



<div style="height: 1000px"></div>
<?php get_footer();?>