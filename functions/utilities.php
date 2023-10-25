<?php

add_action('acf/init', 'register_acf_options_page');

function register_acf_options_page() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Globale indstillinger'),
            'menu_title'    => __('Globale indstillinger'),
            'menu_slug'     => 'globale-indstillinger',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}