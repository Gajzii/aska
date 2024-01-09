<div class="membership-benefits-section">
    <div class="page-margin">
        <div class="membership-benefits-text">
            <h2>Medlemsfordele</h2>
            <p>Som medlem af ASKA får du adgang til en række eksklusive fordele, som du kan drage nytte af. Du kan finde
                flere
                oplysninger om vores forskellige medlemsfordele nedenfor.</p>
        </div>
        <div class="prev-next-btns">

            <div class="membership-benefits-cards membership-benefits-cards-grid">

                <!-- start af ACF repeater field -->
                <?php if ( have_rows('membership_benefits') ) : ?>
                <!-- ACF Repeater field -->
                <div class="cards-container">
                    <?php while ( have_rows('membership_benefits') ) : the_row(); ?>
                    <!-- ACF Repeater field -->
                    <?php
                $membership_benefits_discount = get_sub_field('membership_benefits_discount'); // Henter indholdet fra ACF 
                $membership_benefits_heading = get_sub_field('membership_benefits_heading'); // Henter indholdet fra ACF
                $read_more_btn = get_sub_field('read_more_btn'); // Henter indholdet fra ACF
                $membership_benefits_img = get_sub_field('membership_benefits_img'); // Henter indholdet fra ACF 
                $membership_benefits_description = get_sub_field('membership_benefits_description'); // Henter indholdet fra ACF 
            ?>

                    <div class="membership-benefits-card">
                        <div class="benefits-icon-border">
                            <div class="benefits-icon-bg">
                                <h3><?= $membership_benefits_discount?>%</h3> <!-- Indhold fra ACF -->
                            </div>
                        </div>
                        <div class="benefits-card-bg">
                            <h4><?= $membership_benefits_heading?></h4> <!-- Indhold fra ACF -->
                            <div class="benefits-btn">
                                <div class="secondary-btn-border">
                                    <button class="readMore_multi secondary-btn btn-text-secondary">
                                        Læs mere
                                        <img class="arrow-icon" alt="Pil ikon til højre"
                                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                                    </button>
                                </div>
                            </div>
                            <div class="benefits-card-img-overlay">
                                <img class="benefits-card-img" src="<?php echo $membership_benefits_img['url']; ?>" />
                                <!-- Indhold fra ACF -->
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <!-- ACF Repeater field -->
                    <?php endif; ?>
                    <!-- ACF Repeater field -->
                </div>
            </div>
            <div class="arrow-btn-border arrow-icon-left-grid">
                <button class="arow-btn prev-btn">
                    <img class="arrow-icon-left" alt="Pil ikon til venstre"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow-left.svg" />
                </button>
            </div>
            <div class="arrow-btn-border arrow-icon-right-grid">
                <button class="arow-btn next-btn">
                    <img class="arrow-icon-right" alt="Pil ikon til venstre"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                </button>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
<?php if ( have_rows('membership_benefits') ) : ?>
<!-- ACF Repeater field -->
<?php while ( have_rows('membership_benefits') ) : the_row(); ?>
<!-- ACF Repeater field -->
<?php 
                $membership_benefits_discount = get_sub_field('membership_benefits_discount'); // Henter indholdet fra ACF
                $membership_benefits_heading = get_sub_field('membership_benefits_heading'); // Henter indholdet fra ACF
                $membership_benefits_img = get_sub_field('membership_benefits_img'); // Henter indholdet fra ACF
                $membership_benefits_description = get_sub_field('membership_benefits_description'); // Henter indholdet fra ACF
            ?>


<div class="modal modal_multi">
    <div class="membership-modal-flex">
        <div class="membership-modal-flex">

            <div class="benefits-icon-border modal-discount">
                <div class="benefits-icon-bg">
                    <h3><?= $membership_benefits_discount?>%</h3> <!-- Indhold fra ACF -->
                </div>
            </div>

            <div class="modal-content">
                <div class="modal-padding">
                    <span class="close_multi">
                        <img class="close-icon" alt="Luk modal ikon"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/close-icon.svg" />
                    </span>
                    <div class="modal-text">
                        <h4><?= $membership_benefits_heading?></h4> <!-- Indhold fra ACF -->
                        <div class="membership-modal-text-p">
                            <p><?= $membership_benefits_description?></p> <!-- Indhold fra ACF -->
                        </div>
                    </div>
                </div>
                <div class="modal-img-overlay">
                    <img class="modal-img" src="<?php echo $membership_benefits_img['url']; ?>" />
                    <!-- Indhold fra ACF -->
                </div>
            </div>

        </div>
    </div>
</div>
<?php endwhile; ?>
<!-- ACF Repeater field -->
<?php endif; ?>
<!-- ACF Repeater field -->