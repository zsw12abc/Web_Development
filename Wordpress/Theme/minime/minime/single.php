<?php
/**
 * single.php
 * @package WordPress
 * @subpackage miniME
 * @since miniME 1.1
 */
?>

<?php get_header(); ?>


<?php
   get_template_part('menu_section'); ?>


 <section id="project" class="cd-section section-blog">
 <div class="container">
          <div class="row">


 <?php if( get_option_tree( 'layout_set' ) == 'right-sidebar') { ?>
           <div class="col-md-8">
             <div class="box-content">
                   <?php if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/single', get_post_format() ); 

                    endwhile; 

                     get_template_part( 'post-format/pagination' ); 

                     else : ?>

                    <h2><?php _e('No Posts Found', 'minime') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();


                    ?> 
             </div>
               <div class="col-md-12 post-content-txt">
              <?php comments_template(); ?>
               </div>	
		  </div>
          <div class="col-md-4">
           <?php get_sidebar(); ?>
          </div>

 <?php } elseif( get_option_tree( 'layout_set' ) == 'left-sidebar') { ?>


          <div class="col-md-4">
           <?php get_sidebar(); ?>
          </div>
           <div class="col-md-8">
             <div class="box-content">
                   <?php if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/single', get_post_format() ); 

                    endwhile; 

                     get_template_part( 'post-format/pagination' ); 

                     else : ?>

                    <h2><?php _e('No Posts Found', 'minime') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();


                    ?> 
             </div>
               <div class="col-md-12 post-content-txt">
              <?php comments_template(); ?>
               </div>	
		  </div>


 <?php } elseif( get_option_tree( 'layout_set' ) == 'full-width') { ?>


           <div class="col-md-12">
             <div class="box-content">
                   <?php if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/single', get_post_format() ); 

                    endwhile; 

                     get_template_part( 'post-format/pagination' ); 

                     else : ?>

                    <h2><?php _e('No Posts Found', 'minime') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();


                    ?> 
             </div>
               <div class="col-md-12 post-content-txt">
              <?php comments_template(); ?>
               </div>	
		  </div>

<?php } ?>


        </div><!--close row-->
      </div><!--close container-->
 </section>



<?php get_footer(); ?>