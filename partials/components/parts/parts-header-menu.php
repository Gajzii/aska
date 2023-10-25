<header>
    <div class="header-background"></div>
    <div class="header-inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img alt="ASKA Islandshesteklub logo" class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/logo.svg" />
        </a>
        <nav class="menu-container">
            <div id="dropdownmenu" onclick="onClickMenu()">
                <div id="bar1" class="bar"></div>
                <div id="bar2" class="bar"></div>
                <div id="bar3" class="bar"></div>
            </div>

            <?php wp_nav_menu(
                array(
                    'theme_location' => 'top-menu',
                    'container_class' => 'top-menu',
                )
                );
            ?>
        </nav>
    </div>
    <div class="gradient-border"></div>
</header>
