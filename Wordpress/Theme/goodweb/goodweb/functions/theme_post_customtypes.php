<?php
	/* ------------------------------------- */
	/* PORTFOLIO POST TYPE */
	/* ------------------------------------- */
	
	//Register Portfolio PostType and Category Taxonomy
		add_action('init', 'create_portfolios');
		register_taxonomy("category_portfolio", array("portfolio"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	
		function create_portfolios() {
			$portfolio_args = array(
				'label' => "Portfolio",
				'singular_label' => 'Portfolio',
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => 'portfolio', 'with_front' => true),
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author',/*'tags',*/'comments'),
				//'taxonomies' => array('post_tag')
			);
			register_post_type('portfolio',$portfolio_args);
		}
		
	/* ------------------------------------- */
	/* background POST TYPE */
	/* ------------------------------------- */
	
	$gallery_labels = array(
	    'name' => _x('Background Slider Items', 'post type general name','goodweb'),
	    'singular_name' => _x('Items', 'post type singular name','goodweb'),
	    'add_new' => _x('Add New', 'gallery','goodweb'),
	    'add_new_item' => __("Add New Item","goodweb"),
	    'edit_item' => __("Edit Item","goodweb"),
	    'new_item' => __("New Item","goodweb"),
	    'view_item' => __("View Item","goodweb"),
	    'search_items' => __("Search Item","goodweb"),
	    'not_found' =>  __('No items found',"goodweb"),
	    'not_found_in_trash' => __('No items found in Trash',"goodweb"), 
	    'parent_item_colon' => ''     
	);
	
	$gallery_args = array(
	    'labels' => $gallery_labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true, 
	    'query_var' => true,
	    'rewrite' => true,
	    'hierarchical' => false,
	    'menu_position' => null,
	    'capability_type' => 'post',
	    'supports' => array('title'),
	    'menu_icon' => get_template_directory_uri() . '/images/assets/gallery.png' //16x16 png if you want an icon
	); 
	register_post_type('gallery', $gallery_args);
	
	$labels = array(
		'name'              => _x( 'Sliders', 'taxonomy general name','goodweb' ),
		'singular_name'     => _x( 'Slider', 'taxonomy singular name','goodweb' ),
		'search_items'      => __( 'Search Sliders',"goodweb" ),
		'all_items'         => __( 'All Sliders',"goodweb" ),
		'parent_item'       => __( 'Parent Slider',"goodweb" ),
		'parent_item_colon' => __( 'Parent Slider:' ,"goodweb"),
		'edit_item'         => __( 'Edit Slider',"goodweb" ),
		'update_item'       => __( 'Update Slider',"goodweb" ),
		'add_new_item'      => __( 'Add New Slider',"goodweb" ),
		'new_item_name'     => __( 'New Slider Name' ,"goodweb"),
		'menu_name'         => __( 'Sliders',"goodweb" ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sliders' ),
	);

	register_taxonomy( 'sliders', array( 'gallery' ), $args );
	
?>