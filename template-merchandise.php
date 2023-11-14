<?php   
/**
 *  Template Name: Merchandise */
?>

<?php $merch_hero_img = get_field('merch_hero_img'); ?>

<?php get_header(); ?>
<div class="page-hero-container">
    <img class="page-hero" src="<?php echo $merch_hero_img['url']; ?>" />
    <h1 class="page-hero-content"><?= get_the_title(); ?></h1>
</div>

<?php 
    $merch_heading = get_field('merch_heading'); 
    $merch_description = get_field('merch_description');
?>

<div class="page-margin merch">

    <div class="merch-heading">
        <p><?php the_content(); ?></p>
        <h2><?= $merch_heading?></h2>
        <p><?= $merch_description?></p>
    </div>

    <div class="merch-flex">
        <?php if ( have_rows('merch_merchandise') ) : ?>
        <?php while ( have_rows('merch_merchandise') ) : the_row(); ?>
        <?php
                $merch_imgs = get_sub_field('merch_imgs');
                $merch_merchandise_heading = get_sub_field('merch_merchandise_heading');
                $merch_merchandise_description = get_sub_field('merch_merchandise_description');
                $merch_merchandise_price = get_sub_field('merch_merchandise_price');
                $merch_merchandise_glitter = get_sub_field('merch_merchandise_glitter');
            ?>

        <div>
            <?php 
            if( $merch_imgs ): ?>
            <ul class="merch-imgs-flex">
                <?php foreach( $merch_imgs as $image ): ?>
                <li class="merch-img-bg">
                    <a target="_blank" href="<?php echo esc_url($image['url']); ?>">
                        <img class="merch-img" src="<?php echo $image['url']; ?> ; ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>" />
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="merch-description-text">
                <h3><?= $merch_merchandise_heading?></h3>
                <p><?= $merch_merchandise_description?></p>
                <div class="merch-price">
                    <p>Pris: <?= $merch_merchandise_price?> kr
                        <?php if ($merch_merchandise_glitter) : ?>
                        &lpar; +<?= $merch_merchandise_glitter ?> kr for glittertryk&rpar;</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>