<!DOCTYPE html>
<?php
	$template_uri = get_template_directory_uri();
	
	//Basic Info
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;
		
	//Page Options
		$pageoptions = getOptions($post_id);
	
	//Theme Options	
		$themeoptions = getThemeOptions();	
		
	//Title
		$title = get_the_title($post_id);
		
		if(get_post_type()=='portfolio'){
			$def_title = get_theme_mod('goodweb_portfolio-detail-title',"Portfolio");
			$title = empty($def_title) ? $title : $def_title;  	
		}
		
		if(is_single() && get_post_type()!='portfolio'){
			$def_title = get_theme_mod('goodweb_blog-detail-title',"Blog");
			$title = empty($def_title) ? $title : $def_title;  	
		}
		
		if(!empty($pageoptions["goodweb_page_title"])) $title = $pageoptions["goodweb_page_title"];
		

		
		if(is_archive()){
			if(is_tax()){
				$title = __('Portfolio', 'goodweb');
			}
			else {
				$title = __("Archive",'goodweb');
			}
		}
		if(is_category()) $title = __("Category",'goodweb');
		if(is_tag()) $title = __('Tag Archive', 'goodweb'); 
		if(is_search()) $title = __('Search','goodweb');
		
		
		if (is_page() && basename(get_page_template())=="one_page.php"){ $title = __("Home","goodweb"); }
		
		if(is_404()) $title = __("Page not found","goodweb");
	
	//Blur Boxes
		$nobluredcontainers = get_theme_mod("goodweb_blured-boxes",false) ? "" : "nobluredcontainers";	
	
	//Mobile
		$mobile = strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'webOS') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ||strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') ? "goodwebmobile" : "";
	
		$goodweb_autoslider = 0;
	//Background
		if(empty($pageoptions["goodweb_page_background_type"]) || $pageoptions["goodweb_page_background_type"] == "default"){ 
			$pageoptions["goodweb_page_background_type"] = get_theme_mod("goodweb_background-type","color");
			switch($pageoptions["goodweb_page_background_type"]){
				case 'color': 
					$pageoptions["goodweb_background_color"] = get_theme_mod("goodweb_background-color","#202126");
					break;
				case 'slider':
					$pageoptions["goodweb_background_slider"][0] = get_theme_mod("goodweb_background-slider","");
					$goodweb_autoslider = get_theme_mod("goodweb_background_slider_autoslider","0");
					break;
				case 'image':
					$pageoptions["goodweb_background_image"] = get_attachment_id_from_src(get_theme_mod("goodweb_background-image",""));
					$pageoptions["goodweb_page_background_image_type"] = get_theme_mod("goodweb_background-image-type","full");
					break;
			}
		}
		
		if(empty($pageoptions["goodweb_background_slider"][0]) || $pageoptions["goodweb_background_slider"][0]=="default") $pageoptions["goodweb_background_slider"][0] = get_theme_mod("goodweb_slider","");
		
		if(isset($themeoptions['goodweb_background_slider_autoslider'])) $goodweb_autoslider = str_replace("s","",$themeoptions['goodweb_background_slider_autoslider']);
		
?>
<html <?php language_attributes(); ?>>
  <head>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="<?php echo get_bloginfo('html_type'); ?>; charset=<?php echo get_bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php bloginfo('name'); ?> <?php is_home() || is_front_page() ? bloginfo('description') :  wp_title(); ?></title>
	<?php 
		wp_head(); 
	?>
	
  </head>

  <!-- THE FF HACK FOR MASKING HEADER -->
  <style>
  		.cinematic.overheader	{	mask:url('#m1'); }
  </style>
  	<?php
		//Logos
			$themeoptions["goodweb_header_logo"] = get_theme_mod( 'goodweb_head-logo',$template_uri.'/images/assets/logo.png');
			$themeoptions["goodweb_nav_logo"] = get_theme_mod( 'goodweb_nav-logo','');
	?>
	</head>
	<body <?php body_class(array($mobile,get_theme_mod("goodweb_animations","withmoduleanimations"),get_theme_mod("goodweb_nav-position","menuonleft"),$nobluredcontainers,"gw_".get_theme_mod('goodweb_dark-light','dark'))); ?> data-menutitle="<?php echo $title; ?>" data-autoslider="<?php echo $goodweb_autoslider;?>">
	
	
	<?php echo returnCustomizerCSS(); ?>
	<style id="customizercss"></style>

	 <!-- THE FIREFOX FALL BACK GRADIENT HEADER -->
  	 <svg height="0">
	  <mask id="m1" maskUnits="objectBoundingBox" maskContentUnits="objectBoundingBox">
	    <linearGradient id="g" gradientUnits="objectBoundingBox" x2="0" y2="1">
	      <stop stop-color="white" stop-opacity="1" offset="0"/>
	      <stop stop-color="white" stop-opacity="1" offset="0.80"/>
	      <stop stop-color="white" stop-opacity="0" offset="1"/>
	    </linearGradient>
	    <rect x="0" y="0" width="1" height="1" fill="url(#g)"/>
	  </mask>
	</svg><!-- END OF GRADIENT HEAdER FALL BACK -->

	<!-- THE MENU -->
	<menu id="mainmenuholder">
		<!-- THE NAVIGATION HOLDER -->
		<a><div class="header-menu-closer hidden-phone hidden-tablet menucloser nobg"><div class="single_blurredbg_holder noborder">
						<div class="single_blurredbg"></div>
						<div class="single_bluroverlay"></div>
					</div><i class="icon-cancel"></i></div></a>
			<?php 
				if(get_theme_mod("goodweb_one-multi","multi")=="one") {
					add_filter( 'wp_nav_menu_items', 'home_custom_menu_item', 10, 2 ); //add home and close button
					function home_custom_menu_item ( $items, $args ) {
						$home_hide = get_theme_mod("goodweb_home-hide",FALSE);
						if(!$home_hide) $items = '<li class="menu-item menu-item-type-post_type menu-item-object-page">
						<a href="'.get_home_url().'#home" class="current internallink">'.__("Home","goodweb").'</a></li>
						'.$items;
					    $items = '<li class="header-menu-closer visible-phone visible-tablet"><a><div class="menubutton txt-center"><i class="icon-cancel"></i></div></a></li>'.$items;
					   return $items;
					}
				}
				else {
					
					add_filter( 'wp_nav_menu_items', 'xonly_custom_menu_item', 10, 2 ); //add home and close button
					function xonly_custom_menu_item ( $items, $args ) {
						$home_hide = get_theme_mod("goodweb_home-hide",FALSE);
						if(!$home_hide ) $items = '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="'.get_home_url().'" class="current">'.__("Home","goodweb").'</a></li>'.$items;
					    $items = '<li class="header-menu-closer visible-phone visible-tablet"><a><div class="menubutton txt-center"><i class="icon-cancel"></i></div></a></li>
					    '.$items;
					   return $items;
					}
				}
			//}
			
			$defaults = array(
				'theme_location'  => 'navigation',
				'container'       => 'div', 
				'container_class' => '', 
				'container_id'    => 'navigation',
				'menu_class'      => '',
				'fallback_cb'     => 'wp_page_menu',
			);
			wp_nav_menu( $defaults ); 
			
			remove_filter( 'wp_nav_menu_items', 'home_custom_menu_item');
			remove_filter( 'wp_nav_menu_items', 'xonly_custom_menu_item');
			
			?>
			<?php if(!empty($themeoptions["goodweb_nav_logo"]) && get_theme_mod("goodweb_nav-position","menuonleft") != "menuontop"){ ?>
				<div id="menu-footerlogo">	
					<div class="clear"></div>
					<article  class="menu-footerlogo">
						<div class="logo-holder">
							<?php 	$themeoptions["goodweb_nav_logo"] = get_attachment_id_from_src($themeoptions["goodweb_nav_logo"]); 
									$navlogo = wp_get_attachment_image_src($themeoptions["goodweb_nav_logo"],"full");
									$navlogo_width = $navlogo[1];
									$navlogo_height = $navlogo[2];

							?>
							<img src="<?php echo $navlogo[0];?>" width="<?php echo $navlogo_width; ?>" height="<?php echo $navlogo_height; ?>" alt=""/>
						</div>
					</article>
				</div>
			<?php } ?>
	</menu><!-- END OF MENU -->

	<?php if (!empty($mobile)){?>
		<div class="header-menu-wrapper txtshadow pull-left bgholderparent" id="headermenuholder">
			<div class="single_blurredbg_holder">
				<div class="single_blurredbg"></div>
				<div class="single_bluroverlay"></div>
			</div>
			
			<i class="icon-menu menu-toggler"></i>
			<div id="current-menu-txt"><?php echo $title;?></div>
			<div class="clear"></div>
			
		</div>
	<?php } ?>

	<!-- TO BE ABLE TO SCROLL ALL THE CONTENT IN CASE MENU HAS BEEN PRESSED -->
	<section id="allcontent">

			<!-- HEADER -->
			<header id="headerwrapper">
				<div class="header_innerwrapper container">
	
				<?php if (empty($mobile)){?>
					<div class="header-menu-wrapper txtshadow pull-left bgholderparent" id="headermenuholder">
						<div class="single_blurredbg_holder">
							<div class="single_blurredbg"></div>
							<div class="single_bluroverlay"></div>
						</div>
						
						<i class="icon-menu menu-toggler"></i>
						<div id="current-menu-txt"><?php echo $title;?></div>
						<div class="clear"></div>
						
					</div>
				<?php } ?>
					<!-- !LOGO -->
					<a href="<?php echo home_url(); ?>"><div id="logo-wrapper">
						<img id="logo" src="<?php echo $themeoptions["goodweb_header_logo"];?>"/>
					</div></a><!-- END OF LOGO -->

					<?php if(!get_theme_mod("goodweb_search-hide",false)){ ?>
						<!-- !SEARCH FORM -->
						<article id="header_search" class="pull-right">
							<?php get_search_form(); ?>
						</article>
						<!-- END OF SEARCH FORM -->
					<?php } ?>
					<div class="clear"></div>
				</div>
			</header><!-- END OF HEADER -->
	<?php switch($pageoptions["goodweb_page_background_type"]){ // Switch Background Type 
				case "slider":
	?>
		<?php if(!empty($pageoptions["goodweb_background_slider"][0])){ ?>	
			<section id="background-wrapper">
				<!-- THE BACKGROUND SLIDER -->
				<article class="cinematic" data-contentholder="#slidercontent-wrapper">
					<!-- SLIDER LIST -->
					<ul>
						<!-- A SLIDE ITEM -->
							<?php 
								$categories = !isset($pageoptions["goodweb_background_slider"]) || empty($pageoptions["goodweb_background_slider"]) ? "" : implode(",", $pageoptions["goodweb_background_slider"]);
								$categories = $categories == "all" ? "" : $categories;
								$args = array( 
										'posts_per_page' => 999999, 
										'offset'=> 0,
										'post_type' => 'gallery',
										'sliders' => $categories
								);
								$all_posts = new WP_Query($args);

							
								//The Loop
								if($all_posts->have_posts()) : 
									while($all_posts->have_posts()) : $all_posts->the_post();
									$imageoptions = getOptions($post->ID);
									$backgroundimage = wp_get_attachment_image_src($imageoptions["goodweb_background_src"],"full");
									$backgroundimage_width = $backgroundimage[1];
									$backgroundimage_height = $backgroundimage[2];
									$backgroundimage = $backgroundimage[0];
									$imageoptions["goodweb_background_caption"] = isset($imageoptions["goodweb_background_caption"]) ? $imageoptions["goodweb_background_caption"] : "";
									
									//$backgroundeffectimage = str_replace("preview","effect",$imageoptions["goodweb_background_src_effect"]);
									$backgroundeffectimage = wp_get_attachment_image_src($imageoptions["goodweb_background_src_effect_manual"],"full");
									$backgroundeffectimage = $backgroundeffectimage[0];
									$tiled = isset($imageoptions["goodweb_background_image_type"]) && $imageoptions["goodweb_background_image_type"]=="repeatbg" ? 'data-repeatbg="true"' : 'data-repeatbg="false"';
									$tiled2 = isset($imageoptions["goodweb_background_image2_type"]) && $imageoptions["goodweb_background_image2_type"]=="repeatbg" ? 'data-repeatbg2="true"' : 'data-repeatbg2="false"';
								?>
									<li><!-- USE  data-repeatbg="true" for Tiled BG 's -->
										<div class="slide-background-image" <?php echo $tiled; ?> <?php echo $tiled2; ?> data-src="<?php echo $backgroundimage; ?>" data-srcblur="<?php echo $backgroundeffectimage; ?>" data-width="<?php echo $backgroundimage_width; ?>" data-height="<?php echo $backgroundimage_height; ?>"></div>
											<section class="slidercontent"><?php $title_caption = empty($imageoptions["goodweb_background_title"]) ? "" : do_shortcode($imageoptions["goodweb_background_title"]) ; if(!empty($imageoptions["goodweb_background_title"])){ echo "<h2>".do_shortcode($imageoptions["goodweb_background_title"])."</h2>"; }	if(!empty($imageoptions["goodweb_background_caption"])){ echo "<div class='hidden-phone'><p>".do_shortcode(($imageoptions["goodweb_background_caption"]))."</p></div>"; }?></section>
									</li><!-- END OF A SLIDE ITEM -->
								<?php
								endwhile;endif; 
								
								if($all_posts->found_posts==1) 
									echo '<style>
											#cinematic-navigation {
											   bottom: -15px;
											   display:inline!important;
											}
											
											#cinematic-navigation .cinematic-down {
												bottom: 45px; 
											}
											
											.cinematic-left,.cinematic-right {
											   display:none;
											}
										</style>';
								
								?>
					</ul><!-- END OF SLIDER LIST -->
				</article>
		</section><!-- END OF THE BACKGROUND WRAPPER -->
		<section id="cinematic-title-wrapper" class="txtshadow empty">
				<!--<div class="single_blurredbg_holder noborder">
						<div class="single_blurredbg"></div>
						<div class="single_bluroverlay"></div>
					</div>-->
				<div class="container">
					<section id="slidercontent-wrapper">

					</section>

					<section id="cinematic-navigation" class="txtshadow">
						<div class="cinematic-left cinematic-navbutton"><i class="icon-left-open-big"></i></div>
						<div class="cinematic-right cinematic-navbutton"><i class="icon-right-open-big"></i></div>
						<div class="cinematic-down cinematic-navbutton"><i class="icon-down-open-big"></i></div>
					</section>
				</div>
		</section>
<?php wp_reset_query(); } ?>
	<?php 	break; // End Slider 
			
			case "color":
	?>
	
		<section id="background-wrapper" >	
				<article class="cinematic" data-contentholder="#slidercontent-wrapper" style="background-color:<?php echo $pageoptions["goodweb_background_color"];?>">
				</article>
		</section><!-- END OF THE BACKGROUND WRAPPER -->
	<?php 	break; // End Color 
			
			case "image": ?>
				<section id="background-wrapper">
					<!-- THE BACKGROUND SLIDER -->
					<article class="cinematic" data-contentholder="#slidercontent-wrapper">
						<!-- SLIDER LIST -->
						<ul>
							<!-- A SLIDE ITEM -->
								<?php 
										if(empty($backgroundimage))
											$backgroundimage = wp_get_attachment_image_src($pageoptions["goodweb_background_image"],"full");
										$backgroundimage_width = $backgroundimage[1];
										$backgroundimage_height = $backgroundimage[2];
										$backgroundimage = $backgroundimage[0];
										$tiled = isset($pageoptions["goodweb_page_background_image_type"]) && $pageoptions["goodweb_page_background_image_type"]=="repeatbg" ? 'data-repeatbg="true"' : 'data-repeatbg="false"';
										$tiled2 = isset($pageoptions["goodweb_page_background_image_type"]) && $pageoptions["goodweb_page_background_image_type"]=="repeatbg" ? 'data-repeatbg2="true"' : 'data-repeatbg2="false"';
									?>
										<li><!-- USE  data-repeatbg="true" for Tiled BG 's -->
											<div class="slide-background-image" <?php echo $tiled; ?> <?php echo $tiled2; ?> data-src="<?php echo $backgroundimage; ?>" data-srcblur="<?php echo $backgroundimage; ?>" data-width="<?php echo $backgroundimage_width; ?>" data-height="<?php echo $backgroundimage_height; ?>"></div>
												<section class="slidercontent"></section>
										</li><!-- END OF A SLIDE ITEM -->
						</ul><!-- END OF SLIDER LIST -->
					</article>
			</section>
			
		<?php
			break;
			}
			
	?>
	<?php if (is_page() && basename(get_page_template())=="one_page.php"){ ?><section id="home" class="pagestart"></section><?php } ?>
	<section id="maincontent">