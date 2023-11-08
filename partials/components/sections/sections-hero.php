<?php
    $hero_overskrift = get_field('hero_overskrift');
    $hero_tekst = get_field('hero_tekst');
    $hero_knap = get_field('hero_knap');
?>

<div class="hero">
    <div class="page-margin">
        <div class="hero-content">
            <h1><?= $hero_overskrift?></h1>
            <h4 class="hero-text"><?= $hero_tekst?></h4>
            <a class="primary-btn-border" href="<?= $hero_knap['url']; ?>">
                <button class="primary-btn btn-text-primary">
                    <?= $hero_knap['title']; ?>
                    <img class="arrow-icon" alt="Pil ikon til højre"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                </button>
            </a>
        </div>
    </div>
</div>