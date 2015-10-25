<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
  <head>


        <!-- Meta UTF8 charset -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <!-- Basic page information --> 
        <meta name="author" content="<?php echo esc_html( ot_get_option( 'minime_author' ) ) ?>">
        <meta name="description" content="<?php echo esc_html( ot_get_option( 'minime_description' ) ) ?>">
		<meta name="keywords" content="<?php echo esc_html( ot_get_option( 'minime_keywords' ) ) ?>">

		<meta name="viewport" content="width=device-width, initial-scale=1"/>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> >

			<section id="closepage">
			    <div class="container">
			          <div class="row">
			           <div class="col-md-12 content-close-details">
			               <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="close-redirect"><i class="fa fa-times"></i>Close</a>
			             </div>
			          </div>
			    </div>
			</section>


				<?php 
				
				if (have_posts()) : while (have_posts()) : the_post();
				
				    global $post;
				    
				    $post_name = $post->post_name;
				    
				    $post_id = get_the_ID();
						
				?> 


				 <section id="details" class="cd-section">
				      <div class="container">
				          <div class="row">
				           <div class="col-md-12">
				
				
				             <?php
								
								 $slider_meta = get_post_meta( get_the_ID( ), 'klb_project_item_slides', false );	
								 
								 if(!empty($slider_meta)) { ?> 
				
				          
				                         <div class="slider">
				                              <div id="slider" class="flexslider .flexslider-attachments">
				                                 <ul class="slides">
				                            <?php global $wpdb, $post;
				                            if ( !is_array( $slider_meta ) )
				                                $slider_meta = ( array ) $slider_meta;
				                            if ( !empty( $slider_meta ) ) {
				                                $slider_meta = implode( ',', $slider_meta );
				                                $images = $wpdb->get_col( "
				                                SELECT ID FROM $wpdb->posts
				                                WHERE post_type = 'attachment'
				                                AND ID IN ( $slider_meta )
				                                ORDER BY menu_order ASC
				                                " );
				                                foreach ( $images as $att ) {
				                                    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
				                                    $image_src = wp_get_attachment_image_src( $att, 'full' );
				                                    $image_src2= wp_get_attachment_image_src( $att, '');
				                                    $image_src = $image_src[0];
				                                    $image_src2 = $image_src2[0];
				                                    // Show image
				                                    echo "<li data-thumb=''><img src='{$image_src}' /></li>";
				                                }
				                            } ?>
				                                 </ul>
				                              </div>
				                           </div>
				
								<?php 
									 } else if(get_post_meta(get_the_ID(), 'klb_project_video_embed', true)!='') { 
									  
											  if (get_post_meta( get_the_ID(), 'klb_project_video_type', true ) == 'vimeo') {  
												  echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_project_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
											  }  
											  else if (get_post_meta( get_the_ID(), 'klb_project_video_type', true ) == 'youtube') {  
												  echo '<iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_project_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>';  
											  } 
									 } else if(get_post_meta(get_the_ID(), 'klb_projectaudiourl', true)!='') { 
				                              echo ''.get_post_meta(get_the_ID(), 'klb_projectaudiourl', true).'';
				                    } else { 
											 $att=get_post_thumbnail_id();
											 $image_src = wp_get_attachment_image_src( $att, 'full' );
											 $image_src = $image_src[0];
											 ?>
				                        
				                            <div class="project-image"><?php the_post_thumbnail('full'); ?></div>       
				             <?php }  ?>
				
				
				            </div>
				         </div>
				      </div>
				  </section>
 
					 <section id="project" class="cd-section">
					 <div class="container">
					          <div class="row">
					           <div class="col-md-12">
					             <div class="box-content">
							        <h1> <?php the_title(); ?> </h1>
					
					               <?php the_content(); ?>
					             </div><!--close box content-->
							  </div>
					        </div><!--close row-->
					      </div><!--close container-->
					 </section>
                     <hr />

				         <!-- begin custom related loop, -->
				 
						<?php 
						 
						// get the custom post type's taxonomy terms
						 
						$custom_taxterms = wp_get_object_terms( $post->ID, 'portfolio_filter', array('fields' => 'ids') );
						// arguments
						$args = array(
						'post_type' => 'portfolio',
						'post_status' => 'publish',
						'posts_per_page' => 4, // you may edit this number
						'orderby' => 'rand',
						'tax_query' => array(
						    array(
						        'taxonomy' => 'portfolio_filter',
						        'field' => 'id',
						        'terms' => $custom_taxterms
						    )
						),
						'post__not_in' => array ($post->ID),
						);
						$related_items = new WP_Query( $args );
						// loop over query
						if ($related_items->have_posts()) :
						echo ' <section id="relatedprojects" class="cd-section">
						  <div class="container">
						          <div class="row">
						           <div class="col-md-12">
						             <div class="box-content box-carousel">
						             <h1>RELATED PROJECTS</h1>
						             
						               <div id="owl-demo-details" class="owl-carousel owl-theme owl-details">';
						while ( $related_items->have_posts() ) : $related_items->the_post();
						?>
				                 <div class="item">
				                   <?php 
				                     $att=get_post_thumbnail_id();
									 $image_src = wp_get_attachment_image_src( $att, 'span5' );
									 $image_src = $image_src[0]; ?>
				                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				                         <img src="<?php echo esc_url($image_src); ?>" alt="" /></a>
				                   <?php  ?>
				                     <p class="details-title"><?php the_title(); ?></p>
				                     <p class="details-desc"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Details page', 'minime') ?></a></p>
				                  </div>
				
						<?php
						endwhile;
						echo '                </div>
						               </div>
								    </div><!--close 12-->
						        </div><!--close row-->
						      </div><!--close container-->
						 </section>';
						endif;
						// Reset Post Data
						wp_reset_postdata();
						?>

						 <section id="section6" class="cd-section">
						      <div class="container">
						          <div class="row">
						           <div class="col-md-12">
                                    <footer class="box-content">
									    <div class="footer-logo">

					           				<?php 
												if (ot_get_option( 'minime_logo' )) { ?>
						                        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo ot_get_option( 'minime_logo' ); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						                        <?php } else { ?>
						                        <a class="klb-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo ot_get_option( 'minime_logotext' ); ?></a>
					                        <?php } ?>
                
                                        </div>
                              <?php 
	                             	$clients = ot_get_option( 'minime_socialicons' );
		                            $clientslist = ot_get_option( 'minime_socialicons' );

		                            if ($clientslist) { ?>
                                    <div class="footer-social">
                                    <?php foreach($clientslist as $key => $value) {
					 	             
					 	               if ($value['minime_socialicon']) { 
					 		             echo '<a href="'.$value['minime_sociallink'].'"  target="_blank"><i class="fa fa-'.$value['minime_socialicon'].'"></i></a>';
					 	               } else {
						 	             echo '';
					 	                      }
					 	               
				                      } ?>	
                                     </div>	
	                                <?php } ?> 
								    </footer>
						          </div>
						         </div>
						      </div>
						    </section>


							<?php
							  
							    endwhile;
							    endif; 
								wp_reset_query();
							?>

<?php wp_footer(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: ""

        });
    });
</script>

<script type="text/javascript">
    /********************************************
    CAROUSEL DETAIL
    ********************************************/
    $("#owl-demo-details").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds

        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]

    });
</script>

<script type="text/javascript">
    /********************************************
    CLOSE PAGE DETAIL
    ********************************************/
    $(document).ready(function () {
        $(".close-redirect").on("click", function (event) {
            event.preventDefault();
            linkLocation = this.href;
            $("body").fadeOut(1000, redirectPage);
        });
        function redirectPage() {
            window.location = linkLocation;
        }
    });
</script>
</body>
</html>
