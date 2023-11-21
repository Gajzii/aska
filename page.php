<?php get_header(); ?>

<?php $page_hero_img = get_field('page_hero_img'); ?>

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $page_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<div class="page-margin">
    <div class="page-cards-flex">

        <!-- PAGE CARD CONTENT -->
        <?php if ( have_rows('page_cards') ) : ?>
        <?php while ( have_rows('page_cards') ) : the_row(); ?>
        <?php
                $page_cards_heading = get_sub_field('page_cards_heading');
                $page_cards_bg_img = get_sub_field('page_cards_bg_img');
                $page_cards_description = get_sub_field('page_cards_description');
                $page_cards_text = get_sub_field('page_cards_text');
            ?>

        <div class="page-card" ontouchmove=""
            style="background-image: url('<?php echo $page_cards_bg_img['url']; ?>');">
            <div class="page-card-heading" ontouchmove="">
                <h4>
                    <?= $page_cards_heading ?>
                </h4>
                <div class="page-card-details">
                    <p class="page-card-description"><?= $page_cards_description ?></p>


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
        <?php endif; ?>



        <!-- MODAL -->
        <?php if (have_rows('page_cards')) : ?>
        <?php while (have_rows('page_cards')) : the_row();
        $page_cards_heading = get_sub_field('page_cards_heading');
        $page_cards_bg_img = get_sub_field('page_cards_bg_img');
        $page_cards_text = get_sub_field('page_cards_text');
        $page_cards_btn_choice = get_sub_field('page_cards_btn_choice');
        $page_cards_link = get_sub_field('page_cards_link');
        $page_cards_file = get_sub_field('page_cards_file');
        
        $modal_content = ''; // Initial empty variable for modal content
        
        if ($page_cards_btn_choice === 'Ja - link' && $page_cards_link) {
            $modal_content = '
                <a class="secondary-btn-border modal-btn-link" href="' . $page_cards_link['url'] . '">
                    <button class="secondary-btn btn-text-secondary btn-text-link">' . $page_cards_link['title'] . '
                        <img class="arrow-icon" alt="Pil ikon til højre" src="' . get_stylesheet_directory_uri() . '/assets/media/arrow.svg" />
                    </button>
                </a>
            ';
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
        }
        
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
                            <h4><?= $page_cards_heading ?></h4>
                            <div class="modal-text-p"><?= $page_cards_text ?>
                                <div><?= $modal_content ?></div>
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
        <?php endif; ?>

    </div>
</div>
<?php get_footer(); ?>