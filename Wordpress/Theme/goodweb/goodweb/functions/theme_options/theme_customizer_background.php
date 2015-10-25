<?php
function background_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'background_section',
        array(
            'title' => 'Background',
            'description' => 'Background Defaults',
            'priority' => 33,
        )
    );
    
    // Default Background
    	$wp_customize->add_setting(
		    'goodweb_background-type',
		    array(
		        'default' => 'color',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_background-type',
		    array(
		        'type' => 'radio',
		        'label' => 'Background Default Type',
		        'section' => 'background_section',
		        'choices' => array(
		            'color' => 'Color',
		            'slider' => 'Slider',
		            'image' => 'Image',
		        ),
		    )
		);
	
	// Background Image
		$wp_customize->add_setting( 'goodweb_background-image' ,array(
		        'transport' => 'postMessage',
		    ));
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'goodweb_background-image',
		        array(
		            'label' => 'Default Background Image',
		            'section' => 'background_section',
		            'settings' => 'goodweb_background-image'
		        )
		    )
		);
		
	// Background Image Tiled/Stretched
    	$wp_customize->add_setting(
		    'goodweb_background-image-type',
		    array(
		        'default' => 'full',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_background-image-type',
		    array(
		        'type' => 'radio',
		        'label' => 'Default Background Image Display',
		        'section' => 'background_section',
		        'choices' => array(
		            'full' => 'Full',
		            'repeatbg' => 'Tiled'
		        ),
		    )
		);
	
	// Background Color
		$wp_customize->add_setting(
		    'goodweb_background-color',
		    array(
		        'default' => '#202126',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'goodweb_background-color',
		        array(
		            'label' => 'Default Background Color',
		            'section' => 'background_section',
		            'settings' => 'goodweb_background-color',
		        )
		    )
		); 
	
	// Default Slider
		$wp_customize->add_setting( 'goodweb_background-slider');
		$wp_customize->add_control(
		    new tb_slider_Control(
		        $wp_customize,
		        'goodweb_background-slider',
		        array(
		            'label' => 'Default Background Slider',
		            'section' => 'background_section',
		            'settings' => 'goodweb_background-slider'
		        )
		    )
		);	
	
		$wp_customize->add_setting(
		    'goodweb_background_slider_autoslider',
		    array(
		        'default' => '0',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_background_slider_autoslider',
		    array(
		        'label' => 'Autoplay Delay',
		        'section' => 'background_section',
		        'type' => 'text',
		    )
		); 	
		
   if ( $wp_customize->is_preview() && ! is_admin() ){
    	add_action( 'wp_footer', 'background_customizer_preview', 21);
    }
    
}
add_action( 'customize_register', 'background_customizer' );

function background_customizer_preview() {
   ?>
    <script type="text/javascript">
        ( function() {
        	background_switch("default");
            wp.customize('goodweb_background-type',function( value ) {
               	value.bind(function(to) {
			   		background_switch(to);
			   	});
            });
        } )( jQuery )
        
        function background_switch(to){
        	var $parent_form = jQuery("#customize-controls", parent.document);
	   		
	   		if(to=="default") to = $parent_form.find("input[name='_customize-radio-goodweb_background-type']:checked").val()
	   		
	   		if(to!="image") $parent_form.find("#customize-control-goodweb_background-image,#customize-control-goodweb_background-image-type").hide();
	   		else $parent_form.find("#customize-control-goodweb_background-image,#customize-control-goodweb_background-image-type").fadeIn();
	   		if(to!="slider"){
		   		$parent_form.find("#customize-control-goodweb_background-slider").hide();	
		   		$parent_form.find("#customize-control-goodweb_background_slider_autoslider").hide();
	   		} 
	   		else {
	   			$parent_form.find("#customize-control-goodweb_background-slider").fadeIn();
	   			$parent_form.find("#customize-control-goodweb_background_slider_autoslider").fadeIn();
	   		}
	   		if(to!="color") $parent_form.find("#customize-control-goodweb_background-color").hide();
	   		else $parent_form.find("#customize-control-goodweb_background-color").fadeIn();
        }
        
    </script>
   
<?php
}  // End function example_customize_preview()
?>