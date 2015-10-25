<?php



include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( ABSPATH . 'wp-includes/widgets.php' );

	if (is_plugin_active('revslider/revslider.php')) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		$slider_array = array();
		$counter = 0;
		$slider_array["--"] = "--";		
		if(is_array($arrSliders)){	
			foreach($arrSliders as $sliderlein){
				$slider_array[$sliderlein->getShortcode()] = $sliderlein->getTitle();
			}
		}
	}
	else { $slider_array["--"] = __("No RevSlider available","frontend-builder"); }


if(isset($GLOBALS['fbuilder'])){
	$template_uri = get_template_directory_uri();
	$fbuilder = $GLOBALS['fbuilder'];
	$remove_array = array('text','search','button','video','image','heading','slider','separator','testimonials', 'tabs', 'accordion', 'features', 'post', 'menu', 'icon_menu', 'sidebar');
	//$fbuilder->remove_shortcodes(); 
	$goodweb_shortcodes = array(  /*! TEXT */
			'text' => array(
			'type' => 'draggable',
			'text' => __('Text / HTML','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/2.png',
			'function' => 'tp_text',
			'options' => array(
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content','frontend-builder'),
					'desc' => 'You can use text, html and/or wordpress shortcodes',
					'std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
				),
				'boxed' => array(
					'type' => 'checkbox',
					'label' => __('Display boxed?','frontend-builder'),
					'std' => 'false'
				)
			)
		),
		/*! SHORTCODE */
		'tp_shortcode' => array(
			'type' => 'draggable',
			'text' => __('Shortcode','frontend-builder'),
			//'icon' => $template_uri.'/images/assets/fbuilder/12.png',
			'function' => 'tp_shortcode',
			'options' => array(
				'content' => array(
					'type' => 'input',
					'label' => 'Shortcode',
					'desc' => 'Save&Reload to see the shortcode in action'
				),
				'boxed' => array(
					'type' => 'checkbox',
					'label' => __('Display boxed?','frontend-builder'),
					'std' => 'false'
				)
			)
		),/*! HEADLINE */
		'tp_headline' => array(
			'type' => 'draggable',
			'text' => __('Headline','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/12.png',
			'function' => 'tp_headline',
			'options' => array(
				'content' => array(
					'type' => 'input',
					'label' => 'Text',
					'std' => 'Lorem ipsum'
				)
			)
		),/*! DIVIDER */
		'tp_divider' => array(
			'type' => 'draggable',
			'text' => __('Divider Line','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/8.png',
			'function' => 'tp_divider',
			'options' => array(
				'top_margin' => array(
					'type' => 'number',
					'label' => __('Top margin','frontend-builder'),
					'std' => 25,
					'unit' => 'px',
					'min' => '-50',
					'max' => '50'
				),
				'bot_margin' => array(
					'type' => 'number',
					'label' => __('Bottom margin','frontend-builder'),
					'std' => 25,
					'unit' => 'px',
					'min' => '-50',
					'max' => '50'
				)
			)
		),/*! CLEAR */
		'tp_clear' => array(
			'type' => 'draggable',
			'text' => __('Clear Floats','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/22.png',
			'function' => 'tp_clear',
		),/*! SPACER */
		'tp_spacer' => array(
			'type' => 'draggable',
			'text' => __('Spacer','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/13.png',
			'function' => 'tp_spacer',
			'options' => array(
				'height' => array(
					'type' => 'number',
					'label' => __('Height','frontend-builder'),
					'std' => 0,
					'unit' => 'px'
				),
				'visible_phone' => array(
					'type' => 'checkbox',
					'label' => __('Visible Phone','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
				'visible_tablet' => array(
					'type' => 'checkbox',
					'label' => __('Visible Tablet','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
				'visible_desktop' => array(
					'type' => 'checkbox',
					'label' => __('Visible Desktop','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
				'hidden_phone' => array(
					'type' => 'checkbox',
					'label' => __('Hidden Phone','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
				'hidden_tablet' => array(
					'type' => 'checkbox',
					'label' => __('Hidden Tablet','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
				'hidden_desktop' => array(
					'type' => 'checkbox',
					'label' => __('Hidden Desktop','frontend-builder'),
					'desc' => __('Check Responsive utility classes <a href="http://getbootstrap.com/2.3.2/scaffolding.html#responsive" target="_blank">here</a>','frontend-builder')
				),
			)
		),/*! TABS */
		'tp_tabs' => array(
			'type' => 'draggable',
			'text' => __('Tabs','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/18.png',
			'function' => 'tp_tabs',
			'options' => array(
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Tab elements','frontend-builder'),
					'desc' => __('Elements are sortable','frontend-builder'),
					'item_name' => __('tabs item','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
								'image' => '',
								'active' => 'true'
							),
							1 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
								'image' => '',
								'active' => 'false'
							),
							2 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
								'image' => '',
								'active' => 'false'
							)
						),
						'order' => array(
							0 => 0,
							1 => 1,
							2 => 2
						)
					),
					
					'options'=> array(
						'title' => array(
							'type' => 'input',
							'label' => __('Title','frontend-builder'),
							'std' => 'Lorem ipsum'
						),
						'content' => array(
							'type' => 'textarea',
							'label' => __('Content','frontend-builder'),
							'std' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.'
						)
					)
				)
			)
		), /*! ACCORDION */
		'tp_accordion' => array(
			'type' => 'draggable',
			'text' => __('Accordion','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/9.png',
			'function' => 'tp_accordion',
			'options' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style','frontend-builder'),
					'std' => 'colored',
					'options' => array(
						'colored' => __('Colored','frontend-builder'),
						'glas' => __('Transparent','frontend-builder')
					)
				),
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Accordion elements','frontend-builder'),
					'desc' => __('Elements are sortable','frontend-builder'),
					'item_name' => __('accordion item','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
								'active' => 'false'
							),
							1 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
								'active' => 'false'
							),
							2 => array(
								'title' => 'Lorem ipsum',
								'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
								'active' => 'true'
							)
						),
						'order' => array(
							0 => 0,
							1 => 1,
							2 => 2
						)
					),
					
					'options'=> array(
						'title' => array(
							'type' => 'input',
							'label' => __('Title','frontend-builder')
						),
						'content' => array(
							'type' => 'textarea',
							'label' => __('Content','frontend-builder')
						),
						'active' => array(
							'type' => 'checkbox',
							'label' => __('Active','frontend-builder'),
							'desc' => __('Only one panel can be active at a time, so be sure to uncheck the others for it to work properly','frontend-builder')
						)
					)
				)
			)
		),
		 /*! BUTTON */
		'tp_button' => array(
			'type' => 'draggable',
			'text' => __('GoodButton','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/4.png',
			'function' => 'tp_button',
			'options' => array(
				'button_text' => array(
					'type' => 'input',
					'label' => __('Button Text','frontend-builder'),
					'desc' => __('Leave Blank for no Button','frontend-builder'),
					'std' => __('Click Me','frontend-builder')
				),
				'button_url' => array(
					'type' => 'input',
					'label' => __('Button URL','frontend-builder'),
					'desc' => __('ex. http://yoursite.com/','frontend-builder'),
					'std' => ''
				),
				'button_target' => array(
					'type' => 'select',
					'label' => __('Button URL Target','frontend-builder'),
					'std' => 'clean',
					'options' => array(
						'_self' => __('Same Window/Tab','frontend-builder'),
						'_blank' => __('New Window/Tab','frontend-builder')
					)
				),
				'button_color_text' => array(
					'type' => 'color',
					'label' => __('Button Text Color','frontend-builder'),
					'std' => '#ffffff'
				),
				'button_color' => array(
					'type' => 'color',
					'label' => __('Button Color','frontend-builder'),
					'std' => '#65517c'
				),
				'decoredbutton' => array(
					'type' => 'checkbox',
					'label' => __('Arrow','frontend-builder'),
					'desc' => __('Show arrow on the right side','frontend-builder')
				),
				'centered' => array(
					'type' => 'checkbox',
					'label' => __('Centered','frontend-builder'),
					'desc' => __('Show text centered','frontend-builder')
				),
				'fullwidth' => array(
					'type' => 'checkbox',
					'label' => __('Fullwidth','frontend-builder'),
					'desc' => __('Stretch to fullwidth of the surrounding container','frontend-builder')
				),
				
			)
		),
		 /*! SERVICE */
		'tp_service' => array(
			'type' => 'draggable',
			'text' => __('Service','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/3.png',
			'function' => 'tp_service',
			'options' => array(
				'image' => array(
					'type' => 'image',
					'label' => __('Image','frontend-builder'),
					'std' => $template_uri.'/images/assets/fbuilder/services.jpg'
				),
				'title' => array(
					'type' => 'input',
					'label' => __('Title','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'content' => array(
					'type' => 'textarea',
					'label' => 'Content',
					'std' => 'Lorem ipsum'
				),
				'button_text' => array(
					'type' => 'input',
					'label' => __('Button Text','frontend-builder'),
					'desc' => __('Leave Blank for no Button','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'button_url' => array(
					'type' => 'input',
					'label' => __('Button URL','frontend-builder'),
					'desc' => __('ex. http://yoursite.com/','frontend-builder'),
					'std' => ''
				),
				'button_target' => array(
					'type' => 'select',
					'label' => __('Button URL Target','frontend-builder'),
					'std' => 'clean',
					'options' => array(
						'_self' => __('Same Window/Tab','frontend-builder'),
						'_blank' => __('New Window/Tab','frontend-builder')
					)
				),
				'button_color_text' => array(
					'type' => 'color',
					'label' => __('Button Text Color','frontend-builder'),
					'std' => '#ffffff'
				),
				'button_color' => array(
					'type' => 'color',
					'label' => __('Button color','frontend-builder'),
					'std' => '#65517c'
				)
			)
		),/*! TEAM MEMBER SOLO */
		'tp_team_member' => array(
			'type' => 'draggable',
			'text' => __('Team Member Single','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/19.png',
			'function' => 'tp_team_member',
			'options' => array(
				'image' => array(
					'type' => 'image',
					'label' => __('Image','frontend-builder'),
					'std' => $template_uri.'/images/assets/fbuilder/silhouette.jpg'
				),
				'name' => array(
					'type' => 'input',
					'label' => __('Name','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'position' => array(
					'type' => 'input',
					'label' => __('Position/Title','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'content' => array(
					'type' => 'textarea',
					'label' => 'Description',
					'std' => 'Lorem ipsum'
				),
				'mail' => array(
					'type' => 'input',
					'label' => __('Mail Address','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'phone' => array(
					'type' => 'input',
					'label' => __('Phone Number','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'facebook' => array(
					'type' => 'input',
					'label' => __('Facebook Profile URL','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'twitter' => array(
					'type' => 'input',
					'label' => __('Twitter Profile URL','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'gplus' => array(
					'type' => 'input',
					'label' => __('Google+ Profile URL','frontend-builder'),
					'std' => __('','frontend-builder')
				),
				'linkedin' => array(
					'type' => 'input',
					'label' => __('LinkedIn Profile URL','frontend-builder'),
					'std' => __('','frontend-builder')
				)
			)
		),/*! PROGRESSBAR */
		'tp_progressbar' => array(
			'type' => 'draggable',
			'text' => __('Progress Bars','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/2.png',
			'function' => 'tp_progressbar',
			'options' => array(
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Progress Bars','frontend-builder'),
					'desc' => __('Elements are sortable','frontend-builder'),
					'item_name' => __('bar','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'title' => 'Lorem ipsum',
								'percent' => '50'
							),
							1 => array(
								'title' => 'Lorem ipsum',
								'percent' => '60'
							),
							2 => array(
								'title' => 'Lorem ipsum',
								'percent' => '70'
							)
						),
						'order' => array(
							0 => 0,
							1 => 1,
							2 => 2
						)
					),
					
					'options'=> array(
						'title' => array(
							'type' => 'input',
							'label' => __('Title','frontend-builder'),
							'std' => 'Lorem ipsum'
						),
						'percent' => array(
							'type' => 'number',
							'label' => __('%','frontend-builder'),
							'std' => 50,
							'unit' => ''
						)
					)
				)
			)
		),/*! TEAMWALL */
		'tp_teamwall' => array(
			'type' => 'draggable',
			'text' => __('Team Wall','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/17.png',
			'function' => 'tp_teamwall',
			'options' => array(
				'columns' => array(
					'type' => 'select',
					'label' => __('Columns','frontend-builder'),
					'std' => 'fourcolumn',
					'options' => array(
						'fourcolumn' => __('4','frontend-builder'),
						'threecolumn' => __('3','frontend-builder')
					)
				),
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Team Wall','frontend-builder'),
					'desc' => __('Elements are sortable','frontend-builder'),
					'item_name' => __('team member','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'image' => $template_uri.'/images/assets/fbuilder/silhouette.jpg',
								'name' => 'Jim Doe',
								'position' => '',
								'mail' => '',
								'phone' => '',
								'facebook' => '',
								'twitter' => '',
								'gplus' => '',
								'linkedin' => ''
							),
							1 => array(
								'image' => $template_uri.'/images/assets/fbuilder/silhouette.jpg',
								'name' => 'James Doe',
								'position' => '',
								'mail' => '',
								'phone' => '',
								'facebook' => '',
								'twitter' => '',
								'gplus' => '',
								'linkedin' => ''
							),
							2 => array(
								'image' => $template_uri.'/images/assets/fbuilder/silhouette.jpg',
								'name' => 'Jane Doe',
								'position' => '',
								'mail' => '',
								'phone' => '',
								'facebook' => '',
								'twitter' => '',
								'gplus' => '',
								'linkedin' => ''
							),
						),
						'order' => array(
							0 => 0,
							1 => 1,
							2 => 2
						)
					),
					
					'options'=> array(
						'image' => array(
							'type' => 'image',
							'label' => __('Image','frontend-builder'),
							'image' => $template_uri.'/images/assets/fbuilder/silhouette.jpg'
						),
						'name' => array(
							'type' => 'input',
							'label' => __('Name','frontend-builder'),
							'std' => 'John Doe'
						),
						'position' => array(
							'type' => 'input',
							'label' => __('Position/Title','frontend-builder')
						),
						'mail' => array(
							'type' => 'input',
							'label' => __('Mail Address','frontend-builder')
						),
						'phone' => array(
							'type' => 'input',
							'label' => __('Phone Number','frontend-builder')
						),
						'facebook' => array(
							'type' => 'input',
							'label' => __('Facebook Profile URL','frontend-builder')
						),
						'twitter' => array(
							'type' => 'input',
							'label' => __('Twitter Profile URL','frontend-builder')
						),
						'gplus' => array(
							'type' => 'input',
							'label' => __('Google+ Profile URL','frontend-builder')
						),
						'linkedin' => array(
							'type' => 'input',
							'label' => __('LinkedIn Profile URL','frontend-builder')
						),
					)
				)
			)
		),/*! VIDEO */
		'tp_video' => array(
			'type' => 'draggable',
			'text' => __('Video','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/6.png',
			'function' => 'tp_video',
			'options' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Hosting Type','frontend-builder'),
					'std' => 'iframe',
					'options' => array(
						'iframe' => __('Iframe Hosted (Youtube/Vimeo...)','frontend-builder'),
						'mp4' => __('Self Hosted (mp4)','frontend-builder')
					)
				),
				'content' => array(
					'type' => 'textarea',
					'label' => 'Embed Video Iframe',
					'desc' => 'Sharing/Embed Video Iframe you get from Video hoster. Examples for <a href="'.get_template_directory_uri() . '/images/assets/youtube_hint.png" target="_blank">Youtube</a> and <a href="'.get_template_directory_uri() . '/images/assets/vimeo.png" target="_blank">Vimeo</a>',
					'std' => '<iframe width="853" height="480" src="//www.youtube.com/embed/6BBPaRWvT18" frameborder="0" allowfullscreen></iframe>',
					'hide_if' => array(
					  'type' => array('mp4')
					)
				),
				'link' => array(
					'type' => 'input',
					'label' => __('Link to mp4 File','frontend-builder'),
					'std' => 'http://video-js.zencoder.com/oceans-clip.mp4',
					'hide_if' => array(
					  'type' => array('iframe')
					)
				),
				'poster' => array(
					'type' => 'input',
					'label' => __('Link to placeholder image','frontend-builder'),
					'std' => 'http://video-js.zencoder.com/oceans-clip.png',
					'hide_if' => array(
					  'type' => array('iframe')
					)
				),
				'fitvid' => array(
					'type' => 'checkbox',
					'label' => __('Fit surrounding Container','frontend-builder'),
					'hide_if' => array(
					  'type' => array('mp4')
					),
					'std' => 'true'
				),
			)
		),
		/*! PRICETABLE */
		'tp_pricetable' => array(
			'type' => 'draggable',
			'text' => __('Pricetable','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/20.png',
			'function' => 'tp_pricetable',
			'options' => array(
				'width' => array(
					'type' => 'select',
					'label' => __('Columns per Row','frontend-builder'),
					'std' => 'onethird',
					'options' => array(
						'onethird' => __('3','frontend-builder'),
						'onefourth' => __('4','frontend-builder')
					)
				),
				'style' => array(
					'type' => 'select',
					'label' => __('Style','frontend-builder'),
					'std' => 'colored',
					'options' => array(
						'colored' => __('Colored','frontend-builder'),
						'glas' => __('Transparent','frontend-builder')
					)
				),
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Columns','frontend-builder'),
					'desc' => __('Columns are sortable','frontend-builder'),
					'item_name' => __('Columns','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'highlight' => '',
								'headline' => 'Headline',
								'subline' => 'Subline',
								'price' => '99',
								'currency' => '$',
								'price_subline' => '/mo',
								'button_text' => 'Buy me',
								'button_url' => '#',
								'button_target' => 'self',
								'button_text_color' => '#ffffff',
								'button_color' => '#65517c',
								'row1' => 'Content Row',
								'row2' => 'Content Row',
								'row3' => 'Content Row',
								'row4' => '',
								'row5' => '',
								'row6' => '',
								'row7' => '',
								'row8' => '',
								'row9' => '',
								'row10' => ''
							)
						),
						'order' => array(
							0 => 0
						)
					),
					'options'=> array(
						'highlight' => array(
							'type' => 'checkbox',
							'label' => __('Highlighted','frontend-builder'),
							'desc' => __('Highlight this column (only one column in a row should be highlighted)','frontend-builder')
						),
						'headline' => array(
							'type' => 'input',
							'label' => __('Headline','frontend-builder'),
							'std' => 'Headline'
						),
						'subline' => array(
							'type' => 'input',
							'label' => __('Subline','frontend-builder'),
							'std' => 'Subline'
						),
						'price' => array(
							'type' => 'input',
							'label' => __('Price','frontend-builder'),
							'std' => '45'
						),
						'currency' => array(
							'type' => 'input',
							'label' => __('Currency','frontend-builder'),
							'std' => '$'
						),
						'price_subline' => array(
							'type' => 'input',
							'label' => __('Price Subline','frontend-builder'),
							'std' => '/mo'
						),
						'button_text' => array(
							'type' => 'input',
							'label' => __('Button Text','frontend-builder'),
							'desc' => __('Leave Blank for no Button','frontend-builder'),
							'std' => __('Buy me','frontend-builder')
						),
						'button_url' => array(
							'type' => 'input',
							'label' => __('Button URL','frontend-builder'),
							'desc' => __('ex. http://yoursite.com/','frontend-builder'),
							'std' => '#'
						),
						'button_target' => array(
							'type' => 'select',
							'label' => __('Button URL Target','frontend-builder'),
							'std' => '_self',
							'options' => array(
								'_self' => __('Same Window/Tab','frontend-builder'),
								'_blank' => __('New Window/Tab','frontend-builder')
							)
						),
						'button_color_text' => array(
							'type' => 'color',
							'label' => __('Button Text Color','frontend-builder'),
							'std' => '#ffffff',
							'hide_if' => array(
							  'style' => array('glas')
							)
						),
						'button_color' => array(
							'type' => 'color',
							'label' => __('Button color','frontend-builder'),
							'std' => '#65517c',
							'hide_if' => array(
							  'style' => array('glas')
							)
						),
						'row1' => array(
							'type' => 'input',
							'label' => __('Row 1 Text','frontend-builder'),
							'std' => 'Content Row'
						),
						'row2' => array(
							'type' => 'input',
							'label' => __('Row 2 Text','frontend-builder'),
							'std' => 'Content Row'
						),
						'row3' => array(
							'type' => 'input',
							'label' => __('Row 3 Text','frontend-builder'),
							'std' => 'Content Row'
						),
						'row4' => array(
							'type' => 'input',
							'label' => __('Row 4 Text','frontend-builder'),
							'std' => ''
						),
						'row5' => array(
							'type' => 'input',
							'label' => __('Row 5 Text','frontend-builder'),
							'std' => ''
						),
						'row6' => array(
							'type' => 'input',
							'label' => __('Row 6 Text','frontend-builder'),
							'std' => ''
						),
						'row7' => array(
							'type' => 'input',
							'label' => __('Row 7 Text','frontend-builder'),
							'std' => ''
						),
						'row8' => array(
							'type' => 'input',
							'label' => __('Row 8 Text','frontend-builder'),
							'std' => ''
						),
						'row9' => array(
							'type' => 'input',
							'label' => __('Row 9 Text','frontend-builder'),
							'std' => ''
						),
						'row10' => array(
							'type' => 'input',
							'label' => __('Row 10 Text','frontend-builder'),
							'std' => ''
						)
					)
				)
			)
		),/*! IMAGE */
		'image' => array(
			'type' => 'draggable',
			'text' => __('Image','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/5.png',
			'function' => 'tp_image',
			'options' => array(
				'content' => array(
					'type' => 'image',
					'label' => __('Image','frontend-builder'),
					'std' => $template_uri.'/images/assets/fbuilder/services.jpg'
				),
				'text_align' => array(
					'type' => 'select',
					'label' => __('Alignment','frontend-builder'),
					'std' => 'left',
					'options' => array(
						'' => __('none','frontend-builder'),
						'left' => __('Left','frontend-builder'),
						'right' => __('Right','frontend-builder')
					)
				),
				'link' => array(
					'type' => 'input',
					'label' => __('Link URL','frontend-builder'),
					'std' => ''
				),
				'link_type' => array(
					'type' => 'select',
					'label' => __('Link type','frontend-builder'),
					'std' => '',
					'desc' => __('open in new tab or lightbox','frontend-builder'),
					'options' => array(
						'standard' => __('Standard','frontend-builder'),
						'new-tab' => __('Open in new tab','frontend-builder'),
						'lightbox-image' => __('Lightbox','frontend-builder')
					),
					'hide_if' => array(
						'link' => array('')
					)
				),
				'title' => array(
					'type' => 'input',
					'label' => __('Title','frontend-builder'),
					'std' => '',
					'hide_if' => array(
						'link' => array(''),
						'link_type' => array('standard','new-tab')
					)
				),
				'meta' => array(
					'type' => 'textarea',
					'label' => __('Content','frontend-builder'),
					'std' => '',
					'hide_if' => array(
						'link' => array(''),
						'link_type' => array('standard','new-tab')
					)
				),
			)
		
		),/*! MEDIAWALL */
		'tp_mediawall' => array(
			'type' => 'draggable',
			'text' => __('Media Wall','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/17.png',
			'function' => 'tp_mediawall',
			'options' => array(
				'columns' => array(
					'type' => 'select',
					'label' => __('Columns','frontend-builder'),
					'std' => 'fourcolumn',
					'options' => array(
						'fourcolumn' => __('4','frontend-builder'),
						'threecolumn' => __('3','frontend-builder')
					)
				),
				'height' => array(
					'type' => 'input',
					'label' => __('Lock Height','frontend-builder'),
					'std' => '205',
					'desc' => __('force preview images to this px height(works only for images uploaded to this WordPress)','frontend-builder')
				),
				'autoplay' => array(
					'type' => 'checkbox',
					'label' => __('Lightbox Autoplay','frontend-builder'),
					'std' => 'false'
				),
				'autoplaydelay' => array(
					'type' => 'number',
					'label' => __('Period in seconds','frontend-builder'),
					'std' => 5,
					'unit' => '',
					'hide_if' => array('autoplay' => array('false'))
				),
				'sortable' => array(
					'type' => 'sortable',
					'label' => __('Media Wall','frontend-builder'),
					'desc' => __('Elements are sortable','frontend-builder'),
					'item_name' => __('Image','frontend-builder'),
					'std' => array(
						'items' => array(
							0 => array(
								'image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'name' => 'Image 1',
								'subtitle' => '',
								'description' => '',
								'lightbox_type' => 'same',
								'lightbox_image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'content' => '<iframe width="853" height="480" src="//www.youtube.com/embed/6BBPaRWvT18" frameborder="0" allowfullscreen></iframe>',
								'nodescbox' => 'false'
							),
							1 => array(
								'image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'name' => 'Image 2',
								'subtitle' => '',
								'description' => '',
								'lightbox_type' => 'same',
								'lightbox_image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'content' => '<iframe width="853" height="480" src="//www.youtube.com/embed/6BBPaRWvT18" frameborder="0" allowfullscreen></iframe>',
								'nodescbox' => 'false'
							),
							2 => array(
								'image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'name' => 'Image 3',
								'subtitle' => '',
								'description' => '',
								'lightbox_type' => 'same',
								'lightbox_image' => $template_uri.'/images/assets/fbuilder/services.jpg',
								'content' => '<iframe width="853" height="480" src="//www.youtube.com/embed/6BBPaRWvT18" frameborder="0" allowfullscreen></iframe>',
								'nodescbox' => 'false'
							),
						),
						'order' => array(
							0 => 0,
							1 => 1,
							2 => 2
						)
					),
					'options'=> array(
						'image' => array(
							'type' => 'image',
							'label' => __('Image','frontend-builder'),
							'std' => $template_uri.'/images/assets/fbuilder/services.jpg'
						),
						'name' => array(
							'type' => 'input',
							'label' => __('Title','frontend-builder'),
							'std' => 'Image'
						),
						'subtitle' => array(
							'type' => 'input',
							'label' => __('Subtitle','frontend-builder')
						),
						'description' => array(
							'type' => 'textarea',
							'label' => 'Description',
							'desc' => 'for Lightbox details'
						),
						'nodescbox' => array(
							'type' => 'checkbox',
							'label' => __('Hide Lightbox Title/Desc Box','frontend-builder'),
							'hide_if' => array(
							  'type' => array('mp4')
							),
							'std' => 'false'
						),
						'lightbox_type' => array(
							'type' => 'select',
							'label' => __('Lightbox type','frontend-builder'),
							'std' => 'same',
							'options' => array(
								'same' => __('Same Image as Thumb','frontend-builder'),
								'lightbox-image' => __('Different Image','frontend-builder'),
								'video' => __('Embed Iframe (Youtube/Vimeo)','frontend-builder')
							)
						),
						'lightbox_image' => array(
							'type' => 'image',
							'label' => __('Image','frontend-builder'),
							'std' => $template_uri.'/images/assets/fbuilder/services.jpg',
							'hide_if' => array(
							  'lightbox_type' => array('same','video')
							)
						),
						'content' => array(
							'type' => 'textarea',
							'label' => 'Embed Video Iframe',
							'desc' => 'Sharing/Embed Video Iframe you get from Video hoster. Examples for <a href="'.get_template_directory_uri() . '/images/assets/youtube_hint.png" target="_blank">Youtube</a> and <a href="'.get_template_directory_uri() . '/images/assets/vimeo.png" target="_blank">Vimeo</a>',
							'std' => '<iframe width="853" height="480" src="//www.youtube.com/embed/6BBPaRWvT18" frameborder="0" allowfullscreen></iframe>',
							'hide_if' => array(
							  'lightbox_type' => array('same','lightbox-image')
							)
						),
					)
				)
			)
		),/*! MAP */
		'tp_mapgyver' => array(
			'type' => 'draggable',
			'text' => __('Google Map','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/23.png',
			'function' => 'tp_mapgyver',
			'options' => array(
				'address' => array(
					'type' => 'input',
					'label' => 'Address',
					'desc' => 'enter a search term',
					'std' => 'Wallstreet New York'
				),
				'zoom' => array(
					'type' => 'number',
					'label' => __('Zoom','frontend-builder'),
					'std' => 15,
					'unit' => '',
					'min' => '1',
					'max' => '20'
				),
				'height' => array(
					'type' => 'input',
					'label' => __('Min-Height','frontend-builder'),
					'desc' => __('in px','frontend-builder'),
					'std' => 400
				),
				'content' => array(
					'type' => 'textarea',
					'label' => 'Content',
					'std' => 'Lorem ipsum'
				)
			)
		),/*! WIDGET AREA */
		'tp_widget_area' => array(
			'type' => 'draggable',
			'text' => __('Widget Area','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/12.png',
			'function' => 'tp_shortcode',
			'options' => array(
				'content' => array(
					'type' => 'select',
					'label' => __('Widget Area','frontend-builder'),
					'std' => '',
					'desc' => __('Save once and reload to see widget area in action after editing, Create a new one <a href="'.admin_url( 'themes.php?page=webpaint_theme_options' ).'">here</a>','frontend-builder'),
					'options' => get_my_widgets()
			)
		  )
		),/*! REVSLIDER */
		'revslider' => array(
			'type' => 'draggable',
			'text' => __('RevSlider','frontend-builder'),
			'icon' => $template_uri.'/images/assets/fbuilder/24.png',
			'function' => 'tp_shortcode',
			'options' => array(
				'content' => array(
					'type' => 'select',
					'label' => __('Choose Slider','frontend-builder'),
					'options' => $slider_array,
					'desc' => 'Save&Reload to see the slider in action'
				),
			))
	);
	$fbuilder->add_new_shortcodes($goodweb_shortcodes);
}


?>