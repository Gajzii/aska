<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1"> <!-- This is for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1.0">
    <!-- This is for mobile devices -->
    <?php wp_head(); ?>
    <!-- This is for Wordpress -->

</head>

<body <?php body_class(); ?> <?php get_template_part( 'partials/components/parts/parts','header-menu' ); ?>