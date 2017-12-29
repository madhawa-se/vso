<section class="footer">
    <div class="content-wep">
        <a href="#" class="upbtn animated fadeOut">Up</a>
        <div class="container container-fluid container-fluid-footer container-padding-topBottom">
            <div class="row">
                <div class=" left">
                    <p><?php echo get_footer_company_title(); ?></p>

                    <?php
                    if (has_nav_menu('footermain')) {
                        $menu_footer_defaults = array(
                            'theme_location' => 'footermain',
                            'container' => false,
                            'container_class' => '',
                            'container_id' => '',
                            'menu_class' => 'footer-menu',
                            'menu_id' => 'menu-footer-menu',
                            'echo' => true,
                            'depth' => 1,
                        );
                    }

                    if (has_nav_menu('footermain')) {
                        wp_nav_menu($menu_footer_defaults);
                    }
                    ?>
                    <?php /* ?>
                      <p class="mhte">ΜΗΤΕ: 1351Κ013Α0207500</p>
                      <?php */ ?>
                </div>
                <div class="right">
                    <div class="addthis-container">

                        <div class="adthiswrp">
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                <a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
                            </div>

                            <!-- AddThis Button END -->
                            <?php
                            $facebooklikeurl = get_facebooklike_url();
                            if ($facebooklikeurl != '') {
                                ?>
                                <div class="fb-like" data-href="<?php echo $facebooklikeurl; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                            <?php } ?>

                        </div>

                        <ul class="socialfooter">
                            <?php
                            echo x2_get_socials('facebook', 0);
                            echo x2_get_socials('instagram', 0);
                            echo x2_get_socials('pinterest', 0);
                            echo x2_get_socials('youtube', 0);
                            echo x2_get_socials('googleplus', 0);
                            echo x2_get_socials('twitter', 0);
                            echo x2_get_socials('flickr', 0);
                            echo x2_get_socials('tripadvisor', 0);
                            ?>
                        </ul>

                        <?php
                        $awards = get_footer_icons_awards();
                        if (count($awards) > 0) :
                            ?>
                            <ul class="promo-icons-footer">
                                <?php
                                foreach ($awards as $award) {
                                    ?>
                                    <li><a target="_blank" href="<?php echo $award['url']; ?>">
                                            <img src="<?php echo $award['img']; ?>" />
                                            <img class="hover" src="<?php echo $award['img_hover']; ?>" />
                                        </a></li>
                                <?php } ?>
                            </ul>
                        <?php endif; ?>

                        <?php
                        $weather_info = get_weather_info();
                        if ($weather_info['weather_showhide'] == '1') {
                            ?>
                            <div class="weathercont">
                                <?php if ($weather_info['weather_placename'] != '') { ?>
                                    <p class="weathercont-text"><?php echo stripslashes($weather_info['weather_placename']); ?></p>
                                <?php } ?>
                                <p class="weathercont-temp"></p>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>