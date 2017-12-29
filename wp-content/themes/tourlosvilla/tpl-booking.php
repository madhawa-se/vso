<?php
/*
  Template Name: Booking Form
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
                                if ( $sloganColor != '' ) {
                                    $sloganStyles = 'style="color:'.$sloganColor.'"';
                                    //$buttonStyles = 'style="border-color:'.$sloganColor.'; color:'.$sloganColor.';"';
                                }
                        ?>
                        <p <?php echo $sloganStyles; ?> class="line1"><?php echo $x2postmeta->slide_slogan; ?></p>
                        <p <?php echo $sloganStyles; ?> class="line2"><?php echo $x2postmeta->slide_slogan_2; ?></p>
                        <?php /* ?>
                        <a href="#" class="btns marginTop28 scrolldownbtn"><?php echo ___('SCROLL DOWN', 'x2-frontend', 'scrolldown'); ?></a>
                        <?php */ ?>
                        
                        <?php
                            if ( !empty($x2postmeta->slide_slogan_button_link) || $x2postmeta->slide_slogan_button_link_target == 'scrolldownbtn' ) {
                            $slide_slogan_button_text = ( $x2postmeta->slide_slogan_button_text != '' ? $x2postmeta->slide_slogan_button_text : __('READ MORE', 'x2-frontend') );
                            $slide_slogan_button_target = ( !empty($x2postmeta->slide_slogan_button_link_target) && $x2postmeta->slide_slogan_button_link_target != 'scrolldownbtn' ? $x2postmeta->slide_slogan_button_link_target : 'parent' );
                        ?>
                        <a <?php echo $buttonStyles; ?> title="<?php echo $x2postmeta->slide_slogan_button_seotitle; ?>" href="<?php echo $x2postmeta->slide_slogan_button_link; ?>" class="btns marginTop28 <?php echo ( $x2postmeta->slide_slogan_button_link_target == 'scrolldownbtn' ? 'scrolldownbtn' : '' ); ?>" target="<?php echo $slide_slogan_button_target; ?>"><?php echo $slide_slogan_button_text; ?></a>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wep content-wep-bookingform">
            <div class="container tableClass mobile-clear-table">
                <div class="row tableRowClass">



                    <div class="col-xs-12 col-sm-12 col-md-12 paddingbottom0 tableCellClass heightContentSlideHP2Sl verticalAlignMiddle slideFixWidth990 padding-top-bottom-large">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <?php if ($x2postmeta->slide2_maintitle != '') { ?>
                                    <h1 class="title-big maintitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_maintitle; ?></h1>
                                <?php } ?>

                                <?php if ($x2postmeta->slide2_subtitle != '') { ?>
                                    <h3 class="title-big lightgray subtitle title-mobile-center paddingBottom"><?php echo $x2postmeta->slide2_subtitle; ?></h3>
                                <?php } ?>
                            </div>
                        </div>   

                        <form id="booking_form" class="contactform bookingform" role="form">    
                        <div class="row contact-fck-wrp <?php if ($x2postmeta->slide2_maintitle == '' && $x2postmeta->slide2_subtitle == '') echo 'nopaddingtop'; ?>">

                                <div class="col-xs-12 col-sm-5 col-md-4 contact-left-fck">

                                    <div class="col-sm-12 col-md-12 left">
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-12">
                                                <label class="sr-only" for="arrivaldate"><?php echo ___('Arrival Date', 'x2-frontend', 'booking_fields_arrivaldate'); ?></label>
                                                <p class="dateicon"><input class="arrdate" type="text" class="form-control" id="arrivaldate" name="arrivaldate" rel="check" placeholder="<?php echo ___('Arrival Date', 'x2-frontend', 'booking_fields_arrivaldate'); ?>*"></p> 
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12">
                                                <label class="sr-only" for="departuredate"><?php echo ___('Departure Date', 'x2-frontend', 'booking_fields_departuredate'); ?></label>
                                                <p class="dateicon"><input class="depdate" type="text" class="form-control" id="departuredate" name="departuredate" rel="check" placeholder="<?php echo ___('Departure Date', 'x2-frontend', 'booking_fields_departuredate'); ?>*"></p>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12">
                                                <label class="sr-only" for="adults"><?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?></label>

                                                <div class="select-form">
                                                    <select rel="check" id="adults" name="adults">
                                                        <option value=""><?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>*</option>
                                                        <option>1 (<?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>)</option>
                                                        <option>2 (<?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>)</option>
                                                        <option>3 (<?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>)</option>
                                                        <option>4 (<?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>)</option>
                                                        <option>5 (<?php echo ___('Adults', 'x2-frontend', 'booking_fields_adults'); ?>)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-12">
                                                <label class="sr-only" for="kids"><?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?></label>

                                                <div class="select-form">
                                                    <select id="kids" name="kids">
                                                        <option value=""><?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?></option>
                                                        <option>1 (<?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?>)</option>
                                                        <option>2 (<?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?>)</option>
                                                        <option>3 (<?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?>)</option>
                                                        <option>4 (<?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?>)</option>
                                                        <option>5 (<?php echo ___('Kids', 'x2-frontend', 'booking_fields_kids'); ?>)</option>
                                                    </select>
                                                </div>
                                            </div>
 
                                        </div>
                                    </div> 

                                </div> 

                                <div class="col-xs-12 col-sm-7 col-md-8 contact-right-fck">
                                    <div class="row">                                   
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 left">

                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="name"><?php echo ___('Name', 'x2-frontend', 'booking_fields_name'); ?></label>
                                                        <input type="text" class="form-control" id="name" name="name" rel="check" placeholder="<?php echo ___('Name', 'x2-frontend', 'booking_fields_name'); ?>*">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="surname"><?php echo ___('Surname', 'x2-frontend', 'booking_fields_surname'); ?></label>
                                                        <input type="text" class="form-control" id="surname" name="surname" rel="check" placeholder="<?php echo ___('Surname', 'x2-frontend', 'booking_fields_surname'); ?>*">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="email"><?php echo ___('Email', 'x2-frontend', 'booking_fields_email'); ?></label>
                                                        <input type="email" class="form-control" id="email" name="email" rel="check" placeholder="<?php echo ___('Email', 'x2-frontend', 'booking_fields_email'); ?>*">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="telephone"><?php echo ___('Telephone', 'x2-frontend', 'booking_fields_telephone'); ?></label>
                                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="<?php echo ___('Telephone', 'x2-frontend', 'booking_fields_telephone'); ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-12 col-md-12 right">
                                                <textarea class="textarea-bookingform" name="msg" placeholder="<?php echo ___('Extra information', 'x2-frontend', 'booking_fields_extrainfo'); ?>" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                        </div>

                        <div class="row contact-fck-wrp buttons">    
                            <div class="col-sm-12 col-md-12">
                                <div class="left">
                                    <div class="checkbox">
                                        <?php echo ___('(*) Fields with asterisk are mandatory', 'x2-frontend', 'booking_fields_allfieldsaremandatory'); ?>
                                    </div>
                                </div>
                                <div class="right">
                                    <button type="submit" class="btn blueBtn blueBtn-bookingform-submit mythemecolor-background-color submitformbtn"><?php echo ___('SUBMIT FORM', 'x2-frontend', 'booking_fields_submitform'); ?></button>
                                    <input type="hidden" name="hiddens" id="hiddens" value="<?php echo wp_create_nonce("thisismycontacthoho"); ?>" /> 
                                    <input type="hidden" name="pleasewait" id="pleasewait" value="<?php echo __('Please wait...', 'formresponce_pleasewait'); ?>" /> 
                                    <input type="hidden" name="messagesent" id="messagesent" value="<?php echo __('Message Sent', 'formresponce_messagesent'); ?>" /> 
                                    <input type="hidden" name="messageerror" id="messageerror" value="<?php echo __('Error Please try again', 'formresponce_error'); ?>" />
                                    <input type="hidden" name="thisformtype" id="thisformtype" value="bf" />
                                </div>
                            </div>
                        </div>  
                        
                        </form>
                        

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