<?php

// Enqueue CSS
function enqueue_styling() {
    wp_register_style(
        'style',
        get_template_directory_uri() . '/assets/css/style.css',
        '',
        '1.0',
        'screen',
    );

    wp_enqueue_style('style');
}

add_action( 'wp_enqueue_scripts', 'enqueue_styling' );

// Enqueue JS
function enqueue_script() {
    wp_register_script(
        'main',
        get_template_directory_uri() . '/assets/js/main.js',
        '',
        '1.0',
        'false',
    );

    wp_enqueue_script('main');
}

add_action( 'wp_enqueue_scripts', 'enqueue_script' );
?>