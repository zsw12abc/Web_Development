<?php
function related_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'related_section',
        array(
            'title' => 'Related Posts/Projects',
            'description' => 'Display Related Posts or Projects',
            'priority' => 38,
        )
    );
    
    // Posts
		$wp_customize->add_setting(
		    'goodweb_related-posts',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_related-posts',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Add Related Posts in Blog Detail View',
		        'section' => 'related_section',
		        'priority' => 2
		    )
		);
	
	// Tags or Category
    	$wp_customize->add_setting(
		    'goodweb_related-posts-type',
		    array(
		        'default' => 'yes',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_related-posts-type',
		    array(
		        'type' => 'radio',
		        'label' => 'Related Indicator for Posts',
		        'section' => 'related_section',
		         'priority' => 3,
		        'choices' => array(
		            'tags' => 'Tags',
		            'category' => 'Category'
		        ),
		    )
		);
			
	// Headline
		$wp_customize->add_setting( 'html' );
		$wp_customize->add_control(
		    new tb_html_Control(
		        $wp_customize,
		        'testimonial',
		        array(
		            'label' => '<hr>',
		            'section' => 'related_section',
		            'settings' => 'html',
		            'priority' => 5,
		        )
		    )
		);
	
	// Portfolios
		$wp_customize->add_setting(
		    'goodweb_related-portfolio',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_related-portfolio',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Add Related Projects in Detail View',
		        'section' => 'related_section',
		        'priority' => 6
		    )
		);

	// Projects Related Lightbox
	/*	$wp_customize->add_setting(
		    'goodweb_related-portfolio-lightbox',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_related-portfolio-lightbox',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Lightbox Icon for Related Projects',
		        'section' => 'related_section',
		        'priority' => 7
		    )
		);
	*/
}
add_action( 'customize_register', 'related_customizer' );
?>