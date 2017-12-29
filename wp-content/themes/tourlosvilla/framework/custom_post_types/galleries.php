<?php

add_action('do_meta_boxes', 'x2_cpt_gallery_meta_image');

function x2_cpt_gallery_meta_image() {
	remove_meta_box('postimagediv', 'gallery', 'side');
	add_meta_box('postimagediv', __('Gallery Featured Image','x2'), 'post_thumbnail_meta_box', 'gallery', 'side');
}

add_action('init', 'x2_cpt_gallery_init');

function x2_cpt_gallery_init() {
	$labels = array(
	    'name' => _x('Galleries', 'post type general name', 'x2'),
	    'singular_name' => _x('Gallery', 'post type singular name', 'x2'),
	    'new_item' => __('New Gallery', 'x2'),
	    'add_new' => __('New Gallery', 'x2'),
	    'add_new_item' => __('Add New Gallery', 'x2'),
	    'view_item' => __('View Gallery', 'x2'),
	    'edit_item' => __('Edit Gallery', 'x2'),
	    'search_items' => __('Search Galleries', 'x2'),
	    'not_found' => __('No Galleries found', 'x2'),
	    'not_found_in_trash' => __('No Galleries found in the trash', 'x2'),
	    'parent_item_colon' => __('Parent Gallery Item:', 'x2')
	);

	$args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'exclude_from_search' => false,
	    'show_ui' => true,
	    'singular_label' => __('Gallery', 'x2'),
	    'query_var' => true,
	    //'rewrite' => true,
            'rewrite' => array('slug' => 'photos'),
            'capability_type' => 'post',
	    'hierarchical' => true,
	    'has_archive' => false,
	    'menu_position' => 30,
	    'supports' => array('title', 'thumbnail'),
	    'menu_icon' => get_template_directory_uri() . '/framework/custom_post_types/img/gallery.png',
	    //'taxonomies' => array('post_tag','category'),
	);

	register_post_type('gallery', $args);

}






add_action( 'add_meta_boxes', 'gallery_meta_box_add' ); 

function gallery_meta_box_add () {
    add_meta_box( 'my-meta-box-id', 'Gallery Attributes', 'gallery_meta_order', 'gallery', 'side', 'low' );  
}

function gallery_meta_order() {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['gallery_meta_order'] ) ? esc_attr( $values['gallery_meta_order'][0] ) : ""; 
    ?>
    
    <label for="gallery_meta_order">Order</label>  
    <input type="text" name="gallery_meta_order" id="gallery_meta_order" value="<?php echo $text; ?>" />  

    <?php
}

add_action( 'save_post', 'gallery_meta_save' );  
function gallery_meta_save( $post_id )  {  
    
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'gallery') {
            update_post_meta($post->ID, 'gallery_meta_order', $_POST['gallery_meta_order']);
    }
    
}  


function add_gallery_columns($columns) {
    return array_merge($columns, 
              array('room_category_image' => __('Image')),
              array('ordergallery' => __('Order'))  
            );
}
add_filter('manage_gallery_posts_columns' , 'add_gallery_columns');


function custom_gallery_column( $column ) {
    global $post;
    switch ( $column ) {
      case 'ordergallery':
        echo get_post_meta( $post->ID , 'gallery_meta_order' , true );
        break;
    
      case 'room_category_image':
        $image_id = get_post_meta( $post->ID , 'ct_mb_room_main_image' , true );
        $image_attributes = wp_get_attachment_image_src( $image_id, 'thumbnail' ); // returns an array  
        echo '<img src="'.$image_attributes[0].'" />';
        break; 

    }
}
add_action( 'manage_gallery_posts_custom_column' , 'custom_gallery_column' );


add_filter( 'manage_edit-gallery_sortable_columns', 'my_sortable_gallery_order_column' );  
function my_sortable_gallery_order_column( $columns ) {  
    $columns['ordergallery'] = 'ordergallery';  
  
    return $columns;  
}

function gallery_order_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'ordergallery' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'gallery_meta_order',
			'orderby' => 'meta_value_num'
		) );
	}
 
	return $vars;
}
add_filter( 'request', 'gallery_order_column_orderby' );


?>