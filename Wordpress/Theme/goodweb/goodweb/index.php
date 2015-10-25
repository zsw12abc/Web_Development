<?php
/*
Template Name: Blog
*/
	get_header();
	if(is_tax()){
		get_template_part( 'portfolio_archive_template' ); 			//Portfolio Category , Tags
	}
	else{
		get_template_part( 'blog_template' ); 						//Standard Blog Posts
	}
	get_footer(); 
?>