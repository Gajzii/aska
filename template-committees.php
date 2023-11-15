<?php   
/**
 *  Template Name: Committees */
?>

<?php get_header(); ?>

<?php $committees_hero_img = get_field('committees_hero_img'); ?>

<!-- PAGE HERO -->
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $committees_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<div class="page-margin">
    <div class="page-cards-flex">

        <!-- PAGE CARD CONTENT -->

        <?php
            $committee_pages = get_pages(array(
                'child_of' => 23,
                'sort_column' => 'post_title',
            ));
        ?>

        <?php if (!empty($committee_pages)) : ?>
        <?php foreach ($committee_pages as $page) : ?>
        <?php 
            $page_title = get_the_title($page);
            $page_url = get_permalink($page);
            $page_img = get_field('page_hero_img', $page);
        ?>

        <div class="page-card" ontouchmove="" style="background-image: url('<?= $page_img['url']; ?>');">
            <div class="page-card-heading" ontouchmove="">
                <h4>
                    <?= $page_title; ?>
                </h4>
                <div class="page-card-details">
                    <br>
                    <a href="<?= $page_url; ?>" class="secondary-btn-border page-read-more-btn">
                        <button class="readMore_multi secondary-btn btn-text-secondary page-read-more-btn-secondary">
                            Læs mere
                            <img class="arrow-icon" alt="Pil ikon til højre"
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
</div>

<?php get_footer(); ?>