<?php
/*
  Template Name: Contact
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
                            //$buttonStyles = 'style="border-color:' . $sloganColor . '; color:' . $sloganColor . ';"';
                        }
                        ?>
                        <p <?php echo $sloganStyles; ?>><?php echo $x2postmeta->slide_slogan; ?></p>
                        <a <?php echo $buttonStyles; ?> title="<?php echo $x2postmeta->slide_slogan_button_seotitle; ?>" href="#" class="btns marginTop28 scrolldownbtn"><?php echo ___('SCROLL DOWN', 'x2-frontend', 'scrolldown'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wep">
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

                        <div class="row contact-fck-wrp <?php if ($x2postmeta->slide2_maintitle == '' && $x2postmeta->slide2_subtitle == '') echo 'nopaddingtop'; ?>">

                            <div class="col-xs-12 col-sm-5 col-md-4 contact-left-fck">
                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <h5 class="contactform-title mythemecolor"><?php echo ___('CONTACT DETAILS', 'x2-frontend', 'contact_header_leftcoltitle'); ?></h5>
                                        <div class="fck fck-contact">
                                            <?php //the_content(); ?>

                                            <?php
                                            if ($x2postmeta->contact_tpl_schema_status == '1') {
                                                ?>
                                                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                                    <p itemprop="streetAddress"><?php echo $x2postmeta->contact_tpl_address; ?></p>
                                                </div>

                                                <?php
                                                $map = get_googlemap_options();
                                                ?>
                                                <div itemprop="geo" itemscope itemtype="http://data-vocabulary.org/Geo">
                                                    <a itemprop="hasMap" href="<?php echo $x2postmeta->contact_tpl_googlemapurl; ?>" target="_blank"><?php echo ___('Open in Google Maps', 'x2-frontend', 'contact_tpl_schema_openingooglemaps'); ?></a>
                                                    <meta itemprop="latitude" content="<?php echo $map['lat']; ?>" />
                                                    <meta itemprop="longitude" content="<?php echo $map['long']; ?>" />
                                                </div>

                                                <br>

                                                <p>
                                                    <?php echo ___('Phone', 'x2-frontend', 'contact_tpl_schema_phone'); ?>: <span itemprop="telephone"><?php echo $x2postmeta->contact_tpl_phone; ?></span>
                                                    <br><?php echo ___('Fax', 'x2-frontend', 'contact_tpl_schema_fax'); ?>: <span itemprop="faxNumber"><?php echo $x2postmeta->contact_tpl_fax; ?></span>
                                                    <?php if ( !empty($x2postmeta->contact_tpl_winterphone) ) { ?>
                                                    <br/><?php echo ___('Winter Phone', 'x2-frontend', 'contact_tpl_schema_winterphone'); ?>: <span itemprop="telephone"><?php echo $x2postmeta->contact_tpl_winterphone; ?></span>
                                                    <?php } ?>
                                                </p>

                                                <p><br></p>

                                                <p>
                                                    <?php echo ___('e-mail', 'x2-frontend', 'contact_tpl_schema_email'); ?>: <span itemprop="email"><?php echo $x2postmeta->contact_tpl_email; ?></span><br>
                                                    <span itemprop="url"><?php echo $x2postmeta->contact_tpl_websiteurl; ?></span>
                                                </p>
                                            <?php
                                            } else {
                                                the_content();
                                            }
                                            ?>

                                        </div>
    <?php endwhile;
endif; ?> 
                            </div> 

                            <div class="col-xs-12 col-sm-7 col-md-8 contact-right-fck">
                                <h5 class="contactform-title mythemecolor"><?php echo ___('NEED MORE INFO? ASK A QUESTION', 'x2-frontend', 'contact_header_rightcoltitle'); ?></h5>
                                <div class="row">

                                    <form id="contact_form" class="contactform" role="form">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 left">
                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="name"><?php echo ___('Name', 'x2-frontend', 'contact_fields_name'); ?></label>
                                                        <input type="text" class="form-control" id="name" name="name" rel="check" placeholder="<?php echo ___('Name', 'x2-frontend', 'contact_fields_name'); ?>*">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="surname"><?php echo ___('Surname', 'x2-frontend', 'contact_fields_surname'); ?></label>
                                                        <input type="text" class="form-control" id="surname" name="surname" rel="check" placeholder="<?php echo ___('Surname', 'x2-frontend', 'contact_fields_surname'); ?>*">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="email"><?php echo ___('Email', 'x2-frontend', 'contact_fields_email'); ?></label>
                                                        <input type="email" class="form-control" id="email" name="email" rel="check" placeholder="<?php echo ___('Email', 'x2-frontend', 'contact_fields_email'); ?>*">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="country"><?php echo ___('Country', 'x2-frontend', 'contact_fields_country'); ?></label>
                                                        <input type="text" class="form-control" id="country" name="country" rel="check" placeholder="<?php echo ___('Country', 'x2-frontend', 'contact_fields_country'); ?>*">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="telephone"><?php echo ___('Telephone', 'x2-frontend', 'contact_fields_telephone'); ?></label>
                                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="<?php echo ___('Telephone', 'x2-frontend', 'contact_fields_telephone'); ?>">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-md-6">
                                                        <label class="sr-only" for="fax"><?php echo ___('Fax', 'x2-frontend', 'contact_fields_fax'); ?></label>
                                                        <input type="text" class="form-control" id="fax" name="fax" placeholder="<?php echo ___('Fax', 'x2-frontend', 'contact_fields_fax'); ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-12 col-md-12 right">
                                                <textarea name="msg" placeholder="<?php echo ___('Purpose of Contact', 'x2-frontend', 'contact_fields_purposeofcontact'); ?>" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="row buttons">
                                            <div class="left">
                                                <div class="checkbox">
                                                    <label><?php echo ___('(*) All fields are necessary', 'x2-frontend', 'contact_fields_allfieldsarenecessary'); ?></label>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <button type="submit" class="btn blueBtn mythemecolor-background-color submitformbtn"><?php echo ___('SEND', 'x2-frontend', 'contact_fields_sendbtn'); ?></button>
                                                <input type="hidden" name="hiddens" id="hiddens" value="<?php echo wp_create_nonce("thisismycontacthoho"); ?>" /> 
                                                <input type="hidden" name="pleasewait" id="pleasewait" value="<?php echo __('Please wait...', 'formresponce_pleasewait'); ?>" /> 
                                                <input type="hidden" name="messagesent" id="messagesent" value="<?php echo __('Message Sent', 'formresponce_messagesent'); ?>" /> 
                                                <input type="hidden" name="messageerror" id="messageerror" value="<?php echo __('Error Please try again', 'formresponce_error'); ?>" />
                                                <input type="hidden" name="thisformtype" id="thisformtype" value="cf" />
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'inc/inc-badges' ); ?> 
    
    <section class="promo">
        <div class="img-wrp img-wrp-gmap">
            <div class="gmapslide"></div>
        </div>
    </section>
    
    <?php
    get_template_part('inc/inc', 'footer');
    ?>

<?php get_footer(); ?> 