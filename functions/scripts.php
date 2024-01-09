<?php

// Enqueue CSS 
function enqueue_styling() {
    wp_register_style( // Register the styling 
        'style', // Name of the styling
        get_template_directory_uri() . '/assets/css/style.css', // Get the path to the styling
        '', // Dependencies 
        '1.0', // Version number 
        'screen', // Media type 
    );

    wp_enqueue_style('style'); // Enqueue the styling 
}

add_action( 'wp_enqueue_scripts', 'enqueue_styling' ); // Hook into the 'wp_enqueue_scripts' action 

// Enqueue JS
function enqueue_script() { 
    wp_register_script( // Register the script
        'main', // Name of the script
        get_template_directory_uri() . '/assets/js/main.js', // Get the path to the script
        '', // Dependencies
        '1.0', // Version number 
        'false', // Load the script in the footer 
    );

    wp_enqueue_script('main'); // Enqueue the script
}

add_action( 'wp_enqueue_scripts', 'enqueue_script' ); // Hook into the 'wp_enqueue_scripts' action
?>