<?php
function blog_default_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'blog_default_section',
        array(
            'title' => 'Blog Overview Defaults',
            'description' => 'Overall Blog Settings',
            'priority' => 36,
        )
    );
     
    // Posts Initial
		$wp_customize->add_setting(
		    'goodweb_blog-overview-init-posts',
		    array(
		        'default' => '4',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-overview-init-posts',
		    array(
		        'label' => 'Initial Loading Posts Amount',
		        'section' => 'blog_default_section',
		        'type' => 'text',
		    )
		); 
	
	// Posts Add
		$wp_customize->add_setting(
		    'goodweb_blog-overview-add-posts',
		    array(
		        'default' => '2',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-overview-add-posts',
		    array(
		        'label' => 'Add Posts Amount (Load More)',
		        'section' => 'blog_default_section',
		        'type' => 'text',
		    )
		); 
        
		
	// Categories
		$wp_customize->add_setting(
		    'goodweb_blog-overview-show-categories',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-overview-show-categories',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Categories',
		        'section' => 'blog_default_section'
		    )
		);
	
	// Comments
		$wp_customize->add_setting(
		    'goodweb_blog-overview-show-comments',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-overview-show-comments',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Comments',
		        'section' => 'blog_default_section'
		    )
		);
	 
	 // Excerpt
		$wp_customize->add_setting(
		    'goodweb_blog-overview-excerpt-length',
		    array(
		        'default' => '15',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-overview-excerpt-length',
		    array(
		        'label' => 'Excerpt Length (0 - no excerpt)',
		        'section' => 'blog_default_section',
		        'type' => 'text',
		    )
		); 
	
	// Layout
    	$wp_customize->add_setting(
		    'goodweb_blog-overview-default-media-layout',
		    array(
		        'default' => 'top',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_blog-overview-default-media-layout',
		    array(
		        'type' => 'radio',
		        'label' => 'Default Overview Media Post Layout',
		        'section' => 'blog_default_section',
		        'choices' => array(
		            'top' => 'top',
		            'left' => 'left',
		            'right' => 'right',
		            'bottom' => 'bottom'
		        ),
		    )
		);
		
	// Info
		$wp_customize->add_setting( 'html' );
		$wp_customize->add_control(
		    new tb_html_Control(
		        $wp_customize,
		        'overwrite_info',
		        array(
		            'label' => 'You can overwrite all this defaults <br>in the single <a href="'.get_admin_url().'edit.php">Post\'s Options</a>',
		            'section' => 'blog_default_section',
		            'settings' => 'html'
		        )
		    )
		);	
		
}
add_action( 'customize_register', 'blog_default_customizer' );

?>