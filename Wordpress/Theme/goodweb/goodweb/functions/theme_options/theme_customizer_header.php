<?php
function head_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'head_section',
        array(
            'title' => 'Header',
            'description' => 'Settings according to the Head Area',
            'priority' => 35,
        )
    );
    	
	// Head Logo
		$wp_customize->add_setting( 'goodweb_head-logo' ,array(
		        'transport' => 'postMessage',
		    ));
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'goodweb_head-logo',
		        array(
		            'label' => 'Head Logo',
		            'section' => 'head_section',
		            'settings' => 'goodweb_head-logo'
		        )
		    )
		);
	
	// Nav Logo
		$wp_customize->add_setting( 'goodweb_nav-logo' ,array(
		        'transport' => 'postMessage',
		    ));
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'goodweb_nav-logo',
		        array(
		            'label' => 'Menu Logo',
		            'section' => 'head_section',
		            'settings' => 'goodweb_nav-logo'
		        )
		    )
		);

    // Nav Position
    	$wp_customize->add_setting(
		    'goodweb_nav-position',
		    array(
		        'default' => 'left',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_nav-position',
		    array(
		        'type' => 'radio',
		        'label' => 'Navigation Position',
		        'section' => 'head_section',
		        'choices' => array(
		            'menuontop' => 'Stick to Top',
		            'menuonleft' => 'Dynamic Left'
		        )
		    )
		);		
		
	// Blured Boxes
		$wp_customize->add_setting(
		    'goodweb_blured-boxes',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_blured-boxes',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Blur CurrentPage Box and Search Box',
		        'section' => 'head_section'
		    )
		);
		
	// Search Hide
		$wp_customize->add_setting(
		    'goodweb_search-hide',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_search-hide',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Hide Search',
		        'section' => 'head_section'
		    )
		);
   
   if ( $wp_customize->is_preview() && !is_admin() ){
    	add_action( 'wp_footer', 'head_customizer_preview', 21);
   }
    
}
add_action( 'customize_register', 'head_customizer' );

function head_customizer_preview() {
   ?>
    <script type="text/javascript">
        ( function() {
            wp.customize('goodweb_head-logo',function( value ) {
                value.bind(function(to) {
                	if(jQuery('#logo').length==0)
                		jQuery('#logo').html('<a href="<?php echo home_url(); ?>"><img src="'+to+'" alt="" /></a>');
                    else 
                    	jQuery('#logo').attr('src', to );
                });
            });
        } )( jQuery )
    </script>
<?php
}  // End function example_customize_preview()
?>