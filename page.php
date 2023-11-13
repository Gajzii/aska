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

        <!-- MANAGEMENT CARD -->

        <?php $page_cards_management_heading = get_field('page_cards_management_heading'); ?>
        <?php $page_cards_management_bg_img = get_field('page_cards_management_bg_img'); ?>
        <?php $page_cards_management_description = get_field('page_cards_management_description'); ?>


        <div class="page-card" ontouchmove=""
            style="background-image: url('<?php echo $page_cards_management_bg_img['url']; ?>');">
            <div class="page-card-heading" ontouchmove="">
                <h4>
                    <?= $page_cards_management_heading ?>
                </h4>
                <div class="page-card-details">
                    <p class="page-card-description"><?= $page_cards_management_description ?></p>


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
    </div>



    <!-- MODAL -->
    <?php if (have_rows('page_cards')) : ?>
    <?php while (have_rows('page_cards')) : the_row();
        $page_cards_heading = get_sub_field('page_cards_heading');
        $page_cards_bg_img = get_sub_field('page_cards_bg_img');
        $page_cards_description = get_sub_field('page_cards_description');
        $page_cards_text = get_sub_field('page_cards_text');
        $page_cards_link = get_sub_field('page_cards_link');

        // Check if 'page_cards_link' field has data
        if ($page_cards_link) {
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
                        <h4><?= $page_cards_heading?></h4>
                        <div class="modal-text-p"><?= $page_cards_text?>
                            <div>
                                <a class="secondary-btn-border modal-btn-link" href="<?= $page_cards_link['url']; ?>">
                                    <button class="secondary-btn btn-text-secondary btn-text-link">
                                        <?= $page_cards_link['title']; ?>
                                        <img class="arrow-icon" alt="Pil ikon til højre"
                                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-img-overlay">
                    <img class="modal-img" src="<?php echo $page_cards_bg_img['url']; ?>" />
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
                        <h4><?= $page_cards_heading?></h4>
                        <div class="modal-text-p"><?= $page_cards_text?></div>
                    </div>
                </div>
                <div class="modal-img-overlay">
                    <img class="modal-img" src="<?php echo $page_cards_bg_img['url']; ?>" />
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    endwhile;
    ?>
    <?php endif; ?>




    <!-- MANAGEMENT MODAL -->
    <?php $page_cards_management_text = get_field('page_cards_management_text'); ?>

    <div class="modal modal_multi">
        <div class="modal-flex modal-flex-management">
            <div class="page-modal-content page-modal-content-management">
                <div class="modal-padding">
                    <span class="close_multi">
                        <img class="close-icon" alt="Luk modal ikon"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/close-icon.svg" />
                    </span>
                    <div class="modal-text-management">
                        <h4><?= $page_cards_management_heading ?></h4>
                        <div class="modal-management-scroll">
                            <p><?= $page_cards_management_text ?></p>

                            <div class="management-modal-section">
                                <?php if (have_rows('management')) : ?>
                                <?php while (have_rows('management')) : the_row(); ?>
                                <?php
                                    $management_img = get_sub_field('management_img');
                                    $management_role = get_sub_field('management_role');
                                    $management_name = get_sub_field('management_name');
                                    $management_mail = get_sub_field('management_mail');
                                    $management_responsibility = get_sub_field('management_responsibility');
                                ?>
                                <div class="management-member-flex">
                                    <img class="modal-management-img" src="<?php echo $management_img['url']; ?>" />
                                    <div class="management-member">
                                        <h5><?= $management_role ?></h5>
                                        <p><?= $management_name ?></p>

                                        <div class="management-mail">
                                            <a target=_blank href="mailto:<?= $management_mail ?>">
                                                <?= $management_mail ?>
                                                <img class="mail-icon" alt="email ikon"
                                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/mail-icon.svg" />

                                            </a>
                                        </div>
                                        <ul>
                                            <?php foreach ($management_responsibility as $responsibility) : ?>
                                            <li><?= $responsibility ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>