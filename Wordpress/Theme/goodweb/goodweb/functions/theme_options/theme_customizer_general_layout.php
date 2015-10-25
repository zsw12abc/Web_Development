<?php
function layout_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'layout_section',
        array(
            'title' => 'General Layout',
            'description' => 'Overall Layout Settings',
            'priority' => 33,
        )
    );
    
    // Layout
    	$wp_customize->add_setting(
		    'goodweb_one-multi',
		    array(
		        'default' => 'multi',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_one-multi',
		    array(
		        'type' => 'radio',
		        'label' => 'Theme Type Navigation (do menu items link inside one page or go to single pages?)',
		        'section' => 'layout_section',
		        'choices' => array(
		            'multi' => 'MultiPager',
		            'one' => 'OnePager'
		        ),
		    )
		);
    
    // Effects
    	$wp_customize->add_setting(
		    'goodweb_animations',
		    array(
		        'default' => 'withmoduleanimations',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_animations',
		    array(
		        'type' => 'radio',
		        'label' => 'Scroll Element Animations',
		        'section' => 'layout_section',
		        'choices' => array(
		            'withmoduleanimations' => 'Animations',
		            'withoutmoduleanimations' => 'No Animations'
		        ),
		    )
		);
    
    // Layout
    	$wp_customize->add_setting(
		    'goodweb_dark-light',
		    array(
		        'default' => 'dark',
		        'transport' => 'postMessage'
		    )
		);
		 
		$wp_customize->add_control(
		    'goodweb_dark-light',
		    array(
		        'type' => 'radio',
		        'label' => 'Theme Style',
		        'section' => 'layout_section',
		        'choices' => array(
		            'dark' => 'Dark',
		            'light' => 'Light'
		        ),
		    )
		);
        
    // Highlight Color
		$wp_customize->add_setting(
		    'goodweb_highlight-color',
		    array(
		        'default' => '#ffd658',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'goodweb_highlight-color',
		        array(
		            'label' => 'Highlight Color',
		            'section' => 'layout_section',
		            'settings' => 'goodweb_highlight-color',
		        )
		    )
		);
		
	// Nav Home
		$wp_customize->add_setting(
		    'goodweb_home-hide',
		    array(
		        'transport' => 'postMessage',
		        
		    )
		);
		$wp_customize->add_control(
		    'goodweb_home-hide',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Hide "Home" menu item?',
		        'section' => 'nav'
		    )
		);
		
	// Font
		$wp_customize->add_setting(
		    'goodweb_font-url',
		    array(
		        'default' => 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,800,700',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_font-url',
		    array(
		        'label' => 'Main Font URL',
		        'section' => 'layout_section',
		        'type' => 'text',
		    )
		);

	// Font Family
		$wp_customize->add_setting(
		    'goodweb_font-family',
		    array(
		        'default' => 'font-family: \'Open Sans\', sans-serif;',
		        'transport' => 'postMessage',
		    )
		);
		$wp_customize->add_control(
		    'goodweb_font-family',
		    array(
		        'label' => 'Main Font Family',
		        'section' => 'layout_section',
		        'type' => 'text',
		    )
		); 
		
	// 404 Page
	/*	$wp_customize->add_setting( 'goodweb_404-page');
		$wp_customize->add_control(
		    new tb_pages_Control(
		        $wp_customize,
		        'goodweb_404-page',
		        array(
		            'label' => '404 Page',
		            'section' => 'layout_section',
		            'settings' => 'goodweb_404-page'
		        )
		    )
		);	*/
		
   if ( $wp_customize->is_preview() && ! is_admin() ){
    	add_action( 'wp_footer', 'layout_customizer_preview', 21);
    }
    
}
add_action( 'customize_register', 'layout_customizer' );

function layout_customizer_preview() {
   ?>
    <script type="text/javascript">
        ( function() {
            wp.customize('goodweb_highlight-color',function( value ) {
               	value.bind(function(to) {
                	dark_light = window.parent.jQuery("input[name=_customize-radio-goodweb_dark-light]:checked").val();
                	jQuery("<link/>", {
								id : "customizer_highlight",
								rel: "stylesheet",
								type: "text/css",
								href: "<?php echo get_template_directory_uri(); ?>/css/style-"+dark_light+"-highlight.php?highlight="+to.replace("#", "")
							}).appendTo("head");
                });
            });
            
            wp.customize('goodweb_dark-light',function( value ) {
               	value.bind(function(to) {
                	jQuery("#goodweb_skin_css").remove();	
                	jQuery("<link/>", {
								id : "goodweb_skin_css",
								rel: "stylesheet",
								type: "text/css",
								href: "<?php echo get_template_directory_uri(); ?>/css/style-"+to+".css"
							}).appendTo("head");
					
					dark_light = window.parent.jQuery("#customize-control-goodweb_highlight-color").find(".color-picker-hex.wp-color-picker").val();
	                value.bind(function(to) {
	                	jQuery("<link/>", {
									id : "customizer_highlight",
									rel: "stylesheet",
									type: "text/css",
									href: "<?php echo get_template_directory_uri(); ?>/css/style-"+to+"-highlight.php?highlight="+dark_light.replace("#", "")
								}).appendTo("head");
	                });
                
                });
            });

            wp.customize('goodweb_font-url',function( value ) {
                value.bind(function(to) {
                	jQuery("#goodweb_googlefont_style-css").attr("href",to);
                });
            });
            
            wp.customize('goodweb_font-family',function( value ) {
                value.bind(function(to) {
                	to = to.replace("font-family:","");
                	to = to.replace("'","\'");
                	to = to.replace(";","");
                	jQuery("body, .uneditable-input, .btn, .decoredbutton").css("font-family",to);
                });
            });
            

        } )( jQuery )
    </script>
   
<?php
}  // End function example_customize_preview()
?>