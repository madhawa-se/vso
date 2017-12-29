<?php

//add_action('do_meta_boxes', 'x2_cpt_slide_meta_image');

function x2_cpt_slide_meta_image() {
	remove_meta_box('postimagediv', 'slide', 'side');
	add_meta_box('postimagediv', __('Slide Featured Image','x2'), 'post_thumbnail_meta_box', 'slide', 'side');
}

add_action('init', 'x2_cpt_slide_init');

function x2_cpt_slide_init() {
	$labels = array(
	    'name' => _x('Slides', 'post type general name', 'x2'),
	    'singular_name' => _x('Slide', 'post type singular name', 'x2'),
	    'new_item' => __('New Slide', 'x2'),
	    'add_new' => __('New Slide', 'x2'),
	    'add_new_item' => __('Add New Slide', 'x2'),
	    'view_item' => __('View Slide', 'x2'),
	    'edit_item' => __('Edit Slide', 'x2'),
	    'search_items' => __('Search Slides', 'x2'),
	    'not_found' => __('No Slides found', 'x2'),
	    'not_found_in_trash' => __('No Slides found in the trash', 'x2'),
	    'parent_item_colon' => __('Parent Slide Item:', 'x2')
	);

	$args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'exclude_from_search' => false,
	    'show_ui' => true,
	    'singular_label' => __('Gallery', 'x2'),
	    'query_var' => true,
	    'rewrite' => true,	
            'capability_type' => 'post',
	    'hierarchical' => true,
	    'has_archive' => false,
	    'menu_position' => 30,
	    'supports' => array('title'),
	    'menu_icon' => get_template_directory_uri() . '/framework/custom_post_types/img/gallery.png',
	    //'taxonomies' => array('post_tag','category'),
	);

	register_post_type('slide', $args);

}






add_action( 'add_meta_boxes', 'slide_meta_box_add' ); 

function slide_meta_box_add () {
    add_meta_box( 'my-meta-box-id', 'Gallery Attributes', 'slide_meta_order', 'slide', 'side', 'low' );  
}

function slide_meta_order() {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['slide_meta_order'] ) ? esc_attr( $values['slide_meta_order'][0] ) : ""; 
    ?>
    
    <label for="slide_meta_order">Order</label>  
    <input type="text" name="slide_meta_order" id="slide_meta_order" value="<?php echo $text; ?>" />  

    <?php
}

add_action( 'save_post', 'slide_meta_save' );  
function slide_meta_save( $post_id )  {  
    
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'slide') {
            update_post_meta($post->ID, 'slide_meta_order', $_POST['slide_meta_order']);
    }
    
}  


function add_slide_columns($columns) {
    return array_merge($columns, 
              //array('room_category_image' => __('Image')),
              array('orderslide' => __('Order'))  
            );
}
add_filter('manage_slide_posts_columns' , 'add_slide_columns');


function custom_slide_column( $column ) {
    global $post;
    switch ( $column ) {
      case 'orderslide':
        echo get_post_meta( $post->ID , 'slide_meta_order' , true );
        break;
    
      case 'room_category_image':
        //$image_id = get_post_meta( $post->ID , 'ct_mb_room_main_image' , true );
        //$image_attributes = wp_get_attachment_image_src( $image_id, 'thumbnail' ); // returns an array  
        //echo '<img src="'.$image_attributes[0].'" />';
        break; 

    }
}
add_action( 'manage_slide_posts_custom_column' , 'custom_slide_column' );


add_filter( 'manage_edit-slide_sortable_columns', 'my_sortable_slide_order_column' );  
function my_sortable_slide_order_column( $columns ) {  
    $columns['orderslide'] = 'orderslide';  
  
    return $columns;  
}

function slide_order_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'orderslide' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'slide_meta_order',
			'orderby' => 'meta_value_num'
		) );
	}
 
	return $vars;
}
add_filter( 'request', 'slide_order_column_orderby' );


?>