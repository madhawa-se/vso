<?php
$post = get_post($_GET['gallery']); 
$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<!--
		Supersized - Fullscreen Slideshow jQuery Plugin
		Version : 3.2.7
		Site	: www.buildinternet.com/project/supersized
		
		Author	: Sam Dunn
		Company : One Mighty Roar (www.onemightyroar.com)
		License : MIT License / GPL License
	-->

	<head>

		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/'; ?>css/supersized.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/'; ?>theme/supersized.shutter_x2.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/'; ?>js/jquery.easing.min.js"></script>
		
		<script type="text/javascript" src="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/'; ?>js/supersized.3.2.7.js"></script>
		<script type="text/javascript" src="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/'; ?>theme/supersized.shutter.js"></script>
		
		<script type="text/javascript">
			
                        
                        
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   3000,		// Length between transitions
					transition              :   6, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
					image_path			:	'<?php echo WPCASA_LIB_URL."/assets/js/supersized/img/"; ?>',										   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	1,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   1,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
                                            
                                                                                        <?php
                                                                                            $i = 0;
                                                                                            $len = count($images);
                                                                                            $fetured_img_id = get_post_thumbnail_id( $post->ID );
                                                                                            foreach ($images as $attachment_id => $image) :
                                                                                                
                                                                                                if ( $fetured_img_id == $image->ID ) 
                                                                                                        continue;
                                                                                                
                                                                                                $image_attributes = wp_get_attachment_image_src( $image->ID, 'large' );
                                                                                                $image_thumbnail = wp_get_attachment_image_src( $image->ID );
                       
                                                                                        ?>
                                                                                         
                                                                                         {image : '<?php echo $image_attributes[0]; ?>', title : '', thumb : '<?php echo $image_thumbnail[0]; ?>', url : ''}<?php if ($i < $len-1) { echo ','; } ?>
                                                                                                        
                                                                                        <?php
																								$i += 1;
                                                                                            endforeach;
                                                                                        ?>
                                            
														
												],
												
					// Theme Options			   
					progress_bar			:	1,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
                                //console.log($.supersized.vars);
		    });
		    
		</script>
		
	</head>
	
	<style type="text/css">
		ul#demo-block{ margin:0 15px 15px 15px; }
			ul#demo-block li{ margin:0 0 10px 0; padding:10px; display:inline; float:left; clear:both; color:#aaa; background:url('<?php echo WPCASA_LIB_URL.'/assets/js/supersized/img/'; ?>bg-black.png'); font:11px Helvetica, Arial, sans-serif; }
			ul#demo-block li a{ color:#eee; font-weight:bold; }
	</style>

<body>
    
    

	<!--Demo styles (you can delete this block)-->
	
	
	
	<!--End of styles-->

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	
	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>
	
	<!--Time Bar-->
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">
			
			<a id="play-button"><img id="pauseplay" src="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/img/'; ?>pause.png"/></a>
		
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			
			<!--Thumb Tray button-->
			<a id="tray-button"><img id="tray-arrow" src="<?php echo WPCASA_LIB_URL.'/assets/js/supersized/img/'; ?>button-tray-up.png"/></a>
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>
        
        
        <div id="closebtn-cont"> <a id="closebtn" href="<?php echo get_permalink( $post->ID ); ?>"></a> </div>
        
        
        <div class="submenu-main">
                <div><img src="<?php echo WPCASA_URL . '/img/x2i/logo-villas-gallery.jpg' ?>"/></div>
                <div class="submenu-main-btn">
                    <a href="#"><?php echo upper(get_the_title($post->ID)); ?></a>
                </div>
                <div class="submenu-arrow">
                    <div class="submenu explore">
                        <div class="list">
                            <ul>
                                <?php

                                $args2 = array(
                                    'nopaging' => true,
                                    'post_type' => 'property',
                                    'tax' => 'location',
                                    'post_status' => 'publish'
                                );
                                $query_destinations = new WP_Query( $args2 );

                                while( $query_destinations->have_posts() ):
                                        $query_destinations->next_post();


                                        
                                        ?>    
                                            <li><a href="<?php echo get_permalink($query_destinations->post->ID); ?>?gallery=<?php echo $query_destinations->post->ID; ?>"><?php echo get_the_title( $query_destinations->post->ID ); ?></a></li>
                                        <?php    
                                       
                                        
                                endwhile;



                            ?>
                            </ul>
                        </div>
                    </div>    
                </div>   
        </div>     

</body>
</html>
