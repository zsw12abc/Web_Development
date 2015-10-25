<?php
	// Theme Options		
		$theme_sections = array(
			array(
				'label' => 'Sidebars',
				'desc' => '',
				'sections' => array(
					'sidebars' => 'Sidebars'
				),
				'fields' => array(
								//Sidebars
									array(
										'id' => 'sidebar_builder',
										'label' => 'Sidebars',
										'description' => 'Which one?',
										'type' => 'sidebar_build',
										'section' => 'sidebars'
									)
				), 				
				'slug' => 'sidebars'
			)		
		);
?>