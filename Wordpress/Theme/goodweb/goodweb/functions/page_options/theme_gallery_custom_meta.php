<?php
// Array that holds all Page Options
// class is used to trigger some jQuery action


$custom_gallery_main_image_fields = array(
		array(
			'label'	=> 'Image',
			'text' => 'On/Off',
			'desc'	=> '',
			'id'	=> $prefix.'background_src',
			'type'	=> 'backgroundimage',
			'default' => 'checked',
			'class' => ''
		),
		array (
			'label'	=> 'Image Type',
			'desc'	=> '',
			'id'	=> $prefix.'background_image_type',
			'type'	=> 'radio',
			'default' => 'full',
			'options' => array (
				'full' => array ('label' => 'Full Screen','value'	=> 'full'),
				'repeatbg' => array ('label' => 'Tiled','value'	=> 'repeatbg')		
			),
			'class' => ''
		),
		
	/*	array (
			'label'	=> 'Image Type',
			'desc'	=> 'Using very huge images (over 1600px width or height) might cause memory problems for your server to generate. In that case please generate the image with an image manipulation tool and choose manual upload here',
			'id'	=> $prefix.'background_image_effect_type',
			'type'	=> 'radio',
			'default' => 'generated',
			'options' => array (
				'manual' => array ('label' => 'Manual Upload','value'	=> 'manual'),
				'generated' => array ('label' => 'Generated Image','value'	=> 'generated')		
			),
			'class' => ''
		) */
);

$custom_gallery_second_image_manual_fields = array(
		array(
			'label'	=> 'Upload Effect Image',
			'text' => 'On/Off',
			'desc'	=> 'Upload your modified Image here',
			'id'	=> $prefix.'background_src_effect_manual',
			'type'	=> 'image',
			'default' => 'checked',
			'class' => ''
		),
		array (
			'label'	=> 'Image Type',
			'desc'	=> '',
			'id'	=> $prefix.'background_image2_type',
			'type'	=> 'radio',
			'default' => 'full',
			'options' => array (
				'full' => array ('label' => 'Full Screen','value'	=> 'full'),
				'repeatbg' => array ('label' => 'Tiled','value'	=> 'repeatbg')		
			),
			'class' => ''
		),

);

/*
$custom_gallery_second_image_fields = array(
		array(
			'label'	=> 'Generated Image',
			'text' => 'On/Off',
			'desc'	=> '',
			'id'	=> $prefix.'background_src_effect',
			'type'	=> 'backgroundimage_effect',
			'default' => 'checked',
			'class' => ''
		),
		array(
			'label'	=> 'Brightness',
			'text' => '',
			'desc'	=> '',
			'id'	=> $prefix.'background_brightness',
			'type'	=> 'slider_background',
			'default' => '-100,100',
			'class' => ''
		),
		array(
			'label'	=> 'Blur',
			'text' => '',
			'desc'	=> '',
			'id'	=> $prefix.'background_blur',
			'type'	=> 'slider_background',
			'default' => '0,10',
			'class' => ''
		),
		array(
			'label'	=> 'Grayscale',
			'text' => 'On/Off',
			'desc'	=> '',
			'id'	=> $prefix.'background_grayscale',
			'type'	=> 'checkbox_backgroundimage_effect',
			'default' => 'checked',
			'class' => ''
		)
); */

$custom_gallery_caption_fields = array(
		array(
			'label'	=> 'Title',
			'text' => '',
			'desc'	=> '',
			'id'	=> $prefix.'background_title',
			'type'	=> 'editor',
			'default' => '',
			'class' => 'small'
		),
		array(
			'label'	=> 'Caption',
			'text' => '',
			'desc'	=> '',
			'id'	=> $prefix.'background_caption',
			'type'	=> 'editor',
			'default' => '',
			'class' => ''
		)
);
?>