<?php
/*
Template Name: Portfolio
*/

	global $wp_session;
	
	$wp_session["portfolio"] = $post_id;
	wp_session_commit();
	
	get_header();
	get_template_part( 'portfolio_template' ); 	
	get_footer(); 
 ?>