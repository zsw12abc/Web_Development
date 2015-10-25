<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action


$custom_post_meta_fields = array(
		array(
			'label'	=> 'Hide Page Title Line?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the Page Title?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Page Title Text',
			'desc'	=> 'Alternative Head Title over the content, leave blank for Post Title or Default (via Customizer)',
			'id'	=> $prefix.'page_title',
			'type'	=> 'text',
			'class' => ''
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list'
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
			'desc' => 'The Default is set in the Theme <a href="'.admin_url( 'customize.php' ).'">Customizer</a>',
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
		array(
			'label'	=> 'Hide Categories?',
			'text' => 'Hide Categories in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'detail_activate_categories',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Author?',
			'text' => 'Hide Author in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'detail_activate_author',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Date?',
			'text' => 'Hide Date in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'detail_activate_date',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Tags?',
			'text' => 'Hide Tags in Detail View',
			'desc'	=> '',
			'id'	=> $prefix.'detail_activate_tags',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
);

$custom_post_type_meta_fields = array(
		array (
			'label'	=> 'Post Format',
			'desc'	=> '',
			'id'	=> $prefix.'post_type',
			'type'	=> 'posttype',
			'default' => 'default',
			'options' => array (
				'default' => array ('label' => 'Standard','value'	=> 'default'),
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
			'label'	=> 'Force Featured Image in Overview?',
			'text' => 'Do not show the video in the blog overview but the featured image selected below',
			'desc'	=> '',
			'id'	=> $prefix.'force_featured_image',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'post_type video'
		),
		array(
			'label'	=> 'Excerpt Length (in words)',
			'text' => '',
			'desc'	=> 'The amount of words to display from the excerpt (0 - no excerpt)',
			'id'	=> $prefix.'overview_excerpts_number',
			'type'	=> 'text',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Show Comments in Overview?',
			'text' => 'Show Comments',
			'desc'	=> '',
			'id'	=> $prefix.'overview_activate_comments',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Show Categories in Overview?',
			'text' => 'Show Categories',
			'desc'	=> '',
			'id'	=> $prefix.'overview_activate_categories',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider to this Post',
			'id'	=>  $prefix.'slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'post_type slider'
		),
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
			'desc'	=> 'Using Post-Format "Image" will take the <strong>featured image</strong> and display it at <strong>top of the post</strong>.',
			'type'	=> 'desc',
			'class' => 'post_type image'
		)
);
$custom_post_overview_meta_fields = array(
		array(
			'label'	=> 'Excerpt Length (in words)',
			'text' => '',
			'desc'	=> 'The amount of words to display from the excerpt (0 = no excerpt,blank = take default)',
			'id'	=> $prefix.'overview_excerpts_number',
			'type'	=> 'text',
			'default' => '',
			'class' => ''
		),
		array (
			'label'	=> 'Media Postion Overview',
			'desc'	=> 'Where to place the featured image or the video?',
			'id'	=> $prefix.'overview_media_position',
			'type'	=> 'posttype',
			'default' => '',
			'options' => array (
				'top' => array ('label' => 'top','value'	=> 'top'),
				'left' => array ('label' => 'left','value'	=> 'left'),
				'right' => array ('label' => 'right','value'	=> 'right'),
				'bottom' => array ('label' => 'bottom','value'	=> 'bottom')			
			),
			'class' => ''
		)
);
?>