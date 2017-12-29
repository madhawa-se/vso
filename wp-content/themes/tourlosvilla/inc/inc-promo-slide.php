<?php
    $footer_slogan = getFooterSlogan();
?>
<section class="promo">
        <div class="img-wrp" data-size="">

            <div class="imgsslider" data-property="<?php echo $footer_slogan['slogan_background_image']; ?>" data-seo="<?php echo $footer_slogan['slogan_background_image_seoalt']; ?>">

            </div>
            
            <div class="slogans-img-overlay"></div>
            
            <div class="slogans-img-wrp topCenterPromo">
                <div class="container container-fluid-100">
                    <div class="slogans">
                        <?php
                        $color = ( $footer_slogan['footer_slogan_color'] != '' ? ' style="color:'.$footer_slogan['footer_slogan_color'].';"' : "" );
                        ?>
                        <p <?php echo $color; ?> class="<?php if ( $footer_slogan['footer_slogan_tripadvidor_review'] == '1' ) { echo 'tripadvisor-review'; } ?>">
                            <?php 
                            if ( $footer_slogan['slogan_url'] != '' ) { 
                            ?>
                            <a <?php echo $color; ?> title="<?php echo $footer_slogan['slogan_url_seotitle']; ?>" target="<?php echo $footer_slogan['slogan_target']; ?>" href="<?php echo $footer_slogan['slogan_url']; ?>"><?php echo $footer_slogan['slogan_text']; ?></a>
                            <?php } else {
                                echo $footer_slogan['slogan_text'];
                            } ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
</section>