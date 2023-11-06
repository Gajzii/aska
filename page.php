<?php $page_hero_img = get_field('page_hero_img'); ?>



<?php if ( have_rows('page_cards') ) : ?>
<?php while ( have_rows('page_cards') ) : the_row(); ?>
<?php
                $page_cards_heading = get_sub_field('page_cards_heading');
                $page_cards_bg_img = get_sub_field('page_cards_bg_img');
                $page_cards_description = get_sub_field('page_cards_description');
                $page_cards_text = get_sub_field('page_cards_text');
            ?>

<?php get_header(); ?>

<div class="">
    <img class="page-hero" src="<?php echo $page_hero_img['url']; ?>" />
    <?= get_the_title(); ?>
</div>

<div class="page-margin">



</div>



<?php get_footer(); ?>

<?php endwhile; ?>
<?php endif; ?>