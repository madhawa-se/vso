<?php get_header(); ?>    
<body>


    <?php get_template_part('inc/inc-header'); ?> 
    <?php
    $firstSlide = x2_slider_print_imgdataattr_firstslide(get_the_ID());
    $gallery_imgs_arr = get_post_meta($x2postmeta->category_imagegallery, 'ct_mb_gallery_images', false);
    if (empty($gallery_imgs_arr)) {
        $gallery_imgs_arr = get_post_meta(getDefaultPhotogallery(), 'ct_mb_gallery_images', false);
    }
    ?>

    <section class="">
        <div class="img-wrp" data-size="fullscreen">

            <div class="imgsslider" <?php echo $firstSlide['atr']; ?>>

            </div>

            <div class="slogans-img-wrp topCenter roomTop">
                <div class="container container-fluid-100">
                    <div class="slogans">
                        <?php
                        $sloganColor = $x2postmeta->slide_slogan_color;
                        $sloganStyles = '';
                        $buttonStyles = '';
                        if ($sloganColor != '') {
                            $sloganStyles = 'style="color:' . $sloganColor . '"';
                            //$buttonStyles = 'style="border-color:' . $sloganColor . '; color:' . $sloganColor . ';"';
                        }
                        ?>
                        <p <?php echo $sloganStyles; ?>><?php echo $x2postmeta->slide_slogan; ?></p>
                        <a <?php echo $buttonStyles; ?> title="<?php echo $x2postmeta->slide_slogan_button_seotitle; ?>" href="#" class="btns marginTop28 scrolldownbtn"><?php echo ___('SCROLL DOWN', 'x2-frontend', 'scrolldown'); ?></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-wep slide-bg">
            <div class="container tableClass mobile-clear-table">
                <div class="row tableRowClass">
                    <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl verticalAlignMiddle padding-top-bottom-large">
                        <div class="row">
                            <div class="col-md-12 remove-left-right-paddings slideFixWidth990room rtop">


                                <h1 class="title-big maintitle-room maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_maintitle; ?></h1>
                                <h2 class="title-big subtitle lightgray-subtitle room-subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_subtitle; ?></h2>
                                
                                
                                <div class="two-col-content paddingtop">
                                    <div class="table-row">

                                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                                <div class="table-cell no-border-right">
                                                    <h5 class="blue-small-titles mythemecolor"><?php echo ($x2postmeta->room_deatails_header_title != '' ? $x2postmeta->room_deatails_header_title : ___('SUITE DETAILS', 'x2-frontend', 'room_suite_details')); ?></h5>
                                                    <div class="fck room-text">
                                                        <?php the_content(); ?>
                                                    </div>
                                                </div>
                                            <?php endwhile;
                                        endif; ?> 

                                        <div class="table-cell paddignleft roompaddignleft">
                                            <?php
                                                if ($x2postmeta->room_deatails_fck_2 != '') {
                                            ?>
                                            <h5 class="blue-small-titles mythemecolor"><?php echo $x2postmeta->room_deatails_header_title_2; ?></h5>
                                            <div class="fck room-text">
                                                <?php echo $x2postmeta->room_deatails_fck_2; ?>
                                            </div>
                                            <?php } ?>
                                            <?php
                                                if ($x2postmeta->room_deatails_fck_3 != '') {
                                            ?>
                                            <h5 class="blue-small-titles mythemecolor"><?php echo $x2postmeta->room_deatails_header_title_3; ?></h5>
                                            <div class="fck room-text">
                                                <?php echo $x2postmeta->room_deatails_fck_3; ?>
                                            </div>
                                            <?php } ?>
                                            <?php
                                                if ($x2postmeta->room_deatails_fck_4 != '') {
                                            ?>
                                            <h5 class="blue-small-titles mythemecolor"><?php echo $x2postmeta->room_deatails_header_title_4; ?></h5>
                                            <div class="fck room-text">
                                                <?php echo $x2postmeta->room_deatails_fck_4; ?>
                                            </div>
                                            <?php } ?>
                                            <?php
                                                if ($x2postmeta->room_deatails_fck_5 != '') {
                                            ?>
                                            <h5 class="blue-small-titles mythemecolor"><?php echo $x2postmeta->room_deatails_header_title_5; ?></h5>
                                            <div class="fck room-text">
                                                <?php echo $x2postmeta->room_deatails_fck_5; ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 remove-left-right-paddings slideFixWidth990room rbottom">
                                <div class="excol-action">
                                    <a class="btns excol expand" href="#">expand text</a>
                                    <a class="btns excol collapse hide-btn" href="#">collapse text</a>
                                </div>
                                <div class="actions-btns">
                                    <?php if ($x2postmeta->room_price != '') { ?>
                                        <h4><?php echo __('from', 'x2-frontend', 'room_from'); ?> <span class="mythemecolor">€<?php echo $x2postmeta->room_price; ?></span> <?php echo ___('per night', 'x2-frontend', 'room_per_night'); ?></h4>
                                    <?php } ?>
                                    <p>
                                    <?php
                                        $roomimagegallery = (!empty($x2postmeta->room_imagegallery) ? get_permalink($x2postmeta->room_imagegallery) : '' );
                                        if ($roomimagegallery != '') {
                                    ?>
                                        <a class="btns accomodation-gallery" href="<?php echo $roomimagegallery; ?>"><?php echo ___('view images', 'x2-frontend', 'btn_view_photos'); ?></a>
                                    <?php } ?>
                                    <?php
                                        $bookonlinelink = (!empty($x2postmeta->room_bookonlinelink) ? $x2postmeta->room_bookonlinelink : getBookonlineLink() );
                                        if ($bookonlinelink != '') {
                                    ?>
                                        <a class="btns accomodation-book" href="<?php echo $bookonlinelink; ?>" target="_parent"><?php echo ___('request a quote', 'x2-frontend', 'btn_booknow'); ?></a>
                                    <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php get_template_part( 'inc/inc-badges' ); ?> 

    <?php get_template_part('inc/inc-promo-slide'); ?> 

    <?php
    get_template_part('inc/inc', 'footer');
    ?>

<?php get_footer(); ?> 