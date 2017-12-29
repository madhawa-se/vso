<?php
/*
  Template Name: Offer
*/
?>
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
                            <?php
                                $sloganColor = $x2postmeta->slide_slogan_color;
                                $sloganStyles = '';
                                $buttonStyles = '';
                                if ( $sloganColor != '' ) {
                                    $sloganStyles = 'style="color:'.$sloganColor.'"';
                                    //$buttonStyles = 'style="border-color:'.$sloganColor.'; color:'.$sloganColor.';"';
                                }
                            ?>
                            <p <?php echo $sloganStyles; ?>><?php echo $x2postmeta->slide_slogan; ?></p>
                            <?php
                            if ( !empty($x2postmeta->slide_slogan_button_link) || $x2postmeta->slide_slogan_button_link_target == 'scrolldownbtn' ) {
                                $slide_slogan_button_text = ( $x2postmeta->slide_slogan_button_text != '' ? $x2postmeta->slide_slogan_button_text : ___('READ MORE', 'x2-frontend', 'readmore_btn') );
                                $slide_slogan_button_target = ( !empty($x2postmeta->slide_slogan_button_link_target) && $x2postmeta->slide_slogan_button_link_target != 'scrolldownbtn' ? $x2postmeta->slide_slogan_button_link_target : 'parent' );
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
                        <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl verticalAlignMiddle">
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-3 my-col-md-offset-3 remove-left-right-paddings slideFixWidth">
                                    <?php if( $x2postmeta->slide2_maintitle != '' ) { ?>
                                    <h2 class="title-big maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_maintitle; ?></h2>
                                    <?php } ?>
                                    <?php if( $x2postmeta->slide2_subtitle != '' ) { ?>
                                    <h3 class="title-big lightgray subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_subtitle; ?></h3>
                                    <?php } ?>
                                    <div class="fck fck-justify paddingTop48 paddingTopMobileFck">
                                        <?php the_content(); ?>
                                    </div>
                                    <h4 class="title-medium lightgray75 pricetitle title-mobile-center paddingBottom"><?php echo $x2postmeta->offer_tpl_slogan; ?> <?php if( $x2postmeta->offer_tpl_price != '' ) { ?><span class="helpers helpers--price-medium mythemecolor">€<?php echo $x2postmeta->offer_tpl_price; ?></span><?php } ?></h4>
                                    <?php 
                                        $offerlink_target = ( $x2postmeta->offer_tpl_btn_link_target != '' ? $x2postmeta->offer_tpl_btn_link_target : '_parent' );
                                        if ( $x2postmeta->offer_tpl_btn_link != '' ) {
                                    ?>
                                    <p class="textAlignCenter"><a target="<?php echo $offerlink_target; ?>" class="btns blueBtn mythemecolor-background-color" href="<?php echo $x2postmeta->offer_tpl_btn_link; ?>"><?php echo ( $x2postmeta->offer_tpl_btn_text!='' ? $x2postmeta->offer_tpl_btn_text : __('BOOK NOW', 'x2-frontend') ); ?></a></p>
                                        <?php } ?>
                                </div>
                            </div>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php get_template_part( 'inc/inc-badges' ); ?> 
        
        <?php get_template_part( 'inc/inc-promo-slide' ); ?> 

        <?php
            get_template_part('inc/inc', 'footer');
        ?>
        
        <?php get_footer(); ?>