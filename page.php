<?php $page_hero_img = get_field('page_hero_img'); ?>

<?php get_header(); ?>

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $page_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<!-- PAGE CONTENT -->
<?php if ( have_rows('page_cards') ) : ?>
<?php while ( have_rows('page_cards') ) : the_row(); ?>
<?php
                $page_cards_heading = get_sub_field('page_cards_heading');
                $page_cards_bg_img = get_sub_field('page_cards_bg_img');
                $page_cards_description = get_sub_field('page_cards_description');
                $page_cards_text = get_sub_field('page_cards_text');
            ?>

<div class="page-margin">
    <div class="page-cards-flex">
        <div class="page-card" tabindex="0" ontouchmove=""
            style="background-image: url('<?php echo $page_cards_bg_img['url']; ?>');">
            <div class="page-card-heading" tabindex="0" ontouchmove="">
                <h4>
                    <?= $page_cards_heading ?>
                </h4>
                <div class="page-card-details">
                    <p class="page-card-description"><?= $page_cards_description ?></p>

                    <?php get_template_part( 'partials/components/parts/parts','secondary-btn' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>