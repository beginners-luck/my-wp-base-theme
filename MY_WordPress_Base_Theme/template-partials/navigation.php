<nav id="navigation-menu" class="container-fluid">
    <div>
        <a id="home-logo-link" href="<?php echo get_home_url(); ?>">
            <img class="logo" alt="Site logo" src="<?php echo get_template_directory_uri() . "/images/logo.svg" ?>" />
        </a>

        <a id="mobile-menu-toggle" href="#">
            <span class="icon-menu">=</span>
            <span class="icon-close">x</span>
        </a>

        <div id="menus-container">
            <div id="top-nav-links">
                <?php wp_nav_menu(array('theme_location' => 'top_menu'));?>
            </div>
            <div id="nav-links">
                <?php wp_nav_menu(array('theme_location' => 'main_menu', 'before' => '<div class="parent-menu-item-wrapper">' , 'after' => '<a href="#" class="sub-menu-dropdown-toggle"></a></div>')); ?>
            </div>
        </div> 
    </div>
</nav>

<div id="mobile-navigation-menu" class="container-fluid"> 
    <div id="menus-container">
        <div id="nav-links">
            <?php wp_nav_menu(array('theme_location' => 'main_menu', 'before' => '<div class="parent-menu-item-wrapper">' , 'after' => '<a href="#" class="sub-menu-dropdown-toggle"></a></div>')); ?>
        </div>
        <div id="top-nav-links">
            <?php wp_nav_menu(array('theme_location' => 'top_menu'));?>
        </div>
    </div>
</div>