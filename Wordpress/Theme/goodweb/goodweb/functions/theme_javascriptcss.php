<?php
/* ------------------------------------- */
/* ENQUEUE JAVASCRIPTS + CSS */
/* ------------------------------------- */
function loadJSCSS() {
	if (!is_admin()) {
		wp_enqueue_script( 'jquery' );
	
	// Enqueue the Theme Styles
	
		//Google Font
		$google_font = str_replace("#038;","&",get_theme_mod( "goodweb_font-url",'http://fonts.googleapis.com/css?family=Open+Sans:400,300,800,700'));
	    if(!empty($google_font)) wp_enqueue_style( 'goodweb_googlefont_style',$google_font);

		wp_enqueue_style( 'goodweb_bootstrap_css',T_CSS.'/bootstrap.css');
		wp_enqueue_style( 'goodweb_theme_css',get_stylesheet_directory_uri().'/style.css');
		wp_enqueue_style( 'goodweb_skin_css',T_CSS.'/style-'.get_theme_mod('goodweb_dark-light','dark').'.css');
		wp_enqueue_style( 'goodweb_punchbox_css',T_JS.'/punchbox/css/settings.css');
		wp_enqueue_style( 'goodweb_fontello_css',T_TYPE.'/fontello.css');
	    
	// Enqueue the Theme JS  
		//Bootstrap
		wp_enqueue_script('goodweb_bootstrap_script', T_JS."/bootstrap.min.js", array('jquery'),false,true);
		wp_enqueue_script('themepunchtools', T_JS."/jquery.themepunch.plugins.min.js", array('jquery'),false,true);
		wp_enqueue_script('goodweb_punchbox_script', T_JS."/punchbox/js/jquery.themepunch.punchbox.js", array('jquery'),false,true);
		wp_enqueue_script('goodweb_isotope_script', T_JS."/jquery.isotope.min.js", array('jquery'),false,true);

		
	

	// Hammer JS
		if(!shortcode_exists("rev_slider") || version_compare(GlobalsRevSlider::SLIDER_REVISION, "4.2", "<") ){
			//wp_enqueue_script('goodweb_hammer_script', T_JS."/hammer.js", array('jquery'),false,true);
		}

		wp_enqueue_script('goodweb_theme_script', T_JS."/screen.js", array('jquery'),false,true);
		wp_localize_script('goodweb_theme_script', 'goodweb_theme_vars', array(
					'load' => __('LOAD','goodweb'),
					'more' => __('MORE','goodweb')
				)
			);
		
		//Comments
		if(is_singular() && get_option("thread_comments")) wp_enqueue_script("comment-reply");
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-color');
		wp_enqueue_script('jquery-ui',T_JS . '/jquery-ui.js');
	}
	
}
add_action('wp_enqueue_scripts', 'loadJSCSS');

function wps_enqueue_lt_ie9() { echo '<!--[if lt IE 9]>'; echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>'; echo '<![endif]-->'; global $wp_styles; wp_enqueue_style('ie8-style',T_CSS.'/style_ie8.css'); $wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8'); wp_enqueue_style('ie9-style',T_CSS.'/style_ie9.css'); $wp_styles->add_data( 'ie9-style', 'conditional', 'IE 9' ); 
}

add_action( 'wp_enqueue_scripts', 'wps_enqueue_lt_ie9' );

function tp_add_numeric_slider() {
	// get CSS from CDN
	wp_enqueue_style( 'jquery-ui-css' , 'http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css' , '1.9.2' , array('jquery') , 'all' );

	global $pagenow;
    if( 'edit.php' == $pagenow  || 'post-new.php' == $pagenow ) {
    	wp_deregister_script('jquery-ui');
		wp_enqueue_script('jquery-ui',T_JS . '/jquery-ui.js');
    }
		
	wp_enqueue_script('jquery-color');
}
add_action( 'admin_enqueue_scripts', 'tp_add_numeric_slider' );

function tp_add_color_module() {
	wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_style('thickbox');
    wp_enqueue_style( 'goodweb_fontello_css',T_TYPE.'/fontello.css');
}
add_action( 'admin_enqueue_scripts', 'tp_add_color_module' );
?>
