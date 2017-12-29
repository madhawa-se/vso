<?php get_header(); ?>   
    <body>
        
        <?php get_template_part( 'inc/inc-header' ); ?> 
        <?php
            $firstSlide = x2_slider_print_imgdataattr_firstslide(get_the_ID());
            $gallery_imgs_arr = get_post_meta($x2postmeta->category_imagegallery, 'ct_mb_gallery_images', false );
            if (empty($gallery_imgs_arr)) {
                $gallery_imgs_arr = get_post_meta(getDefaultPhotogallery(), 'ct_mb_gallery_images', false );
            }
        ?>
        <section class="">
            <div class="img-wrp" data-size="fullscreen">

                <div class="imgsslider" <?php echo $firstSlide['atr']; ?>>

                </div>

                <div class="slogans-img-wrp topCenter">
                    <div class="container container-fluid-100">
                        <div class="slogans">
                            <p><?php echo $x2postmeta->slide_slogan; ?></p>
                            <?php
                                if ( !empty($x2postmeta->slide_slogan_button_link) ) {
                                $slide_slogan_button_text = ( $x2postmeta->slide_slogan_button_text != '' ? $x2postmeta->slide_slogan_button_text : __('READ MORE', 'x2-frontend') );
                                $slide_slogan_button_target = ( !empty($x2postmeta->slide_slogan_button_link_target) ? $x2postmeta->slide_slogan_button_link_target : 'parent' );
                            ?>
                            <a href="<?php echo $x2postmeta->slide_slogan_button_link; ?>" class="btns marginTop28" target="<?php echo $slide_slogan_button_target; ?>"><?php echo $slide_slogan_button_text; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--<div class="logo-main-slide"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/logo-main-slide.png" /></div>-->
            </div>
            <div class="content-wep">
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
                                    </div>
                                    <?php endwhile; endif; ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'inc/inc-promo-slide' ); ?> 

        <?php
            get_template_part('inc/inc', 'footer');
        ?>
        
        <?php get_footer(); ?>