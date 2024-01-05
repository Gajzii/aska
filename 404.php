<?php   
/**
* The template for displaying 404 pages (Not Found) */
?>

<?php get_header(); ?>

<div class="page-margin">
    <div class="page-not-found">
        <h1 class="page-not-found-text">Siden blev ikke fundet</h1>
        <h4 class="page-not-found-text">Vi beklager, men den side, du forsøge at besøge, eksisterer ikke.</h4>
        <p class="page-not-found-text-p">Du kan prøve følgende:</p>
        <div class="page-not-found-list">
            <ul class="page-not-found-text">
                <li>Kontrollér, at du har skrevet adressen korrekt i adresselinjen.</li>
                <li>Gå til <a class="page-not-found-text" href="<?php echo esc_url( home_url() ); ?>">hjemmesiden</a>.
                </li>
                <li>Klik på tilbage-knappen i din browser for at gå til den side, du kom fra.</li>
            </ul>
        </div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img alt="ASKA Islandshesteklub logo" class="page-not-found-logo"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/logo.svg" />
        </a>
    </div>
</div>

<?php get_footer(); ?>