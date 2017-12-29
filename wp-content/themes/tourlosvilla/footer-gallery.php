  
    <?php wp_footer(); ?>
    <?php 
    $photogallery_IDs = get_post_meta(get_the_ID(), 'ct_mb_gallery_images', false );
    $photogallery_imgs = x2_get_gallery($photogallery_IDs,'x2_photogallery_thumb_small');
    $x2_page_photogallery_json = '';
    foreach ($photogallery_imgs as $photogallery_img) {
        $x2_page_photogallery_json .= "{image : '{$photogallery_img['full'][0]}', title:''},";
    }
    ?>
    <script type="text/javascript">
			
                        var backgroundimages = [<?php echo $x2_page_photogallery_json; ?>];
                        
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slide_interval          : 3000,		// Length between transitions
					transition              : 1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed	: 700,		// Speed of transition
					image_path		: '<?php echo get_template_directory_uri(); ?>/js/supersized_final/img/',										   
					// Components							
                                        slide_links		:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
                                        <?php /* ?>slides 			:  	[			// Slideshow Images
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-1.jpg', title : 'Image Credit: Maria Kazvan', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/kazvan-1.jpg', url : 'http://www.nonsensesociety.com/2011/04/maria-kazvan/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-2.jpg', title : 'Image Credit: Maria Kazvan', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/kazvan-2.jpg', url : 'http://www.nonsensesociety.com/2011/04/maria-kazvan/'},  
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-3.jpg', title : 'Image Credit: Maria Kazvan', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/kazvan-3.jpg', url : 'http://www.nonsensesociety.com/2011/04/maria-kazvan/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-1.jpg', title : 'Image Credit: Colin Wojno', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/wojno-1.jpg', url : 'http://www.nonsensesociety.com/2011/03/colin/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-2.jpg', title : 'Image Credit: Colin Wojno', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/wojno-2.jpg', url : 'http://www.nonsensesociety.com/2011/03/colin/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-3.jpg', title : 'Image Credit: Colin Wojno', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/wojno-3.jpg', url : 'http://www.nonsensesociety.com/2011/03/colin/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-1.jpg', title : 'Image Credit: Brooke Shaden', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/shaden-1.jpg', url : 'http://www.nonsensesociety.com/2011/06/brooke-shaden/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-2.jpg', title : 'Image Credit: Brooke Shaden', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/shaden-2.jpg', url : 'http://www.nonsensesociety.com/2011/06/brooke-shaden/'},
                                                                            {image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-3.jpg', title : 'Image Credit: Brooke Shaden', thumb : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/thumbs/shaden-3.jpg', url : 'http://www.nonsensesociety.com/2011/06/brooke-shaden/'}
                                                                          ],<?php */ ?>
                                       slides 			: backgroundimages                                           
                                                                          
					
				});
                                
                                
		    });
		    
		</script>

  </body>
</html>