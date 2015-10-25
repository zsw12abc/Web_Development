<?php
	if ( ! isset( $content_width ) ) $content_width = 960;

//Register Main Navigation
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'navigation', 'Main Navigation' );
	}
	
//Featured Image Support	
	add_theme_support( 'post-thumbnails' );

//Custom Excerpts
	function new_excerpt_length($length) {
		global $excerpt_length_single;
	    return $excerpt_length_single;
	}	
	
	function excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
		return $excerpt;
	}
	
	function content($limit) {
		$excerpt = explode(' ', get_the_content(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
		if($limit<1) $excerpt = "";
	
		return $excerpt;
	}
	
	function excerpt_by_id($limit,$post_id) {
		global $post;  
		$save_post = $post;
		$post = get_post($post_id);
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		$post = $save_post;
		return $excerpt;
	}
	
	function complete_excerpt($length_callback='', $more_callback='') {

        if(function_exists($more_callback)){
            add_filter('excerpt_more', $more_callback);
        }

        if(function_exists($length_callback)){
            add_filter('excerpt_length', $length_callback);
        }

        $output = get_the_excerpt();

        if( empty( $output ) ){ 
            $excerpt = get_the_content();
            $excerpt = preg_replace('/\[(.*)\]/','',$excerpt);
            $excerpt = esc_attr( strip_tags( stripslashes( $excerpt ) ) );
            $excerpt = wp_trim_words( $excerpt, ( (function_exists($length_callback)) ? call_user_func($length_callback,55) : 55 ), ( (function_exists($more_callback)) ? call_user_func($more_callback) : '' ) );

            $output = $excerpt;
        }

        $output = apply_filters('wptexturize', $output);
        $output = apply_filters('convert_chars', $output);
        return $output;
}

//Get Special Categories */
	function getCategories($id){
		$categories = get_the_category($id);
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<div class="blogcategory"><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'goodweb' ), $category->name ) ) . '">'.$category->cat_name.'</a></div>';
			}
		return $output;
		}
	}

//Get all Page Options as Array
	function getOptions($id = 0){
	    if ($id == 0) :
	        global $wp_query;
	        $content_array = $wp_query->get_queried_object();
			if(isset($content_array->ID)){
	        	$id = $content_array->ID;
			}
	    endif;   
	
	    $first_array = get_post_custom_keys($id);
	
		if(isset($first_array)){
			foreach ($first_array as $key => $value) :
				   $second_array[$value] =  get_post_meta($id, $value, FALSE);
					foreach($second_array as $second_key => $second_value) :
							   $result[$second_key] = $second_value[0];
					endforeach;
			 endforeach;
		 }
		
		if(isset($result)){
	    	return $result;
		}
	}

//Get all Theme Options as Array
	function getThemeOptions(){
		if(is_array(get_theme_mods()))
		return array_merge(get_theme_mods());	
	}


//ID by Slug
	function idbyslug($page_slug) {
		$page = get_page_by_path($page_slug);
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	};

//Add classes to the first and last Widget
	function widget_first_last_classes($params) {
		global $my_widget_num; // Global a counter array
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
	
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
	
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
	
		$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
	
		if($my_widget_num[$this_id] == 1 && $my_widget_num[$this_id] != count($arr_registered_widgets[$this_id])) { // If this is the first widget
			$class .= ' first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' last ';
		}
	
		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
	
		return $params;
	}
	add_filter('dynamic_sidebar_params','widget_first_last_classes');


//Special Comment Reply Link
	add_filter('comment_reply_link', 'replace_reply_link_class');
	
	
	function replace_reply_link_class($class){
	    $class = str_replace("class='comment-reply-link", "class='comment-reply-link small reply", $class);
	    return $class;
	}

if(!function_exists('aq_resize')){
	/**
* Title		: Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.4
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true, $retina = false ) {
		
		 //validate inputs
		 if(!$url OR !$width ) return false;
		
		 //define upload path & dir
		 $upload_info = wp_upload_dir();
		 $upload_dir = $upload_info['basedir'];
		 $upload_url = $upload_info['baseurl'];
		
		 //check if $img_url is local
		 if(strpos( $url, $upload_url ) === false) return false;
		
		 //define path of image
		 $rel_path = str_replace( $upload_url, '', $url);
		 $img_path = $upload_dir . $rel_path;
		
		 //check if img path exists, and is an image indeed
		 if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
		
		 //get image info
		 $info = pathinfo($img_path);
		 $ext = $info['extension'];
		 list($orig_w,$orig_h) = getimagesize($img_path);
		
		 //get image size after cropping
		 $dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
		 $dst_w = $dims[4];
		 $dst_h = $dims[5];
		
		 //use this to check if cropped image already exists, so we can return that instead
		 $suffix = "{$dst_w}x{$dst_h}";
		 $dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
		 $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
		
		 //Retina Image
		 if($retina){
		  if(!$dst_h) {
		   //can't resize, so return original url
		   $img_url = $url;
		   $dst_w = $orig_w;
		   $dst_h = $orig_h;
		  }
		  //else check if cache exists
		  elseif(file_exists(str_replace(".".$ext,"@2x.".$ext,$destfilename)) && getimagesize(str_replace(".".$ext,"@2x.".$ext,$destfilename))) {
		   $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}@2x.{$ext}";
		  } 
		  //else, we resize the image and return the new resized image url
		  else {
		   if(function_exists('wp_get_image_editor')) {
		    $editor = wp_get_image_editor($img_path);
		    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width*2, $height*2, $crop ) ) )
		     return false;
		 
		    $resized_img_path = $editor->save();
		 
		   } else {
		    	//$resized_img_path = image_resize( $img_path, $width*2, $height*2, $crop ); // Fallback foo
		    	return false;
		   }
		 
		   try{
			  if(!is_wp_error($resized_img_path)) {
			   $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
			   $img_url = $upload_url . $resized_rel_path['path'];
			  } else {
			   return false;
			  }
		  }  catch (Exception $e) {return false;}
		 
		  }
		 }
		 
		
		 if(!$dst_h) {
		  //can't resize, so return original url
		  $img_url = $url;
		  $dst_w = $orig_w;
		  $dst_h = $orig_h;
		 }
		 //else check if cache exists
		 elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		  $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		 } 
		 //else, we resize the image and return the new resized image url
		 else {
		  if(function_exists('wp_get_image_editor')) {
		   $editor = wp_get_image_editor($img_path);
		
		   if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
		    return false;
		
		   $resized_img_path = $editor->save();
		
		  } else {
		   //$resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
		   return false;
		  }
		
		  try{
			  if(!is_wp_error($resized_img_path)) {
			   $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
			   $img_url = $upload_url . $resized_rel_path['path'];
			  } else {
			   return false;
			  }
		  }  catch (Exception $e) {return false;}

		
		 }
		
		 //return the output
		 if($single) {
		  //str return
		  $image = $img_url;
		 } else {
		  //array return
		  $image = array (
		   0 => $img_url,
		   1 => $dst_w,
		   2 => $dst_h
		  );
		 }
		
		
		$image = $suffix == "x" ? "{$upload_url}{$dst_rel_path}.{$ext}" : "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}"; 
		
		 return $image;
		}
}


//Color Hex to RGB
	function HexToRGB($hex) {
		$hex = str_replace("#", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return $color;
	}
	
function raw_formatter($content) {
  // Shortcode [ raw] ... [ /raw] to preserve code formatting
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
 
    foreach ($pieces as $piece) {
        if (preg_match($pattern_contents, $piece, $matches)) {
        $new_content .= htmlspecialchars($matches[1]);
        } else {
            $new_content .= wptexturize(wpautop($piece));
        }
    }
 
    return $new_content;
}	
	
//Parse Uneeded Half Open Tags
	function fix_shortcodes($content){
			$columns = array("tp_tabs","tp_accordion","tp_service","tp_team_member","tp_teamwall","tp_mediawall","tp_pricetable","tp_button","contact-form-7","revslider");
	        $block = join("|",$columns);

			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);
			
			return $rep;
	}
	add_filter('the_content', 'fix_shortcodes');
	
//Allow Contact Form 7 Forms to include shortcodes
	
	add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );	
	
	function mycustom_wpcf7_form_elements( $form ) {
		$array = array (
	                '<p>[' => '[',
	                ']</p>' => ']',
	                ']<br />' => ']'
	        );
	    $form = strtr($form, $array);
		$form = do_shortcode( $form );
		return $form;
	}

//Add shortcode support to widgets
add_filter('widget_text', 'do_shortcode');

//Rebuild Search Form
	function rebuild_search_form($form) {
		$form = '<form role="search" method="get" id="searchform"  action="'.get_bloginfo("url").'">
							<div style="position:relative;z-index:10">
								<input type="text" id="Form_Search" class="searchinput" name="s">
								<input type="submit" class="searchsubmitter"> <i class="icon-search searchsubmittericon"></i>
							</div>
							<div class="single_blurredbg_holder">
								<div class="single_blurredbg"></div>
								<div class="single_bluroverlay"></div>
							</div>
							<div class="clear"></div>
						</form>';
	    return $form;
		
	}
	add_filter( 'get_search_form', 'rebuild_search_form' );

//Get RevSlider Property
	function get_revslider_property($slider,$property){
		global $wpdb;
		global $table_prefix;
		$table_prefix = $wpdb->base_prefix;
		if (!isset($wpdb->tablename)) {
			$wpdb->tablename = $table_prefix . 'revslider_sliders';
		}
		$revolution_sliders = $wpdb->get_results(
			"
			SELECT params
			FROM $wpdb->tablename
			WHERE alias='$slider'
			"
		);
		if(is_array($revolution_sliders[0]))
			foreach($revolution_sliders[0] as $key => $value){
				$vowels = array("{", "}", '"');
			 	$sliderparams = str_replace($vowels,"",$value);
			 	$sliderparams_array = split(",", $sliderparams);
			 	foreach($sliderparams_array as $sliderparam){
				 	$sliderparam_array = split(":",$sliderparam);
				 	if(isset($sliderparam_array[0]) && $sliderparam_array[0]==$property){
					 	$return_value = $sliderparam_array[1];
					 	break;
				 	}
			 	}
			}
		if(!empty($return_value))	
			return $return_value;
	}

//Get all Tags
	function wp_get_all_tags( $args = '' ) {
	  $tags = get_terms('post_tag');
	  foreach ( $tags as $key => $tag ) {
	      if ( 'edit' == 'view' )
	          $link = get_edit_tag_link( $tag->term_id, 'post_tag' );
	      else
	          $link = get_term_link( intval($tag->term_id), 'post_tag' );
	      if ( is_wp_error( $link ) )
	          return false;
	
	      $tags[ $key ]->link = $link;
	      $tags[ $key ]->id = $tag->term_id;
	      $tags[ $key ]->name = $tag->name;
	      echo ' <li><a href="'. $link .'">' . $tag->name . '</a></li>';
	      }
	  return $tags;
	}
	
//Get all Custom Post Types
	function get_registered_post_types() {
	    global $wp_post_types;
	
	    return array_keys( $wp_post_types );
	}
	
//Get the excluded Categories from the Portfolio	
	function get_excluded_portfolio_categories($post_id){
		$page_options = getOptions($post_id);
		$taxonomy = 'category_portfolio';
		$tax_terms = get_terms($taxonomy);
		$categories = "";

		if( !empty($page_options["goodweb_portfolio_categories"]) && !in_array("all", $page_options["goodweb_portfolio_categories"])){
			foreach ($tax_terms as $tax_term) {
				if(!in_array($tax_term->slug,$page_options["goodweb_portfolio_categories"]))
					$categories[] = $tax_term->term_id;
			}
		}
		return $categories;
	}
	
	function all_taxonomies_but($the_ones){
		$taxonomy = 'category_portfolio';
		$tax_terms = get_terms($taxonomy);
		foreach ($tax_terms as $tax_term) {
				if(!in_array($tax_term->slug,$the_ones))
					$categories[] = $tax_term->term_id;
		}
		return $categories;
	}
	

//Get adjacent Portfolio Posts
	function get_adjacent_portfolio_post( $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy = 'category_portfolio' ) {
	global $post, $wpdb;

	if ( empty( $post ) )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			$cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
			$join .= " AND tt.taxonomy = '$taxonomy' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = '$taxonomy'";
		if ( ! empty( $excluded_categories ) ) {
			if ( ! is_array( $excluded_categories ) ) {
				// back-compat, $excluded_categories used to be IDs separated by " and "
				if ( strpos( $excluded_categories, ' and ' ) !== false ) {
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.','goodweb' ), "'and'" ) );
					$excluded_categories = explode( ' and ', $excluded_categories );
				} else {
					$excluded_categories = explode( ',', $excluded_categories );
				}
			}

			$excluded_categories = array_map( 'intval', $excluded_categories );
				
			if ( ! empty( $cat_array ) ) {
				$excluded_categories = array_diff($excluded_categories, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_categories) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = '$taxonomy' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $posts_in_ex_cats_sql $sort";
	//echo $query;
	$query_key = 'adjacent_post_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $posts_in_ex_cats_sql $sort");
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}


//Change ReadMore [...]
	function new_excerpt_more( $more ) {
		return "...";
	}
	add_filter('excerpt_more', 'new_excerpt_more');

/* ------------------------------------- */
/* Tag Cloud Widget Font Size
/* ------------------------------------- */

function tagcloud_settings($args){
	$args = array('smallest' => 13, 'largest' => 13, 'unit' => 'px');
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'tagcloud_settings' );

// Ago
	function time_ago( $type = 'post' ) {
	  $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	  return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago','goodweb');
	 
	}


function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}	

/* ------------------------------------- */
/* Menu Icon JS Script Actions
/* ------------------------------------- */
function menu_icon_enqueue($hook) {
    if( 'nav-menus.php' != $hook )
        return;
    wp_enqueue_script( 'goodweb_menu_icon_script', T_JS . '/menu_icons.js' );
}
add_action( 'admin_enqueue_scripts', 'menu_icon_enqueue' );

function icon_custom_walker( $args ) {
    return array_merge( $args, array(
        'walker' => new rc_scm_walker()
    ) );
}
if (has_nav_menu( 'navigation' )) add_filter( 'wp_nav_menu_args', 'icon_custom_walker' );

?>
