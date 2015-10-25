                     
       


                  <div class="blog-content">
                      <div class="featured-video">
                                               <?php  
                        if (get_post_meta( get_the_ID(), 'rnr_blog_video_type', true ) == 'vimeo') {  
                            echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
                        }  
                        else if (get_post_meta( get_the_ID(), 'rnr_blog_video_type', true ) == 'youtube') {  
                            echo '<iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>';  
                        }  
                        else {  
                            echo get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ); 
                        }  
                        ?> 
                      </div>
                    <h5 class="text-uppercase color-dark text-bold "><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'whoiam'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h5>
                    <div class="post-meta font-alt">
                      <span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?></span>
                      <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                      <span> <?php _e('<i class="fa fa-folder-o"></i> ', 'whoiam'); the_category(', '); ?></span>                      				                       
                     <span><?php the_tags( '<i class="fa fa-tag"></i>', ',', ' '); ?></span>
                    </div>
                    <div class="klbtheme">
                    <?php the_content(); ?> 
                     <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                    </div>
                  </div>