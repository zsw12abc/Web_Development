<?php

$templatepath = get_template_directory();

define('T_FUNCTIONS', $templatepath . '/functions/');
define('T_THEME', get_template_directory_uri());
define('T_JS', get_template_directory_uri() . '/js');
define('T_CSS', get_template_directory_uri() . '/css');
define('T_TYPE', get_template_directory_uri() . '/css/type');

/* Theme Functionality */
if ( ! class_exists( 'WP_Session' ) ) {
	require_once( T_FUNCTIONS . 'class-wp-session.php' );
	require_once( T_FUNCTIONS . 'wp-session.php' );
}
require_once(T_FUNCTIONS . '/theme_functions.php');
require_once(T_FUNCTIONS . '/theme_pagination.php');
require_once(T_FUNCTIONS . '/theme_options/theme_customizer.php');
require_once(T_FUNCTIONS . '/navigation/sweet-custom-menu.php');

/* JavaScripts, Widgets, Sidebars, Shortcodes */
require_once(T_FUNCTIONS . '/theme_javascriptcss.php');
require_once(T_FUNCTIONS . '/theme_widgets.php');
require_once(T_FUNCTIONS . '/theme_sidebars.php');

/* Post Comments, Custom Post Types */
require_once(T_FUNCTIONS . '/theme_post_customtypes.php');

/* Theme Language */
require_once(T_FUNCTIONS . '/theme_language.php');

if (is_admin()){
	//require_once(T_FUNCTIONS . '/theme_firstinstall.php');
	require_once(T_FUNCTIONS . '/page_options/theme_page_options.php');
	require_once(T_FUNCTIONS . '/theme_options/theme_settings.php');
	require_once(T_FUNCTIONS . '/theme_featured_image_preview.php');
	require_once T_FUNCTIONS . '/theme_plugins.php';
	require_once(T_FUNCTIONS . '/theme_startmessage.php');
	require_once(T_FUNCTIONS . '/theme_builder.php');
	require_once(T_FUNCTIONS . '/dashboard_docu.php');
	
}

function load_media_box(){
    if(function_exists(wp_enqueue_media())) wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_media_box');

add_action( 'admin_head', 'admin_css' );

function admin_css(){ ?>
     <style>
	     .fbuilder_save{
			clear:both;
			margin-top: 20px;
		}
		#toplevel_page_frontendbuilder {
			display:none;
		}
		#fbuilder_main_menu .fbuilder_control:first-child { display : none; }
		
		.fbuilder_draggable_holder {
			max-height: 507px !important;
		}
     </style>
<?php
}
add_action('wp_print_scripts','fbuilder_dequeue_scripts',99999);
add_action('wp_print_styles','fbuilder_dequeue_scripts',99999);



function fbuilder_dequeue_scripts() {
   wp_dequeue_script( 'fbuilder_prettyphoto_js' );
   wp_deregister_script( 'fbuilder_prettyphoto_js' );
   wp_dequeue_script( 'fbuilder_swiper_js' );
   wp_deregister_script( 'fbuilder_swiper_js' );
   
   wp_dequeue_style( 'fbuilder_prettyphoto_css' );
   wp_deregister_style( 'fbuilder_prettyphoto_css' );
   wp_dequeue_style( 'fbuilder_swiper_css' );
   wp_deregister_style( 'fbuilder_swiper_css' );
}

function get_my_widgets()
{
    foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar)
    {
        $sidebar_options["[tp_widget_area]".$sidebar['name']."[/tp_widget_area]"] = $sidebar['name'];
    }
    return $sidebar_options;
}

add_action('init','get_my_widgets');

?>