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

        <style type="text/css">
           
           <?php echo ot_get_option( 'minime_css' ); ?>
        </style>
		
		<script type="text/javascript">
           <?php echo esc_js( ot_get_option( 'minime_js' ) ); ?>
        </script>
		
		<?php echo  ot_get_option( 'minime_googleanalitycs' ); ?>

 <?php wp_footer(); ?>
 </body>
</html>