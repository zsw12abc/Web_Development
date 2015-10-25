<?php
/**
 * functions.php
 * @package WordPress
 * @subpackage miniME 1.0
 * @since miniME 1.1
 * 
 */
/*************************************************
## Post Type
*************************************************/

if (is_admin() ){
	function minime_admin_scripts(){	
		wp_register_script('klbmetajs', get_template_directory_uri() .'/js/init.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('klbmetajs');
	}
}
add_action('admin_enqueue_scripts', 'minime_admin_scripts');

add_theme_support( 'post-formats', array('gallery', 'audio', 'video')); 

/*************************************************
## Styles and Scripts
*************************************************/ 
define('MINIME_INDEX_JS', get_template_directory_uri()  . '/js');
define('MINIME_INDEX_CSS', get_template_directory_uri()  . '/css');

function minime_scripts() {

     if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
     wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '1.0');
     wp_enqueue_style( 'fonts-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, '1.0');
     wp_enqueue_style( 'icon-css', get_template_directory_uri() . '/css/icon.css', false, '1.0');
     wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/minislide/flexslider.css', false, '1.0');

     wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl_carousel/owl.carousel.css', false, '1.0');
     wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl_carousel/owl.theme.css', false, '1.0');
     wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', false, '1.0');
     wp_enqueue_style( 'stylem', get_template_directory_uri() . '/css/style.css', false, '1.0');
     wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', false, '1.0');

     wp_enqueue_style( 'style', get_stylesheet_uri() );


	wp_enqueue_script( 'google-map','https://maps.googleapis.com/maps/api/js?v=3.exp', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/minislide/jquery.flexslider.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/gallery/isotope.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'ui-totop', get_template_directory_uri() . '/js/jquery.ui.totop.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl_carousel/owl.carousel.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}

add_action( 'wp_enqueue_scripts', 'minime_scripts' );

/*************************************************
## Google Font
*************************************************/


function minime_fonts() 
{
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'open-sans-italic', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300" );
	wp_enqueue_style( 'raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900" );
	wp_enqueue_style( 'tangerine', "$protocol://fonts.googleapis.com/css?family=Tangerine:400,700" );

}
add_action( 'wp_enqueue_scripts', 'minime_fonts' );




/*************************************************
## Theme option
*************************************************/ 

        require('includes/metaboxes.php');
        require('includes/metaboxes/meta-box.php');
        require('includes/portfolio-post-type.php');
        require('includes/minimeshortcodes/minime/minime-shortcodes.php');
        require('includes/minimeshortcodes/shortcodes.php');
        add_filter( 'ot_show_pages', '__return_false' );
        add_filter( 'ot_show_new_layout', '__return_false' );
        add_filter( 'ot_theme_mode', '__return_true' );
        include_once( 'option-tree/ot-loader.php' );
        include_once( 'option-tree/theme-options.php' );



/*************************************************
## Word Limiter
*************************************************/ 
function minime_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}


/*************************************************
## Excerpt More
*************************************************/ 

function minime_excerpt_more($more) {
  global $post;
  return '&hellip;<div class="text-right"><a href="'. get_permalink($post->ID) . '" class="klbtheme-button btn-tiny standard">' . '' . __('Read More', 'minime') . '</a></div>';
 }
 add_filter('excerpt_more', 'minime_excerpt_more');



/*************************************************
## Theme Title Option
*************************************************/ 
function minime_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'minime' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'minime_wp_title', 10, 2 );

/*************************************************
## Register Menu 
*************************************************/

function register_menus() {
	register_nav_menus( array( 'main-menu' => 'Primary Navigation Menu') );
}
add_action('init', 'register_menus');
 
class description_walker extends Walker_Nav_Menu
{




      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           

           $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
           $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
           $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
          	
          	if( $icon_class != '' ) {
            	$icon_classes = '';
		   	}
		   	else{
		   		$icon_classes = '';
		   	}

           if($object->object == 'page')
           {
                $varpost = get_post($object->object_id);                
                $separate_page = get_post_meta($object->object_id, "klb_separate_page", true);
                $disable_menu = get_post_meta($object->object_id, "klb_disable_section_from_menu", true);
				$current_page_id = get_option('page_on_front');

                if ( ( $disable_menu != true ) && ( $varpost->ID != $current_page_id ) ) {

                	$output .= $indent . '<li class="cl-effect-11">';

                	if ( $separate_page == true )
	                	$attributes .= ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';
	                else{
	                	if (is_front_page()) 
	                		$attributes .= ' href="#' . $varpost->post_name . '" '; 
	                	else 
	                		$attributes .= ' href="' .  ''.home_url().'/#' . $varpost->post_name . '"';
	                }		

	                $object_output = $args->before;
		            $object_output .= '<a'. $attributes .' data-hover="'.apply_filters( 'the_title', $object->title, $object->ID ).'">';
		            $object_output .= $args->link_before . $icon_classes .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
		            $object_output .= $args->link_after;
		            $object_output .= '</a>';
		            $object_output .= $args->after;    

		             $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
                }
                                         
           }
           else{

           		$output .= $indent . '<li class="dropdown">';

                $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) .'"' : '';

	            $object_output = $args->before;
	            $object_output .= '<a'. $attributes .' class="dropdown-toggle" data-toggle="dropdown">';
	            $object_output .= $args->link_before . $icon_classes .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	            $object_output .= $args->link_after;
	            $object_output .= '</a>';
	            $object_output .= $args->after;

	             $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
	        }

           
      }
}


/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function minime_theme_setup() {

	add_theme_support( 'title-tag' );
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'minime_theme_setup' );




/*************************************************
## miniME Color Picker
*************************************************/

function minime_custom_styling() { ?>

<style type="text/css">

/* Define the base color */

<?php $minime_background = ot_get_option( 'minime_background', array() ); ?> 
body
{ 
background-color: <?php if($minime_background['background-color']){echo $minime_background['background-color'] ; }else{ echo '#fff';} ?>;
background-repeat:<?php if($minime_background['background-repeat']){echo $minime_background['background-repeat'] ; }else{ echo '';} ?>;
background-attachment:<?php if($minime_background['background-attachment']){echo $minime_background['background-attachment'] ; }else{ echo 'fixed';} ?>;
background-position:<?php if($minime_background['background-position']){echo $minime_background['background-position'] ; }else{ echo 'top';} ?>;
background-image:url(<?php if($minime_background['background-image']){echo $minime_background['background-image'] ; }else{ echo '';} ?>) ;
background-size:<?php if($minime_background['background-size']){echo $minime_background['background-size'] ; }else{ echo 'cover';} ?> ;

}
</style>
<?php }
add_action('wp_head','minime_custom_styling');


/*************************************************
## Pagination Function
*************************************************/

function minime_pagination($pages = '', $range = 4) {
	$showitems = ($range * 2)+1;
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class'button button-small' href='".get_pagenum_link(1)."'>&laquo; " . __('First', 'minime') . "</a></li>";
		if($paged > 1 && $showitems < $pages) echo "<li><a class=\"active\" href='".get_pagenum_link($paged - 1)."'>&lsaquo; " . __('Previous', 'minime') . "</a></li>";
		
		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<li ><a class=\"active\">".$i."</a></li>":"<li><a  href='".get_pagenum_link($i)."' >".$i."</a></li>";
			}
		}
	
		if ($paged < $pages && $showitems < $pages) echo "<a class=\"active\" href=\"".get_pagenum_link($paged + 1)."\">" . __('Next', 'minime') . " &rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a class=\"active\" href='".get_pagenum_link($pages)."'>" . __('Last', 'minime') . " &raquo;</a></li>";
	
}



/*************************************************
## Widgets
*************************************************/ 


function minime_widgets_init() {
	register_sidebar( array(
	  'name' => __( 'Blog Sidebar', 'minime' ),
	  'id' => 'sidebar-1',
	  'description'   => __( 'These are widgets for the Blog page.','minime' ),
	  'before_widget' => '<div class="blog-right-column">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h2>',
	  'after_title'   => '</h2>'
	) );

}
add_action( 'widgets_init', 'minime_widgets_init' );


/*************************************************
## miniME Comment
*************************************************/

if ( ! function_exists( 'minime_comment' ) ) :
 function minime_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <div class="comments">
   <article class="post pingback">
   <p><?php _e( 'Pingback:', 'minime' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'minime' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>


                   <div class="col-md-2 col-xs-2 b-mention-item-user f-center">
                        <div class="b-mention-item-user-img">
                            	<?php echo get_avatar( $comment, 80 ); ?>
                        </div>
                       
                            <div class="f-mention-item-user-name f-primary-b"><?php comment_author(); ?></div>
                       
                    </div>
                    <div class="col-md-10 col-xs-10 b-remaining">
                        <div class="b-mention-item__comment">
                            <div class="b-mention-item__comment_text f-mention-item__comment_text">
                                <span><time class="comment-date" pubdate datetime="<?php comment_time( 'c' ); ?>"><?php comment_date(); ?> at <?php comment_time(); ?></time></span>
                                <span class="reply">
								    <i class="fa fa-rely"></i>	<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>				
								</span>
                               <p><?php comment_text(); ?></p>
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'minime' ); ?></em>
					<?php endif; ?> 
					<article class="clearfix" id="comment-<?php comment_ID(); ?>"></article>                                
                            </div>
                        </div>
                    </div>
                    <div class="clear separ-post"></div>

                 
  <?php
    break;
  endswitch;
 }
endif;



/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'minime_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function minime_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'                  => 'Envato WordPress Toolkit',
            'slug'                  => 'envato-wordpress-toolkit-master',
            'source'                => get_template_directory() . '/plugins/envato-wordpress-toolkit-master.zip',
            'required'              => true,
            'version'               => '1.7.1',
            'force_activation'      => true,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => 'Contact Form 7',
            'slug'                  => 'contact-form-7',
            'source'                => get_template_directory() . '/plugins/contact-form-7.4.1.zip',
            'required'              => false,
            'version'               => '4.0.1',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),




    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}