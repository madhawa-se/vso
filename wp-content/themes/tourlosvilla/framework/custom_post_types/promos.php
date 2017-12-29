<?php

add_action('do_meta_boxes', 'x2_cpt_promo_meta_image');

function x2_cpt_promo_meta_image() {
	remove_meta_box('postimagediv', 'promo', 'side');
	add_meta_box('postimagediv', __('Promo Featured Image','x2'), 'post_thumbnail_meta_box', 'promo', 'side');
}

add_action('init', 'x2_cpt_promo_init');

function x2_cpt_promo_init() {
	$labels = array(
	    'name' => _x('Promos', 'post type general name', 'x2'),
	    'singular_name' => _x('Promo', 'post type singular name', 'x2'),
	    'new_item' => __('New Promo', 'x2'),
	    'add_new' => __('New Promo', 'x2'),
	    'add_new_item' => __('Add New Promo', 'x2'),
	    'view_item' => __('View Promo', 'x2'),
	    'edit_item' => __('Edit Promo', 'x2'),
	    'search_items' => __('Search Promos', 'x2'),
	    'not_found' => __('No Promos found', 'x2'),
	    'not_found_in_trash' => __('No Promos found in the trash', 'x2'),
	    'parent_item_colon' => __('Parent Promo Item:', 'x2')
	);

	$args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'exclude_from_search' => false,
	    'show_ui' => true,
	    'singular_label' => __('Promo', 'x2'),
	    'query_var' => true,
	    'rewrite' => true,	
            'capability_type' => 'post',
	    'hierarchical' => true,
	    'has_archive' => false,
	    'menu_position' => 30,
	    //'supports' => array('title', 'editor', 'thumbnail','revisions','custom-fields','author'),
            'supports' => array('title', 'thumbnail','revisions','author'),
            //'supports' => array('title','revisions'),
	    'menu_icon' => get_template_directory_uri() . '/framework/custom_post_types/img/gallery.png',
	    //'taxonomies' => array('post_tag','category'),
	);

	register_post_type('promo', $args);

}



///*


add_action( 'add_meta_boxes', 'promo_meta_box_add' ); 

function promo_meta_box_add () {
    add_meta_box( 'my-meta-box-id', 'Promo Attributes', 'promo_meta_order', 'promo', 'side', 'low' );  
}

function promo_meta_order() {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['promo_meta_order'] ) ? esc_attr( $values['promo_meta_order'][0] ) : ""; 
    ?>
    
    <label for="promo_meta_order">Order</label>  
    <input type="text" name="promo_meta_order" id="promo_meta_order" value="<?php echo $text; ?>" />  

    <?php
}

add_action( 'save_post', 'promo_meta_save' );  
function promo_meta_save( $post_id )  {  
    
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'promo') {
            update_post_meta($post->ID, 'promo_meta_order', $_POST['promo_meta_order']);
    }
    
}  


function add_promo_columns($columns) {
    return array_merge($columns, 
              //array('room_category_image' => __('Image')),
              array('orderpromo' => __('Order'))  
            );
}
add_filter('manage_promo_posts_columns' , 'add_promo_columns');


function custom_promo_column( $column ) {
    global $post;
    switch ( $column ) {
      case 'orderpromo':
        echo get_post_meta( $post->ID , 'promo_meta_order' , true );
        break;
    }
}
add_action( 'manage_promo_posts_custom_column' , 'custom_promo_column' );


add_filter( 'manage_edit-promo_sortable_columns', 'my_sortable_promo_order_column' );  
function my_sortable_promo_order_column( $columns ) {  
    $columns['orderpromo'] = 'orderpromo';  
  
    return $columns;  
}

function promo_order_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'orderpromo' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'promo_meta_order',
			'orderby' => 'meta_value_num'
		) );
	}
 
	return $vars;
}
add_filter( 'request', 'promo_order_column_orderby' );

//*/
?>