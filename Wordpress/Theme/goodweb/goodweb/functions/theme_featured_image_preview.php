<?php

// GET FEATURED IMAGE
function ST4_get_featured_image($post_ID){
	 $post_thumbnail_id = get_post_thumbnail_id($post_ID);
	 if ($post_thumbnail_id){
	  $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
	  return $post_thumbnail_img[0];
	 }
	 else {
		 $imageoptions =  get_post_meta($post_ID,"goodweb_background_src",true) ;
		 $backgroundimage = wp_get_attachment_image_src($imageoptions,"full");
		 if(!empty($backgroundimage[0]))
		 return $backgroundimage[0];
	 }
}

// ADD NEW COLUMN
function ST4_columns_head($defaults) {
 $defaults['featured_image'] = 'Image';
 return $defaults;
}

// SHOW INFO IN THE NEW COLUMN
function ST4_columns_content($column_name, $post_ID) {
 if ($column_name == 'featured_image') {
  $post_featured_image = ST4_get_featured_image($post_ID);
  if ($post_featured_image){
   echo '<img src="' . aq_resize($post_featured_image,55,55,true) . '" />'; 
  }
 }
}

add_filter('manage_posts_columns', 'ST4_columns_head');
add_filter('manage_posts_custom_column', 'ST4_columns_content', 10, 2);

/**************************************************************************/

// ADD NEW COLUMN
function ST5_columns_head($defaults) {
 $defaults['goodweb_category'] = 'Category';
 return $defaults;
}

function ST5_columns_content($column_name, $post_ID) {
  if ($column_name == 'goodweb_category') {
  	$terms = wp_get_post_terms( $post_ID, "category_portfolio",array("fields" => "names"));
  	echo implode(",",$terms);
  }
}

add_filter('manage_portfolio_posts_columns', 'ST5_columns_head');
add_action('manage_portfolio_posts_custom_column', 'ST5_columns_content', 10, 2);
?>