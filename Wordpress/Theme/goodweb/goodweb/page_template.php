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
	
	//Page Content
	global $pagecontent;

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
		
	//Page Box
		if(empty($pageoptions['goodweb_show_box'])){
			$boxed = "boxedbg";
			$fluid = "-fluid";
		}
		else{
			 $boxed = "";
			 $fluid = "";
		}
	
	global $onepager;
	global $lastboxer;	
	global $boxers;
		
	//Sidebar
		$pageoptions["goodweb_sidebar"] = isset($pageoptions["goodweb_sidebar"]) ? $pageoptions["goodweb_sidebar"] : "nosidebar";
		$pageoptions["goodweb_sidebar"] = isset($pagecontent) && !empty($pagecontent) ? "nosidebar" : $pageoptions["goodweb_sidebar"];
		$container_class = $pageoptions["goodweb_sidebar"]!="nosidebar" ? "withsidebar" : $boxed;
		
	global $firstitem;	
?>
		<?php if($headline){ ?>	
			<h2 class="module-title "><?php echo get_the_title($post_id); ?></h2>
		<?php } ?>
		<section class="container <?php echo $container_class; ?>"> <!-- Start Container -->
			<section class="row<?php echo $fluid; ?>"> <!-- Start Row --> 
				<!-- A ROW TO SPLIT ROW IN DIFFERENT SPANS -->
				<?php if(!empty($pageoptions["goodweb_sidebar"]) && $pageoptions["goodweb_sidebar"]!="nosidebar"){ //Sidebar ?>
					<!-- THE CONTENT PART -->
					    <section class="span9 <?php echo $boxed; ?>"> <!-- Begin Span -->
				<?php } else { ?>
						<section class="span12"> <!-- Begin Span -->
				<?php } ?>
				<?php if(!$headline && !empty($pagecontent) && !empty($lastboxer) && !empty($boxers)) { ?>	
					<div class="contentdivider merge"></div>
				<?php } ?>
				<?php 
				    $post = get_page($post_id); 
				    $content = empty($pagecontent) ? do_shortcode(apply_filters('the_content', get_post_field('post_content', $post_id))) : do_shortcode($pagecontent);
					echo $content; 
				?>	
					</section> <!-- End Span -->
			<?php if(!empty($pageoptions["goodweb_sidebar"]) && $pageoptions["goodweb_sidebar"]!="nosidebar"){ //Sidebar ?>
					<!-- THE SIDEBAR -->
				   <section class="span3 thesidebar">	
				   			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($pageoptions["goodweb_sidebar"]) ) : ?>		
									<article class="widget textwidget">
										<h4 class="widget-title">Sidebar Widget</h4>
										<div class="widget-inner">
											Please configure this Widget Area in the Admin Panel under Appearance -> Widget	
										</div>
									</article>   
							<?php endif; ?>		
				   </section>
				   <!-- END OF THE SIDEBAR -->
			<?php } ?>
		</section> <!-- End Row -->
	</section> <!-- End Container -->