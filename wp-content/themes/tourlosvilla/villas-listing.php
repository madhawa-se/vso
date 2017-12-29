<?php
/*
  Template Name: Ammenities Listing Template
 */
?> 
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

            <div class="slogans-img-wrp topCenter">
                <div class="container container-fluid-100">
                    <div class="slogans">
                        <?php
                        $sloganColor = $x2postmeta->slide_slogan_color;
                        $sloganStyles = '';
                        $buttonStyles = '';
                        if ($sloganColor != '') {
                            $sloganStyles = 'style="color:' . $sloganColor . '"';
                            //$buttonStyles = 'style="border-color:'.$sloganColor.'; color:'.$sloganColor.';"';
                        }
                        ?>
                        <p <?php echo $sloganStyles; ?>><?php echo $x2postmeta->slide_slogan; ?></p>
                        <?php
                        if (!empty($x2postmeta->slide_slogan_button_link) || $x2postmeta->slide_slogan_button_link_target == 'scrolldownbtn') {
                            $slide_slogan_button_text = ( $x2postmeta->slide_slogan_button_text != '' ? $x2postmeta->slide_slogan_button_text : ___('READ MORE', 'x2-frontend', 'readmore_btn') );
                            $slide_slogan_button_target = (!empty($x2postmeta->slide_slogan_button_link_target) && $x2postmeta->slide_slogan_button_link_target != 'scrolldownbtn' ? $x2postmeta->slide_slogan_button_link_target : 'parent' );
                            ?>
                            <a <?php echo $buttonStyles; ?> title="<?php echo $x2postmeta->slide_slogan_button_seotitle; ?>" href="<?php echo $x2postmeta->slide_slogan_button_link; ?>" class="btns marginTop28 <?php echo ( $x2postmeta->slide_slogan_button_link_target == 'scrolldownbtn' ? 'scrolldownbtn' : '' ); ?>" target="<?php echo $slide_slogan_button_target; ?>"><?php echo $slide_slogan_button_text; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-wep slide-bg">
            <div class="container tableClass mobile-clear-table">
                <div class="row tableRowClass">
                    <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl verticalAlignMiddle padding-top-bottom-large">
                        <div class="row">
                            <div class="col-md-7 col-md-offset-3 my-col-md-offset-3 remove-left-right-paddings slideFixWidth">

                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <h2 class="title-big maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_maintitle; ?></h2>
                                        <h3 class="title-big lightgray subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_subtitle; ?></h3>

                                        <div class="fck fck-justify paddingTop48 paddingTopMobileFck">
                                            <?php the_content(); ?>


                                            <div class="villas-listing">
                                                <?php
                                                $args_rooms = array(
                                                    'post_type' => 'room',
                                                    'posts_per_page' => -1,
                                                    'post_status' => 'publish',
                                                    'orderby' => 'menu_order',
                                                    'order' => 'ASC'
                                                );
                                                $rooms = new WP_Query($args_rooms);
                                                while ($rooms->have_posts()) {
                                                    $rooms->the_post();
                                                    ?>

                                                    <div class="villa-wrp">
                                                        <div class="villa-t">
                                                            <div class="villa-r">
                                                                <?php
                                                                $thumb = getFeaturedImageRoom(get_the_ID());
                                                                ?>
                                                                <div class="villa-image">
                                                                    <?php /* ?><img width="362" src="<?php echo get_template_directory_uri(); ?>/images/dummy/template-dummy-villaslisting.jpg" /><?php */ ?>
                                                                    <a title="<?php echo $thumb['seo']['seoatr']['title']; ?>" href="<?php echo get_permalink(); ?>"><img alt="<?php echo $thumb['seo']['seoatr']['alt']; ?>" width="362" src="<?php echo $thumb[0]; ?>" /></a>
                                                                </div>
                                                                <div class="villa-text">
                                                                    <h4 class="list-room-title"><a title="<?php echo $thumb['seo']['seoatr']['title']; ?>" href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                                                        
                                                                    <?php
                                                                    $terms = wp_get_post_terms(get_the_ID(), 'highlight');
                                                                    $terms_total = count($terms);
                                                                    ?>

                                                                    <?php
                                                                    echo '<ul>';
                                                                    foreach ($terms as $term) {
                                                                        ?>
                                                                        <li><?php echo $term->name; ?></li>
                                                                        <?php
                                                                    }
                                                                    echo '</ul>';
                                                                    ?>

                                                                </div>

                                                            </div>
                                                        </div>    
                                                        <p class="villa-btn-wrp">

                                                            <a title="<?php echo $thumb['seo']['seoatr']['title']; ?>" class="btns roomlisting" target="_blank" href="<?php echo get_permalink(); ?>"><?php echo ___('READ MORE', 'x2-frontend', 'btn_readmore_roomlist'); ?></a>
                                                            
                                                            <?php
                                                            $bookonlinelink = (!empty($x2postmeta->room_bookonlinelink) ? $x2postmeta->room_bookonlinelink : getBookonlineLink() );
                                                            if ($bookonlinelink != '') {
                                                            ?>
                                                            <a title="<?php echo $thumb['seo']['seoatr']['title']; ?>" class="btns roomlisting widthArrow" href="<?php echo $bookonlinelink; ?>"><?php echo ___('BOOK THIS ROOM', 'x2-frontend', 'btn_booknow_roomlist'); ?></a>
                                                            <?php } ?>
                                                        </p>
                                                    </div>
                                                <?php } ?>

                                            </div>   


                                        </div>
                                    <?php endwhile;
                                endif;
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('inc/inc-badges'); ?> 

    <?php get_template_part('inc/inc-promo-slide'); ?> 

    <?php
    get_template_part('inc/inc', 'footer');
    ?>

<?php get_footer(); ?>