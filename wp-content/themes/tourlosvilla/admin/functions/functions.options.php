<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");
                
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				//"block_four"	=> "Block Four",
			),
		);
                
                //gallieries//
                $of_galleries[''] = 'select...';
                $args_galleries = array(
                    'post_type'  => 'gallery',
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                    
                );
                $galleries = new WP_Query( $args_galleries );
                while ( $galleries->have_posts() ) {
                        $galleries->the_post();
                        $of_galleries[get_the_ID()] = get_the_title();
                }
                wp_reset_postdata();
                //gallieries//
                
                $args_slides = array(
                    'post_type'  => 'page', 
                    'meta_query' => array( 
                        array(
                            'key'   => '_wp_page_template', 
                            'value' => array('tpl-homepage.php','tpl-homepage.php')
                        )
                    )
                );
                $homepage_slides = new WP_Query( $args_slides );
                
               $of_homepag[''] = 'select...';
                while ( $homepage_slides->have_posts() ) {
                        $homepage_slides->the_post();
                        $homepage_slides_arr[get_the_ID()] = get_the_title();
                        
                        $of_homepag[get_the_ID()] = get_the_title();
                }
                wp_reset_postdata();
                $homepage_slides_obj = array(
                    "disabled" => array("placebo" => "placebo"),
                    "enabled" => array("placebo" => "placebo"),
                );
                foreach($homepage_slides_arr as $homepage_slides_arrK=>$homepage_slides_arrV ) {
                    $homepage_slides_obj['disabled']['slide_'.$homepage_slides_arrK] = $homepage_slides_arrV;
                }

		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

                
                
                //*/
		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Homepage",
						"type" 		=> "heading"
                                 );



$of_options[] = array( 	"name" 		=> "Select Homepage Template",
						"desc" 		=> "Homepage Template",
						"id" 		=> "homepage_template",
						"std" 		=> "",
						"type" 		=> "selectx2",
						"options" 	=> $of_homepag
				);

$of_options[] = array( 	"name" 		=> "Google Map",
						"type" 		=> "heading"
                                 );



$of_options[] = array( 	"name" 		=> "Goole Map - Pin",
						"desc" 		=> "Goole Map - Pin",
						"id" 		=> "icons_logo_pin",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Goole Map - Lat",
						"desc" 		=> "Goole Map - Lat",
						"id" 		=> "googlemap_lat",
						"std" 		=> "0",
						"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Goole Map - Long",
						"desc" 		=> "Goole Map - Long",
						"id" 		=> "googlemap_long",
						"std" 		=> "0",
						"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Goole Map - Zoom",
						"desc" 		=> "Goole Map - Zoom",
						"id" 		=> "googlemap_zoom",
						"std" 		=> "14",
						"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Icons",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Logo Seo Title",
						"desc" 		=> "Logo Seo Title",
						"id" 		=> "logo_seotitle",
						"std" 		=> "",
						"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Logo Desktop (201x47)",
						"desc" 		=> "Logo Desktop (201x47)",
						"id" 		=> "icons_logo_desktop",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Logo Mobile (201x47)",
						"desc" 		=> "Logo Mobile (201x47)",
						"id" 		=> "icons_logo_mobile",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Favicon",
						"desc" 		=> "Favicon",
						"id" 		=> "icons_logo_favicon",
						"std" 		=> "",
						"type" 		=> "upload"
				);





$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Company Title & Copyright",
						"desc" 		=> "Company Name",
						"id" 		=> "footer_company_title_copyright",
						"std" 		=> "COMPANY TITLE © 2014",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Facebook Like Url",
						"desc" 		=> "Facebook Like Url",
						"id" 		=> "footer_facebooklike_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 1",
						"desc" 		=> "Footer Icons Icon",
						"id" 		=> "footer_icon_1",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 1 (hover)",
						"desc" 		=> "Footer Icons Icon (hover)",
						"id" 		=> "footer_icon_1_hover",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 1 (URL)",
						"desc" 		=> "Footer Icons Icon 1 (URL)",
						"id" 		=> "footer_icon_1_url",
						"std" 		=> "",
						"type" 		=> "text"
				);


$of_options[] = array( 	"name" 		=> "Footer Icons Icon 2",
						"desc" 		=> "Footer Icons Icon 2",
						"id" 		=> "footer_icon_2",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 2 (hover)",
						"desc" 		=> "Footer Icons Icon 2 (hover)",
						"id" 		=> "footer_icon_2_hover",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 2 (URL)",
						"desc" 		=> "Footer Icons Icon 2 (URL)",
						"id" 		=> "footer_icon_2_url",
						"std" 		=> "",
						"type" 		=> "text"
				);


$of_options[] = array( 	"name" 		=> "Footer Icons Icon 3",
						"desc" 		=> "Footer Icons Icon 3",
						"id" 		=> "footer_icon_3",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 3 (hover)",
						"desc" 		=> "Footer Icons Icon 3 (hover)",
						"id" 		=> "footer_icon_3_hover",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Footer Icons Icon 3 (URL)",
						"desc" 		=> "Footer Icons Icon 3 (URL)",
						"id" 		=> "footer_icon_3_url",
						"std" 		=> "",
						"type" 		=> "text"
				);


$of_options[] = array( 	"name" 		=> "Footer Promo",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Promo Slogan Color",
						"desc" 		=> "Footer Slogan Color",
						"id" 		=> "footer_slogan_color",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Promo Slogan",
						"desc" 		=> "Footer Slogan",
						"id" 		=> "footer_slogan",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Promo Slogan Link",
						"desc" 		=> "Footer Slogan Link",
						"id" 		=> "footer_slogan_link",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Promo Slogan Link (SEO Title)",
						"desc" 		=> "Promo Slogan Link (SEO Title)",
						"id" 		=> "footer_slogan_link_seotitle",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Promo Slogan Link (Target)",
						"desc" 		=> "Footer Slogan Link (Target)",
						"id" 		=> "footer_slogan_link_target",
						"std" 		=> "",
						"type" 		=> "selectx2",
                                                "options" 	=> array(
                                                    'parent' => '_parent',
                                                    'blank' => '_blank'
                                                )
				);

$of_options[] = array( 	"name" 		=> "Promo Background Image",
						"desc" 		=> "Promo Background Image",
						"id" 		=> "footer_slogan_backgroundimage",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Promo Background Image (SEO Alt)",
						"desc" 		=> "Promo Background Image (SEO Alt)",
						"id" 		=> "footer_slogan_backgroundimage_seoalt",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Footer promo - Tripadvisor Review",
						"desc" 		=> "Footer promo - Tripadvisor Review",
						"id" 		=> "footer_slogan_tripadvidor_review",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"name" 		=> "Social Networks",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "Facebook",
						"id" 		=> "x2_social_facebook",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_facebook_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				); 

$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "Twitter",
						"id" 		=> "x2_social_twitter",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_twitter_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				); 

$of_options[] = array( 	"name" 		=> "Google+",
						"desc" 		=> "Google Plus",
						"id" 		=> "x2_social_googleplus",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_googleplus_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				); 

$of_options[] = array( 	"name" 		=> "Pinterest",
						"desc" 		=> "Pinterest",
						"id" 		=> "x2_social_pinterest",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_pinterest_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				); 


$of_options[] = array( 	"name" 		=> "Youtube",
						"desc" 		=> "Youtube",
						"id" 		=> "x2_social_youtube",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_youtube_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "Instagram",
						"id" 		=> "x2_social_instagram",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_instagram_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "Flickr",
						"id" 		=> "x2_social_flickr",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_flickr_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Tripadvisor",
						"desc" 		=> "Tripadvisor",
						"id" 		=> "x2_social_tripadvisor",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "x2_social_tripadvisor_switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
                                 );


$of_options[] = array( 	"name" 		=> "SEO - Logo Link title Attribute",
						"desc" 		=> "Logo Link title Attribute",
						"id" 		=> "x2_seo_logo_title_attr",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Custom Color",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Theme Customization",
						"desc" 		=> "",
						"id" 		=> "x2_theme_switch",
						"std" 		=> 0,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Theme Color",
						"desc" 		=> "(default: #7bc2d6).",
						"id" 		=> "x2_theme_color",
						"std" 		=> "#7bc2d6",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Theme Color Hover actions",
						"desc" 		=> "(default: #66b5ce).",
						"id" 		=> "x2_theme_color_hover",
						"std" 		=> "#66b5ce",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Buttons :: Light Background Color",
						"desc" 		=> "(default: #9edaed).",
						"id" 		=> "x2_theme_buttons_light",
						"std" 		=> "#9edaed",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Buttons :: Light Background Color (hover)",
						"desc" 		=> "(default: #79c1d8).",
						"id" 		=> "x2_theme_buttons_light_hover",
						"std" 		=> "#79c1d8",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Main menu BOOK ONLINE hover action",
						"desc" 		=> "(default: #49a3c0).",
						"id" 		=> "x2_theme_color_bookonline_hover",
						"std" 		=> "#49a3c0",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Main menu hover/active",
						"desc" 		=> "(default: #57b0cd).",
						"id" 		=> "x2_theme_color_mainmenu_hoveractive",
						"std" 		=> "#57b0cd",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "WYSIWYG Link",
						"desc" 		=> "(default: #63bcd9).",
						"id" 		=> "x2_theme_color_fck_link",
						"std" 		=> "#63bcd9",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "WYSIWYG Link (hover)",
						"desc" 		=> "(default: #4796af).",
						"id" 		=> "x2_theme_color_fck_link_hover",
						"std" 		=> "#4796af",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Google Font Select",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "x2_theme_font",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my preview text!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> array(
										"none" => "Select a font",//please, always use this key: "none"
										"Lato" => "Lato",
										"Loved by the King" => "Loved By the King",
										"Tangerine" => "Tangerine",
										"Terminal Dosis" => "Terminal Dosis"
						)
				);

$of_options[] = array( 	"name" 		=> "Online Booking",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Online Booking Url",
						"desc" 		=> "Online Booking Url",
						"id" 		=> "x2_onlinebooking_url",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Main Menu -- Online Booking Link (Target)",
						"desc" 		=> "Main Menu - Online Booking Link (Target)",
						"id" 		=> "x2_onlinebooking_url_mainmenu_target",
						"std" 		=> "",
						"type" 		=> "selectx2",
						"options" 	=> array(
                                                    '_parent' => 'Parent',
                                                    '_blank' => 'Blank'
                                                )
				);

$of_options[] = array( 	"name" 		=> "Languages",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Extra Languages",
						"desc" 		=> "",
						"id" 		=> "x2_languagesnavigationmenu",
						"std" 		=> 0,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Forms",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Contact Form Email",
						"desc" 		=> "Contact Form Email",
						"id" 		=> "x2_contactform_email",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Booking Form Email",
						"desc" 		=> "Booking Form Email",
						"id" 		=> "x2_bookingform_email",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Weather",
						"type" 		=> "heading"
                                 );

$of_options[] = array( 	"name" 		=> "Weather Footer",
						"desc" 		=> "",
						"id" 		=> "x2_weather_showhide",
						"std" 		=> 0,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Yahoo Weather : Place ID",
						"desc" 		=> "Find your location id (http://woeid.rosselliot.co.nz)",
						"id" 		=> "x2_weather_id",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Yahoo Weather : Place Name",
						"desc" 		=> "Yahoo Weather : Place Name",
						"id" 		=> "x2_weather_placename",
						"std" 		=> "",
						"type" 		=> "text"    
    );

$of_options[] = array( 	"name" 		=> "Globals",
						"type" 		=> "heading"
                                 );





$FGLOBALS  = registerGlobals($of_options, $of_options);
$of_options = $FGLOBALS;



// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);


	}//End function: of_options()
}//End chack if function exists: of_options()
?>
