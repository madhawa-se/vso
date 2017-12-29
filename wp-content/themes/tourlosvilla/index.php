<?php get_header(); ?>
<?php global $x2postmeta; ?>
    <body>

        <?php get_template_part( 'inc/inc-header' ); ?> 
        
        <?php
            $homepageID = getHomepageId();
            if ( !empty($homepageID) ) {
                $homepage = get_page( $homepageID );
                $homepage_globals= setX2Globals($homepage->ID);
                $firstSlide = x2_slider_print_imgdataattr_firstslide($homepage->ID);
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
                            <p <?php echo $sloganStyles; ?> class=""><?php echo $x2postmeta->slide_slogan; ?></p>
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
                        <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl padding-top-bottom-homepage verticalAlignMiddle">
                            <div class="row">
                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div class="col-md-7 col-md-offset-3 my-col-md-offset-3 remove-left-right-paddings slideFixWidth">
                                    <h1 class="title-big maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_maintitle; ?></h1>
                                    <h4 class="title-big subtitle lightgray-subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_subtitle; ?></h4>
                                    <div class="fck fck-justify paddingBorderTop">
                                        <?php //the_content(); ?>
                                        <?php
                                            echo content_short_text(get_the_ID());
                                        ?>
                                    </div>
                                </div>
                                <?php endwhile; endif; ?> 
                                <?php
                            if (!empty($x2postmeta->homepage_2rd_slide_button_link)) {
                                $secondslidecontent_text = ( $x2postmeta->homepage_2rd_slide_button_text != '' ? $x2postmeta->homepage_2rd_slide_button_text : ___('READ MORE', 'x2-frontend', 'readmore_btn') );
                                $secondslidecontent_target = (!empty($x2postmeta->homepage_2rd_slide_button_link_target) ? $x2postmeta->homepage_2rd_slide_button_link_target : 'parent' );
                                ?>
                                <p class="textAlignCenter paddingTopLarge"><a rel="nofollow" class="btns blueBtnWithArrowGray" target="<?php echo $secondslidecontent_target; ?>" href="<?php echo $x2postmeta->homepage_2rd_slide_button_link; ?>"><?php echo $secondslidecontent_text; ?></a></p>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <?php
            $args_promos = array(
                'post_type'  => 'promo',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_key' => 'promo_meta_order',
                'orderby' => 'promo_meta_order',
                'order' => 'ASC'

            );
            $promos = new WP_Query( $args_promos );
            $promos_num = $promos->post_count;
            
            if ( $promos_num > 0 ) {
        ?>
        <section class="">
            <div class="content-wep">
                <div class="container container-fluid remove-left-right-paddings">
                    <div class="row ">
                        <div class="col-xs-12 col-sm-12 col-md-12 remove-left-right-paddings">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 remove-left-right-paddings">
                                    <div class="gallery-grid-container">
                                        <div class="gallery-grid-container-holder">
                                            
                                            <ul class="gallery_inner">
                                            <?php
                                                 while ( $promos->have_posts() ) :
                                                    $promos->the_post();
                                                 
                                                   $promo_meta= setX2Globals(get_the_ID()); 
                                                   $promoImage = promoImage(get_the_ID());
                                                   $promoTitle = $promo_meta->promo_text;
                                                   $promoLinkText = ( $promo_meta->promo_url_text != '' ? $promo_meta->promo_url_text : ___('LEARN MORE', 'x2-frontend', 'promohome_link_text') );
                                                   $promoUrl = $promo_meta->promo_url;
                                                   $promoUrlTArget = ($promo_meta->promo_url_target != '' ? $promo_meta->promo_url_target : '_parent');
                                            ?>
                                                
                                                <li class="categorythumb">
                                                    <div class="overflow-layer">
                                                        <div class="overflow-layer-t">
                                                            <div class="overflow-layer-r">
                                                                <?php if ($promoTitle != '') { ?>
                                                                <div class="overflow-layer-c">
                                                                    <p>
                                                                        <?php echo $promoTitle; ?>
                                                                        <a title="<?php echo $promo_meta->promo_text_seotitle; ?>" class="gallery-grip-btn" href="<?php echo $promoUrl; ?>" target="<?php echo $promoUrlTArget; ?>"><?php echo $promoLinkText; ?></a>
                                                                    </p>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#"><img itemprop="photo" alt="<?php echo $promoImage['alt']; ?>" width="600" height="600" src="<?php echo $promoImage[0]; ?>" /></a>
                                                </li>
                                            
                                            <?php 
                                            endwhile; 
                                            wp_reset_postdata();
                                            ?>
                                            </ul>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>

        <section class="">
            <div class="content-wep">
                <div class="container tableClass mobile-clear-table">
                    <div class="row tableRowClass">
                        <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl padding-top-bottom-homepage verticalAlignMiddle">
                            <div class="row">
                                <div class="col-md-7 col-md-offset-3 my-col-md-offset-3 remove-left-right-paddings slideFixWidth">
                                    <?php if( $x2postmeta->homepage_3rd_slide_title != '' ) { ?>
                                    <h2 class="title-big maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->homepage_3rd_slide_title; ?></h2>
                                    <?php } ?>
                                    <?php if( $x2postmeta->homepage_3rd_slide_subtitle != '' ) { ?>
                                    <h3 class="title-big lightgray-subtitle-sm subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->homepage_3rd_slide_subtitle; ?></h3>
                                    <?php } ?>
                                    <div class="fck fck-justify paddingBorderTopBottomSmaller paddingTopMobileFck">
                                        <?php echo $x2postmeta->homepage_3rd_slide_text; ?>
                                    </div>
                                    <h4 class="price-title title-mobile-center paddingBottom"><?php echo $x2postmeta->homepage_3rd_slide_slogan; ?> <?php if( $x2postmeta->homepage_3rd_slide_thisprice != '' ) { ?><span>€<?php echo $x2postmeta->homepage_3rd_slide_thisprice; ?></span><?php } ?><?php if( $x2postmeta->homepage_3rd_slide_slogan_per != '' ) { ?> <?php echo $x2postmeta->homepage_3rd_slide_slogan_per; ?><?php } ?></h4>
                                    <p class="textAlignCenter"><a rel="nofollow" class="btns blueBtnWithArrowGrayNoRoBorder" target="_parent" href="<?php echo $x2postmeta->homepage_3rd_slide_booknowlink; ?>"><?php echo ___('BOOK NOW', 'x2-frontend', 'homepage_offer_btn'); ?></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php get_template_part( 'inc/inc-badges' ); ?> 
        
        <?php get_template_part( 'inc/inc-promo-slide' ); ?> 

                

        <?php get_template_part('inc/inc', 'footer');?>


        <?php get_footer(); ?>