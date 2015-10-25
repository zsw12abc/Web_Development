<?php
/*
Template Name: OnePage
*/
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

	//Page Options
		$pageoptions = getOptions();	
		
	//Theme Options	
		$themeoptions = getThemeOptions(); 

	//Page Head Area
		if(!empty($pageoptions['goodweb_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
		}

	get_header();
?>

  <div class="onepagecontent">		
	  <?php if(have_posts()) : 
		    	while(have_posts()) : the_post();	
		    	if (empty($pageoptions["goodweb_header_slider"])) echo '<section id="home" class="first">';	
		    		the_content();	
		    	if (empty($pageoptions["goodweb_header_slider"])) echo '</section>';
		    	endwhile;  //have_posts 
		    	
	   endif;?> 
	  <?php  
	  	$locations = get_registered_nav_menus();
		$menus = wp_get_nav_menus();
		$menu_locations = get_nav_menu_locations();
		
		$location_id = 'navigation';
		if (isset($menu_locations[ $location_id ])) {
			foreach ($menus as $menu) {
				if ($menu->term_id == $menu_locations[ $location_id ]) {
					$menu_obj = $menu->term_id;
					break;
				}
			}
		} else {
			// The location that you're trying to search doesn't exist
		}

	  	if(isset($menu_obj)){
			$menu_items = wp_get_nav_menu_items( $menu_obj);
			global $firstitem;
			global $onepager;
			global $lastboxer;
			global $boxers;
			$onepager = 1;
			
			$firstitem = true;
			$pageoptions["goodweb_page_background_type"] = isset($pageoptions["goodweb_page_background_type"]) ? $pageoptions["goodweb_page_background_type"] : 'default';
			if(((empty($pageoptions["goodweb_page_background_type"]) || ($pageoptions["goodweb_page_background_type"] == "default" && get_theme_mod("goodweb_background-type")!="slider")) && $pageoptions["goodweb_page_background_type"] != "slider") ){
				$first_without_slider = true;
			}
			else {
				$first_without_slider = false;
			}

			
			$lastboxer = "";
			$boxers = "";
			foreach ( (array) $menu_items as $key => $menu_item ) {
				global $firstitem;
				if ($menu_item->type == "post_type") {
					$pageoptions = getOptions($menu_item->object_id);
					$headliner = get_post_meta( $menu_item->object_id , 'goodweb_activate_page_title', true );
					$boxers = get_post_meta( $menu_item->object_id , 'goodweb_show_box', true );
					$boxers = empty($boxers) ? "inboxed" : "" ;
					//TEMPLATE CONTENTS
					$template_name = get_post_meta( $menu_item->object_id , '_wp_page_template', true );
					$content = "";
					global $element_id;
					global $pagecontent;
					$element_id = $menu_item->object_id;
					if(empty($menu_item->subtitle)){
						switch($template_name){
							case 'index.php':
									if(!$firstitem) echo '<div class="modulespacer"></div>';
									echo '<section id="'.str_replace('%','',sanitize_title($menu_item->title)).'"><!-- Start ID -->';
									get_template_part( 'blog_template' );
									$lastboxer = "";
									break;
							case 'portfolio.php':
									if(!$firstitem) echo '<div class="modulespacer"></div>';
									echo '<section id="'.str_replace('%','',sanitize_title($menu_item->title)).'"><!-- Start ID -->';
									get_template_part( 'portfolio_template' );
									$lastboxer = "";
									break;
							default:
									if((!$firstitem && (empty($boxers) || empty($lastboxer)) || (empty($headliner))) && !$first_without_slider) echo '<div class="modulespacer"></div>';
									if(empty($headliner)){ //if "no headline" is NOT selected
										echo '<section id="'.str_replace('%','',sanitize_title($menu_item->title)).'"><!-- Start ID -->';
									}
									else{ // "no headline" is selected
										echo '<section class="noheadline '.$boxers.'" id="'.str_replace('%','',sanitize_title($menu_item->title)).'"><!-- Start ID -->';
									}
									$firstitem = false;
									$first_without_slider = false;
									$pagecontent =  str_replace('id="fbuilder_content','class="fbuilder_content',str_replace('id="fbuilder_content_wrapper','class="fbuilder_content_wrapper',str_replace('id="fbuilder_wrapper"','class="fbuilder_wrapper"',wpautop(get_post_field('post_content', $menu_item->object_id)))));
									get_template_part('page_template');
									$lastboxer = $boxers;
									break;
									echo "</section>";
						}
					echo $content."
					</section> <!-- End ID -->";
					}
			    }
			}
		}
		?>   	 
      <div class="clear"></div>
    </div>
    <style>
    	#wp-admin-bar-fbuilder_edit, #fbuilder_wrapper.empty {display: none}
    </style>
    <!-- End Inner --> 
  <?php get_footer(); ?>