<?php get_header(); 

  get_template_part('menu_section');

/*
Template name: Frontpage Template
*/

global $current_page_id;
$current_page_id = get_option('page_on_front');

if ( ( $locations = get_nav_menu_locations() ) && $locations['main-menu'] ) {
    $menu = wp_get_nav_menu_object( $locations['main-menu'] );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $test_include = array();
    foreach($menu_items as $item) {
        if($item->object == 'page')
            $test_include[] = $item->object_id;
    }
	
	$args = array( 'post_type' => 'page', 'post__in' => $test_include, 'posts_per_page' => count($test_include), 'orderby' => 'post__in',  'suppress_filters'=> true );
	
	if( function_exists('CPTOrderPosts') )
    	remove_filter('posts_orderby', 'CPTOrderPosts', 99, 2);
    
	$main_query = new WP_Query($args);
	

}
else{
    $args=array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => '-1',
	'suppress_filters'=> true
  );
    $main_query = new WP_Query($args); 
}


$menu = 1;
if( have_posts() ) : 
    while ($main_query->have_posts()) : $main_query->the_post();

    global $post;

    $post_name = $post->post_name;
    
    $post_id = get_the_ID();
    
    $separate_page = get_post_meta($post_id, "klb_separate_page", true); 
    if (($separate_page!= true )&& ($post_id != $current_page_id ))
    {
		
?>




<!--/*************************************************
## Contact Section miniME
*************************************************/-->

<?php if (get_post_meta($post_id, "klb_assign_type", true) == "contact-section") { ?>

<section id="<?php echo esc_attr($post_name); ?>" class="cd-section klb-contact">
		<div class="container">
          <div class="row">
           <div class="col-md-12">


        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
	 
		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
                
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>

        <?php } ?>	
 
       <div class="box-content contact">
          <?php the_content(); ?>
        </div>
             </div>
          </div>
      </div>		  

</section>



<!--/*************************************************
## Map Section miniME
*************************************************/-->
 <?php } else if (get_post_meta($post_id, "klb_assign_type", true) == "map-section") {  ?> 


<section id="<?php echo esc_attr($post_name); ?>" class="cd-section">

        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
	 
		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
                
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>

        <?php } ?>	
       <div id="map_container">
 <?php get_template_part('contact_section'); ?>
          <?php the_content(); ?>

      </div>		  

</section>

<!--/*************************************************
## Home Section miniME
*************************************************/-->
 <?php } else if (get_post_meta($post_id, "klb_assign_type", true) == "home-section") {  ?> 


<section id="<?php echo esc_attr($post_name); ?>" class="cd-section">
      <div class="container">
          <div class="row">
           <div class="col-md-12">
             <div class="box-content about">


        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
	 
		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
                
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>

        <?php } ?>	
 

          <?php the_content(); ?>
               </div>
             </div>
          </div>
      </div>		  

</section>

<!--/*************************************************
## miniMe Parallax Section With Box
*************************************************/-->
 <?php } else if (get_post_meta($post_id, "klb_assign_type", true) == "parallax-section-one") {  ?> 
 
<section id="<?php echo esc_attr($post_name); ?>" class="cd-section">
      <div class="parallax1" style="background:url(<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 940,550 ), false, '' ); echo esc_url( $src[0]); ?>) center center/cover no-repeat fixed;">
        <div class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-12">

        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>

		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
                          
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>		 
		 
        <?php } ?>	


                <?php the_content(); ?>

               </div>
             </div>
           </div>
        </div>
      </div>
</section>

<!--/*************************************************
## miniMe Portfolio Section
*************************************************/-->

 <?php } else if (get_post_meta($post_id, "klb_assign_type", true) == "portfolio-section") {  ?> 
 
<section  class="cd-section">
       <div class="container" >
          <div class="row" id="<?php echo esc_attr($post_name); ?>">
           <div class="col-md-12">
		    <div class="box-content">

        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
        
		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
                
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>

        <?php } ?>	


     
                <?php the_content(); ?>
                 <?php get_template_part('portfolio_section'); ?>

                  </div><!--close box content-->
             </div>
		  </div>
      </div>

</section>
<!--/*************************************************
## miniMe Parallax Two Section
*************************************************/-->

 <?php } else 	 if (get_post_meta($post_id, "klb_assign_type", true) == "parallax-section-two") {  ?> 

<section id="<?php echo esc_attr($post_name); ?>" class="cd-section" >
      <div class="parallax2" style="background:url(<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 940,550 ), false, '' ); echo esc_url ($src[0]); ?>) center center/cover no-repeat fixed;">
        <div class="overlay-white">
            <div class="container">
              <div class="row">
               <div class="col-md-12">
        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>

		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>                  
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>

        <?php } ?>	


                <?php the_content(); ?>
              
		      </div>
          </div>
        </div>
       </div>
      </div>

</section>


<!--/*************************************************
## miniME Experiences Section
*************************************************/-->

 <?php } else 	 if (get_post_meta($post_id, "klb_assign_type", true) == "experience-section") {  ?> 

<section id="<?php echo esc_attr($post_name); ?>" class="cd-section">
		<div class="container">


        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
                 	 
		 <h1 class="exp-title"><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
               
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2 class="exp-sub">'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>
		    
        <?php } ?>



               
                <?php the_content(); ?>

   </div>
</section>


<!--/*************************************************
## miniME Blog Section
*************************************************/-->

 <?php } else 	 if (get_post_meta($post_id, "klb_assign_type", true) == "blog-section") {  ?> 

<section id="<?php echo esc_attr($post_name); ?>" class="cd-section">
		<div class="container">
          <div class="row">
           <div class="col-md-12">
                <div class="box-content blog">


        <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?>
                 	 
		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h1>
               
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2>'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>
		    
        <?php } ?>

		           <div id="owl-demo-blog" class="owl-carousel owl-theme owl-details">
		
		              <?php the_content(); ?>
		
		            </div
            </div>
        </div>
      </div>
   </div>
</section>


 <?php } else {
	 if (get_post_meta($post_id, "rnr_assign_type", true) == "home-section12") { 
 }

 ?>


 
<section  id="<?php echo esc_attr($post_name); ?>" class="cd-section">

<?php if((get_post_meta($post_id, "klb_assign_type", true) != "home-section12") ){ ?> 
     

          <?php if((get_post_meta( $post_id, 'klb_disable_title', true )!= true) ){ ?> 


		 <h1><?php if(get_post_meta( get_the_ID(), 'klb_alt_title', true )){ echo get_post_meta( get_the_ID(), 'klb_alt_title', true ); } else { the_title(); } ?></h2>
          <div class="accent-rule-short"></div>                  
         <?php if(get_post_meta( get_the_ID(), 'klb_subtitle', true )){ echo '<h2">'.get_post_meta( get_the_ID(), 'klb_subtitle', true ).'</h2>
         '; } ?>		 
                                 
          
  <?php } ?>   
  <?php } ?>   
   <?php
	if (get_post_meta($post_id, "klb_assign_type", true) == "home-section12") { ?>
      <?php 
	  
	}

	else if (get_post_meta($post_id, "klb_assign_type", true) == "portfolio-section12") { ?>
       <div class="container">
          <div class="row">
           <div class="col-md-12">
		    <div class="box-content">
     
                <?php the_content(); ?>
                 <?php get_template_part('portfolio_section'); ?>
                  </div><!--close box content-->
             </div>
		  </div>
      </div>
      
 <?php	}
	else if (get_post_meta($post_id, "klb_assign_type", true) == "contact-section") { ?><!-- pricing section here -->	



	
	<?php get_template_part('contact_section');
	}
 	else { ?> 
      


      <div class="container">

	<?php the_content(); ?>
       </div>
 <?php } ?> 

 </section> 

    
<?php
    } ?>
 
    
   <?php if($menu==0){

     } 	
	  $menu=2;
  }
    endwhile;
    endif; 
	wp_reset_query();
	if( function_exists('CPTOrderPosts') )
		add_filter('posts_orderby', 'CPTOrderPosts', 99, 2);


function arnem_custom_scripts() {
global $smof_data; 
?>
 
 
<?php }


 get_footer(); ?>
