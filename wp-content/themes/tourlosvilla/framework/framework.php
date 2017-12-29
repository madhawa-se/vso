<?php
//Custom Post Types
locate_template('/framework/custom_post_types.php', true, true);
locate_template( '/framework/taxonomies.php', true, true );

//Metabox
locate_template('/meta-box/meta-box.php', true, true);
locate_template('/framework/includes/theme-metaboxes.php', true, true);

//Media extra fields
locate_template( '/framework/includes/media_extra_meta.php', true, true );

//Lib
locate_template('/framework/includes/lib.php', true, true);

//Menus
locate_template('/framework/includes/wp_bootstrap_navwalker.php', true, true);
//locate_template('/framework/includes/wp_bootstrap_navwalker_mobile.php', true, true);
locate_template('/framework/includes/menus.php', true, true);

//Thumbs
locate_template('/framework/includes/thumbs.php', true, true);

//Scripts & Styles
locate_template( '/framework/includes/scripts.php', true, true );
locate_template( '/framework/includes/styles.php', true, true );


