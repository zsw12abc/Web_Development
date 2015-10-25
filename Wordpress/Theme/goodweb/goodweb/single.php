<?php
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

	//Page Options
		$postoptions = getOptions();	

	//Page Head Area
		$pagetitle = get_the_title($post_id);
		if(isset($postoptions['goodweb_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
			$pagetitle_over = get_theme_mod("goodweb_blog-detail-title","");
			$pagetitle = empty($pagetitle_over) ? $pagetitle :  $pagetitle_over;
			$pagetitle = empty($postoptions['goodweb_page_title']) ? $pagetitle : $postoptions['goodweb_page_title'];

		}
	
	//Sidebar
		$postoptions["goodweb_sidebar"] = !empty($postoptions["goodweb_sidebar"]) ? $postoptions["goodweb_sidebar"] : "nosidebar";
		if($postoptions["goodweb_sidebar"]=="nosidebar"){
			if(get_theme_mod("goodweb_blog-post-sidebar","nosidebar") != "nosidebar" && get_theme_mod("goodweb_blog-post-sidebar")!="") $postoptions["goodweb_sidebar"] = get_theme_mod("goodweb_blog-post-sidebar","nosidebar");
		}
		
		$container_class = $postoptions["goodweb_sidebar"]!="nosidebar" ? "withsidebar" : "boxedbg";
		
		
	
	//Defaults
		$categories = get_theme_mod('goodweb_blog-detail-show-categories',true);
		$author = get_theme_mod('goodweb_blog-detail-show-author',true);
		$date = get_theme_mod('goodweb_blog-detail-show-date',true);
		$tags = get_theme_mod('goodweb_blog-detail-show-tags',true);
		
		$categories = isset($postoptions["goodweb_detail_activate_categories"]) ? false : $categories;
		$author = isset($postoptions["goodweb_detail_activate_author"]) ? false : $author;
		$date = isset($postoptions["goodweb_detail_activate_date"]) ? false : $date;
		$tags = isset($postoptions["goodweb_detail_activate_tags"]) ? false : $tags;

	get_header();
?>

<!-- START OF THE MAIN CONTENT CONTAINER -->

<?php
	if(have_posts()) : 
    	while(have_posts()) : the_post();	
			//Categories
			$category_links = "";
			
			foreach((get_the_category()) as $category) {
				$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
			}				
			$category_links = substr($category_links, 2);
			
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
	
	<?php if($postoptions["goodweb_sidebar"]!="nosidebar"){ ?>	
		<section class="container withsidebar">
			<section class="row">		
				<section class="span9">
	<?php } ?>
	
	<!-- THE SINGLE POST CONTENT -->
	<article class="blog-single-post">
		<section class="container onfullwidth">
			<?php echo $post_top;?>
		</section>
		<section class="container boxedbg">
			<?php if($date){ ?><span class="blog-date"><?php echo get_the_date(); ?></span><?php } ?>
			<?php if($author){ ?><span class="blog-author"><?php echo __('by','goodweb').' '.$author_link; ?></span><?php } ?>
			<?php if($categories){ ?><span class="blog-category bo-last"><?php echo $category_links; ?></span><?php } ?>
			<?php if($headline) { ?><h2 class="blog-title"><?php the_title();?></h2><?php } ?>
			<?php the_content(); ?>
			<?php if(has_tag() && $tags){?>
				<p class="blog-tagged"><strong><?php _e("tagged:","goodweb"); echo "</strong> "; echo the_tags('<span class="blog-tag bo-last">', ', ', '</span>'); ?></p>
			<?php } ?>
			<?php $args2 = array(
											'before'           => '<p class="blog-tagged">' . __('<strong>Pages:</strong>','goodweb'),
											'after'            => '</p>',
											'link_before'      => '',
											'link_after'       => '',
											'next_or_number'   => 'number',
											'nextpagelink'     => __('Next page','tb_mebpo'),
											'previouspagelink' => __('Previous page','tb_mebpo'),
											'pagelink'         => '%',
											'echo'             => 1
										); ?>
			<?php wp_link_pages( $args2 ); ?>
			<div class="clear"></div>
			<?php if(comments_open()) { ?><div class="contentdivider-mini"></div><a href="#comments"><p class="blog-comments"><strong><?php echo $numOfComments; ?></strong> <?php echo $numOfComments_detail;?></p></a><?php } ?>
		</section>
	</article>
	<!-- END OF THE SINGLE POST CONTENT -->
	
	
	
	<!-- RELATED POSTS -->		
		<?php if(shortcode_exists("showbiz") && get_theme_mod( 'goodweb_related-posts',false)) : ?>
			<article class="related-posts">

				<div class="boxedbg-title container">
					<h4 class="pull-left"><?php echo __("Related Posts","goodweb"); ?></h4>
					<div class="showbiz-navigation sb-nav-goodweb pull-right">
						<a id="showbiz_left_1" class="sb-navigation-left"><i class="sb-icon-left-open"></i></a>
						<a id="showbiz_play_1" class="sb-navigation-play"><i class="sb-icon-play sb-playbutton"></i><i class="sb-icon-pause sb-pausebutton"></i></a>					
						<a id="showbiz_right_1" class="sb-navigation-right"><i class="sb-icon-right-open"></i></a>
						<div class="sbclear"></div>
					</div> <!-- END OF THE NAVIGATION -->
				</div>
				<article id="showbiz-teaser-1" class="boxedbg container">
												
					<!--	THE PORTFOLIO ENTRIES	-->
					<div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1">
	
						<!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
						<div class="overflowholder">
							<!-- LIST OF THE ENTRIES -->
							<ul>
							<?php 
								$tags = wp_get_post_tags($post->ID);
					   			if(get_theme_mod( 'goodweb_related-posts-type','category') == "tags" && $tags){
					        		$tag_ids = array();	        		
									foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
									$args=array(
										'tag__in' => $tag_ids,
										'post__not_in' => array($post->ID),
										//'showposts'=> $columns, 
										'ignore_sticky_posts'=>1,
									);
								}
								else {
									$cat = "";
									foreach((get_the_category()) as $category) { 
									    $cat .= ",".$category->cat_ID ;
									} 
									$cat = substr($cat, 1);
									$args=array(
										'cat' => $cat,
										'post__not_in' => array($post->ID),
										//'showposts'=> $columns, 
										'ignore_sticky_posts'=>1,
									);
								}
								$temp = $wp_query; 
								$my_query = new wp_query($args);
								if( $my_query->have_posts() ) {						
							?>						
							<?php
								while ($my_query->have_posts()) {
									$my_query->the_post();
									$postcustoms = getOptions($post->ID);
									$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),100,100,true,true,true);
									$the_title = get_the_title();
									$the_title = strlen($the_title)>40 ? trim(substr($the_title, 0, 40))."..." : $the_title;
									if(!empty($blogimageurl)){
										$mediaholder = '<div class="mediaholder">
												<!-- THE INNER WRAP FOR MEDIA HOLDER -->
												<div class="mediaholder_innerwrap">
													<a href="'.get_permalink().'"><img alt="" src="'.$blogimageurl.'"></a>											
												</div><!-- END OF MEDIAHOLDER INNER WRAP-->
											</div><!-- END OF MEDIAHOLDER CONTAINER -->';
										$detailstyle = "";
									}
									else{
										$mediaholder="";
										$detailstyle = "width: 100%";
									} 
							?>								
									<li class="sb-goodweb-skin">
											<!-- THE MEDIAHOLDER CONTAINER -->
											<?php echo $mediaholder; ?>
	
											<!-- THE VISIBLE DETAILS -->
											<div class="detailholder" style="<?php echo $detailstyle;?>">
												<h4 class="showbiz-title"><a href="<?php the_permalink(); ?>"><?php echo $the_title;?></a></h4>
												<div class="contentdivider-mini"></div>
												<p class="showbiz-date"><?php echo get_the_date(); ?></p>
											</div><!-- END OF VISIBLE DETAILS -->
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

					jQuery('#showbiz-teaser-1').showbizpro({
						dragAndScroll:"off",
						visibleElementsArray:[3,2,2,1],
						carousel:"off",
						entrySizeOffset:0,
						allEntryAtOnce:"off",
						rewindFromEnd:"off",
						autoPlay:"off",
						delay:2000,						
						speed:250
					});
				});
				</script>
		
	</article><!-- END OF THE RELATED POSTS -->
	<?php endif; 
	
	comments_template('', true);	
	
	endwhile; endif; ?>
	<?php if($postoptions["goodweb_sidebar"]!="nosidebar"){ ?>
			</section><!--END OF LEFT CONTENT PART -->
			   <!-- THE SIDEBAR -->
			   <section class="span3 thesidebar">	
   					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($postoptions["goodweb_sidebar"]) ) : ?>		
							<article class="widget textwidget">
								<h4 class="widget-title">Sidebar Widget</h4>
								<div class="widget-inner">
									Please configure this Widget Area in the Admin Panel under Appearance -> Widget	
								</div>
							</article>   
					<?php endif; ?>	   
			   </section>
			   <!-- END OF THE SIDEBAR -->
			</section><!-- END OF ROW -->
		 </section><!-- END OF CONTAINER -->
	<?php } ?>

<?php get_footer(); ?>