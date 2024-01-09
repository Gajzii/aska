<?php
    $hero_overskrift = get_field('hero_overskrift'); // Henter indholdet fra ACF 
    $hero_tekst = get_field('hero_tekst'); // Henter indholdet fra ACF 
    $hero_knap = get_field('hero_knap'); // Henter indholdet fra ACF
?>

<div class="hero">
    <div class="page-margin">
        <div class="hero-content">
            <h1><?= $hero_overskrift?></h1> <!-- Overskrift fra ACF -->
            <h4 class="hero-text"><?= $hero_tekst?></h4> <!-- Tekst fra ACF -->
            <a class="primary-btn-border" href="<?= $hero_knap['url']; ?>">
                <!-- Knap fra ACF -->
                <button class="primary-btn btn-text-primary">
                    <?= $hero_knap['title']; ?>
                    <!-- Knap fra ACF -->
                    <img class="arrow-icon" alt="Pil ikon til højre"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/arrow.svg" />
                    <!-- Pileikon fra assets -->
                </button>
            </a>
        </div>
    </div>
</div>