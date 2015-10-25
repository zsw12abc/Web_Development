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


	$_SESSION['portfolio'] = $post_id;
		
	$template_uri = get_template_directory_uri();

	//Page Options
		$pageoptions = getOptions($post_id);	

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
			
	//HighlightColor
		$themeoptions["goodweb_highlight_color"] = get_theme_mod( 'goodweb_highlight-color', '#ff0036' );

	get_header();
?>
		<!--THE MEDIA WALL MODULE-->
		<section class="mediawall container slidemefrombottom" id="portfoliooverview">
		<h2 class="module-title "><?php 	
											if(isset($wp_query->query_vars['taxonomy']) && taxonomy_exists($wp_query->query_vars['taxonomy'])) {
												$value    = get_query_var($wp_query->query_vars['taxonomy']);
												if (term_exists($wp_query->query_vars['term'])) {
													$term = get_term_by( 'slug', get_query_var( 'term'  ),$wp_query->query_vars['taxonomy'] );
													$htitle_cat = $term->name;
												}
											}
											echo __('Portfolio ', 'goodweb')." '".$htitle_cat."'"; ?>
									</h2>
		
			<article class="mediawall-gallery  " data-maxshownitems="<?php echo $posts_per_page; ?>">
				<?php if(is_tag()){ 
						$args = array( 
								'posts_per_page' => 999999, 
								'offset'=> 0,
								'post_type' => 'portfolio',
								'tag_id' => get_query_var('tag_id')
						);
					}
					else{
						$args = array( 
								'posts_per_page' => 999999, 
								'offset'=> 0,
								'post_type' => 'portfolio',
								'category_portfolio' => get_query_var( 'term'  )
						);
					}
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
							if(isset($pageoptions["goodweb_portfolio_lightbox_active"])){
								if(isset($postoptions["goodweb_post_type"]) && $postoptions["goodweb_post_type"]=="video"){
									$video_iframe = $postoptions["goodweb_video_iframe"];
									preg_match('/src="(.*?)"/', $video_iframe, $src); 
									$video_url = $src[1];
									preg_match('/height="(.*?)"/', $video_iframe, $src); 
									$video_height = $src[1];
									preg_match('/width="(.*?)"/', $video_iframe, $src); 
									$video_width = $src[1];
									$icon_lightbox = '<li class="mediawall-lightbox notalone"><a class="punchbox" data-ref="'.$video_url.'" data-rel="group" data-title="'.get_the_title().'" data-meta="'.excerpt(10).'" data-width="'.$video_width.'" data-height="'.$video_height.'" data-type="iframe"><i class="icon-search"></i></a></li>';
								}
								else {
									if(!empty($blogimageurl_lb)) $icon_lightbox = '<li class="mediawall-lightbox notalone"><a class="punchbox" data-ref="'.$blogimageurl_lb.'" data-rel="group" data-title="'.get_the_title().'" data-meta="'.excerpt(10).'"><i class="icon-search"></i></a></li>';
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
									  <?php echo implode(",",$category_names); ?>
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