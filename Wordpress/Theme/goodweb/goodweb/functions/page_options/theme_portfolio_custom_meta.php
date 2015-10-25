<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');


$custom_portfolio_meta_fields = array(
		array(
			'label'	=> 'Page Title Text',
			'desc'	=> 'Alternative Head Title over the content, leave blank for Post Title or Default (via Customizer)',
			'id'	=> $prefix.'page_title',
			'type'	=> 'text',
		),
		array (
			'label'	=> 'Page Background',
			'id'	=> $prefix.'page_background_type',
			'type'	=> 'select',
			'default' => 'top',
			'options' => array (
				'default' => array ('label' => 'Default','value' => 'default'),
				'slider' => array ('label' => 'Slider','value'	=> 'slider'),
				'image' => array ('label' => 'Image','value'	=> 'image'),
				'color' => array ('label' => 'Color','value'	=> 'color')			
			),
			'desc' => 'The Default is set in the Theme <a href="'.admin_url( 'customize.php').'">Customizer</a>',
			'class' => ''
		),
		array(
			'label'	=> 'Background Slider',
			'desc'	=> '',
			'id'	=> $prefix.'background_slider',
			'type'	=> 'gallery_category_list',
			'class' => 'background_type slider'
		),
		array(
			'label'	=> 'Background Color',
			'text' => '',
			'id'	=> $prefix.'background_color',
			'type'	=> 'colorpicka',
			'default' => '',
			'desc'=> '',
			'class' => 'background_type color'
		),
		array(
			'label'	=> 'Background Image',
			'desc'	=> '',
			'id'	=> $prefix.'background_image',
			'type'	=> 'image',
			'class' => 'background_type image'
		),
		array (
			'label'	=> 'Background Image Type',
			'id'	=> $prefix.'page_background_image_type',
			'type'	=> 'select',
			'default' => 'full',
			'options' => array (
				'full' => array ('label' => 'Full','value' => 'full'),
				'repeatbg' => array ('label' => 'Tiled','value'	=> 'repeatbg')		
			),
			'desc' => 'Set wether the image should be stretched over the display or should be displayed tiled',
			'class' => 'background_type image'
		),
		array (
			'label'	=> 'Media Postion Overview',
			'desc'	=> 'Where to place the featured image,gallery or video (if given)?',
			'id'	=> $prefix.'overview_media_position',
			'type'	=> 'posttype',
			'default' => 'top',
			'options' => array (
				'top' => array ('label' => 'top','value'	=> 'top'),
				'left' => array ('label' => 'left','value'	=> 'left')			
			),
			'class' => ''
		),
		array(
			'label'	=> 'Hide Categories?',
			'text' => 'Hide Categories in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'portfolio_detail_activate_categories',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Author?',
			'text' => 'Hide Author in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'portfolio_detail_activate_author',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Date?',
			'text' => 'Hide Date in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'portfolio_detail_activate_date',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		)
);

$custom_post_portfolio_type_meta_fields = array(
		array (
			'label'	=> 'Project Type',
			'desc'	=> '',
			'id'	=> $prefix.'post_type',
			'type'	=> 'posttype',
			'default' => 'image',
			'options' => array (
				'image' => array ('label' => 'Image','value'	=> 'image'),
				'video' => array ('label' => 'Video','value'	=> 'video'),
				'slider' => array ('label' => 'Slider','value'	=> 'slider')
			),
			'class' => ''
		),
		array(
			'label'	=> 'Embed Iframe',
			'desc'	=> 'Sharing/Embed Video Iframe you get from Video hoster. Examples for <a href="'.get_template_directory_uri() . '/images/assets/youtube_hint.png" target="_blank">Youtube</a> and <a href="'.get_template_directory_uri() . '/images/assets/vimeo.png" target="_blank">Vimeo</a>',
			'id'	=> $prefix.'video_iframe',
			'type'	=> 'textarea',
			'class' => 'post_type video'
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Fill this fields for the video to play in the <strong>lightbox</strong>.',
			'type'	=> 'desc',
			'class' => 'post_type video'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider to this Post',
			'id'	=>  $prefix.'slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'post_type slider'),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Please use the "<strong>featured image</strong>" option of WP below to display thumb preview pics.',
			'type'	=> 'desc',
			'class' => ''
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'The <strong>first</strong> standard WordPress <strong>gallery</strong> ("Add Media,Create Gallery") that is found inside the post will be used as slider gallery for the blog overview',
			'type'	=> 'desc',
			'class' => 'post_type gallery'
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Using Post-Format "Image" will take the <strong>featured image</strong> and display it at <strong>top of the post</strong>.',
			'type'	=> 'desc',
			'class' => 'post_type image'
		)
);
?>