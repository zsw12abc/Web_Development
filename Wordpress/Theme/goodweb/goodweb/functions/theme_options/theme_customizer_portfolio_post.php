<?php
function portfolio_post_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'portfolio_post_section',
        array(
            'title' => 'Portfolio Post Defaults',
            'description' => 'Detail Portfolio Post Settings',
            'priority' => 36,
        )
    );
        
    // Back
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-back',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-back',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Back Button (links to Portfolio or Page above)',
		        'section' => 'portfolio_post_section'
		    )
		);
	
	// Back
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-back-force',
		    array(
		        'transport' => 'postMessage',
		        'default' => false 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-back-force',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Force Back Button to page above always (for onepager pages sometimes useful)',
		        'section' => 'portfolio_post_section'
		    )
		);
	
	// Default Page Return
		$wp_customize->add_setting( 'goodweb_portfolio-parent');
		$wp_customize->add_control(
		    new tb_pages_Control(
		        $wp_customize,
		        'goodweb_portfolio-parent',
		        array(
		            'label' => 'Default Portfolio "Back" Page (when calling Portfolio Item from extern) ',
		            'section' => 'portfolio_post_section',
		            'settings' => 'goodweb_portfolio-parent'
		        )
		    )
		);

	
	// Next/Prev
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-nextprev',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-nextprev',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Next/Prev Button',
		        'section' => 'portfolio_post_section'
		    )
		);
	
	// Default Post Page Title
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-title',
		    array(
		        'default' => 'Portfolio',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-title',
		    array(
		        'label' => 'Portfolio Post Menu Title Overwrite',
		        'section' => 'portfolio_post_section',
		        'type' => 'text'
		    )
		);
		
	// Categories
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-categories',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-categories',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Categories',
		        'section' => 'portfolio_post_section'
		    )
		);
	
	// Comments
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-date',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-date',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Date',
		        'section' => 'portfolio_post_section'
		    )
		);	
	
	// Author
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-author',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-author',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Author',
		        'section' => 'portfolio_post_section'
		    )
		);
		
	/*// Author
		$wp_customize->add_setting(
		    'goodweb_portfolio-detail-show-tags',
		    array(
		        'transport' => 'postMessage',
		        'default' => true 
		    )
		);
		$wp_customize->add_control(
		    'goodweb_portfolio-detail-show-tags',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Show Tags',
		        'section' => 'portfolio_post_section'
		    )
		);*/
}
add_action( 'customize_register', 'portfolio_post_customizer' );

?>