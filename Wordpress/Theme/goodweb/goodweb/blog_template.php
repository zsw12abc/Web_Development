<?php 	//Post ID
		global $wp_query;
		global $element_id;
		global $blog_id;
		if(empty($element_id)){
		    $content_array = $wp_query->get_queried_object();
			if(isset($content_array->ID)){
		    	$post_id = $content_array->ID;
			}
			else $post_id=$blog_id;
		}
		else{
			$post_id = $element_id;
		}
	
	global $onepager;

	$template_uri = get_template_directory_uri();
	
	//Posts per Page
		$posts_per_page = get_theme_mod("goodweb_blog-overview-add-posts",2);
		$posts_first = get_theme_mod("goodweb_blog-overview-init-posts",4);
		
		if(is_archive() || is_category()){
			$posts_first = get_option('posts_per_page');
			$posts_per_page = $posts_first;
		}
	
	//Defaults
		$categories = get_theme_mod('goodweb_blog-overview-show-categories',true);
		$excerpt_length = get_theme_mod('goodweb_blog-overview-excerpt-length',15);
		$comments = get_theme_mod('goodweb_blog-overview-show-comments',true);
		$mediaposition = get_theme_mod('goodweb_blog-overview-default-media-layout','left');
	
	//Page Options
		$pageoptions = getOptions($post_id);
	
	//Page Head Area
		if(!empty($pageoptions['goodweb_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
		}
	
?>
<section id="blogoverview" class="container blogoverview"><!-- Blogoverview -->
	<?php if($headline){ ?>
		<h2 class="module-title rotatemefromtop">
			<?php 
					if(is_category()){
						$cur_cat_id = get_cat_id( single_cat_title("",false) );
						$current_cat = get_category($cur_cat_id);
						echo __("Category","goodweb")." '".$current_cat->name."'";
					}
					elseif(is_archive()){
									if(is_tag()){ echo __('Tag Archive', 'goodweb')." '".single_tag_title(' ', false)."'"; }
									elseif(is_tax()){
										if(isset($wp_query->query_vars['taxonomy']) && taxonomy_exists($wp_query->query_vars['taxonomy'])) {
											$value    = get_query_var($wp_query->query_vars['taxonomy']);
											if (term_exists($wp_query->query_vars['term'])) {
												$term = get_term_by( 'slug', get_query_var( 'term'  ),$wp_query->query_vars['taxonomy'] );
												$htitle_cat = $term->name;
											}
										}
										echo __('Portfolio Category', 'goodweb')." ".$htitle_cat;
									}
									else echo __('Archive', 'goodweb')." ".single_month_title(' ', false);
					}				
					else echo get_the_title($post_id); 
					
			?>
		</h2>
	<?php } ?>		
		<section class="bo-posts-list" data-showatonce="<?php echo $posts_per_page; ?>" data-showfirst="<?php echo $posts_first; ?>"> <!-- LIST OF BLOGPOSTS -->
			<div class="bo-middledivider"></div>		
			<?php	$postcounter = 0;	
					
					//Custom Blog WP Query
					if(is_category()){
						$args = array('offset'=> 0,'posts_per_page'=>9999, 'cat' => $cur_cat_id );
					}
					elseif(is_archive()){
						if(is_tag()){ 
							$args = array('offset'=> 0,'posts_per_page'=>9999, 'tag_id' => get_query_var('tag_id') );	
						}
						else {
							if(is_year()){
								$args = array('offset'=> 0,'posts_per_page'=>9999, 'year' =>  get_the_date("Y")	);
							}
							else{
								$args = array('offset'=> 0,'posts_per_page'=>9999, 'monthnum' => get_the_date("m"), 'year' =>  get_the_date("Y")	);
							}
								
						}
					}
					else $args = array('offset'=> 0,'posts_per_page'=>9999);							
					
					$wp_query = new WP_Query($args);
					
					if(have_posts()) : while(have_posts()) : the_post();
						$postcounter++;		
						//Categories
						$category_links = "";
						
						//Basic Category Class (with check for loadmore)
						$category_class = $postcounter > $posts_per_page ? "dontshowmeatstart" : "";
						
						foreach((get_the_category()) as $category) {
							$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
							$category_class .= ' '.$category->slug;
						}
						$category_links = substr($category_links, 2);		
						
						//Comments
						$numOfComments = get_comments_number();
						$numOfComments_detail = $numOfComments == 0 ? __("Comments","goodweb") : $numOfComments;
						$numOfComments_detail = $numOfComments == 1 ? __("Comment","goodweb") :  __(" Comments","goodweb");	
						
						//Time
						$post_time_day = get_post_time('j', true);
						$post_time_month = get_post_time('M', true, get_the_ID(), TRUE);
						$post_time_year = get_post_time('Y', true);
						
						//Defaults/Overwrite
						$postoptions = getOptions($post->ID);
						global $excerpt_length_single;
						$excerpt_length_single = isset($postoptions["goodweb_overview_excerpts_number"]) ? $postoptions["goodweb_overview_excerpts_number"] : $excerpt_length;
						$mediaposition_single = isset($postoptions["goodweb_overview_media_position"]) ? $postoptions["goodweb_overview_media_position"] : $mediaposition;				
						//Post Format
						$postoptions["goodweb_post_type"] = isset($postoptions["goodweb_post_type"]) ? $postoptions["goodweb_post_type"] : "" ;
						if($postoptions["goodweb_post_type"]=="video" && !empty($postoptions["goodweb_force_featured_image"])) $postoptions["goodweb_post_type"] = "image";
						switch($postoptions["goodweb_post_type"]){
							case "video":
									$post_top = '<div class="bo-mediaholder fitvideo">
													<div class="be-mediasource" data-mediasrc=\''.strip_tags($postoptions["goodweb_video_iframe"],"<iframe>").'\'></div>
												</div>';
								break;
							default:
									$featuredImage = get_post_thumbnail_id($post->ID);
				        			if(!empty($featuredImage)){
				        				$blogimageurl = aq_resize(wp_get_attachment_url($featuredImage),760);
					        			$post_top = '<a href="'.get_permalink($post->ID).'">
														<div class="bo-mediaholder">							
															<div class="be-mediasource" data-mediasrc=\'<img class="bo-seomedia" src="'.$blogimageurl.'" />\'></div>
														</div>
													</a>';
				        			}
				        			else { 
				        				$post_top = "";
				        			}
								break;
						}
						//Class for Fullwidth posts with no media
						$nomedia = empty($post_top) ? "nomedia" : "";
			?>
						<!-- A BLOG POST -->
						<article <?php post_class(array("bo-post","bo-".$mediaposition_single,$nomedia)); ?> data-day="<?php echo $post_time_day;?>" data-month="<?php echo $post_time_month;?>" data-year="<?php echo $post_time_year; ?>">
							<?php if($mediaposition_single!="bottom") echo $post_top; ?>
							<div class="bo-details">
								<?php if($categories){ ?><p class="bo-category"><?php echo $category_links; ?></p><?php } ?>
									<a href="<?php the_permalink(); ?>"><h3 class="bo-title"><?php the_title(); ?></h3></a>
								<?php if($excerpt_length_single > 0){ ?>
									<div class="excerpt">
										<?php
											//Modify the length of the_excerpt
											add_filter('excerpt_length', 'new_excerpt_length');
											the_excerpt();
										?>
									</div>
								<?php } ?>
								<?php if($comments && comments_open()){ ?>
									<div class="contentdivider-mini-blog"></div>
									<a href="<?php the_permalink(); ?>#comments"><p class="bo-comments"><strong><?php echo $numOfComments; ?></strong> <?php echo $numOfComments_detail;?></p></a>
									<a href="<?php the_permalink(); ?>"><icon class="icon-forward bo-forward"></icon></a>
								<?php } ?>
								<div class="clear"></div>						
							</div>
							<?php if($mediaposition_single=="bottom") echo $post_top; ?>
							<div class="clear"></div>
						</article>
						<!-- END OF A BLOG POST-->
			<?php endwhile; 
			endif; ?>
		</section><!-- END OF THE LIST OF BLOG POSTS -->
</section><!-- END OF BLOG OVERVIEW-->
<div class="clear"></div>