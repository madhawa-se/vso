<?php

function x2_register_scripts() {

    $min = getMin();

    if (!is_admin()) {


        if (get_post_type(get_the_ID()) == 'gallery') {

            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js', false, '1.6.1', true);
            wp_enqueue_script('jquery');

            wp_register_script('jquery-easing', get_template_directory_uri() . '/js/supersized_final/js/jquery.easing.min.js', false, false, true);
            wp_enqueue_script('jquery-easing');

            wp_register_script('supersized-3-2-7', get_template_directory_uri() . '/js/supersized_final/js/supersized.3.2.7.js', false, false, true);
            wp_enqueue_script('supersized-3-2-7');

            wp_register_script('supersized-shutter', get_template_directory_uri() . '/js/supersized_final/theme/supersized.shutter.js', false, false, true);
            wp_enqueue_script('supersized-shutter');

            if (!is_admin() && is_admin_bar_showing()) {
                wp_register_script('adminjs', get_template_directory_uri() . '/js/adminjs.js', false, false, true);
                wp_enqueue_script('adminjs');
            }
        } else {

            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', false, '1.11.0', true);
            wp_enqueue_script('jquery');

            wp_register_script('jquery-migrate', 'http://code.jquery.com/jquery-migrate-1.2.1.js', false, '1.11.0', true);
            wp_enqueue_script('jquery-migrate');

            global $post;
            $template_name = get_post_meta($post->ID, '_wp_page_template', true);
            if ($template_name == 'tpl-contact.php') {
                wp_register_script('gmapapi', 'http://maps.google.com/maps/api/js?sensor=true', false, false, true);
                wp_enqueue_script('gmapapi');
            }
            
            wp_register_script('theme-scripts', get_template_directory_uri() . '/js/scripts.php', false, false, true);
            wp_enqueue_script('theme-scripts');

            if ($min === true) {
                wp_register_script('scripts.min', get_template_directory_uri() . '/js/all.min.js', false, $v, true);
                wp_enqueue_script('scripts.min');
            } else {

            wp_register_script('x2-jquery-ui', get_template_directory_uri() . '/css/jquery-ui-1.11.2.custom/jquery-ui.js', false, false, true);
            wp_enqueue_script('x2-jquery-ui');

            wp_register_script('jquery.backstretch__seoalt', get_template_directory_uri() . '/js/jquery.backstretch__seoalt.js', false, false, true);
            wp_enqueue_script('jquery.backstretch__seoalt');

            wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', false, false, true);
            wp_enqueue_script('modernizr');

            wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', false, false, true);
            wp_enqueue_script('bootstrap');

            wp_register_script('fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', false, false, true);
            wp_enqueue_script('fancybox');

            wp_register_script('wow', get_template_directory_uri() . '/js/wow.js', false, false, true);
            wp_enqueue_script('wow');

            wp_register_script('jquery.stellar', get_template_directory_uri() . '/js/jquery.stellar.js', false, false, true);
            wp_enqueue_script('jquery.stellar');

            wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.js', false, false, true);
            wp_enqueue_script('plugins');

            wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', false, false, true);
            wp_enqueue_script('scripts');
            
            }
            
            if (!is_admin() && is_admin_bar_showing()) {
                wp_register_script('adminjs', get_template_directory_uri() . '/js/adminjs.js', false, false, true);
                wp_enqueue_script('adminjs');
            }
        }
    }
}

add_action('wp_enqueue_scripts', 'x2_register_scripts');
