				<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				   <div class="clearfix box-blog">
    <?php global $blog_post_type; 
    
    $blog_slides = get_post_meta( get_the_ID( ), 'rnr_blogitemslides', false ); 

    if(!empty($blog_slides)) { ?>

      <div class="blog-bg">

      <section class="slider">
        <div class="flexslider">
          <ul class="slides">

                <?php global $wpdb, $post;

                if ( !is_array( $blog_slides ) )
                    $blog_slides = ( array ) $blog_slides;

                if ( !empty( $blog_slides ) ) {

                    $blog_slides = implode( ',', $blog_slides );
                    $images = $wpdb->get_col( "
                    SELECT ID FROM $wpdb->posts
                    WHERE post_type = 'attachment'
                    AND ID IN ( $blog_slides )
                    ORDER BY menu_order ASC
                    " );

                    foreach ( $images as $att ) {
                        // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
                        $image_src = wp_get_attachment_image_src( $att, 'blog-standard' );
                        $image_src2= wp_get_attachment_image_src( $att, '');
                        $image_src = $image_src[0];
                        $image_src2 = $image_src2[0]; ?>
                        <li><?php echo '<img src="'.$image_src.'"   />'; ?></li>
                    <?php 
                    } // ends foreach loop
                } // ends if block (!empty $blogs_slides)
                ?>
              </ul>
            </div>
          </section>
 
    </div><!-- Ends Post Media -->

    <?php } // ends if block (!empty $blogs_slides)?>

                  <div class="blog-content">
                    <h5 class="text-uppercase color-dark text-bold"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'whoiam'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h5>
                    <div class="post-meta font-alt">
                      <span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?></span>
                      <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                      <span> <?php _e('<i class="fa fa-folder-o"></i> ', 'whoiam'); the_category(', '); ?></span>
                      				
                       
                     <span><?php the_tags( '<i class="fa fa-tag"></i>', ',', ' '); ?></span>
                       
                    
                    </div>
                    <p><?php the_excerpt(); ?> 
                     <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?></p>
                  </div>
					




</div><!-- End of Post -->

</li>

