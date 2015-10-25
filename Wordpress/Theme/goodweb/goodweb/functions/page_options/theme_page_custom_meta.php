<?php
// Array that holds all Page Options
// class is used to trigger some jQuery action

$custom_page_meta_fields = array(
		array(
			'label'	=> 'Not Boxed',
			'text' => '',
			'desc'	=> 'Hide the transparent Content Background',
			'id'	=> $prefix.'show_box',
			'type'	=> 'checkbox',
			'default' => ''	,
			'class' => 'tp_options default'
		),
		array(
			'label'	=> 'Hide Page Title Line?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the Page Title?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'tp_options default index blog portfolio'
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => '',
			'type'	=> 'sidebar_list',
			'class' => 'tp_options default'
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
		array (
			'label'	=> 'Background Slider Autoplay',
			'id'	=> $prefix.'background_slider_autoslider',
			'type'	=> 'select',
			'default' => '0',
			'options' => array (
				'none' => array ('label' => 'None','value' => '0s'),
				'1' => array ('label' => '1s','value'	=> '1s'),
				'2' => array ('label' => '2s','value'	=> '2s'),
				'3' => array ('label' => '3s','value'	=> '3s'),
				'4' => array ('label' => '4s','value'	=> '4s'),
				'5' => array ('label' => '5s','value'	=> '5s'),
				'6' => array ('label' => '6s','value'	=> '6s'),
				'7' => array ('label' => '7s','value'	=> '7s'),
				'8' => array ('label' => '8s','value'	=> '8s'),
				'9' => array ('label' => '9s','value'	=> '9s'),
				'10' => array ('label' => '10s','value'	=> '10s')			
			),
			'desc' => 'Seconds each slide is displayed',
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
		)/*,
		array(
			'label'	=> 'Front Builder Code',
			'text' => '',
			'desc'	=> 'The amount of words to display from the excerpt',
			'id'	=> $prefix.'fbuilder_code',
			'type'	=> 'textarea',
			'default' => '{}',
			'class' => ''
		),*/

);

$custom_page_blog_meta_fields = array(
		array(
			'label'	=> 'Initial Post per Page',
			'text' => '',
			'desc'	=> 'The amount of blog posts visible after page loading',
			'id'	=> $prefix.'posts_first',
			'type'	=> 'text',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Additional Post per Page',
			'text' => '',
			'desc'	=> 'How many posts are shown after clicking on "Read More"',
			'id'	=> $prefix.'posts_per_page',
			'type'	=> 'text',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Show Exerpts in Overview?',
			'text' => 'Show Exerpts',
			'desc'	=> '',
			'id'	=> $prefix.'overview_activate_excerpts',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'tp_options index blog'
		),
		array(
			'label'	=> 'Excerpt Length (in words)',
			'text' => '',
			'desc'	=> 'The amount of words to display from the excerpt',
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
		array (
			'label'	=> 'Media Postion Overview',
			'desc'	=> 'Where to place the featured image or the video?',
			'id'	=> $prefix.'overview_media_position',
			'type'	=> 'posttype',
			'default' => 'top',
			'options' => array (
				'top' => array ('label' => 'top','value'	=> 'top'),
				'left' => array ('label' => 'left','value'	=> 'left'),
				'right' => array ('label' => 'right','value'	=> 'right'),
				'bottom' => array ('label' => 'bottom','value'	=> 'bottom')			
			),
			'class' => ''
		),
);

$custom_page_portfolio_meta_fields = array(
		array(
			'label'	=> 'Categories',
			'desc'	=> 'Choose all Categories you like to see in this overview (use shift,strg,cmd key for multiple selection)',
			'id'	=> $prefix.'portfolio_categories',
			'type'	=> 'portfolio_category_list',
			'class' => ''
		),
		array(
			'label'	=> 'Projects per Page',
			'text' => '',
			'desc'	=> 'How many Projects to display on one page?',
			'id'	=> $prefix.'project_per_page',
			'type'	=> 'text',
			'defaultsfd' => '8',
			'class' => ''
		),
		array (
			'label'	=> 'Projects per Row',
			'desc'	=> 'Display how many items in one row?<br>(4 items w/ Sidebar will default to 3)',
			'id'	=> $prefix.'portfolio_columns',
			'type'	=> 'radio',
			'default' => '4',
			'options' => array (
				'sixcolumn' => array ('label' => '&nbsp;&nbsp;6','value'	=> 'sixcolumn'),
				'fivecolumn' => array ('label' => '&nbsp;&nbsp;5','value'	=> 'fivecolumn'),
				'fourcolumn' => array ('label' => '&nbsp;&nbsp;4','value'	=> 'fourcolumn'),
				'threecolumn' => array ('label' => '&nbsp;&nbsp;3','value'	=> 'threecolumn'),
				'twocolumn' => array ('label' => '&nbsp;&nbsp;2','value'	=> 'twocolumn'),
			),
			'class' => ''
		),
		array(
			'label'	=> 'Image Lock Height',
			'text' => '',
			'desc'	=> 'Lock the Images in certain height in px<br>(dependend on image width of 570px)',
			'id'	=> $prefix.'page_portfolio_img_height',
			'type'	=> 'text',
			'default' => '320',
			'class' => ''
		),
		array(
			'label'	=> 'Default Single Portfolio Page Title',
			'text' => '',
			'desc'	=> 'Lock the Images in certain height in px<br>(dependend on image width of 570px)',
			'id'	=> $prefix.'page_portfolio_title',
			'type'	=> 'text',
			'default' => '320',
			'class' => ''
		),
		array(
			'label'	=> 'Activate Lightbox',
			'text' => 'Lightbox On',
			'desc'	=> 'Show the icon to open the featured image in the Fancybox',
			'id'	=> $prefix.'portfolio_lightbox_active',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Lightbox Autoplay',
			'text' => 'Autoplay On',
			'desc'	=> 'Enable Lightbox Autoplay',
			'id'	=> $prefix.'portfolio_lightbox_autoplay_active',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => 'lightbox'
		),
		array(
			'label'	=> 'Period Lightbox (in seconds)',
			'text' => '',
			'desc'	=> 'How many seconds till the next item is shown?',
			'id'	=> $prefix.'portfolio_lightbox_autoplay_delay',
			'type'	=> 'text',
			'default' => '5',
			'class' => 'lightbox autoplay'
		),
		array (
			'label'	=> 'Display Page Content',
			'desc'	=> 'Where is the content located?',
			'id'	=> $prefix.'portfolio_content_display',
			'type'	=> 'radio',
			'default' => 'above',
			'options' => array (
				'above' => array ('label' => 'Above Portfolio','value'	=> 'above'),
				'below' => array ('label' => 'Below Portfolio','value'	=> 'below')
			),
			'class' => ''
		)
);
?>