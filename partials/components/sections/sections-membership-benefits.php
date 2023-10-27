<div class="membership-benefits-section">
    <div class="page-margin">
        <h2>Medlemsfordele</h2>
        <p>Som medlem af ASKA får du adgang til en række eksklusive fordele, som du kan drage nytte af. Du kan finde
            flere
            oplysninger om vores forskellige medlemsfordele nedenfor.</p>
        <div class="membership-benefits-cards">

            <?php if ( have_rows('membership_benefits') ) : ?>

            <?php while ( have_rows('membership_benefits') ) : the_row(); ?>
            <?php
                $membership_benefits_discount = get_sub_field('membership_benefits_discount');
                $membership_benefits_heading = get_sub_field('membership_benefits_heading');
                $read_more_btn = get_sub_field('read_more_btn');
                $membership_benefits_img = get_sub_field('membership_benefits_img');
            ?>

            <div class="membership-benefits-card">
                <div class="benefits-icon-border">
                    <div class="benefits-icon-bg">
                        <h3><?= $membership_benefits_discount?>%</h3>
                    </div>
                </div>
                <div class="benefits-card-bg">
                    <h4><?= $membership_benefits_heading?></h4>
                    <div class="benefits-btn">
                        <a class="primary-btn-border" href="<?= $read_more_btn['url']; ?>">
                            <button class="primary-btn btn-text-primary">
                                <?= $read_more_btn['title'];?>
                                <img class="arrow-icon" alt="Pil ikon til højre"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                            </button>
                        </a>
                    </div>
                    <div class="benefits-card-img-overlay">
                        <img class="benefits-card-img" src="<?php echo $membership_benefits_img['url']; ?>" />
                    </div>
                </div>
            </div>




            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="prev-next-btns">
        <?php get_template_part( 'partials/components/parts/parts','arrow-btn-left' ); ?>
        <?php get_template_part( 'partials/components/parts/parts','arrow-btn-right' ); ?>
    </div>
</div>