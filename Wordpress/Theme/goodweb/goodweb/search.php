<?php
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

	//Search
		$allsearch = &new WP_Query("s=$s&showposts=-1");
		$count = $allsearch->post_count;
		wp_reset_query();
		$hits = $count == 1 ? $count." ".__("hit for","goodweb") : $count." ".__("hits for","goodweb");

	get_header();
?>
		<h2 class="module-title "><?php _e("Search","goodweb"); ?> <?php echo $hits; ?> '<?php the_search_query(); ?>'</h2>
		<section class="container boxedbg"> <!-- Start Container -->
			<section class="row-fluid"> <!-- Start Row --> 
	
		  
				<?php		$paged =
			    				( get_query_var('paged') && get_query_var('paged') > 1 )
			    				? get_query_var('paged')
			    				: 1;
			    			$args = array(
			    				'posts_per_page' => 10,
			    				'paged' => $paged
			    			);
			    			$args =
			    				( $wp_query->query && !empty( $wp_query->query ) )
			    				? array_merge( $wp_query->query , $args )
			    				: $args;
			    			query_posts( $args );
			    ?>
			
			    <?php if (have_posts()) : ?>
			    		 <?php while (have_posts()) : the_post(); 
			    		 
				    			if(get_post_type()!="post" && get_post_type()!="page"){
				    					$post_content_org = do_shortcode(get_the_content());
						    			$post_content = strip_tags(substr($post_content_org, 0 , 250));
						    			if(strlen($post_content_org)>250) $post_content .= "...";
				    					$post_link = '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
				    			}
				    			else{
					    			$post_content_org = do_shortcode(get_the_content());
					    			$post_content = strip_tags(substr($post_content_org, 0 , 250));
					    			if(strlen($post_content_org)>250) $post_content .= "...";
					    			 $post_link = '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
					    		} 
			    			?>
	    					<article>
	    		                <h2 class="section-title" style="color:#000"><?php echo $post_link; ?></h4>
								<?php if(get_post_type()=="post" || get_post_type()=="portfolio"){ 
											if(get_post_type()=="portfolio"){
												//Categories
												$category_links = "";
												$category_links = ( get_the_term_list($post->ID, 'category_portfolio','',', ') );
											} else {
												//Categories
												$category_links = "";
												
												foreach((get_the_category()) as $category) {
													$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
												}				
												$category_links = substr($category_links, 2);
											}
											
											//Comments
											$numOfComments = get_comments_number();
											$numOfComments_detail = $numOfComments == 0 ? __("Comments","goodweb") : $numOfComments;
											$numOfComments_detail = $numOfComments == 1 ? __("Comment","goodweb") :  __(" Comments","goodweb");	
											
											//Author
											ob_start();
											the_author_posts_link();
											$author_link = ob_get_contents();
											ob_end_clean();
								?>
	    		                	<p class="postinfowrap">
	    		                		<span class="blog-date"><?php echo get_the_date(); ?></span>
			    		                <span class="blog-author"><?php echo __('by','goodweb').' '.$author_link; ?></span>
										<span class="blog-category bo-last"><?php echo $category_links; ?></span>
										<?php if(comments_open()) { ?>
										<span class="bo-comments"><a href="<?php the_permalink(); ?>#comments"><span class="blog-comments"><strong><?php echo $numOfComments; ?></strong> <?php echo $numOfComments_detail;?></span></a></span><?php } ?>
									</p>
								<?php } ?>
	    		                <?php the_excerpt();?>
	    		                <hr/>
	    					</article>
			    		<?php endwhile; ?>
				<?php else : ?>
						<h1>
						        <?php echo $searchnotfound ?>
						   </h1>
						<div style="clear:both"></div>
				<?php  endif; ?>   
				<?php if(function_exists('pagination')){ pagination(); }else{ paginate_links(); } ?>
	</section><!-- END OF CONTENT CONTAINER -->
</section><!-- END OF MAIN CONTENT CONTAINER -->
<?php get_footer(); ?>