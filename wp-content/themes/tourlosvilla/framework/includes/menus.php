<?php

if (function_exists('add_theme_support')) {
	add_theme_support('menus');
	add_action('init', 'x2_register_menus');
}

function x2_register_menus() {
	register_nav_menus(
		array(
		    'main' => __('Main','x2'),
                    'footermain' => __('Footer Menu','x2')
		)
	);
}


add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 10 );
function your_custom_menu_item ( $items, $args ) {
    global $post;
    $bookinglink= getBookonlineLink();
    $bookinglink_target = getBookonlineLink_linktarget_themeoptions();
    $langOptions = get_languages_options();
    $lang_settings = getCurrentLang();
    
    if ($args->theme_location == 'main' ) {
        
        $template_name = get_post_meta( $post->ID, '_wp_page_template', true );
        if (!is_home() && $template_name != 'tpl-homepage.php') {
        $items = '<li><a href="'.$lang_settings['iso']['url'].'">'.___('HOME', 'x2-frontend', 'homebtnmainmenu').'</a></li>'.$items;
        }
        
        if ($langOptions['status'] == true) {
        $items .= '<li class="lang"><a class="selected-lang" href="#">'.$lang_settings['iso']['text_active'].'</a>';
        $items .= '<ul role="menu" class=" dropdown-menu">';
        $items .= '<li><a href="/">EN</a></li>';
        $items .= '<li><a href="/gr/">GR</a></li>';
        $items .= '</ul>';
        $items .= '</li>';
        }
        
        $items .= '<li class="boldcategory mythemecolor-background-color"><a rel="nofollow" class="bookbtnredirect" target="'.$bookinglink_target.'" href="'.$bookinglink.'">'.___('BOOK ONLINE', 'x2-frontend','mainmenu_bookonline').'</a></li>';
    }
    
    if ($args->theme_location == 'footermain' ) {
        $items = '<li><a rel="nofollow" target="_blank" href="'.$bookinglink.'">'.___('Book Online', 'x2-frontend', 'footer_bookonline').'</a></li>'.$items;
        $items .= '<li><a target="_blank" href="http://www.x2interactive.gr">Website by X2interactive</a></li>';
    }
    
    return $items;
}

?>