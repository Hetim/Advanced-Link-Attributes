<?php

/*
Plugin Name: Advanced Link Attributes
Plugin URI: https://www.chingin.de/blog/advanced-link-attributes/
Description: Define link attributes like rel, class, etc. for specific links within the tiny mce link dialog.
Version: 0.1
Author: Modul Digital
Author URI: http://www.moduldigital.de/
*/

function ala_custom_link_dialog_styles( $hook ) {
    
    if ( 'post.php' == $hook OR 'post-new.php' == $hook ) {
        
        wp_enqueue_style( 'ala_editor_styles', plugins_url('editor.css', __FILE__) );
        
    }
    
}
add_action( 'admin_enqueue_scripts', 'ala_custom_link_dialog_styles', 999 );

function advanced_link_attributes() {
    
	wp_deregister_script( 'wplink' );
    
	wp_register_script( 'wplink', plugins_url( 'wplink.js', __FILE__), array( 'jquery', 'wpdialogs' ), false, 1 );
	
	wp_localize_script( 'wplink', 'wpLinkL10n', array(
		'title' => __('Insert/edit link'),
		'update' => __('Update'),
		'save' => __('Add Link'),
		'noTitle' => __('(no title)'),
		'noMatchesFound' => __('No matches found.')
	) );
    
}

add_action( 'admin_enqueue_scripts', 'advanced_link_attributes', 999 );


function tinymce_allow_unsafe_link_target( $mceInit ) {
    
    $mceInit['allow_unsafe_link_target'] = true;
    
    return $mceInit;
    
}

add_filter( 'tiny_mce_before_init', 'tinymce_allow_unsafe_link_target' );

?>
