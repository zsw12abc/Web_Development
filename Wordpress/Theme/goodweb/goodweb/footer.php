		</section>
<?php if(!get_theme_mod( 'goodweb_footer-hide',false)){ //footer on/off ?>
		<footer id="footer">
			
			<section class="container">
				<div class="row">
						<article class="span4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Left") ) : ?>
							<h4 class="widget-title">Footer Widget</h4>
							<div class="widget-inner">
								Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Left
							</div>
				        <?php endif; ?>
				        </article>
				        <article class="span4">
				        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Center") ) : ?>
							<h4 class="widget-title">Footer Widget</h4>
							<div class="widget-inner">
								Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Center
							</div>
				        <?php endif; ?>
				        </article>
				        <article class="span4 last">
				        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Right") ) : ?>
							<h4 class="widget-title">Footer Widget</h4>
							<div class="widget-inner">
								Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Right
							</div>
				        <?php endif; ?>
				        </article>
						<div class="clear"></div>
				</div><!-- END OF THE ROW -->
			</section><!-- END OF THE FOOTER CONTAINER -->						
		</footer>
<?php } ?>

			
<?php if(!get_theme_mod( 'goodweb_subfooter-hide',false)){ //subfooter on/off ?>
		<?php  if(get_theme_mod( 'goodweb_footer-hide',false)) { ?>
			<div style="height:200px" class="hidden-phone"></div>
		<?php } ?>
		<!-- SUBFOOTER -->
		<section id="subfooter">
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<article class="span6">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("SubFooter Left") ) : ?>
							Please configure <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> SubFooter Left
						<?php endif; ?>
					</article>
					
					<article class="span6 txt-right">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("SubFooter Right") ) : ?>
							Please configure <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> SubFooter Right
						<?php endif; ?>						
					</article>
					
				</div><!-- END OF ROW -->
			</div>
		</section><!-- END OF SUBFOOTER -->



	</section><!-- END OF ALL CONTENT HERE -->
<?php } ?>
		
	<?php wp_footer(); ?>
  </body>
</html>