<?php
header("content-type: application/x-javascript");
require_once('../../../../wp-load.php');
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header, $post;

$icons = get_googlemap_options();
$pin = ($icons['pin'] != '' ? $icons['pin'] : get_stylesheet_directory_uri().'/images/icons/pin.png');
$pin_lat = $icons['lat'];
$pin_long = $icons['long'];
$pin_zoom = ($icons['zoom']!='' ? intval($icons['zoom']) : 14);
echo '
   
    var directory_uri = "'.get_stylesheet_directory_uri().'";
    var pin_img = "'.$pin.'"; 
    var pin_lat = "'.$pin_lat.'"; 
    var pin_long = "'.$pin_long.'";
    var pin_zoom = '.$pin_zoom.';    
   
';