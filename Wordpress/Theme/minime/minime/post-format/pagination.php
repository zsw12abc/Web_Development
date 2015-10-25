				<div class="text-center">
					
					<ul class="pagination   flat-pagination ">
	 <?php minime_pagination(); ?> 
        <?php $args = array(
                    'base'         => '%_%',
                    'format'       => '?page=%#%',
                    'total'        => 1,
                    'current'      => 0,
                  );
                ?>

         <?php echo paginate_links( $args ) ?> 
</div>
