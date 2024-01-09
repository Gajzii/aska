<!-- this is the default page template -->

<?php get_header(); ?>

<?php $page_hero_img = get_field('page_hero_img'); ?>
<!-- Henter indholdet fra ACF -->

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $page_hero_img['url']; ?>" /> <!-- Indhold fra ACF -->
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1> <!-- Titel fra WP -->
</div>

<div class="page-margin">
    <div class="page-cards-flex">

        <!-- PAGE CARD CONTENT -->
        <?php if ( have_rows('page_cards') ) : ?>
        <!-- ACF Repeater field -->
        <?php while ( have_rows('page_cards') ) : the_row(); ?>
        <!-- ACF Repeater field -->
        <?php
                $page_cards_heading = get_sub_field('page_cards_heading'); // Henter indholdet fra ACF
                $page_cards_bg_img = get_sub_field('page_cards_bg_img'); // Henter indholdet fra ACF 
                $page_cards_description = get_sub_field('page_cards_description'); // Henter indholdet fra ACF
                $page_cards_text = get_sub_field('page_cards_text'); // Henter indholdet fra ACF
            ?>

        <div class="page-card" ontouchmove=""
            style="background-image: url('<?php echo $page_cards_bg_img['url']; ?>');">
            <div class="page-card-heading" ontouchmove="">
                <h4>
                    <?= $page_cards_heading ?>
                    <!-- Indhold fra ACF -->
                </h4>
                <div class="page-card-details">
                    <p class="page-card-description"><?= $page_cards_description ?></p> <!-- Indhold fra ACF -->


                    <div class="secondary-btn-border page-read-more-btn">
                        <button class="readMore_multi secondary-btn btn-text-secondary page-read-more-btn-secondary">
                            Læs mere
                            <img class="arrow-icon" alt="Pil ikon til højre"
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <!-- ACF Repeater field -->
        <?php endif; ?>
        <!-- ACF Repeater field -->



        <!-- MODAL -->
        <?php if (have_rows('page_cards')) : ?>
        <!-- ACF Repeater field -->
        <?php while (have_rows('page_cards')) : the_row(); // ACF Repeater field 
        $page_cards_heading = get_sub_field('page_cards_heading'); // Henter indholdet fra ACF
        $page_cards_bg_img = get_sub_field('page_cards_bg_img'); // Henter indholdet fra ACF
        $page_cards_text = get_sub_field('page_cards_text'); // Henter indholdet fra ACF
        $page_cards_btn_choice = get_sub_field('page_cards_btn_choice'); // Henter indholdet fra ACF
        $page_cards_link = get_sub_field('page_cards_link'); // Henter indholdet fra ACF
        $page_cards_file = get_sub_field('page_cards_file'); // Henter indholdet fra ACF
        
        $modal_content = ''; // Initial empty variable for modal content
        
        if ($page_cards_btn_choice === 'Ja - link' && $page_cards_link) { // If statement for modal content 
            $modal_content = ' 
                <a class="secondary-btn-border modal-btn-link" href="' . $page_cards_link['url'] . '">
                    <button class="secondary-btn btn-text-secondary btn-text-link">' . $page_cards_link['title'] . '
                        <img class="arrow-icon" alt="Pil ikon til højre" src="' . get_stylesheet_directory_uri() . '/assets/media/arrow.svg" />
                    </button>
                </a>
            '; // Modal content for link button 
        } elseif ($page_cards_btn_choice === 'Ja - fil') {
            $modal_content = '
                <a target=_blank class="secondary-btn-border modal-btn-link" href="' . $page_cards_file['url'] . '">
                    <button class="secondary-btn btn-text-secondary btn-text-link">' . $page_cards_file['title'] . '
                        <img class="arrow-icon" alt="Pil ikon til højre" src="' . get_stylesheet_directory_uri() . '/assets/media/arrow.svg" />
                    </button>
                </a>
            ';
        } else {
            $modal_content = '';
        } // Modal content for file button 
        
        ?>
        <div class="modal modal_multi">
            <div class="modal-flex">
                <div class="page-modal-content">
                    <div class="modal-padding">
                        <span class="close_multi">
                            <img class="close-icon" alt="Luk modal ikon"
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/close-icon.svg" />
                        </span>
                        <div class="modal-text">
                            <h4><?= $page_cards_heading ?></h4> <!-- Indhold fra ACF -->
                            <div class="modal-text-p"><?= $page_cards_text ?>
                                <!-- Indhold fra ACF -->
                                <div><?= $modal_content ?></div> <!-- Indhold fra ACF -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-img-overlay">
                        <img class="modal-img" src="<?php echo $page_cards_bg_img['url']; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <!-- ACF Repeater field -->
        <?php endif; ?>
        <!-- ACF Repeater field -->

    </div>
</div>
<?php get_footer(); ?>