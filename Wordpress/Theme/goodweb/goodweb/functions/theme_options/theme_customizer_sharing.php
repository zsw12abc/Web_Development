<?php
function sharing_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'sharing_section',
        array(
            'title' => 'Social Sharing',
            'description' => 'goodweb Internal Sharing Options',
            'priority' => 38,
        )
    );
    
    // Posts
		$wp_customize->add_setting(
		    'goodweb_sharing-posts',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_sharing-posts',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Add Sharing Line in Posts',
		        'section' => 'sharing_section',
		        'priority' => 1
		    )
		);
	
	// Portfolios
		$wp_customize->add_setting(
		    'goodweb_sharing-portfolio',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_sharing-portfolio',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Add Sharing Line in Portfolio',
		        'section' => 'sharing_section',
		        'priority' => 1
		    )
		);

	// Pages
	/*	$wp_customize->add_setting(
		    'goodweb_sharing-pages',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_sharing-pages',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Add Sharing Line in Pages',
		        'section' => 'sharing_section',
		        'priority' => 1
		    )
		);    */
}
add_action( 'customize_register', 'sharing_customizer' );

?>