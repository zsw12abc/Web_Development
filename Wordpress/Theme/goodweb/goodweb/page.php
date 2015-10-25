<?php
	get_header();
	global $pagecontent;
	$pagecontent = "";
	if(!post_password_required() )
		get_template_part( 'page_template' ); 	
	else{
		echo '
		<section class="container <?php echo $container_class; ?>">
			<section class="row-fluid"> <!-- Start Row --> 
				<!-- A ROW TO SPLIT ROW IN DIFFERENT SPANS -->
										<section class="span12"> <!-- Begin Span -->
											<div style="clear:both;height:60px;"></div>	
												<form action="'.get_home_url().'/wp-login.php?action=postpass" class="post-password-form" method="post">
													<p>This content is password protected. To view it please enter your password below:</p>
													<p><label for="pwbox-459">Password: <input name="post_password" id="pwbox-459" type="password" size="20"></label> <input type="submit" name="Submit" value="Submit"></p>
												</form>
									<div style="clear:both"></div>
					</section> <!-- End Span -->
					</section>
				</section>
		';
	}
		

	get_footer();  
?>