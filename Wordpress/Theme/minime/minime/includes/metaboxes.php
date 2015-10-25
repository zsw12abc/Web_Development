<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'klb_';

global $meta_boxes;

$meta_boxes = array();

global $smof_data;



/* ----------------------------------------------------- */
// portfolio Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'portfoliosettings',
	'title' => 'Page Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(


		array(
			'name'		=> 'Open as a Separate Page',
			'id'		=> $prefix . 'separate_page',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
	
		array(
			'name' => 'Disable Page Title',
			'id'   => $prefix . "disable_title",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Alternate Page Title',
			'id'		=> $prefix . "alt_title",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Page Subtitle',
			'id'		=> $prefix . "subtitle",
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Disable section from menu',
			'id'		=> $prefix . 'disable_section_from_menu',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),			
			
		array(
			'name'		=> 'Assign current page as',
			'id'		=> $prefix . "assign_type",
			'type'		=> 'select',
			'options'	=> array(
			    'select'		=> 'Select a Section',
				'home-section'		 => 'Home Section',
                'parallax-section-one'	 => 'Parallax Section One',
				'portfolio-section'	 => 'Portfolio Section',
                'parallax-section-two'	 => 'Parallax Section Two',
                'experience-section'      => 'Experience Section',
				'blog-section'	     => 'Blog Section',
				'contact-section'	 => 'Contact Section', 
				'map-section'	 => 'Map Section',          			
			),
			'multiple'	=> false,
			'std'		=> 'Select Custom Section'
		),	

				
	)
);





/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> $prefix .'project_gallery',
	'title'		=> 'Project Image Slides',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Project Slider Images',
			'desc'	=> 'Upload up to 20 project images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
			'id'	=> $prefix . 'project_item_slides',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 20,
		)
		
	)
);



/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> $prefix .'project_video',
	'title'		=> 'Project Video',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Video Type',
			'id'		=> $prefix . 'project_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Video URL or own Embedd Code<br />(Audio Embedd Code is possible, too)',
			'id'	=> $prefix . 'project_video_embed',
			'desc'	=> 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);



/*  Blog Audio Post Settings */

$meta_boxes[] = array(
	'id' => $prefix .'project_audio',
	'title' => 'Audio Settings',
	'pages' => array( 'portfolio'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> 'Audio Embed Code',
			'id'		=> $prefix . 'projectaudiourl',
			'desc'		=> 'Enter your Audio URL(Oembed) or Embed Code.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function volter_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'volter_register_meta_boxes' );