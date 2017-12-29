<?php

//$prefix = 'ct_mb_';

global $meta_boxes;

$meta_boxes = array();

function ct_meta_boxes_obj() {
    $prefix = 'ct_mb_';
    global $meta_boxes;

    /* get pages */
    $args_slides = array(
        'sort_order' => 'ASC',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'slide',
        'post_status' => 'publish'
    );
    $pages_slides = get_pages($args_slides);
    $pages_select_slides[''] = 'Select...';
    foreach ($pages_slides as $pages_slide) {
        $pages_select_slides[$pages_slide->ID] = $pages_slide->post_title;
    }

////
    $args = array(
        'sort_order' => 'ASC',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'gallery',
        'post_status' => 'publish'
    );
    $pages = get_pages($args);
    $pages_select[''] = 'Select...';
    foreach ($pages as $page) {
        $pages_select[$page->ID] = $page->post_title;
    }

    /*
      $meta_boxes[] = array(
      'title'		=> __('First Slide Options', 'x2-backend'),
      'pages' => array( 'page','room' ),
      'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
      'id'		=> 'ct_firstslide_options',
      'fields'	=> array(

      array(
      'name'				=> __('First Slide - Images', 'x2-backend'),
      'id'				=> "{$prefix}first_slide_imgs",
      'type'				=> 'select',
      'options'                       => $pages_select_slides,
      ),

      array(
      'name'				=> __('Slogan Text', 'x2-backend'),
      'id'				=> "{$prefix}slide_slogan",
      'type'				=> 'textarea',
      ),
      array(
      'name'				=> __('Slogan Button Text', 'x2-backend'),
      'id'				=> "{$prefix}slide_slogan_button_text",
      'type'				=> 'text',
      ),
      array(
      'name'				=> __('Slogan Button link', 'x2-backend'),
      'id'				=> "{$prefix}slide_slogan_button_link",
      'type'				=> 'text',
      ),
      array(
      'name'				=> __('Slogan Button link (target)', 'x2-backend'),
      'id'				=> "{$prefix}slide_slogan_button_link_target",
      'type'				=> 'select',
      'options'                       => array(
      '_parent'=>'Parent Page',
      '_blank'=>'Blank Page',
      'scrolldownbtn'=>'Scroll Down',
      ),
      ),


      )
      );
     */

    $meta_boxes[] = array(
        'title' => __('First Slide Options', 'x2-backend'),
        'pages' => array('page', 'room'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_firstslide_options',
        'fields' => array(
            array(
                'name' => __('First Slide - Images', 'x2-backend'),
                'id' => "{$prefix}first_slide_imgs",
                'type' => 'select',
                'options' => $pages_select_slides,
            ),
            array(
                'name' => __('Slogan Text', 'x2-backend'),
                'id' => "{$prefix}slide_slogan",
                'type' => 'textarea',
            ),
            array(
                'name' => __('Slogan Text 2 (Line 2 with different style - booking template)', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_2",
                'type' => 'textarea',
            ),
            array(
                'name' => __('Slogan Button Text', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_button_text",
                'type' => 'text',
            ),
            array(
                'name' => __('Slogan Button (SEO TITLE)', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_button_seotitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Slogan Button link', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_button_link",
                'type' => 'text',
            ),
            array(
                'name' => __('Slogan Button link (target)', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_button_link_target",
                'type' => 'select',
                'options' => array(
                    '_parent' => 'Parent Page',
                    '_blank' => 'Blank Page',
                    'scrolldownbtn' => 'Scroll Down',
                ),
            ),
            array(
                'name' => __('Slogan Color', 'x2-backend'),
                'id' => "{$prefix}slide_slogan_color",
                'type' => 'color',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Contact Template - Schema.com friendly', 'x2-backend'),
        'pages' => array('page'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_offer_tpl_options',
        'show_on' => array('key' => 'page-template', 'value' => 'tpl-contact.php'),
        'fields' => array(
            array(
                'name' => __('Schema.com - Template Enable/Disable', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_schema_status",
                'type' => 'checkbox',
            ),
            array(
                'name' => __('Address', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_address",
                'type' => 'text',
            ),
            array(
                'name' => __('Phone', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_phone",
                'type' => 'text',
            ),
            array(
                'name' => __('Fax', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_fax",
                'type' => 'text',
            ),
            array(
                'name' => __('Winter Phone', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_winterphone",
                'type' => 'text',
            ),
            array(
                'name' => __('Email', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_email",
                'type' => 'text',
            ),
            array(
                'name' => __('Website Url', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_websiteurl",
                'type' => 'text',
            ),
            array(
                'name' => __('Google Map Url', 'x2-backend'),
                'id' => "{$prefix}contact_tpl_googlemapurl",
                'type' => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Homepage Options', 'x2-backend'),
        'pages' => array('page'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_homepage_tpl_options',
        'show_on' => array('key' => 'page-template', 'value' => 'tpl-homepage.php'),
        'fields' => array(
            array(
                'name' => __('Short Text', 'x2-backend'),
                'id' => "{$prefix}category_shorttext",
                'type' => 'wysiwyg',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Offer Template - Options', 'x2-backend'),
        'pages' => array('page'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_offer_tpl_options',
        'show_on' => array('key' => 'page-template', 'value' => 'tpl-offer.php'),
        'fields' => array(
            array(
                'name' => __('Offer Slogan', 'x2-backend'),
                'id' => "{$prefix}offer_tpl_slogan",
                'type' => 'text',
            ),
            array(
                'name' => __('Offer Price', 'x2-backend'),
                'id' => "{$prefix}offer_tpl_price",
                'type' => 'text',
            ),
            array(
                'name' => __('Offer Link', 'x2-backend'),
                'id' => "{$prefix}offer_tpl_btn_link",
                'type' => 'text',
            ),
            array(
                'name' => __('Offer Link Button Text', 'x2-backend'),
                'id' => "{$prefix}offer_tpl_btn_text",
                'type' => 'text',
            ),
            array(
                'name' => __('Offer Button link (target)', 'x2-backend'),
                'id' => "{$prefix}offer_tpl_btn_link_target",
                'type' => 'select',
                'options' => array(
                    '_parent' => 'Parent Page',
                    '_blank' => 'Blank Page',
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Homepage - Options', 'x2-backend'),
        'pages' => array('page'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_homepage_options',
        'show_on' => array('key' => 'page-template', 'value' => 'tpl-homepage.php'),
        'fields' => array(
            array(
                'name' => __('Homepage - 2rd Slide - Button', 'x2-backend'),
                'id' => "{$prefix}homepage_2rd_slide_button_text",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 2rd Slide - Button Link', 'x2-backend'),
                'id' => "{$prefix}homepage_2rd_slide_button_link",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 2rd Slide - Button Link (target)', 'x2-backend'),
                'id' => "{$prefix}homepage_2rd_slide_button_link_target",
                'type' => 'select',
                'options' => array(
                    '_parent' => 'Parent Page',
                    '_blank' => 'Blank Page'
                ),
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Title', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_title",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Subtitle', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_subtitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Text', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_text",
                'type' => 'wysiwyg',
            ),
            array(
                'name' => __('divider', 'x2-backend'),
                'id' => "{$prefix}page_divider",
                'type' => 'divider',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Slogan', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_slogan",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Price', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_thisprice",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Slogan (per nignt)', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_slogan_per",
                'type' => 'text',
            ),
            array(
                'name' => __('Homepage - 3rd Slide - Booknow Link', 'x2-backend'),
                'id' => "{$prefix}homepage_3rd_slide_booknowlink",
                'type' => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Promo - Options', 'x2-backend'),
        'pages' => array('promo'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_promo_options',
        'fields' => array(
            array(
                'name' => __('Promo - Title', 'x2-backend'),
                'id' => "{$prefix}promo_text",
                'type' => 'text',
            ),
            array(
                'name' => __('Promo - Title (SEO TITLE)', 'x2-backend'),
                'id' => "{$prefix}promo_text_seotitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Promo - Url (Text)', 'x2-backend'),
                'id' => "{$prefix}promo_url_text",
                'type' => 'text',
            ),
            array(
                'name' => __('Promo - Url', 'x2-backend'),
                'id' => "{$prefix}promo_url",
                'type' => 'text',
            ),
            array(
                'name' => __('Promo Url (target)', 'x2-backend'),
                'id' => "{$prefix}promo_url_target",
                'type' => 'select',
                'options' => array(
                    '_parent' => 'Parent Page',
                    '_blank' => 'Blank Page',
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Badge - Options', 'x2-backend'),
        'pages' => array('badge'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_badge_options',
        'fields' => array(
            array(
                'name' => __('Badge - Link', 'x2-backend'),
                'id' => "{$prefix}badge_url",
                'type' => 'text',
            ),
            array(
                'name' => __('Badge - (SEO ALT)', 'x2-backend'),
                'id' => "{$prefix}badge_image_alt",
                'type' => 'text',
            ),
            array(
                'name' => __('Badge - (SEO TITLE)', 'x2-backend'),
                'id' => "{$prefix}badge_seotitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Badge Image', 'x2-backend'),
                'id' => "{$prefix}badge_image",
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => __('Badge Image (hover)', 'x2-backend'),
                'id' => "{$prefix}badge_image_hover",
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Footer Promo - Options', 'x2-backend'),
        'pages' => array('page', 'room'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_footerpromo_options',
        'fields' => array(
            array(
                'name' => __('Footer Promo Slogan', 'x2-backend'),
                'id' => "{$prefix}footer_slogan",
                'type' => 'text',
            ),
            array(
                'name' => __('Footer Promo Slogan Color', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_color",
                'type' => 'color',
            ),
            array(
                'name' => __('Footer Promo Url', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_url",
                'type' => 'text',
            ),
            array(
                'name' => __('Footer Promo Url (SEO Title)', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_url_seotitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Footer Promo Url (target)', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_url_target",
                'type' => 'select',
                'options' => array(
                    '_parent' => 'Parent Page',
                    '_blank' => 'Blank Page',
                ),
            ),
            array(
                'name' => __('Footer promo Background Image', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_backgroundimage",
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => __('Footer promo Background Image (SEO ALT)', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_backgroundimage_seoalt",
                'type' => 'text',
            ),
            array(
                'name' => __('Footer promo - Tripadvisor Review', 'x2-backend'),
                'id' => "{$prefix}footer_slogan_tripadvidor_review",
                'type' => 'checkbox',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Pages Options - General', 'x2-backend'),
        'pages' => array('page'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_pages_options_general',
        'fields' => array(
            array(
                'name' => __('Slide(2) Title', 'x2-backend'),
                'id' => "{$prefix}slide2_maintitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Slide(2) Subtitle', 'x2-backend'),
                'id' => "{$prefix}slide2_subtitle",
                'type' => 'text',
            ),
        )
    );

    /* get pages */
    $args_back_gallery = array(
        'sort_order' => 'ASC',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $pages_backgallery = get_pages($args_back_gallery);
    $pages_select_back_gallery[''] = 'Select...';
    foreach ($pages_backgallery as $page_backgallery) {
        $pages_select_back_gallery[$page_backgallery->ID] = $page_backgallery->post_title;
    }
    $meta_boxes[] = array(
        'title' => __('Gallery images', 'x2-backend'),
        'pages' => array('gallery'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_gallery_images',
        'fields' => array(
            array(
                'name' => __('Add Images for Gallery', 'x2-backend'),
                'id' => "{$prefix}gallery_images",
                'type' => 'image_advanced',
                'max_file_uploads' => 50,
            ),
            array(
                'name' => __('Backlink', 'x2-backend'),
                'id' => "{$prefix}gallery_backlink",
                'type' => 'select',
                'options' => $pages_select_back_gallery,
            ),
            array(
                'name' => __('Backlink (permalink)', 'x2-backend'),
                'id' => "{$prefix}gallery_backlink_permalink",
                'type' => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => __('Slides images', 'x2-backend'),
        'pages' => array('slide'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_slide_images',
        'fields' => array(
            array(
                'name' => __('Add Images for this slide', 'x2-backend'),
                'id' => "{$prefix}slide_images",
                'type' => 'image_advanced',
                'max_file_uploads' => 50,
            ),
        )
    );

    /* get pages */

    $meta_boxes[] = array(
        'title' => __('Room Options', 'x2-backend'),
        'pages' => array('room'),
        'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'id' => 'ct_room_options',
        'fields' => array(
            array(
                'name' => __('Room Title', 'x2-backend'),
                'id' => "{$prefix}slide2_maintitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Room Subtitle', 'x2-backend'),
                'id' => "{$prefix}slide2_subtitle",
                'type' => 'text',
            ),
            array(
                'name' => __('Request a quote Link', 'x2-backend'),
                'id' => "{$prefix}room_bookonlinelink",
                'type' => 'text',
            ),
            array(
                'name' => __('Price (euro)', 'x2-backend'),
                'id' => "{$prefix}room_price",
                'type' => 'number',
            ),
            array(
                'name' => __('Image Gallery', 'x2-backend'),
                'id' => "{$prefix}category_imagegallery",
                'type' => 'select',
                'options' => $pages_select,
            ),
            array(
                'name' => __('Left Column - Header Title', 'x2-backend'),
                'id' => "{$prefix}room_deatails_header_title",
                'type' => 'text',
            ),
            array(
                'name' => __('Right Column - Section 1 - Header Title', 'x2-backend'),
                'id' => "{$prefix}room_deatails_header_title_2",
                'type' => 'text',
            ),
            array(
                'name' => __('Right Column - Section 1 - Text', 'x2-backend'),
                'id' => "{$prefix}room_deatails_fck_2",
                'type' => 'wysiwyg',
            ),
            array(
                'name' => __('Right Column - Section 2 - Header Title', 'x2-backend'),
                'id' => "{$prefix}room_deatails_header_title_3",
                'type' => 'text',
            ),
            array(
                'name' => __('Right Column - Section 2 - Text', 'x2-backend'),
                'id' => "{$prefix}room_deatails_fck_3",
                'type' => 'wysiwyg',
            ),
            array(
                'name' => __('Right Column - Section 3 - Header Title', 'x2-backend'),
                'id' => "{$prefix}room_deatails_header_title_4",
                'type' => 'text',
            ),
            array(
                'name' => __('Right Column - Section 3 - Text', 'x2-backend'),
                'id' => "{$prefix}room_deatails_fck_4",
                'type' => 'wysiwyg',
            ),
            array(
                'name' => __('Right Column - Section 4 - Header Title', 'x2-backend'),
                'id' => "{$prefix}room_deatails_header_title_5",
                'type' => 'text',
            ),
            array(
                'name' => __('Right Column - Section 4 - Text', 'x2-backend'),
                'id' => "{$prefix}room_deatails_fck_5",
                'type' => 'wysiwyg',
            ),
            array(
                'name' => __('test madhawa', 'x2-backend'),
                'id' => "{$prefix}room_deatails_fck_m",
                'type' => 'wysiwyg',
            ),
        )
    );
}

add_action('admin_init', 'ct_meta_boxes_obj', 1);

function ct_register_meta_boxes() {
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (!class_exists('RW_Meta_Box'))
        return;

    global $meta_boxes;
    foreach ($meta_boxes as $meta_box) {
        new RW_Meta_Box($meta_box);
    }
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'ct_register_meta_boxes', 2);
?>