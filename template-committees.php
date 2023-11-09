<?php   
/**
 *  Template Name: Committees */
?>

<?php get_header(); ?>

<!-- <div style="padding-top:100px;color:black !important;">

    <?php
    $committee_pages = get_pages(array(
        'child_of' => 176, // ID of the parent page
        'sort_column' => 'post_title',
    ));
?>

    <?php if (!empty($committee_pages)) : ?>
    <h3>My Page List :</h3>
    <?php foreach ($committee_pages as $page) : ?>
    <?php 
            $page_title = get_the_title($page);
            $page_url = get_permalink($page);
            $page_id = $page->ID;
        ?>
    <br /> <?= $page_title; ?> (<?= $page_url; ?>) ID: <?= $page_id; ?>
    <?php endforeach; ?>
    <?php endif; ?>

</div> -->


<?php $committees_hero_img = get_field('committees_hero_img'); ?>

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $committees_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<div class="page-margin">
    <div class="page-cards-flex">

        <!-- PAGE CARD CONTENT -->
        <?php if ( have_rows('committees') ) : ?>
        <?php while ( have_rows('committees') ) : the_row(); ?>
        <?php
                $committees_heading = get_sub_field('committees_heading');
                $committees_bg_img = get_sub_field('committees_bg_img');
                $committees_description = get_sub_field('committees_description');
                $committees_text = get_sub_field('committees_text');
            ?>

        <div class="page-card" ontouchmove=""
            style="background-image: url('<?php echo $committees_bg_img['url']; ?>');">
            <div class="page-card-heading" ontouchmove="">
                <h4>
                    <?= $committees_heading ?>
                </h4>
                <div class="page-card-details">
                    <p class="page-card-description"><?= $committees_description ?></p>


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
        <?php if ( have_rows('committees') ) : ?>
        <?php while ( have_rows('committees') ) : the_row(); ?>
        <?php
                $committees_heading = get_sub_field('committees_heading');
                $committees_bg_img = get_sub_field('committees_bg_img');
                // $committees_description = get_sub_field('committees_description');
                $committees_text = get_sub_field('committees_text');
                $committees_link = get_sub_field('committees_link');

        // Check if 'page_cards_link' field has data
        if ($committees_link) {
            // Render the modal content with the link/button
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
                            <h4><?= $committees_heading?></h4>
                            <div class="modal-text-p"><?= $committees_text?>
                                <a class="secondary-btn-border modal-btn-link" href="<?= $committees_link['url']; ?>">
                                    <button class="secondary-btn btn-text-secondary btn-text-link">
                                        <?= $committees_link['title']; ?>
                                        <img class="arrow-icon" alt="Pil ikon til højre"
                                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="modal-img-overlay">
                        <img class="modal-img" src="<?php echo $committees_bg_img['url']; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else {
            // Render the modal content without the link/button
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
                            <h4><?= $committees_heading?></h4>
                            <div class="modal-text-p"><?= $committees_text?></div>
                        </div>
                    </div>
                    <div class="modal-img-overlay">
                        <img class="modal-img" src="<?php echo $committees_bg_img['url']; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
    endwhile;
    ?>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>