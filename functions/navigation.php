<?php
// Theme Options
add_theme_support('menus'); // Enable custom menus in the admin panel 

//Menus
function menus(){ 
register_nav_menus(
  array(
    'top-menu' => __('Top Menu Location') // Top menu location in the admin panel
  )
);
}
add_action('init', 'menus'); // Hook into the 'init' action 
?>