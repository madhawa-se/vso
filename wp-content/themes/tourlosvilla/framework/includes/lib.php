<?php

//*******************************************
// Title
//*******************************************
function x2_title() {
    global $page, $paged;

    if (defined('WPSEO_VERSION')) {
        $title = wp_title('');
        return $title;
    } else {

        $separator = ' | ';
        $title = '';
        $title .= wp_title($separator, false, 'right');
        $title .= get_bloginfo('name');
        $description = get_bloginfo('description');

        if ((is_home() || is_front_page()) && !empty($description))
            $title .= $separator . $description;
        if ($paged >= 2 || $page >= 2)
            $title .= $separator . sprintf(__('Page %s', 'x2'), max($paged, $page));

        return $title;
    }
}

function x2_get_page_meta($id) {

    if ($id == '')
        $id = get_the_ID();

    $prefix = 'ct_mb_';
    $ar = array(
        'slide_slogan' => "{$prefix}slide_slogan",
        'slide_slogan_2' => "{$prefix}slide_slogan_2",
        'slide_slogan_button_text' => "{$prefix}slide_slogan_button_text",
        'slide_slogan_button_link' => "{$prefix}slide_slogan_button_link",
        'slide_slogan_button_link_target' => "{$prefix}slide_slogan_button_link_target",
        'slide_slogan_button_seotitle' => "{$prefix}slide_slogan_button_seotitle",
        'slide_slogan_color' => "{$prefix}slide_slogan_color",
        'this_gallery' => "{$prefix}gallery_images",
        'slide2_maintitle' => "{$prefix}slide2_maintitle",
        'slide2_subtitle' => "{$prefix}slide2_subtitle",
        'footer_slogan' => "{$prefix}footer_slogan",
        'footer_slogan_color' => "{$prefix}footer_slogan_color",        
        'footer_slogan_url' => "{$prefix}footer_slogan_url",
        'footer_slogan_url_seotitle' => "{$prefix}footer_slogan_url_seotitle",
        'footer_slogan_url_target' => "{$prefix}footer_slogan_url_target",
        'footer_slogan_backgroundimage' => "{$prefix}footer_slogan_backgroundimage",
        'footer_slogan_tripadvidor_review' => "{$prefix}footer_slogan_tripadvidor_review",
        'homepage_3rd_slide_title' => "{$prefix}homepage_3rd_slide_title",
        'homepage_3rd_slide_subtitle' => "{$prefix}homepage_3rd_slide_subtitle",
        'homepage_3rd_slide_text' => "{$prefix}homepage_3rd_slide_text",
        'homepage_3rd_slide_slogan' => "{$prefix}homepage_3rd_slide_slogan",
        'homepage_3rd_slide_thisprice' => "{$prefix}homepage_3rd_slide_thisprice",
        'homepage_3rd_slide_slogan_per' => "{$prefix}homepage_3rd_slide_slogan_per",
        'homepage_3rd_slide_booknowlink' => "{$prefix}homepage_3rd_slide_booknowlink",
        'homepage_2rd_slide_button_text' => "{$prefix}homepage_2rd_slide_button_text",
        'homepage_2rd_slide_button_link' => "{$prefix}homepage_2rd_slide_button_link",
        'homepage_2rd_slide_button_link_target' => "{$prefix}homepage_2rd_slide_button_link_target",
        'promo_text' => "{$prefix}promo_text",
        'promo_text_seotitle' => "{$prefix}promo_text_seotitle",
        'promo_url_text' => "{$prefix}promo_url_text",
        'promo_url' => "{$prefix}promo_url",
        'promo_url_target' => "{$prefix}promo_url_target",
        'room_price' => "{$prefix}room_price",
        'room_bookonlinelink' => "{$prefix}room_bookonlinelink",
        'room_imagegallery' => "{$prefix}category_imagegallery",
        'room_deatails_header_title' => "{$prefix}room_deatails_header_title",
        'room_deatails_header_title_2' => "{$prefix}room_deatails_header_title_2",
        'room_deatails_fck_2' => "{$prefix}room_deatails_fck_2",
        'room_deatails_header_title_3' => "{$prefix}room_deatails_header_title_3",
        'room_deatails_fck_3' => "{$prefix}room_deatails_fck_3",
        'room_deatails_header_title_4' => "{$prefix}room_deatails_header_title_4",
        'room_deatails_fck_4' => "{$prefix}room_deatails_fck_4",
        'room_deatails_header_title_5' => "{$prefix}room_deatails_header_title_5",
        'room_deatails_fck_5' => "{$prefix}room_deatails_fck_5",
        'offer_tpl_slogan' => "{$prefix}offer_tpl_slogan",
        'offer_tpl_price' => "{$prefix}offer_tpl_price",
        'offer_tpl_btn_link' => "{$prefix}offer_tpl_btn_link",
        'offer_tpl_btn_text' => "{$prefix}offer_tpl_btn_text",
        'offer_tpl_btn_link_target' => "{$prefix}offer_tpl_btn_link_target",
        'gallery_backlink' => "{$prefix}gallery_backlink",
        'gallery_backlink_permalink' => "{$prefix}gallery_backlink_permalink",
        'contact_tpl_schema_status' => "{$prefix}contact_tpl_schema_status",
        'contact_tpl_address' => "{$prefix}contact_tpl_address",
        'contact_tpl_phone' => "{$prefix}contact_tpl_phone",
        'contact_tpl_winterphone' => "{$prefix}contact_tpl_winterphone",
        'contact_tpl_fax' => "{$prefix}contact_tpl_fax",
        'contact_tpl_email' => "{$prefix}contact_tpl_email",
        'contact_tpl_websiteurl' => "{$prefix}contact_tpl_websiteurl",
        'contact_tpl_googlemapurl' => "{$prefix}contact_tpl_googlemapurl",
        'badge_image' => "{$prefix}badge_image",
        'badge_image_hover' => "{$prefix}badge_image_hover",
        'badge_url' => "{$prefix}badge_url",
        'badge_image_alt' => "{$prefix}badge_image_alt",
        'badge_seotitle' => "{$prefix}badge_seotitle",
        'category_shorttext' => "{$prefix}category_shorttext",        
    );

    $ar_ = '';
    foreach ($ar as $k => $v) {
        $ar_[$k] = do_shortcode(get_post_meta($id, $v, true));
    }

    return $ar_;
}

function setX2Globals($id) {
    $g = json_decode(json_encode(x2_get_page_meta($id)));
    return $g;
}

function x2_get_rooms($id) {
    global $x2postmeta;

    $args_rooms_ = array(
        'posts_per_page' => -1,
        'post_type' => 'room',
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'roomtype',
                'field' => 'id',
                'terms' => $x2postmeta->room_type
            )
        ),
        'order' => 'ASC'
    );
    $rooms_query_ = new WP_Query($args_rooms_);
    $ar = '';
    $i = 0;
    while ($rooms_query_->have_posts()) {
        $rooms_query_->the_post();

        $room_post_permalink = get_permalink();
        preg_match('/\/([\w-]*?)\/$/', $room_post_permalink, $room_permalink_m);

        $ar[$i]['name'] = get_the_title();
        $ar[$i]['permalink'] = $room_post_permalink;
        $ar[$i]['permalink_ui'] = $room_permalink_m[1];

        $i++;
    }
    //wp_reset_postdata();
    wp_reset_query();

    return json_decode(json_encode($ar));
}

function get_dummy_img($name = '') {
    $f = '';
    switch ($name) {

        case 'x2_thumb_600x600' :
            $f = get_template_directory_uri() . '/img/dummy/noimage_x2_thumb_600x600.jpg';
            break;
        
        case 'x2_thumb_506x278' :
            $f = get_template_directory_uri() . '/img/dummy/noimage_x2_thumb_506x278.jpg';
            break;

        case 'slider' :
            $f = get_template_directory_uri() . '/images/dummy/template-dummy-img.jpg';
            break;

        case 'promo' :
            $f = get_template_directory_uri() . '/images/dummy/template-dummy-promo.jpg';
            break;

        case 'footerpromo' :
            $f = get_template_directory_uri() . '/images/dummy/template-dummy-promoslide.jpg';
            break;
    }
    return $f;
}

function getPackegeImages($thumbID) {
    $package_img_284x182 = wp_get_attachment_image_src($thumbID, 'x2_thumb_284x182');
    $package_img_173x173 = wp_get_attachment_image_src($thumbID, 'x2_thumb_173x173');

    $ar['large'] = ( $package_img_284x182[0] != '' ? $package_img_284x182[0] : get_dummy_img('x2_thumb_284x182'));
    $ar['small'] = ( $package_img_173x173[0] != '' ? $package_img_173x173[0] : get_dummy_img('x2_thumb_173x173'));

    return $ar;
}

function RoomSliderImage($thumbID) {
    $img = wp_get_attachment_image_src($thumbID, 'full');
    $img_ = ( $img[0] != '' ? $img[0] : get_dummy_img('slider'));
    return $img_;
}

function BlogSliderImage($thumbID) {
    $img = wp_get_attachment_image_src($thumbID, 'full');
    $img_ = ( $img[0] != '' ? $img[0] : get_dummy_img('slider'));
    return $img_;
}

function x2_get_img_sliders($ar = '') {

    if (!is_array($ar) || $ar == '')
        return null;

    $c = 0;
    foreach ($ar as $id) {
        $full = wp_get_attachment_image_src($id, 'full');
        $arr[$c]['full'] = $full;
        $arr[$c]['id'] = $id;
        $c++;
    }
    return $arr;
}

function x2_slider_images_check($id, $slider = 1, $fckcheck = true) {
    global $x2postmeta;
    $r = false;
    $slider_ = array(
        1 => 'ct_mb_page_general_slide1_image',
        2 => 'ct_mb_page_general_slide2_image'
    );
    $IDs = get_post_meta($id, $slider_[$slider], false);
    if (count($IDs) > 0) {
        $r = true;
    }

    if (!empty($x2postmeta->slide2_text) && $fckcheck == true) {
        $r = true;
    }

    return $r;
}

function x2_slider_print_imgdataattr($id, $slider = 1) {

    $slider_ = array(
        1 => 'ct_mb_page_general_slideparalax_img'
    );
    $atr = 'data-property="';

    $IDs = get_post_meta($id, $slider_[$slider], false);

    if (count($IDs) > 0) {
        $imgs = x2_get_img_sliders($IDs);
        $i = 0;
        foreach ($imgs as $img) {
            $atr .= "{$img['full'][0]}";
            if (count($imgs) > ($i + 1)) {
                $atr .= ",";
            }
            $i++;
        }
    } else {
        $atr .= get_dummy_img("slider");
    }

    $atr .= '"';


    /* alt atr */
    $atr .= ' data-seo="';
    if (count($IDs) > 0 && $IDs != '') {
        $i = 0;
        foreach ($imgs as $img) {
            $alt = get_post_meta($img['id'], '_wp_attachment_image_alt', true);
            $atr .= $alt;
            if (count($imgs) > ($i + 1)) {
                $atr .= "###";
            }
            $i++;
        }
    }

    $atr .= '"';
    /* alt atr */

    return $atr;
}

function x2_slider_print_imgdataattr_firstslide($id, $slider = 1) {

    $SlideID = get_post_meta($id, 'ct_mb_first_slide_imgs', true);
    $slider_ = array(
        1 => 'ct_mb_slide_images'
    );
    $atr = 'data-property="';

    $IDs = get_post_meta($SlideID, $slider_[$slider], false);

    if (count($IDs) > 0 && $IDs != '') {
        $imgs = x2_get_img_sliders($IDs);
        $i = 0;
        foreach ($imgs as $img) {
            $atr .= "{$img['full'][0]}";
            if (count($imgs) > ($i + 1)) {
                $atr .= ",";
            }
            $i++;
        }
    } else {
        $atr .= get_dummy_img("slider");
    }

    $atr .= '"';

    /* alt atr */
    $atr .= ' data-seo="';
    if (count($IDs) > 0 && $IDs != '') {
        $i = 0;
        foreach ($imgs as $img) {
            $alt = get_post_meta($img['id'], '_wp_attachment_image_alt', true);
            $atr .= $alt;
            if (count($imgs) > ($i + 1)) {
                $atr .= "###";
            }
            $i++;
        }
    }

    $atr .= '"';
    /* alt atr */

    $ar['atr'] = $atr;
    $ar['slogan'] = get_post_meta($SlideID, 'ct_mb_slide_slogan', true);
    $ar['btn_text'] = get_post_meta($SlideID, 'ct_mb_slide_slogan_button_text', true);
    $ar['btn_link'] = get_post_meta($SlideID, 'ct_mb_slide_slogan_button_link', true);
    $ar['btn_target'] = get_post_meta($SlideID, 'ct_mb_slide_slogan_button_link_target', true);

    return $ar;
}

function getPressPdf($id) {
    $f = '#';
    $press_item_pdf_id = get_post_meta(get_the_ID(), 'ct_mb_press_pdf', true);
    if ($press_item_pdf_id != '') {
        $press_item_pdf = wp_get_attachment_url($press_item_pdf_id);
        $f = $press_item_pdf;
    }
    return $f;
}

function getDownloadsPdf($id) {
    $f = '#';
    $press_item_pdf_id = get_post_meta(get_the_ID(), 'ct_mb_download_pdf', true);
    if ($press_item_pdf_id != '') {
        $press_item_pdf = wp_get_attachment_url($press_item_pdf_id);
        $f = $press_item_pdf;
    }
    return $f;
}

function getPackagePdf($id) {
    $f = '';
    $press_item_pdf_id = get_post_meta(get_the_ID(), 'ct_mb_package_pdf', true);
    if ($press_item_pdf_id != '') {
        $press_item_pdf = wp_get_attachment_url($press_item_pdf_id);
        $f = $press_item_pdf;
    }
    return $f;
}

function getSlogan($id, $slide, $slogan = 1) {

    if (empty($id) || empty($slide) || empty($slogan)) {
        return '';
    }

    $pageGlobals = x2_get_page_meta($id);
    $ar = array(
        1 => array(
            1 => $pageGlobals['slide1_img_slogan1'],
            2 => $pageGlobals['slide1_img_slogan2']
        ),
        2 => array(
            1 => $pageGlobals['slide2_img_slogan1'],
            2 => $pageGlobals['slide2_img_slogan2']
        )
    );

    return $ar[$slide][$slogan];
}

function getGalleryThumb($thumbID) {
    $img_x2_thumb_600x600 = wp_get_attachment_image_src($thumbID, 'x2_thumb_600x600');
    $img_full = wp_get_attachment_image_src($thumbID, 'full');

    $ar['x2_thumb_600x600']['thumb'] = ( $img_x2_thumb_600x600[0] != '' ? $img_x2_thumb_600x600[0] : get_dummy_img('x2_thumb_600x600'));
    $ar['full']['thumb'] = ( $img_full[0] != '' ? $img_full[0] : get_dummy_img('x2_thumb_600x600'));
    $ar['x2_thumb_600x600']['dummy'] = get_dummy_img('x2_thumb_600x600');

    $ar['alt'] = get_post_meta($thumbID, '_wp_attachment_image_alt', true);
    $ar['title'] = get_post_meta($thumbID, 'seo_title_attr', true);

    return $ar;
}

function pressDownloadsBtns() {
    global $x2postmeta;

    $ar = array(
        'btn1' => array(
            'text' => $x2postmeta->pressdownloads_button1_text,
            'url' => $x2postmeta->pressdownloads_button1_url,
            'target' => $x2postmeta->pressdownloads_button1_target,
        ),
        'btn2' => array(
            'text' => $x2postmeta->pressdownloads_button2_text,
            'url' => $x2postmeta->pressdownloads_button2_url,
            'target' => $x2postmeta->pressdownloads_button2_target,
        ),
        'btn3' => array(
            'text' => $x2postmeta->pressdownloads_button3_text,
            'url' => $x2postmeta->pressdownloads_button3_url,
            'target' => $x2postmeta->pressdownloads_button3_target,
        ),
        'btn4' => array(
            'text' => $x2postmeta->pressdownloads_button4_text,
            'url' => $x2postmeta->pressdownloads_button4_url,
            'target' => $x2postmeta->pressdownloads_button4_target,
        ),
    );

    $t = '';
    foreach ($ar as $k => $v) {
        if ($v['text'] != '' && $v['url'] != '') {
            //$ar_[$k] = $v;
            $v['target'] = ( $v['target'] != '' ? $v['target'] : 'parent' );
            $t .= sprintf("<a target=\"%s\" class=\"btns light-blue\" href=\"%s\">%s</a>", $v['target'], $v['url'], $v['text']);
        }
    }

    return $t;
}

function x2_video_templates($els, $id) {

    if (empty($id)) {
        global $x2postmeta;
    } else {
        $x2postmeta = json_decode(json_encode(x2_get_page_meta($id)));
    }


    $ar = array(
        'video' => array(
            'id' => $x2postmeta->buttons_videolink,
            'text' => $x2postmeta->buttons_videolink_text,
            'type' => $x2postmeta->buttons_videotype,
        ),
        'image' => array(
            'id' => $x2postmeta->buttons_imagegallery,
            'text' => $x2postmeta->buttons_imagegallery_text,
            'url' => get_permalink($x2postmeta->buttons_imagegallery),
        )
    );

    $ar_ = '';
    foreach ($ar as $k => $v) {
        if ($v['id'] != '') {
            $ar_[$k] = $v;
        }
    }

    $c = 0;
    foreach ($els as $el_k => $el_v) {

        switch ($el_k) {

            case 'video' :
                $t = $el_v;

                if ($ar['video']['id'] == '') {
                    $t = '';
                } else {
                    $t = preg_replace('/VIDEOLINK/i', $ar['video']['id'], $t);
                    $t = preg_replace('/VIDEOTYPE/i', $ar['video']['type'], $t);
                    $t = preg_replace('/VIDEOTEXT/i', $ar['video']['text'], $t);
                    $c++;
                }
                $els['video'] = $t;
                break;

            case 'imagegallery' :
                $t = $el_v;

                if ($ar['image']['id'] == '') {
                    $t = '';
                } else {
                    $t = preg_replace('/PHOTOSLINK/i', $ar['image']['url'], $t);
                    $t = preg_replace('/PHOTOSTEXT/i', $ar['image']['text'], $t);
                    $c++;
                }
                $els['imagegallery'] = $t;
                break;
        }
    }

    foreach ($els as $el_k => $el_v) {
        echo $el_v;
    }
}

function x2_video_templates_new($els, $id) {

    if (empty($id)) {
        global $x2postmeta;
    } else {
        $x2postmeta = json_decode(json_encode(x2_get_page_meta($id)));
    }


    $ar = array(
        'video' => array(
            'id' => $x2postmeta->buttons_videolink,
            'text' => $x2postmeta->buttons_videolink_text,
            'type' => $x2postmeta->buttons_videotype,
        ),
        'image' => array(
            'id' => $x2postmeta->buttons_imagegallery,
            'text' => $x2postmeta->buttons_imagegallery_text,
            'url' => get_permalink($x2postmeta->buttons_imagegallery),
        )
    );

    $c = 0;
    foreach ($els as $el_k => $el_v) {

        switch ($el_k) {

            case 'video' :
                $t = $el_v;
                if ($ar['video']['id'] == '') {
                    $t = '';
                } else {
                    $ar['video']['text'] = ( $ar['video']['text'] == '' ? __('VIEW VIDEO', 'x2-frontend') : $ar['video']['text'] );
                    $t = preg_replace('/VIDEOLINK/i', $ar['video']['id'], $t);
                    $t = preg_replace('/VIDEOTYPE/i', $ar['video']['type'], $t);
                    $t = preg_replace('/VIDEOTEXT/i', $ar['video']['text'], $t);
                    $c++;
                }
                $els['video'] = $t;
                break;

            case 'imagegallery' :
                $t = $el_v;
                if ($ar['image']['id'] == '') {
                    $t = '';
                } else {
                    $ar['image']['text'] = ( $ar['image']['text'] == '' ? __('VIEW PHOTOS', 'x2-frontend') : $ar['image']['text'] );
                    $t = preg_replace('/PHOTOSLINK/i', $ar['image']['url'], $t);
                    $t = preg_replace('/PHOTOSTEXT/i', $ar['image']['text'], $t);
                    $c++;
                }
                $els['imagegallery'] = $t;
                break;
        }
    }

    $ar_['count'] = $c;
    foreach ($els as $el_k => $el_v) {
        $ar_['text'] .= $el_v;
        $ar_['el'][] = $el_v;
    }


    return json_decode(json_encode($ar_));
}

function getHomepageId() {
    global $x2_options_data;
    return $x2_options_data['homepage_template'];
}

function getFooterSlogan() {
    global $x2_options_data, $post;

    $globals = setX2Globals($post->ID);

    $ar = array(
        'slogan_text' => $x2_options_data['footer_slogan'],
        'slogan_url' => $x2_options_data['footer_slogan_link'],
        'slogan_url_seotitle' => $x2_options_data['footer_slogan_link_seotitle'],
        'slogan_target' => $x2_options_data['footer_slogan_link_target'],
        'slogan_background_image' => ( $x2_options_data['footer_slogan_backgroundimage'] != '' ? $x2_options_data['footer_slogan_backgroundimage'] : get_dummy_img('footerpromo') ),
        'slogan_background_image_seoalt' => $x2_options_data['footer_slogan_backgroundimage_seoalt'],
        'footer_slogan_tripadvidor_review' => $x2_options_data['footer_slogan_tripadvidor_review'],
        'footer_slogan_color' => $x2_options_data['footer_slogan_color'],
    );

    if ($globals->footer_slogan != '') {
        $ar['slogan_text'] = ($globals->footer_slogan != '' ? $globals->footer_slogan : $x2_options_data['footer_slogan']);
        $ar['slogan_url'] = $globals->footer_slogan_url;
        $ar['slogan_target'] = ($globals->footer_slogan_url_target != '' ? $globals->footer_slogan_url_target : '_parent' );
        $ar['slogan_url_seotitle'] = $globals->footer_slogan_url_seotitle;
        $ar['footer_slogan_color'] = $globals->footer_slogan_color;

        if ($globals->footer_slogan_backgroundimage != '') {
            $bg_image_img = getImagewithID($globals->footer_slogan_backgroundimage);
            $ar['slogan_background_image'] = $bg_image_img[0];
            $ar['slogan_background_image_seoalt'] = $globals->footer_slogan_backgroundimage_seoalt;
        }
    }

    if ($globals->footer_slogan_tripadvidor_review == '1') {
        $ar['footer_slogan_tripadvidor_review'] = $globals->footer_slogan_tripadvidor_review;
    }

    return $ar;
}

function getDefaultPhotogallery() {
    global $x2_options_data;
    return $x2_options_data['defaultphotogallery'];
}

function getFeaturedImageGallery($id) {

    $gallery_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'x2_thumb_600x600');

    if ($gallery_thumb[0] == '') {
        $gallery_thumb[0] = get_dummy_img('x2_thumb_600x600');
    }

    return $gallery_thumb;
}

function getFeaturedImageGallerySeo($id) {

    $arr = array();
    $thumbNID = get_post_thumbnail_id($id);
    $arr['alt'] = get_post_meta($thumbNID, '_wp_attachment_image_alt', true);
    $arr['title'] = get_post_meta($thumbNID, 'seo_title_attr', true);
    $arr['id'] = $thumbNID;

    return $arr;
}

function getHomepageSlides() {
    global $x2_options_data;
    $c = 0;

    foreach ($x2_options_data['homepage_slides']['enabled'] as $k => $v) {

        if ($k === 'placebo')
            continue;

        $id = preg_replace('/slide_/i', '', $k);
        $template = get_post_meta($id, '_wp_page_template', true);
        $ar[$c]['id'] = $id;
        $ar[$c]['template'] = $template;

        $c++;
    }
    return $ar;
}

function homePageSlidesIds($slides) {

    foreach ($slides as $slide) {
        $ar[] = $slide['id'];
    }
    return $ar;
}

function getBookonlineLink_themeoptions() {
    global $x2_options_data;
    return $x2_options_data['x2_onlinebooking_url'];
}

function getBookonlineLink_linktarget_themeoptions() {
    global $x2_options_data;
    return $x2_options_data['x2_onlinebooking_url_mainmenu_target'];
}

function getBookonlineLink() {
    global $BOOKONLINEURL;
    return $BOOKONLINEURL;
}

function x2_get_socials($social = '', $delay = '0') {
    global $x2_options_data;

    switch ($social) {

        case 'tripadvisor' :
            $url = $x2_options_data['x2_social_tripadvisor'];
            $text = '';
            if ($x2_options_data['x2_social_tripadvisor_switch'] == 1) {
                $text = '<li class="tripadvisor-icon"><a class="" href="' . $url . '" target="_blank">tripadvisor</a></li>';
            }
            return $text;
            break;

        case 'facebook' :
            $url = $x2_options_data['x2_social_facebook'];
            $text = '';
            if ($x2_options_data['x2_social_facebook_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">facebook</a></li>';
            }
            return $text;
            break;

        case 'twitter' :
            $url = $x2_options_data['x2_social_twitter'];
            $text = '';
            if ($x2_options_data['x2_social_twitter_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">twitterbird</a></li>';
            }
            return $text;
            break;

        case 'googleplus' :
            $url = $x2_options_data['x2_social_googleplus'];
            $text = '';
            if ($x2_options_data['x2_social_googleplus_switch'] == 1) {
                $text = '<li class="googleplus-icon"><a class="symbol" href="' . $url . '" target="_blank">googleplus</a></li>';
            }
            return $text;
            break;

        case 'pinterest' :
            $url = $x2_options_data['x2_social_pinterest'];
            $text = '';
            if ($x2_options_data['x2_social_pinterest_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">pinterest</a></li>';
            }
            return $text;
            break;

        case 'youtube' :
            $url = $x2_options_data['x2_social_youtube'];
            $text = '';
            if ($x2_options_data['x2_social_youtube_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">youtube</a></li>';
            }
            return $text;
            break;

        case 'instagram' :
            $url = $x2_options_data['x2_social_instagram'];
            $text = '';
            if ($x2_options_data['x2_social_instagram_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">instagram</a></li>';
            }
            return $text;
            break;

        case 'flickr' :
            $url = $x2_options_data['x2_social_flickr'];
            $text = '';
            if ($x2_options_data['x2_social_flickr_switch'] == 1) {
                $text = '<li><a class="symbol" href="' . $url . '" target="_blank">flickr</a></li>';
            }
            return $text;
            break;
    }
}

function getTemplate($name = '') {
    $args = array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => $name,
    );
    $query = new WP_Query($args);
    $query = $query->posts[0];
    return $query;
}

function getBlogPermalink() {
    $blog = getTemplate('tpl-blog.php');
    return get_permalink($blog->ID);
}

function getLatestBlogPost() {
    $args = array(
        'numberposts' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
    );
    $recent_posts = wp_get_recent_posts($args);
    return $recent_posts;
}

function getCurrentLang() {
    
    $lid = get_current_blog_id();
    $arlang = array(
        1 => array(
            'url' => '/',
            'locale' => 'en',
            'iso' => 'en',
            'text_active' => 'EN',
            'text_active_mobile' => 'EN'
        ),
        2 => array(
            'url' => '/gr/',
            'locale' => 'el_GR',
            'iso' => 'gr',
            'text_active' => ___('GR', 'x2-frontend', 'header_langmenu_greek_active'),
            'text_active_mobile' => 'GR'
        ),
    );
    
    $ar = array(
        'id' => $lid,
        'iso' => $arlang[$lid],
    );
    
    return $ar;
    
}

function x2_upper($s) {
    $s = strtoupper($s);
    return $s;
}

function getAllGalleries() {

    //gallieries//
    $args_galleries = array(
        'post_type' => 'gallery',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    $gal = array();
    $galleries = new WP_Query($args_galleries);
    while ($galleries->have_posts()) {
        $galleries->the_post();

        $arr = get_post_meta(get_the_ID(), 'ct_mb_gallery_images', false);
        $arr = array_reverse($arr);
        $gal = array_merge($gal, $arr);
    }
    wp_reset_postdata();

    $gal = array_reverse($gal);
    return $gal;
}

function getAllRooms() {

    //Rooms//
    $args_rooms = array(
        'post_type' => 'room',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    $r = array();
    $i = 0;
    $rooms = new WP_Query($args_rooms);
    while ($rooms->have_posts()) {
        $rooms->the_post();

        $r[$i]['name'] = get_the_title();
        $r[$i]['di'] = get_the_ID();
        $i++;
    }
    wp_reset_postdata();

    $res = json_decode(json_encode($r));
    return $res;
}

function logo_title_attr() {
    global $x2_options_data;
    return $x2_options_data['x2_seo_logo_title_attr'];
}

function x2_get_gallery($x2_page_gal_ = '', $thumb_size = 'x2_photogallery_thumb_small') {

    if (!is_array($x2_page_gal_) || $x2_page_gal_ == '')
        return null;

    $c = 0;
    foreach ($x2_page_gal_ as $x2_page_gal) {
        $bck_large = wp_get_attachment_image_src($x2_page_gal, 'full');
        $bck_thumb = wp_get_attachment_image_src($x2_page_gal, $thumb_size);
        $x2_gal_arr[$c]['full'] = $bck_large;
        $x2_gal_arr[$c]['thumb'] = $bck_thumb;
        $x2_gal_arr[$c]['id'] = $x2_page_gal;
        $c++;
    }
    return $x2_gal_arr;
}

function promoImage($id) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'x2_thumb_419x324');
    $img['alt'] = get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true);
    if ($img[0] == '') {
        $img[0] = get_dummy_img('promo');
    }
    return $img;
}

function getImagewithID($imageID, $thumb = 'full') {
    $img = wp_get_attachment_image_src($imageID, $thumb);
    return $img;
}

function themeColorAndMoreOptions() {
    global $x2_options_data;

    $ar = array(
        'status' => $x2_options_data['x2_theme_switch'],
        'color' => $x2_options_data['x2_theme_color'],
        'hover' => $x2_options_data['x2_theme_color_hover'],
        'menu-hoveractive' => $x2_options_data['x2_theme_color_mainmenu_hoveractive'],
        'bookonline-hover' => $x2_options_data['x2_theme_color_bookonline_hover'],
        'font' => $x2_options_data['x2_theme_font'],
        'fck-link' => $x2_options_data['x2_theme_color_fck_link'],
        'fck-link-hover' => $x2_options_data['x2_theme_color_fck_link_hover'],
        'buttons-light' => $x2_options_data['x2_theme_buttons_light'],
        'buttons-light-hover' => $x2_options_data['x2_theme_buttons_light_hover'],
    );

    return $ar;
}

function registerGlobalsSetObject($ar) {

    $o = array(
        "name" => "Name",
        "desc" => "",
        "id" => "x2_globals_name",
        "std" => "",
        "type" => "text"
    );

    foreach ($ar as $v) {
        $ar_[] = array_merge($o, $v);
    }
    return $ar_;
}

function registerGlobals($globals, $a) {

    $ar[] = array( "name" => "HOME Button (Main menu)", "id" => "homebtnmainmenu", "std"  => "" );
    $ar[] = array( "name" => "Book Online (Footer Menu)", "id" => "footer_bookonline", "std"  => "" );
    
    $ar[] = array("name" => "LEARN MORE :: PROMO LINK", "id" => "promohome_link_text", "std" => "");
    $ar[] = array("name" => "MAIN MENU :: BOOK ONLINE", "id" => "mainmenu_bookonline", "std" => "");
    $ar[] = array("name" => "MAIN MENU :: BOOK (MOBILE)", "id" => "mainmenu_bookonline_mobile", "std" => "");
    $ar[] = array( "name" => "Scroll Down", "id" => "scrolldown", "std"  => "" );
    $ar[] = array("name" => "Read More", "id" => "readmore_btn", "std" => "");
    $ar[] = array("name" => "BUTTONS :: view images", "id" => "btn_view_photos", "std" => "");
    $ar[] = array("name" => "BUTTONS :: request a quote", "id" => "btn_booknow", "std" => "");
    $ar[] = array("name" => "HOMEPAGE OFFER BUTTON :: BOOK NOW", "id" => "homepage_offer_btn", "std" => "");

    $ar[] = array("name" => "ROOM TEMPLATE :: suite details", "id" => "room_suite_details", "std" => "");
    $ar[] = array("name" => "ROOM TEMPLATE :: per night", "id" => "room_per_night", "std" => "");
    $ar[] = array("name" => "ROOM TEMPLATE :: from", "id" => "room_from", "std" => "");
    $ar[] = array("name" => "ROOM TEMPLATE :: Amenities", "id" => "room_amenities", "std" => "");

    $ar[] = array("name" => "CONTACT TEMPLATE :: Contact Details", "id" => "contact_header_leftcoltitle", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE :: New more info...", "id" => "contact_header_rightcoltitle", "std" => "");

    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Name", "id" => "contact_fields_name", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Surname", "id" => "contact_fields_surname", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Email", "id" => "contact_fields_email", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Country", "id" => "contact_fields_country", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Telephone", "id" => "contact_fields_telephone", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Fax", "id" => "contact_fields_fax", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: Purpose of Contact", "id" => "contact_fields_purposeofcontact", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: (*) All fields are necessary", "id" => "contact_fields_allfieldsarenecessary", "std" => "");
    $ar[] = array("name" => "CONTACT TEMPLATE / FORM FIELDS :: SEND (Button)", "id" => "contact_fields_sendbtn", "std" => "");
    $ar[] = array( "name" => "CONTACT TEMPLATE / FORM FIELDS :: Open in Google Maps", "id" => "contact_tpl_schema_openingooglemaps", "std"  => "" );

    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Arrival Date", "id" => "booking_fields_arrivaldate", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Departure Date", "id" => "booking_fields_departuredate", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Room Type", "id" => "booking_fields_roomtype", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Number of Rooms", "id" => "booking_fields_numberofrooms", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Adults", "id" => "booking_fields_adults", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Kids", "id" => "booking_fields_kids", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Name", "id" => "booking_fields_name", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Surname", "id" => "booking_fields_surname", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Email", "id" => "booking_fields_email", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Telephone", "id" => "booking_fields_telephone", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Extra information", "id" => "booking_fields_extrainfo", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: (*) Fields with asterisk are mandatory", "id" => "booking_fields_allfieldsaremandatory", "std" => "");
    $ar[] = array("name" => "BOOKING FORM TEMPLATE / FORM FIELDS :: Submit Form (Button)", "id" => "booking_fields_submitform", "std" => "");

    $ar[] = array("name" => "FORMS TEMPLATE / STATUS :: Please Wait", "id" => "formresponce_pleasewait", "std" => "");
    $ar[] = array("name" => "FORMS TEMPLATE / STATUS :: Message Sent", "id" => "formresponce_messagesent", "std" => "");
    $ar[] = array("name" => "FORMS TEMPLATE / STATUS :: Error Please try again", "id" => "formresponce_error", "std" => "");


    $ar[] = array("name" => "CONTACT FROM TEMPLATE :: Open in Google Maps", "id" => "contact_tpl_openingooglemaps", "std" => "");
    $ar[] = array("name" => "CONTACT FROM TEMPLATE :: Phone", "id" => "contact_tpl_schema_phone", "std" => "");
    $ar[] = array("name" => "CONTACT FROM TEMPLATE :: Winter Phone", "id" => "contact_tpl_schema_winterphone", "std" => "");
    $ar[] = array("name" => "CONTACT FROM TEMPLATE :: Fax", "id" => "contact_tpl_schema_fax", "std" => "");
    $ar[] = array("name" => "CONTACT FROM TEMPLATE :: Email", "id" => "contact_tpl_schema_email", "std" => "");

    $ar[] = array( "name" => "GALLERY :: Close Button", "id" => "gallery_close_btn", "std"  => "" );
    $ar[] = array( "name" => "GALLERY :: Choose Gallery", "id" => "gallery_choosegallery_btn", "std"  => "" );
    
    $ar_ = registerGlobalsSetObject($ar);

    return array_merge($globals, $ar_);
}

function ___($str, $domain, $var) {

    global $x2_options_data;
    $r = getGlobal($var);

    if ($r === false) {
        $r = __($str, $domain);
    }

    return $r;
}

function getGlobal($k) {
    global $x2_options_data;
    return ( empty($x2_options_data[$k]) ? false : $x2_options_data[$k] );
}

function get_footer_company_title() {
    global $x2_options_data;
    return $x2_options_data['footer_company_title_copyright'];
}

function get_static_icons() {
    global $x2_options_data;

    $ar = array();
    $ar['logo_desktop'] = $x2_options_data['icons_logo_desktop'];
    $ar['logo_mobile'] = $x2_options_data['icons_logo_mobile'];
    $ar['favicon'] = $x2_options_data['icons_logo_favicon'];
    $ar['pin'] = $x2_options_data['icons_logo_pin'];
    $ar['logo_seotitle'] = $x2_options_data['logo_seotitle'];

    return $ar;
}

function get_googlemap_options() {
    global $x2_options_data;

    $ar = array();
    $ar['lat'] = $x2_options_data['googlemap_lat'];
    $ar['long'] = $x2_options_data['googlemap_long'];
    $ar['pin'] = $x2_options_data['icons_logo_pin'];
    $ar['zoom'] = $x2_options_data['googlemap_zoom'];

    return $ar;
}

function get_languages_options() {
    global $x2_options_data;

    $ar['status'] = ($x2_options_data['x2_languagesnavigationmenu'] == 1 ? true : false);

    return $ar;
}

function get_forms_email() {
    global $x2_options_data;

    $ar['contactform'] = $x2_options_data['x2_contactform_email'];
    $ar['bookingform'] = $x2_options_data['x2_bookingform_email'];

    return $ar;
}

function get_weather_info() {
    global $x2_options_data;

    $ar['weather_showhide'] = $x2_options_data['x2_weather_showhide'];
    $ar['weather_id'] = $x2_options_data['x2_weather_id'];
    $ar['weather_placename'] = $x2_options_data['x2_weather_placename'];

    return $ar;
}

function get_facebooklike_url() {
    global $x2_options_data;
    $str = ( $x2_options_data['footer_facebooklike_url'] != '' ? $x2_options_data['footer_facebooklike_url'] : '' );
    return $str;
}

function getfileversion() {
    $v = 1;
    return $v;
}

function get_footer_icons_awards() {
    global $x2_options_data;

    $ar = '';
    for ($i = 1; $i < 4; $i++) {
        if (!empty($x2_options_data['footer_icon_' . $i])) {
            $ar[$i - 1]['img'] = $x2_options_data['footer_icon_' . $i];
            $ar[$i - 1]['img_hover'] = ( $x2_options_data['footer_icon_' . $i . '_hover'] != '' ? $x2_options_data['footer_icon_' . $i . '_hover'] : $x2_options_data['footer_icon_' . $i] );
            $ar[$i - 1]['url'] = $x2_options_data['footer_icon_' . $i . '_url'];
        }
    }

    return $ar;
}

function getImageID($thumbID, $imageSize = 'full') {
    $img = wp_get_attachment_image_src($thumbID, $imageSize);
    return $img;
}

function getAllBadges() {

    //Badges//
    $args_rooms = array(
        'post_type' => 'badge',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => 'badge_meta_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );
    $r = array();
    $i = 0;
    $rooms = new WP_Query($args_rooms);
    while ($rooms->have_posts()) {
        $rooms->the_post();

        $x2postmeta_ = setX2Globals(get_the_ID());
        
        $r[$i]['name'] = get_the_title();
        $r[$i]['image'] = getImageID($x2postmeta_->badge_image);
        $r[$i]['image_hover'] = getImageID($x2postmeta_->badge_image_hover);
        $r[$i]['url'] = stripslashes($x2postmeta_->badge_url);
        $r[$i]['seo_alt'] = stripslashes($x2postmeta_->badge_image_alt);
        $r[$i]['seo_title'] = stripslashes($x2postmeta_->badge_seotitle);
        $r[$i]['id'] = get_the_ID();
        $i++;
    }
    wp_reset_postdata();

    $res = json_decode(json_encode($r));
    return $res;
}

function getFeaturedImageRoom($id) {
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'x2_thumb_506x278');
    if ( $thumb[0] == ''  ) {
        $thumb[0] = get_dummy_img('x2_thumb_506x278'); 
        $thumb['seo'] = getFeaturedImageSeoAttr(get_post_thumbnail_id($id));
    }
    return $thumb;
}

function content_short_text($id) {
        if ( $id == '' ) {
            global $post;
        }
        $post = get_post($id);
        $content = $post->post_content;
        
        //print_r($post);        
        
        $id = $post->ID;
        $x2postmeta = setX2Globals($id);
        $a = '';
        if ($x2postmeta->category_shorttext != '') {
            $a .= '<div class="shorttext-wrp">';
            $a .= '<div class="shorttext">';
            $a .= stripslashes($x2postmeta->category_shorttext);
            $a .= '<a href="#" title="'.___('expand', 'x2-frontend', 'content_readmore_seotitle').'" class="content-readmore content-readmore-action">'.___('read more', 'x2-frontend', 'content_readmore').'</a>';
            $a .= '</div>';
            $a .= '<div class="main_content">';
            $a .= $content;
            $a .= '<a href="#" title="'.___('close', 'x2-frontend', 'content_readless_seotitle').'" class="content-readless content-readless-action">'.___('read less', 'x2-frontend', 'content_readless').'</a>';
            $a .= '</div>';
            $a .= '</div>';
        } else {
            $a .= $content;
        }
        return $a;
    }
    
function getFeaturedImageSeoAttr($id) {
    $ar['seoattr']['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
    $ar['seoattr']['title'] = get_post_meta($id, 'seo_title_attr', true);
    return $ar;
}     

function getMin() {
    return true;
}