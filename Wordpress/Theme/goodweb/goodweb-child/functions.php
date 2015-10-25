<?php
add_action( 'wp_enqueue_scripts', 'goodweb_child_enqueue_styles' );
function goodweb_child_enqueue_styles() {
	wp_enqueue_style( 'goodweb_bootstrap_css',get_template_directory_uri().'/css/bootstrap.css');
    wp_enqueue_style( 'parent-style',get_template_directory_uri().'/style.css',null);
}
?>