<header>
    <div class="header-outer">
        <div class="header-background"></div>
        <div class="header-inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img alt="ASKA Islandshesteklub logo" class="logo"
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/logo.svg" />
            </a>
            <nav class="menu-container">
                <div id="dropdownmenu" onclick="onClickMenu()">
                    <!-- This is the hamburger menu button -->
                    <div id="bar1" class="bar"></div>
                    <div id="bar2" class="bar"></div>
                    <div id="bar3" class="bar"></div>
                </div>

                <?php wp_nav_menu( // Display the menu
                array( 
                    'theme_location' => 'top-menu', // Menu location in the admin panel 
                    'container_class' => 'top-menu', // Class name 
                )
                );
            ?>
            </nav>
        </div>
        <div class="gradient-border gradient-border-open"></div>
        <div class="header-overlay"></div>
    </div>
</header>