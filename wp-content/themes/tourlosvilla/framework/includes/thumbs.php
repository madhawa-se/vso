<?php

if (function_exists('add_theme_support')) {

        add_theme_support('post-thumbnails');
        
        //Promos
        add_image_size('x2_thumb_600x600', 600, 600, true);
        
        //Photogallery Thumbnails
        //add_image_size('x2_photogallery_thumb_main', 560, 325, true);
        //add_image_size('x2_photogallery_thumb_main_desktop', 276, 160, true);
        add_image_size('x2_photogallery_thumb_small', 267, 267, true);
        
        //Promos
        add_image_size('x2_thumb_419x324', 419, 324, true);
        
        //Rooms Listing
        add_image_size('x2_thumb_506x278', 506, 278, true);
        
}

?>
