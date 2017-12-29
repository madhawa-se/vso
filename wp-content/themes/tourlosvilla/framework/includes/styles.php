<?php

function x2_register_styles() {

    $v = getfileversion();
    $min = getMin();

    if (get_post_type(get_the_ID()) == 'gallery') {

        wp_register_style('supersized-css', get_template_directory_uri() . "/js/supersized_final/css/supersized.css", '', $v);
        wp_enqueue_style('supersized-css');

        wp_register_style('supersized-shutter', get_template_directory_uri() . "/js/supersized_final/theme/supersized.shutter.css", '', $v);
        wp_enqueue_style('supersized-shutter');

        wp_register_style('supersized-shutter-mod', get_template_directory_uri() . "/css/supersized_gallery_mod.css", '', $v);
        wp_enqueue_style('supersized-shutter-mod');
    } else {

        if ($min === true) {
                
        } else {
            wp_register_style('fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css');
            wp_enqueue_style('fancybox');

            wp_register_style('x2-jquery-ui', get_template_directory_uri() . "/css/jquery-ui-1.11.2.custom/jquery-ui.css", '', $v);
            wp_enqueue_style('x2-jquery-ui');

            wp_register_style('bootstrap', get_template_directory_uri() . "/css/bootstrap.css", '', $v);
            wp_enqueue_style('bootstrap');
        }
    }
}

add_action('wp_enqueue_scripts', 'x2_register_styles', 11);

function addmainstylesheet() {
    $v = getfileversion();
    $min = getMin();
    if (get_post_type(get_the_ID()) == 'gallery') {
        
    } else {
        if ($min === true) {
            
            wp_register_style('mystyles-min', get_template_directory_uri() . "/css/all.min.css", '', $v);
            wp_enqueue_style('mystyles-min'); 
            
        } else {
            wp_register_style('mystyles', get_template_directory_uri() . "/css/styles.css", '', $v);
            wp_enqueue_style('mystyles');
        }
        
    }
}

add_action('wp_enqueue_scripts', 'addmainstylesheet', 12);

function x2_register_styles_themeoptions() {
    wp_register_style('theme-mystyles', get_template_directory_uri() . "/css/styles.php", '', $v);
    wp_enqueue_style('theme-mystyles');
}

add_action('wp_enqueue_scripts', 'x2_register_styles_themeoptions', 20);

function x2_register_styles_head() {

    //wp_register_style('opensans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600&subset=latin,cyrillic-ext,greek-ext,vietnamese,latin-ext,cyrillic,greek');
    //wp_enqueue_style('opensans-font');

    //wp_register_style('roboto-font', 'http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,400italic,300italic&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic');
    //wp_enqueue_style('roboto-font');

    //wp_register_style('lato-font', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,400italic&subset=latin,latin-ext');
    //wp_enqueue_style('lato-font');

    $themeFont = themeColorAndMoreOptions();
    if ($themeFont['font'] != '') {
        wp_register_style('themefont-font', 'http://fonts.googleapis.com/css?family=' . $themeFont['font'] . ':300italic,400italic,400,300,600&subset=latin,cyrillic-ext,greek-ext,vietnamese,latin-ext,cyrillic,greek');
        wp_enqueue_style('themefont-font');
    }
}

add_action('wp_enqueue_scripts', 'x2_register_styles_head');
?>
