<?php
function footer_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'footer_section',
        array(
            'title' => 'Footer',
            'description' => 'Settings according to the Footer Area',
            'priority' => 38,
        )
    );
    
	// Footer Hide
		$wp_customize->add_setting(
		    'goodweb_footer-hide',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_footer-hide',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Hide Footer',
		        'section' => 'footer_section',
		        'priority' => 2
		    )
		);
		
	// SubFooter Hide
		$wp_customize->add_setting(
		    'goodweb_subfooter-hide',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_subfooter-hide',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Hide SubFooter',
		        'section' => 'footer_section',
		        'priority' => 3
		    )
		);	

	
   if ( $wp_customize->is_preview() && ! is_admin() ){
    	add_action( 'wp_footer', 'footer_customizer_preview', 21);
    }
    
}
add_action( 'customize_register', 'footer_customizer' );

function footer_customizer_preview() {
   ?>
    <script type="text/javascript">
        ( function() {
            
            wp.customize('goodweb_subfooter-hide',function( value ) {
	            value.bind(function(to) {
	                if(to) jQuery("#subfooter").fadeOut();
	                else jQuery("#subfooter").fadeIn();
	            });
            });
            wp.customize('goodweb_footer-hide',function( value ) {
	            value.bind(function(to) {
	                if(to){
	                	 jQuery("#footer").fadeOut();
	                	 jQuery("#subfooter").css("margin-top",'200px');
	                }
	                else {
		              	jQuery("#footer").fadeIn();  
		              	jQuery("#subfooter").css("margin-top",'0');
	                } 
	            });
            });
         
            
        } )( jQuery )
    </script>
<?php
}  // End function example_customize_preview()
?>