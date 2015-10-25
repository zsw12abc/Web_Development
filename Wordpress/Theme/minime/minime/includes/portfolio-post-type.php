<?php




function portfolio_register() {  

	global $smof_data;
	
	$labels = array(
		'name' => __( 'Portfolio', 'arnem' ),
		'singular_name' => __( 'Portfolio Item', 'arnem' ),
		'add_new' => __( 'Add New Item', 'arnem' ),
		'add_new_item' => __( 'Add New Portfolio Item', 'arnem' ),
		'edit_item' => __( 'Edit Portfolio Item', 'arnem' ),
		'new_item' => __( 'Add New Portfolio Item', 'arnem' ),
		'view_item' => __( 'View Item', 'arnem' ),
		'search_items' => __( 'Search Portfolio', 'arnem' ),
		'not_found' => __( 'No portfolio items found', 'arnem' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'arnem' )
	);
	
    $args = array(  
        'labels' => $labels, 
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => array('slug' => 'portfolio-item'), 
        'supports' => array('title', 'editor', 'thumbnail', 'comments' , 'post-formats')  
       );  
  
    register_post_type( 'portfolio' , $args );  
}  

	register_taxonomy(  
	'portfolio_filter', 'portfolio',  
	array(  
	    'hierarchical' => true,  
	    'labels' => array(
	    	'name' => __( 'Portfolio Categories', 'arnem' ),
	    	'singular_name' => __( 'Portfolio Category', 'arnem' ),
	    	'search_items' => __( 'Search Portfolio Categories', 'arnem' ),
	    	'popular_items' => __( 'Popular Portfolio Categories', 'arnem' ),
	    	'all_items' => __( 'All Portfolio Categories', 'arnem' ),
	    	'edit_item' => __( 'Edit Portfolio Category', 'arnem' ),
	    	'update_item' => __( 'Update Portfolio Category', 'arnem' ),
	    	'add_new_item' => __( 'Add New Portfolio Category', 'arnem' ),
	    	'new_item_name' => __( 'New Portfolio Category Name', 'arnem' ),
	    	'separate_items_with_commas' => __( 'Separate Portfolio Categories With Commas', 'arnem' ),
	    	'add_or_remove_items' => __( 'Add or Remove Portfolio Categories', 'arnem' ),
	    	'choose_from_most_used' => __( 'Choose From Most Used Portfolio Categories', 'arnem' ),  
	    	'parent' => __( 'Parent Portfolio Category', 'arnem' )      	
	    	),
	    'query_var' => true,  
	    'rewrite' => true  
		)  
	);

/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function portfolio_edit_columns( $portfolio_columns ) {
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Title' ,'arnem'),
		"thumbnail" => __('Thumbnail', 'arnem'),
		"author" => __('Author', 'arnem'),
		"date" => __('Date', 'arnem'),
	);
	return $portfolio_columns;
}





function portfolio_column_display( $portfolio_columns, $post_id ) {

	// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
	
	switch ( $portfolio_columns ) {
		
		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 75;
			$height = (int) 75;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'class' => array(),
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
	'div' => array(),
	'figcaption' => array(),
	'p' => array(
		'class' => array(),
     ),
    'li' => array(),
    'img' => array(
		'href' => array(),
		'title' => array(),
		'class' => array(),
        'height' => array(),
        'width' => array(),
        'src' => array(),
    ),
); 
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo wp_kses($thumb, $allowed_html);
			} else {
				echo __('None', 'minime');
			}
			break;	
			
		// Display the portfolio tags in the column view
		case "portfolio_filter":
		
		if ( $category_list = get_the_term_list( $post_id, 'portfolio_filter', '', ', ', '' ) ) {
			echo wp_kses($category_list, $allowed_html);
		} else {
			echo __('None', 'minime');
		}
		break;			
	}
}

// Adds Custom Post Type
add_action('init', 'portfolio_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-portfolio_columns', 'portfolio_edit_columns' );
add_action( 'manage_posts_custom_column', 'portfolio_column_display', 10, 2 );

?>