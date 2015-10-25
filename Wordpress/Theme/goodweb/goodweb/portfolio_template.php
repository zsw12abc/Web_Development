<?php
	global $wp_query;
	global $element_id;
	if(empty($element_id)){
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;
	}
	else{
		$post_id = $element_id;
	}
	
	global $onepager;

	global $wp_session;
	
	$wp_session["portfolio"] = $post_id;
	wp_session_commit();
	
	$template_uri = get_template_directory_uri();

	//Page Options
		$pageoptions = getOptions($post_id);	

	//Page Head Area
		if(!empty($pageoptions['goodweb_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
		}
	
	//Sidebar
		$pageoptions["goodweb_sidebar"] = isset($pageoptions["goodweb_sidebar"]) ? $pageoptions["goodweb_sidebar"] : "nosidebar";
		$container_class = $pageoptions["goodweb_sidebar"]!="nosidebar" ? "withsidebar" : "boxedbg";

	//Portfolio Page Options	
		//Posts per Page
		$posts_per_page = empty($pageoptions["goodweb_project_per_page"]) ? 8 : $pageoptions["goodweb_project_per_page"];
		
		//Portfolio Columns
		$pageoptions["goodweb_portfolio_columns"] = empty($pageoptions["goodweb_portfolio_columns"]) ? "fourcolumn" : $pageoptions["goodweb_portfolio_columns"];
		
		//Portfolio Categories 
		$categories = empty($pageoptions["goodweb_portfolio_categories"]) ? "" : implode(",", $pageoptions["goodweb_portfolio_categories"]);
		$categories = $categories == "all" ? "" : $categories;

		//Overview Image Size
		$pageoptions["goodweb_page_portfolio_img_height"] = empty($pageoptions["goodweb_page_portfolio_img_height"]) ? "320" : $pageoptions["goodweb_page_portfolio_img_height"];

		//Portfolio Page Content
		$pageoptions["goodweb_portfolio_content_display"] = isset($pageoptions["goodweb_portfolio_content_display"]) ? $pageoptions["goodweb_portfolio_content_display"] : "above";
		
		//Portfolio Punchbox Data
		$pageoptions["goodweb_portfolio_lightbox_active"] = isset($pageoptions["goodweb_portfolio_lightbox_active"]) ? true : false;
		$pageoptions["goodweb_portfolio_lightbox_autoplay_active"] = isset($pageoptions["goodweb_portfolio_lightbox_autoplay_active"]) ? true : false;
		$pageoptions["goodweb_portfolio_lightbox_autoplay_delay"] = empty($pageoptions["goodweb_portfolio_lightbox_autoplay_delay"]) ? 5000 : $pageoptions["goodweb_portfolio_lightbox_autoplay_delay"]*1000;
		if($pageoptions["goodweb_portfolio_lightbox_active"] && $pageoptions["goodweb_portfolio_lightbox_autoplay_active"]) {
			$autoplay = 'data-autoplay="enabled" data-autoplaydelay="'.$pageoptions["goodweb_portfolio_lightbox_autoplay_delay"].'"';
		}
		else $autoplay = "";
			
	//HighlightColor
		$themeoptions["goodweb_highlight_color"] = get_theme_mod( 'goodweb_highlight-color', '#ff0036' );

	//Page Box
		if(empty($pageoptions['goodweb_show_box'])){
			$boxed = "boxedbg";
			$fluid = "-fluid";
		}
		else{
			 $boxed = "";
			 $fluid = "";
		}
		
		$container_class = $boxed;
		
		$content = get_page($post_id); $content = $content->post_content;

	get_header();
?>
		<!--THE MEDIA WALL MODULE-->
		<section class="mediawall container slidemefrombottom" <?php echo $autoplay; ?> id="portfoliooverview">
		<?php if($headline){ ?>	
			<h2 class="module-title "><?php echo get_the_title($post_id); ?></h2>
		<?php } ?>

			<?php if($pageoptions["goodweb_portfolio_content_display"] == "above" && !empty($content) ){?>
				<section class="container <?php echo $container_class; ?> portfoliocontent_top"> <!-- Start Container -->
					<section class="row<?php echo $fluid; ?>">
						<?php echo apply_filters('the_content',$content); ?>
					</section>
				</section>
			<?php }  ?>

			<article class="mediawall-filter-wrapper slidemefrombottom">
				<ul class="mediawall-filters">
					<?php $tax_terms = get_terms("category_portfolio"); 
						if((is_array($tax_terms) && !isset($pageoptions["goodweb_portfolio_categories"])) || ((isset($pageoptions["goodweb_portfolio_categories"]) && in_array("all", $pageoptions["goodweb_portfolio_categories"]))) || ((isset($pageoptions["goodweb_portfolio_categories"]) && sizeof($pageoptions["goodweb_portfolio_categories"])>1))){
					?>
						<li><a class="mediawall-filter selected" href="#" data-filter="allitem"><?php _e("ALL","goodweb"); ?></a></li>
				        <?php 
					       if (empty($categories) || in_array("all", $pageoptions["goodweb_portfolio_categories"]) ){
								foreach($tax_terms as $tax_term){	
									echo '<li><a class="mediawall-filter"  data-filter="'.$tax_term->slug.'">'.$tax_term->name.'</a></li>';
								}
							} elseif(sizeof($pageoptions["goodweb_portfolio_categories"])>0){
									foreach($pageoptions["goodweb_portfolio_categories"] as $category){
										$term = get_term_by('slug',$category,'category_portfolio');
										echo '<li><a href="#" class="mediawall-filter" data-filter="'.$term->slug.'">'.$term->name.'</a></li>';
									}
								} 
				        ?>
			        <?php } ?>
				</ul>
				<div class="clear"></div>
			</article>

			<article class="mediawall-gallery  " data-maxshownitems="<?php echo $posts_per_page; ?>">
				<?php $args = array( 
										'posts_per_page' => 999999, 
										'offset'=> 0,
										'post_type' => 'portfolio',
										'category_portfolio' => $categories
								);
					$wp_query = new WP_Query($args);
				
					//The Loop
						if(have_posts()) : 
							while(have_posts()) : the_post();
							
							//Categories
							$category_slugs = array();
							$category_names = array();
							
							foreach(wp_get_post_terms($post->ID, 'category_portfolio') as $category) {
								$category_slugs[] = $category->slug;
								$term_link = get_term_link( $category, 'category_portfolio' );
								$category_names[] = '<a href="'.$term_link.'" class="mediawall-category">'.$category->name."</a>";
							}	
							$featuredImage = get_post_thumbnail_id($post->ID);
							if(!empty($featuredImage)){
								if(empty($pageoptions["goodweb_page_portfolio_img_height"])) $pageoptions["goodweb_page_portfolio_img_height"] = 444;
								
								$blogimageurl = aq_resize(wp_get_attachment_url($featuredImage),585,$pageoptions["goodweb_page_portfolio_img_height"],true);
								
								$blogimageurl_lb = wp_get_attachment_url($featuredImage);
							}
							
							//Lightbox
							$postoptions = getOptions($post->ID);
							if(($pageoptions["goodweb_portfolio_lightbox_active"])){
								if(isset($postoptions["goodweb_post_type"]) && $postoptions["goodweb_post_type"]=="video"){
									$video_iframe = $postoptions["goodweb_video_iframe"];
									preg_match('/src="(.*?)"/', $video_iframe, $src); 
									$video_url = $src[1];
									preg_match('/height="(.*?)"/', $video_iframe, $src); 
									$video_height = $src[1];
									preg_match('/width="(.*?)"/', $video_iframe, $src); 
									$video_width = $src[1];
									$icon_lightbox = '<li class="mediawall-lightbox notalone"><a class="punchbox" data-ref="'.$video_url.'" data-rel="group" data-title="'.get_the_title().'" data-meta="'.excerpt(20).'" data-width="'.$video_width.'" data-height="'.$video_height.'" data-type="iframe"><i class="icon-search"></i></a></li>';
								}
								else {
									if(!empty($blogimageurl_lb)) $icon_lightbox = '<li class="mediawall-lightbox notalone"><a class="punchbox" data-ref="'.$blogimageurl_lb.'" data-rel="group" data-title="'.get_the_title().'" data-meta="'.excerpt(20).'"><i class="icon-search"></i></a></li>';
								}
							}
							else $icon_lightbox="";
				?>
							
							<div class="<?php echo $pageoptions["goodweb_portfolio_columns"]; ?> item <?php echo implode(" ",$category_slugs);?> ">
								<!-- THE MEDIA ITSELF -->
								<div class="mediawall-mediacontainer"><img src="<?php echo $blogimageurl;?>" alt=""/>
									<div class="mediawall-overlay"></div>
								</div><!-- END OF MEDIA -->
								
								<!-- HOVER BUTTONS -->
								<ul>
									<?php echo $icon_lightbox; ?>
									<li class="mediawall-link notalone"><a href="<?php the_permalink(); ?>"><i class="icon-forward"></i></a></li>
								</ul>
			
								<!-- THE CONTENT ON THE MEDIA -->
								<div class="mediawall-content photography ">
									<a href="<?php the_permalink(); ?>"><h4 class="mediawall-title txtshadow"><?php the_title(); ?></h4></a>
									<div class="mediawall-categories">
									  <?php echo implode(", ",$category_names); ?>
									</div>
								</div>
								<!-- END OF CONTENT OF THE MEDIA -->
							</div>
				<?php	
			    		endwhile;  //have_posts 	
				   endif;
				?>
				 <?php wp_reset_query(); ?>
			</article>
		</section><!-- END OF MEDIA WALL MODULE-->
		<?php if($pageoptions["goodweb_portfolio_content_display"] == "below" && !empty($content)){ ?> 
				<section class="container <?php echo $container_class; ?> portfoliocontent_bottom"> <!-- Start Container -->
					<section class="row<?php echo $fluid; ?>">
						<?php echo apply_filters('the_content',$content); ?>
					</section>
				</section> 
			<?php } ?>