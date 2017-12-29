<?php
 

 
function be_attachment_field_credit( $form_fields, $post ) {
	$form_fields['seo-title-attr'] = array(
		'label' => 'Seo Title Attr',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'seo_title_attr', true ),
		'helps' => '',
	);
        
	return $form_fields;
}
 
add_filter( 'attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2 );
 

 
function be_attachment_field_credit_save( $post, $attachment ) {
	
        if( isset( $attachment['seo-title-attr'] ) )
		update_post_meta( $post['ID'], 'seo_title_attr', $attachment['seo-title-attr'] );
    
        
	return $post;
}
 
add_filter( 'attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2 );