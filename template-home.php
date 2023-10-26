<?php   
/**
 *  Template Name: Home */
?>

<?php get_header(); ?>

<div class="hero">
    <div class="page-margin">
        <div class="hero-content">
            <h1><?php echo get_the_title(); ?></h1>
            <h4 class="hero-text"><?php echo get_the_content(); ?></h4>
        </div>
    </div>
</div>

<?php get_template_part( 'partials/components/sections/sections','hero-cta' ); ?>


<?php get_footer(); ?>