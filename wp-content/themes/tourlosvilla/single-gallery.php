<?php get_header('gallery'); ?> 
<?php
    $backlink = ($x2postmeta->gallery_backlink != '' ? get_permalink($x2postmeta->gallery_backlink) : site_url());
    if ( $x2postmeta->gallery_backlink_permalink != '' ) {
        $backlink = $x2postmeta->gallery_backlink_permalink;
    }
?>
<body class="galleryfullscreen">

        <div id="navigation">
            <ul class="menu">
                <li class="mainlist">
                    <a href="#"><?php echo ___('CHOOSE GALLERY', 'x2-frontend', 'gallery_choosegallery_btn'); ?></a>
                    <div class="galleries-wrp">
                        <ul class="galleries">
                            <?php /* ?>
                            <li><a href="#">Apartment</a></li>
                            <li><a href="#">Family Room</a></li>
                            <li><a href="#">Suite</a></li>
                            <li><a href="#">Maisonette</a></li>
                            <li><a href="#">Superior Double Room</a></li>
                            <li><a href="#">Economy Room</a></li>
                            <?php */ ?>
                            
                            <?php
                                $thisGalleryId = get_the_ID();
                                   //gallieries//
                                $args_galleries = array(
                                    'post_type'  => 'gallery',
                                    'posts_per_page' => -1,
                                    'post_status' => 'publish',
                                    'meta_key' => 'gallery_meta_order',
                                    'orderby' => 'gallery_meta_order',
                                    'order' => 'ASC'

                                );
                                $galleries = new WP_Query( $args_galleries );
                                while ( $galleries->have_posts() ) {
                                        $galleries->the_post();
                                        $gallery_seo_title = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true );
                                ?>
                                    <li><a title="<?php echo $gallery_seo_title; ?>" class="" href="<?php echo get_permalink(); ?>"><?php echo x2_upper(get_the_title()); ?></a></li>
                                <?php        
                                }
                                wp_reset_postdata();
                                //gallieries//
                                ?>
                                
                                <li class="gallerymenu-closebtn"><a class="closebtnmenu mythemecolor-background-color" href="<?php echo $backlink; ?>"><?php echo ___('CLOSE', 'x2-frontend', 'gallery_close_btn'); ?></a></li>
                            
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="close close-btn-custom">
                <a href="<?php echo $backlink; ?>" class="closebtn"><span>x</span></a>
            </div>
        </div>
	
	<!--End of styles-->

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<!--Arrow Navigation-->
        <?php /* ?>
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	<?php */ ?>
         
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
			
			<a id="play-button">
                            <img id="pauseplay" src="<?php echo get_template_directory_uri(); ?>/js/supersized_final/img/pause.png"/>
                        </a>
		
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			
			<!--Thumb Tray button-->
			<a id="tray-button">
                            <img id="tray-arrow" src="<?php echo get_template_directory_uri(); ?>/js/supersized_final/img/button-tray-up.png"/>
                        </a>
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>

<?php get_footer('gallery'); ?>  