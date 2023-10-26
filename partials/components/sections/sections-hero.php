    <?php
        $hero_overskrift = get_field('hero_overskrift');
        $hero_tekst = get_field('hero_tekst');
    ?>

<div class="hero">
    <div class="page-margin">
        <div class="hero-content">
            <h1><?= $hero_overskrift?></h1>
            <h4 class="hero-text"><?= $hero_tekst?></h4>
        </div>
    </div>
</div>