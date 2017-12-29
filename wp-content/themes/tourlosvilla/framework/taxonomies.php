<?php

//add_action( 'init', 'x2_taxonomy_roomtype_register');
function x2_taxonomy_roomtype_register() {
        
	// Set labels and localize them	
	$features_name	   = apply_filters( 'x2_taxonomy_roomtype_name', __( 'Room Types', 'x2-backend' ) );
	$features_singular = apply_filters( 'x2_taxonomy_roomtype_singular', __( 'Room Types', 'x2-backend' ) );
	
	$features_labels = array(
		'name' 			=> $features_name,
		'singular_name' => $features_singular
	);	
	// Set args incl rewrite rules
	$features_args = array(
		'labels' 	   => $features_labels,
		'hierarchical' => true,
		'rewrite' 	   => array(
			'slug' 		 => apply_filters( 'x2_rewrite_roomtype_slug', 'roomtype' ),
			'with_front' => false
		)
	);	
	$features_args = apply_filters( 'x2_taxonomy_roomtype_args', $features_args );
	
	// Register taxonomy	
	register_taxonomy( 'roomtype', array( 'room' ), $features_args );
}


/**
 * This function adds the features taxonomy
 *
 * @uses register_taxonomy()
 *
 * @since 1.0
 */
 
add_action( 'init', 'x2_taxonomy_features_register' );

function x2_taxonomy_features_register() {

	// Set labels and localize them
	
	$features_name	   = apply_filters( 'x2_taxonomy_features_name', __( 'Features', 'x2-backend' ) );
	$features_singular = apply_filters( 'x2_taxonomy_features_singular', __( 'Feature', 'x2-backend' ) );
	
	$features_labels = array(
		'name' 			=> $features_name,
		'singular_name' => $features_singular
	);
	
	// Set args incl rewrite rules

	$features_args = array(
		'labels' 	   => $features_labels,
		'hierarchical' => true,
		'rewrite' 	   => array(
			'slug' 		 => apply_filters( 'x2_rewrite_features_slug', 'feature' ),
			'with_front' => false
		)
	);
	
	$features_args = apply_filters( 'x2_taxonomy_features_args', $features_args );
	
	// Register taxonomy
	
	register_taxonomy( 'feature', array( 'room' ), $features_args );

}

add_action( 'init', 'x2_taxonomy_highlights_register' );
function x2_taxonomy_highlights_register() {

	// Set labels and localize them
	
	$features_name	   = apply_filters( 'x2_taxonomy_highlights_name', __( 'Highlights', 'x2-backend' ) );
	$features_singular = apply_filters( 'x2_taxonomy_highlights_singular', __( 'Highlight', 'x2-backend' ) );
	
	$features_labels = array(
		'name' 			=> $features_name,
		'singular_name' => $features_singular
	);
	
	// Set args incl rewrite rules

	$features_args = array(
		'labels' 	   => $features_labels,
		'hierarchical' => true,
		'rewrite' 	   => array(
			'slug' 		 => apply_filters( 'x2_rewrite_features_slug', 'highlight' ),
			'with_front' => false
		)
	);
	
	$features_args = apply_filters( 'x2_taxonomy_features_args', $features_args );
	
	// Register taxonomy
	register_taxonomy( 'highlight', array( 'room' ), $features_args );

}   