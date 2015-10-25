                 <div class="blog-content">
                      <div class="featured-image">
                       <?php echo get_post_meta($post->ID, 'rnr_blogaudiourl', true); ?>
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
