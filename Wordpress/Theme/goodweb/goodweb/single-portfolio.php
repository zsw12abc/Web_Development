<?php
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();
	
	global $wp_session;
	
	//Parent Portfolio
			$customizer_link = (get_theme_mod("goodweb_portfolio-parent",""));
			$customizer_link = !empty($customizer_link) ? get_permalink($customizer_link) : get_home_url();
			$parent_link = !empty($wp_session["portfolio"]) && !get_theme_mod("goodweb_portfolio-detail-show-back-force",0) ? get_permalink($wp_session["portfolio"]) : $customizer_link;
			$wp_session["portfolio"] = get_theme_mod("goodweb_portfolio-detail-show-back-force",0) ? "" : $wp_session["portfolio"];
			
			if(!empty($wp_session["portfolio"])){
				$excluded_categories = get_excluded_portfolio_categories($wp_session["portfolio"]);
			}
			else {
				$category_slugs = array();
				$category_names = array();
				
				foreach(wp_get_post_terms($post->ID, 'category_portfolio') as $category) {
					$category_names[] = $category->slug;
				}
				$excluded_categories = all_taxonomies_but($category_names);
			}
			$prev_post =  get_adjacent_portfolio_post( false, $excluded_categories,false );
			if($prev_post) : 
				$prev_id = $prev_post->ID;
				$prev_title = $prev_post->post_title;
				$prev_link = get_permalink($prev_id);
				$prev_button = '<a href="'.$prev_link.'" title="'.$prev_title.'" class="mediawall-filter" >'.__("PREVIOUS","goodweb").'</a>';
			else:
				$prev_button = "";
			endif; 
	
			$next_post = get_adjacent_portfolio_post( false, $excluded_categories ,true );
			if($next_post) : 
				$next_id = $next_post->ID;
				$next_title = $next_post->post_title;
				$next_link = get_permalink($next_id);
				$next_button = '<a href="'.$next_link.'" title="'.$next_title.'" class="mediawall-filter ml7" >'.__("NEXT","goodweb").'</a>';
				else:
					$next_button = "";
			endif; 
			
		
	//Page Options
		$postoptions = getOptions();	

	//Page Head Area
		if(isset($postoptions['goodweb_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
			$pagetitle = get_the_title($post_id);
			$pagetitle_over = get_theme_mod("goodweb_portfolio-detail-title","");
			$pagetitle = empty($pagetitle_over) ? $pagetitle :  $pagetitle_over;
			$pagetitle = empty($postoptions['goodweb_page_title']) ? $pagetitle : $postoptions['goodweb_page_title'];
		}
	
	//Defaults
		$categories = get_theme_mod('goodweb_portfolio-detail-show-categories',true);
		$author = get_theme_mod('goodweb_portfolio-detail-show-author',true);
		$date = get_theme_mod('goodweb_portfolio-detail-show-date',true);
		$tags = get_theme_mod('goodweb_portfolio-detail-show-tags',false);
		$tags = false;
		
		$categories = isset($postoptions["goodweb_portfolio_detail_activate_categories"]) ? false : $categories;
		$author = isset($postoptions["goodweb_portfolio_detail_activate_author"]) ? false : $author;
		$date = isset($postoptions["goodweb_portfolio_detail_activate_date"]) ? false : $date;
		$tags = isset($postoptions["goodweb_portfolio_detail_activate_tags"]) ? false : $tags;

	get_header();
?>

<?php
	if(have_posts()) : 
    	while(have_posts()) : the_post();
			//Categories
			$category_links = "";
			$category_links = ( get_the_term_list($post->ID, 'category_portfolio','',', ') );
			
			//Comments
			$numOfComments = get_comments_number();
			$numOfComments_detail = $numOfComments == 0 ? __("Comments","goodweb") : $numOfComments;
			$numOfComments_detail = $numOfComments == 1 ? __("Comment","goodweb") :  __(" Comments","goodweb");	
			
			//Author
			ob_start();
			the_author_posts_link();
			$author_link = ob_get_contents();
			ob_end_clean();	
			
			//Post Format
			$postoptions["goodweb_post_type"] = isset($postoptions["goodweb_post_type"]) ? $postoptions["goodweb_post_type"] : "" ;
			switch($postoptions["goodweb_post_type"]){
				case "video":
						if(!empty($postoptions["goodweb_video_iframe"])) $post_top = '<div class="blog-media-holder fitvideo">'.strip_tags($postoptions["goodweb_video_iframe"],"<iframe>").'</div>';
						else $post_top = "";
					break;
				case "image":
						$featuredImage = get_post_thumbnail_id($post->ID);
	        			if(!empty($featuredImage)){
	        				$blogimageurl = aq_resize(wp_get_attachment_url($featuredImage),1170);
		        			$post_top = '<div class="blog-media-holder"><img alt="" src="'.$blogimageurl.'"></div>';
	        			}
	        			else { 
	        				$post_top = "";
	        			}
					break;
				case 'slider':
							/*if(get_revslider_property($postoptions["tb_glisseo_slider"],'slider_type')=="fullwidth")
								echo '<style>.featured .fullwidthabanner{height:'.get_revslider_property($postoptions["tb_glisseo_slider"],'height').'px;}</style>'; 
							*/
							$post_top = do_shortcode('[rev_slider '.$postoptions["goodweb_slider"].']');
										break;
				default:
					$post_top = "";
			}
?>
	<!-- THE PREV AND NEXT BUTTON FOR SWAPPING BETWEEN PORTFOLIOS -->
	<section class="container portfolio-navigation onfullwidth">
		<?php if(get_theme_mod("goodweb_portfolio-detail-show-back","true")){?>
			<div class="pull-left">
				<a class="mediawall-filter hidden-phone" href="<?php echo $parent_link;?>"><?php _e("Portfolio Overview","goodweb");?></a>
				<a class="mediawall-filter visible-phone icon-layout arrowoverview" href="<?php echo $parent_link;?>"></a>
			</div>
		<?php } ?>
		<?php if(get_theme_mod("goodweb_portfolio-detail-show-nextprev","true")){?>
			<div class="pull-right">
				<?php echo $prev_button; ?>
				<?php echo $next_button; ?>
			</div>
		<?php } ?>	
		<div class="clear"></div>
	</section>
	
	<?php if(!isset($postoptions["goodweb_overview_media_position"]) || $postoptions["goodweb_overview_media_position"]=="top") { ?>
		<!-- THE SINGLE POST CONTENT -->
		<article class="blog-single-post">
			<section class="container onfullwidth">
				<?php echo $post_top;?>
			</section>
			<section class="container boxedbg">
				<?php if($date){ ?><span class="blog-date"><?php echo get_the_date(); ?></span><?php } ?>
				<?php if($author){ ?><span class="blog-author"><?php echo __('by','goodweb').' '.$author_link; ?></span><?php } ?>
				<?php if($categories){ ?><span class="blog-category bo-last"><?php echo $category_links; ?></span><?php } ?>
				<h2 class="blog-title"><?php the_title();?></h2>
				<?php the_content(); ?>
				<?php if(has_tag() && $tags){?>
					<p class="blog-tagged"><strong><?php _e("tagged:","goodweb"); echo "</strong> "; echo the_tags('<span class="blog-tag bo-last">', ', ', '</span>'); ?></p>
				<?php } ?>
				<div class="clear"></div>
				<?php if(comments_open()) { ?><div class="contentdivider-mini"></div><a href="#comments"><p class="blog-comments"><strong><?php echo $numOfComments; ?></strong> <?php echo $numOfComments_detail;?></p></a><?php } ?>
			</section>
		</article>
		<!-- END OF THE SINGLE POST CONTENT -->
	<?php } else {?>
		<article class="container onfullwidth">	
			<section class="halfhalf">
				<?php echo $post_top;?>
			</section>
			<section class="halfhalf boxedbg">
				<?php if($date){ ?><span class="blog-date"><?php echo get_the_date(); ?></span><?php } ?>
					<?php if($author){ ?><span class="blog-author"><?php echo __('by','goodweb').' '.$author_link; ?></span><?php } ?>
					<?php if($categories){ ?><span class="blog-category bo-last"><?php echo $category_links; ?></span><?php } ?>
					<h2 class="blog-title"><?php the_title();?></h2>
					<?php the_content(); ?>
					<?php if(has_tag() && $tags){?>
						<p class="blog-tagged"><strong><?php _e("tagged:","goodweb"); echo "</strong> "; echo the_tags('<span class="blog-tag bo-last">', ', ', '</span>'); ?></p>
					<?php } ?>
					<div class="clear"></div>
					<?php if(comments_open()) { ?><div class="contentdivider-mini"></div><a href="#comments"><p class="blog-comments"><strong><?php echo $numOfComments; ?></strong> <?php echo $numOfComments_detail;?></p></a><?php } ?>
			</section>
		</article>
	<?php } ?>
		
		<!— RELATED POSTS —>		
		<?php if(shortcode_exists("showbiz") && get_theme_mod( 'goodweb_related-portfolio',false)) :
				$my_terms = get_the_terms( $post->ID, ‘portfolio’ );
				$taxonomy = array();
				if( $my_terms && !is_wp_error( $my_terms ) ) {
  				  foreach( $my_terms as $term ) {
     				   $taxonomy[]= $term->slug; break;
 				   }
				}
				$taxonomy = join(“,”,$taxonomy);
		?>
		
			<article class="related-posts">

				<div class="boxedbg-title container">
					<h4 class="pull-left"><?php echo __("Related Projects","goodweb"); ?></h4>
					<div class="showbiz-navigation sb-nav-goodweb pull-right">
						<a id="showbiz_left_2" class="sb-navigation-left"><i class="sb-icon-left-open"></i></a>
						<a id="showbiz_right_2" class="sb-navigation-right"><i class="sb-icon-right-open"></i></a>
						<div class="sbclear"></div>
					</div> <!-- END OF THE NAVIGATION -->
				</div>
				<article id="showbiz-teaser-2" class="container mediawallshowbiz onfullwidth">
												
					<!--	THE PORTFOLIO ENTRIES	-->
					<div class="showbiz" data-left="#showbiz_left_2" data-right="#showbiz_right_2" data-play="#showbiz_play_2">
	
						<!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
						<div class="overflowholder">
							<!-- LIST OF THE ENTRIES -->
							<ul>
							<?php 
									$cat = "";
									
									$args=array(
										'category_portfolio' => $taxonomy,
										'post__not_in' => array($post->ID),
										'ignore_sticky_posts'=>1,
										'post_type' => 'portfolio',
										'posts_per_page' => '10'
									);
																		
								$temp = $wp_query; 
								$my_query = new wp_query($args);
								if( $my_query->have_posts() ) {						
							?>						
							<?php
								while ($my_query->have_posts()) {
									$my_query->the_post();
									$postcustoms = getOptions($post->ID);
									$blogimageurl_lb = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
									$blogimageurl = aq_resize($blogimageurl_lb,640,360,true);
									$the_title = get_the_title();
									$the_title = strlen($the_title)>25 ? trim(substr($the_title, 0, 25))."..." : $the_title;
									
									//Categories
									$category_slugs = array();
									$category_names = array();
									
									foreach(wp_get_post_terms($post->ID, 'category_portfolio') as $category) {
										$category_slugs[] = $category->slug;
										$term_link = get_term_link( $category, 'category_portfolio' );
										$category_names[] = '<a href="'.$term_link.'" class="mediawall-category">'.$category->name."</a>";
									}
									//Lightbox
									$postoptions = getOptions($post->ID);
										$postoptions["goodweb_post_type"] = isset($postoptions["goodweb_post_type"]) ? $postoptions["goodweb_post_type"] : 'image';
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
										$lightbox_active = get_theme_mod("goodweb_related-portfolio-lightbox","");
										if((empty($lightbox_active) || $lightbox_active == "false") && $lightbox_active != 1) $icon_lightbox = "";
										
							?>								
									<li class="sb-goodweb-mediawall-skin">
										<!-- THE MEDIA ITSELF -->
										<div class="mediawall-mediacontainer"><img src="<?php echo $blogimageurl;?>" alt=""/>
											<div class="mediawall-overlay"></div>
											<!--ul>
												<?php echo $icon_lightbox;?>
												<li class="mediawall-link notalone"><a href="<?php the_permalink(); ?>"><i class="icon-forward"></i></a></li>
											</ul-->
										</div><!-- END OF MEDIA -->
					
										<!-- THE CONTENT ON THE MEDIA -->
										<div class="mediawall-content photography ">
											<a href="<?php the_permalink(); ?>"><h4 class="mediawall-title txtshadow"><?php echo $the_title;?></h4></a>
											<div class="mediawall-categories">
											  	<?php echo implode(",",$category_names); ?>
											</div>
											<div class="clear"></div>
					
										</div><!-- END OF CONTENT OF THE MEDIA -->
									</li>						 
							<?php
							}
								$wp_query = null; 
								$wp_query = $temp;
								wp_reset_query();
						 ?>
						<?php } //if have_posts()
				//endif; //if related posts		
				?>
	</ul>
							<div class="sbclear"></div>
						</div> <!-- END OF OVERFLOWHOLDER -->
						<div class="sbclear"></div>
					</div>
				</aricle><!-- END OF THE SHOWBIZ CONTAINER -->
		
				<script type="text/javascript">
				jQuery(document).ready(function() {

					jQuery('#showbiz-teaser-2').showbizpro({
						dragAndScroll:"off",
						visibleElementsArray:[4,3,2,1],
						carousel:"on",
						entrySizeOffset:0,
						allEntryAtOnce:"off",
						rewindFromEnd:"off",
						autoPlay:"off",
						delay:2000,						
						speed:700,						
						easing:'Power3.easeOut'
					});

				});
				</script>
		
	</article><!-- END OF THE RELATED POSTS -->
	<?php comments_template('', true); ?>
	
	<?php endif; endwhile; endif; ?>
<?php get_footer(); ?>