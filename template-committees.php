<?php   
/**
 *  Template Name: Committees */
?>

<?php get_header(); ?>

<div style="padding-top:100px;color:black !important;">

<?php
    $committee_pages = get_pages(array(
        'child_of' => 119, // ID of the parent page
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

</div>


<?php get_footer(); ?>