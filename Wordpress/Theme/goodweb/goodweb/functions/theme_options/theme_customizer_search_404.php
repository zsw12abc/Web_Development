<?php
function search_404_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'search_404_section',
        array(
            'title' => 'Search & 404',
            'description' => 'Search Settings & 404 Page',
            'priority' => 33,
        )
    );
        
    // 404 Page
		$wp_customize->add_setting( 'goodweb_404-page');
		$wp_customize->add_control(
		    new tb_pages_Control(
		        $wp_customize,
		        'goodweb_404-page',
		        array(
		            'label' => '404 Page',
		            'section' => 'search_404_section',
		            'settings' => 'goodweb_404-page'
		        )
		    )
		);	    
}
add_action( 'customize_register', 'search_404_customizer' );
?>