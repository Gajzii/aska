<?php
// Theme Options
add_theme_support('menus');

//Menus
function menus(){
register_nav_menus(
  array(
    'top-menu' => __('Top Menu Location')
  )
);
}
add_action('init', 'menus');