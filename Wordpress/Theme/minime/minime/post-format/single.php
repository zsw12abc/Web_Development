
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="blog-item">
                    <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
                       <div class="blog-img">
					      <?php the_post_thumbnail('post-thumb'); ?>
                       </div>
				     <?php } ?>

                    <div class="blog-desc box-text">
                       <div class="post-meta font-alt">
                        <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
                        <span class="date-blog"><?php the_time('F j, Y'); ?> </span>
                        <div class="category"><?php _e('&nbsp;<i class="fa fa-folder-o"></i> ', 'whoiam'); the_category(', '); ?></div>
                        <div class="tags"> <?php the_tags( '&nbsp; <i class="fa fa-tag"></i>&nbsp;', ',', ' '); ?></div>
                    
                       </div>
                         <div class="minime-post">
                        <p><?php the_content(); ?> 
                        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?></p></div>
                    </div>
                 </div>
             </article>

