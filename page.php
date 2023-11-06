<?php $page_hero_img = get_field('page_hero_img'); ?>

<?php get_header(); ?>

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
        <?php endwhile; ?>
        <?php endif; ?>
    </div>


    <!-- MODAL -->
    <?php if ( have_rows('page_cards') ) : ?>
    <?php while ( have_rows('page_cards') ) : the_row(); ?>
    <?php
                $page_cards_heading = get_sub_field('page_cards_heading');
                $page_cards_bg_img = get_sub_field('page_cards_bg_img');
                $page_cards_description = get_sub_field('page_cards_description');
                $page_cards_text = get_sub_field('page_cards_text');
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
                        <h4><?= $page_cards_heading?></h4>
                        <p><?= $page_cards_text?></p>
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
<?php get_footer(); ?>