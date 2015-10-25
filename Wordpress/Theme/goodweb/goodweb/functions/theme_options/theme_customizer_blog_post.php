<?php
function blog_post_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'blog_post_section',
        array(
            'title' => 'Blog Post Defaults',
            'description' => 'Detail Blog Post Settings',
            'priority' => 36,
        )
    );
        
    // Default Post Sidebar
		$wp_customize->add_setting( 'goodweb_blog-post-sidebar');
		$wp_customize->add_control(
		    new tb_sidebars_Control(
		        $wp_customize,
		        'goodweb_blog-post-sidebar',
		        array(
		            'label' => 'Blog Post Default Sidebar',
		            'section' => 'blog_post_section',
		            'settings' => 'goodweb_blog-post-sidebar',
		            'default' => 'nosidebar' 
		        )
		    )
		);	
	
	// Default Post Page Title
		$wp_customize->add_setting(
		    'goodweb_blog-detail-title',
		    array(
		        'default' => 'Blog',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-detail-title',
		    array(
		        'label' => 'Blog Post Menu Title Overwrite',
		        'section' => 'blog_post_section',
		        'type' => 'text'
		    )
		);
		
	// Categories
		$wp_customize->add_setting(
		    'goodweb_blog-detail-show-categories',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-detail-show-categories',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Categories',
		        'section' => 'blog_post_section'
		    )
		);
	
	// Comments
		$wp_customize->add_setting(
		    'goodweb_blog-detail-show-date',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-detail-show-date',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Date',
		        'section' => 'blog_post_section'
		    )
		);	
	
	// Author
		$wp_customize->add_setting(
		    'goodweb_blog-detail-show-author',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-detail-show-author',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Author',
		        'section' => 'blog_post_section'
		    )
		);
		
	// Author
		$wp_customize->add_setting(
		    'goodweb_blog-detail-show-tags',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blog-detail-show-tags',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Tags',
		        'section' => 'blog_post_section'
		    )
		);
}
add_action( 'customize_register', 'blog_post_customizer' );

?>