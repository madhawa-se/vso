<?php

add_action('do_meta_boxes', 'x2_cpt_room_meta_image');
function x2_cpt_room_meta_image() {
	remove_meta_box('postimagediv', 'room', 'side');
	add_meta_box('postimagediv', __('Room Featured Image','x2'), 'post_thumbnail_meta_box', 'room', 'side');
}

add_action('init', 'x2_cpt_room_init');
function x2_cpt_room_init() {
        $labels = array(
	    'name' => _x('Rooms', 'post type general name', 'x2'),
	    'singular_name' => _x('Room', 'post type singular name', 'x2'),
	    'new_item' => __('New Room', 'x2'),
	    'add_new' => __('New Room', 'x2'),
	    'add_new_item' => __('Add New Room', 'x2'),
	    'view_item' => __('View Room', 'x2'),
	    'edit_item' => __('Edit Room', 'x2'),
	    'search_items' => __('Search Rooms', 'x2'),
	    'not_found' => __('No Rooms found', 'x2'),
	    'not_found_in_trash' => __('No Rooms found in the trash', 'x2'),
	    'parent_item_colon' => __('Parent Room Item:', 'x2')
	);

	$args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'exclude_from_search' => false,
	    'show_ui' => true,
	    'singular_label' => __('Room', 'x2'),
	    'query_var' => true,
	    //'rewrite' => true,
            'rewrite' => array('slug' => 'accommodation'),
            'capability_type' => 'page',
	    'hierarchical' => true,
	    'has_archive' => false,
	    'menu_position' => 30,
	    'supports' => array('title', 'editor', 'thumbnail','excerpt','revisions','custom-fields','author', 'page-attributes'),
	    'menu_icon' => get_template_directory_uri() . '/framework/custom_post_types/img/room.png'
	    
	);

	register_post_type('room', $args);

        
}


function add_room_columns($columns) {
    return array_merge($columns, 
              
              array('room_features' => __('Features')),
              array('room_order' => __('Order'))
            );
}
add_filter('manage_room_posts_columns' , 'add_room_columns');


function custom_room_column( $column ) {
    global $post;
    switch ( $column ) {
      
      case 'room_order':
        $order = $post->menu_order;
        echo $order;                    
        break; 
     
      case 'room_features':
        echo get_the_term_list( $post->ID, 'feature', '', ', ','' ) . '<br />';  			
        break; 

    }
}
add_action( 'manage_room_posts_custom_column' , 'custom_room_column' );


add_filter( 'manage_edit-room_sortable_columns', 'my_sortable_cake_column' );  
function my_sortable_cake_column( $columns ) {  
    $columns['room_order'] = 'room_order';
    $columns['room_terms'] = 'room_features';
  
    return $columns;  
}

function room_order_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'room_order' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'room_order' => 'menu_order'
		) );
	}
 
	return $vars;
}
add_filter( 'request', 'room_order_column_orderby' );


?>