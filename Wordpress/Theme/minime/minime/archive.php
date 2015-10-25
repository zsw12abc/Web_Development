<?php
/**
 * archive.php
 * @package WordPress
 * @subpackage minime
 * @since miniME 1.1
 */
?>

<?php get_header(); ?>


<?php
   get_template_part('menu_section'); ?>



 <section id="project" class="cd-section section-blog">
 <div class="container">
          <div class="row">
           <div class="col-md-8">
<!-- ***************************************
Start of BreadCrumbs
*************************************** -->          
               <h2 class="klb-archive">
			         <?php if (is_category()) { ?>
                      <?php _e('Category Archive for:', 'minime') ?> <?php single_cat_title(); ?>
    
                      <?php } elseif( is_tag() ) { ?>
                          <?php _e('Posts Tagged:', 'minime') ?><?php single_tag_title(); ?>
          
                      <?php } elseif (is_day()) { ?>
                          <?php _e('Archive for:', 'minime') ?> <?php the_time('F jS, Y'); ?>
          
                      <?php } elseif (is_month()) { ?>
                          <?php _e('Archive for:', 'minime') ?> <?php the_time('F, Y'); ?>
          
                      <?php } elseif (is_year()) { ?>
                          <?php _e('Archive for:', 'minime') ?> <?php the_time('Y,'); ?>
          
                      <?php } elseif (is_author()) { ?>
                          <?php _e('Author Archive:', 'minime') ?>
          
                      <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                          <?php _e('Blog Archives:', 'minime') ?>
                      <?php } ?>
                </h2>
      


<!-- ***************************************
End  of BreadCrumbs
*************************************** -->
             <div class="box-content">
                   <?php if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/content', get_post_format() ); 

                    endwhile; 

                     get_template_part( 'post-format/pagination' ); 

                     else : ?>

                    <h2><?php _e('No Posts Found', 'minime') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();


                    ?> 
             </div>
		  </div>
          <div class="col-md-4">
           <?php get_sidebar(); ?>
          </div>
        </div><!--close row-->
      </div><!--close container-->
 </section>



<?php get_footer(); ?>
