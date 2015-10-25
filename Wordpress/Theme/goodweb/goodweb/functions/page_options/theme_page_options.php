<?php
/* ------------------------------------- */
/* PAGE/POST/PORTFOLIO OPTIONS */
/* ------------------------------------- */

// Prefix for Page/Post/Portfolio Options
$prefix="goodweb_";

// Load the Page Option Meta Fields
$custom_meta_fields=array();
require_once(T_FUNCTIONS . '/page_options/theme_page_custom_meta.php');
require_once(T_FUNCTIONS . '/page_options/theme_post_custom_meta.php');
require_once(T_FUNCTIONS . '/page_options/theme_portfolio_custom_meta.php');
require_once(T_FUNCTIONS . '/page_options/theme_gallery_custom_meta.php');

// Generate Page/Post/Portfolio Options
add_action('admin_init', 'init_page_options');
function init_page_options() {
	add_meta_box("page-options", "Page Options", "show_custom_page_meta_box", "page", "normal", "high");
	add_meta_box("page-portfolio-options", "Portfolio Options", "show_custom_page_portfolio_meta_box", "page", "side", "high");
	//add_meta_box("page-blog-options", "Blog Options", "show_custom_page_blog_meta_box", "page", "side", "high");
	
	add_meta_box("portfolio-post-options", "Portfolio Item Options", "show_custom_portfolio_meta_box", "portfolio", "normal", "high");
	add_meta_box("post-options", "Post Options", "show_custom_post_meta_box", "post", "normal", "high");

	add_meta_box("gallery-main-image-options", "Main Image", "show_custom_post_gallery_main_image_fields", "gallery", "normal", "high");
	//add_meta_box("gallery-second-image-options", "Effect Image", "show_custom_post_gallery_second_image_fields", "gallery", "normal", "high");
	add_meta_box("gallery-second-image-manual-options", "Effect Image", "show_custom_post_gallery_second_image_manual_fields", "gallery", "normal", "high");
	add_meta_box("gallery-caption-options", "Caption", "show_custom_post_gallery_caption_fields", "gallery", "normal", "high");

	add_meta_box("post-type-options", "Post Format Options", "show_custom_post_type_meta_box", "post", "side", "high");
	add_meta_box("post-overview-options", "Blog Overview Options", "show_custom_post_overview_meta_box", "post", "normal", "high");
	
	add_meta_box("portfolio-post-options", "Portfolio Item Options", "show_custom_portfolio_meta_box", "portfolio", "normal", "high");	
	add_meta_box("portfolio-post-type-options", "Portfolio Type Options", "show_custom_post_portfolio_type_meta_fields", "portfolio", "side", "high"); 		
}

// Include the Page Option Framework Functions
require_once(T_FUNCTIONS . '/page_options/theme_page_options_functions.php');
?>