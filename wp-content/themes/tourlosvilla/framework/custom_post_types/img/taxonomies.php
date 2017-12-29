<?php

add_action( 'init', 'x2_taxonomy_roomtype_register');
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

add_action( 'init', 'x2_taxonomy_packagetype_register');
function x2_taxonomy_packagetype_register() {
        
	// Set labels and localize them	
	$features_name	   = apply_filters( 'x2_taxonomy_packagetype_name', __( 'Package Types', 'x2-backend' ) );
	$features_singular = apply_filters( 'x2_taxonomy_packagetype_singular', __( 'Package Types', 'x2-backend' ) );
	
	$features_labels = array(
		'name' 			=> $features_name,
		'singular_name' => $features_singular
	);	
	// Set args incl rewrite rules
	$features_args = array(
		'labels' 	   => $features_labels,
		'hierarchical' => true,
		'rewrite' 	   => array(
			'slug' 		 => apply_filters( 'x2_rewrite_packagetype_slug', 'packagetype' ),
			'with_front' => false
		)
	);	
	$features_args = apply_filters( 'x2_taxonomy_packagetype_args', $features_args );
	
	// Register taxonomy	
	register_taxonomy( 'packagetype', array( 'package' ), $features_args );
}
