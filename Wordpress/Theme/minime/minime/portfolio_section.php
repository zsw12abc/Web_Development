 <?php global $smof_data;  

  
global $root, $post_id;


	  $portfolio_filters = get_terms('portfolio_filter');

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'class' => array(),
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
	'div' => array(),
	'figcaption' => array(),
	'p' => array(
		'class' => array(),
     ),
    'li' => array(),

);

  ?> 
  

            <?php
								
		
	               	if($portfolio_filters): ?>
                 <dl class="group">
                  <dt></dt>
		           <dd>
			         <ul class="filter group albumFilter"> 
                       <li data-filter="*" class="cl-effect-11 current"><a data-hover="All" href="#"><?php _e('All', 'minime'); ?></a></li>
                       <?php foreach($portfolio_filters as $portfolio_filter): ?>
                       <li class="cl-effect-11" data-filter=".<?php echo esc_attr($portfolio_filter->slug); ?>"><a data-hover="<?php echo esc_attr($portfolio_filter->name); ?>" href="#" ><?php echo esc_attr($portfolio_filter->name); ?></a></li>
                        <?php endforeach; ?> 
			          </ul> 
		            </dd>
	              </dl>
                    <?php endif; ?>


<?php  ?>


<?php
	//	$temp = $wp_query;
       
       global $wp_query;
		$paged = get_query_var('page') ? get_query_var('page') : 1;
	    $port_args = array(
            'post_type' 		=> 'portfolio',
            'post_status' 		=> 'publish',
            'orderby' 			=> 'menu_order',
            'order' 			=> 'DESC',
            'paged' 			=> $paged
        );
     
        
        $wp_query = new WP_Query($port_args);
        if( have_posts() ) : ?>
                <div class="portfolio albumContainer">
                  <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                  <?php $terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>
                   
              
              <div class="<?php if($terms) : foreach ($terms as $term) { echo ''.$term->slug.' col-md-4 item '; } endif; ?>" data-animated="0">
               <?php 
                   $taxonomy = strip_tags( get_the_term_list($post->ID, 'portfolio_filter', '', ', ', '') );
			        $port_gallery = get_post_meta( get_the_ID( ), 'klb_project_item_slides12', false );





                    if( get_post_meta( get_the_ID(), 'klb_project_video_embed12', true ) != "") {							
						 $lightboxtype = '<div class="thumb-info"></i><h3>'. get_the_title() .'</h3><p class="portfolio-tags">'.$taxonomy.'</p></div>';
				     }
					 
					  else if(!empty($port_gallery)) {
                      $lightboxtype = '<div class="thumb-info"><h3>'. get_the_title() .'</h3><p class="portfolio-tags">'.$taxonomy.'</p></div>';						
		    	     }

				      else{
				      $lightboxtype = '<figcaption>
							            <p>'. get_the_title() .'</p>
                                        <p class="taxonomy">'. $taxonomy .'</p>
                                        <a href="?portfolio='.$post->post_name.'/" class="smooth-redirect"></a>
						               </figcaption>';

				     } 
					 
					 if($smof_data['klb_disable_portfolio_ajax']==true) {
						 
						 $link = '<a href="' .get_permalink().'" title="'. get_the_title() .'" class="image">';
				     }  else { 
					     $link = '
                     <div class="grid"><figure class="effect-oscar">';
					 }


                    ?>


                    
                    
                
 <?php
              // IF PORTFOLIO TYPE IS IMAGE					 
              if ( has_post_thumbnail()) { ?>				
                
                   
                  <?php echo '<div class="grid"><figure class="effect-oscar">';
                     $att=get_post_thumbnail_id();
					 $image_src = wp_get_attachment_image_src( $att, 'span4' );
					 $image_src = $image_src[0]; ?>
                     <img src="<?php echo esc_url($image_src); ?>" /><?php echo wp_kses($lightboxtype, $allowed_html); ?></figure></div>
                  <?php } ?>
                  
 
</div>
    
    <?php
	
 	endwhile; ?>
 </div>
 <?php	endif; ?>
 
    <?php wp_reset_query();  ?>