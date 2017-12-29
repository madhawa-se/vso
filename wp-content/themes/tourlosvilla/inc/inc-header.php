<?php echo '<div itemscope itemtype="http://schema.org/LocalBusiness">'; ?>

<div class="preloader-overlay">
    <div class="preloader-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/preloader.gif" /></div>
</div> 

<div class="navbar navbar-default navbar-fixed-top mainnavbar-wrp" role="navigation">
            <div class="container-navi">
                <?php 
                    $logoOptions = get_static_icons();
                    $logo_itemprop = ($logoOptions['logo_desktop']!='' ? $logoOptions['logo_desktop'] : get_stylesheet_directory_uri().'/images/icons/logo-navi.png');
                ?>
                <div class="logo" content="<?php echo $logo_itemprop; ?>" itemprop="logo"><a title="<?php echo $logoOptions['logo_seotitle']; ?>" href="<?php echo site_url(); ?>">Home</a></div>

                <?php 
                    $langOptions = get_languages_options();
                    $lang_settings = getCurrentLang();
                    if ($langOptions['status'] == true) {
                ?>
                <div class="navbar-collapse navbar-collapse-left collapse">
                    <ul class="nav navbar-nav">
                        <li class="lang" class="menu-item menu-item-type-post_type menu-item-object-page"><a class="selected-lang" href="#"><?php echo $lang_settings['iso']['text_active']; ?></a>
                            <ul role="menu" class=" dropdown-menu">
                                <li><a href="/">EN</a></li>
                                <li><a href="/gr/">GR</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>  
                <?php } ?>

                <div class="mobile-navigation-c <?php echo ( $langOptions['status'] == true ? 'lang-active' : '' ); ?>">
                    <?php
                        $bookinglink= getBookonlineLink();
                        $bookinglink_target = getBookonlineLink_linktarget_themeoptions();
                    ?>
                    <a href="#" class="hamburger-icon <?php echo ( $langOptions['status'] == true ? '' : 'nolang' ); ?>">hamburger menu</a>
                    <a href="#" class="closemainmenubtn">close menu</a>
                    <a href="<?php echo $bookinglink; ?>" target="<?php echo $bookinglink_target; ?>" class="bookonline-btn"><?php echo ___('BOOK', 'x2-frontend','mainmenu_bookonline_mobile'); ?></a>
                </div>  
                
                
                <?php
                if (has_nav_menu('main')) {
                        $menu_main_defaults = array(
                            'theme_location' => 'main',
                            'container' => 'div',
                            'container_class' => 'navbar-collapse navbar-collapse-mainmenu collapse',
                            'container_id' => '',
                            'menu_class' => 'nav navbar-nav afterArrow',
                            'menu_id' => 'menu-main-menu',
                            'echo' => true,
                            'depth' => 3,
                            'walker' => new wp_bootstrap_navwalker()
                        );
                        
                        if ($langOptions['status'] == true) {
                            $menu_main_defaults['menu_class'] = 'nav navbar-nav afterArrow lang-enabled';
                        }
                }

                if (has_nav_menu('main')) {
                        wp_nav_menu($menu_main_defaults);
                }
                ?>  
                
            </div>
        </div>  