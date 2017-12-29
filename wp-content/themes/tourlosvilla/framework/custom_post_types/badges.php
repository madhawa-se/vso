<?php

add_action('do_meta_boxes', 'x2_cpt_badge_meta_image');

function x2_cpt_badge_meta_image() {
	remove_meta_box('postimagediv', 'badge', 'side');
	add_meta_box('postimagediv', __('Badge Featured Image','x2'), 'post_thumbnail_meta_box', 'badge', 'side');
}

add_action('init', 'x2_cpt_badge_init');

function x2_cpt_badge_init() {
	$labels = array(
	    'name' => _x('Badges', 'post type general name', 'x2'),
	    'singular_name' => _x('Badge', 'post type singular name', 'x2'),
	    'new_item' => __('New Badge', 'x2'),
	    'add_new' => __('New Badge', 'x2'),
	    'add_new_item' => __('Add New Badge', 'x2'),
	    'view_item' => __('View Badge', 'x2'),
	    'edit_item' => __('Edit Badge', 'x2'),
	    'search_items' => __('Search Badges', 'x2'),
	    'not_found' => __('No Badges found', 'x2'),
	    'not_found_in_trash' => __('No Badges found in the trash', 'x2'),
	    'parent_item_colon' => __('Parent Badge Item:', 'x2')
	);

	$args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'exclude_from_search' => false,
	    'show_ui' => true,
	    'singular_label' => __('Badge', 'x2'),
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

	register_post_type('badge', $args);

}



///*


add_action( 'add_meta_boxes', 'badge_meta_box_add' ); 

function badge_meta_box_add () {
    add_meta_box( 'my-meta-box-id', 'Badge Attributes', 'badge_meta_order', 'badge', 'side', 'low' );  
}

function badge_meta_order() {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['badge_meta_order'] ) ? esc_attr( $values['badge_meta_order'][0] ) : ""; 
    ?>
    
    <label for="badge_meta_order">Order</label>  
    <input type="text" name="badge_meta_order" id="promo_meta_order" value="<?php echo $text; ?>" />  

    <?php
}

add_action( 'save_post', 'badge_meta_save' );  
function badge_meta_save( $post_id )  {  
    
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'badge') {
            update_post_meta($post->ID, 'badge_meta_order', $_POST['badge_meta_order']);
    }
    
}  


function add_badge_columns($columns) {
    return array_merge($columns, 
              array('orderbadge' => __('Order'))  
            );
}
add_filter('manage_badge_posts_columns' , 'add_badge_columns');


function custom_badge_column( $column ) {
    global $post;
    switch ( $column ) {
      case 'orderbadge':
        echo get_post_meta( $post->ID , 'badge_meta_order' , true );
        break;
    }
}
add_action( 'manage_badge_posts_custom_column' , 'custom_badge_column' );


add_filter( 'manage_edit-badge_sortable_columns', 'my_sortable_badge_order_column' );  
function my_sortable_badge_order_column( $columns ) {  
    $columns['orderbadge'] = 'orderbadge';  
  
    return $columns;  
}

function badge_order_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'orderbadge' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'badge_meta_order',
			'orderby' => 'meta_value_num'
		) );
	}
 
	return $vars;
}
add_filter( 'request', 'badge_order_column_orderby' );

//*/
?>