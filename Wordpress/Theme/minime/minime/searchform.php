<form action="<?php echo home_url(); ?>/" class="box-widget" id="searchform" method="get">
   <div class="input-group">
  <input class="form-control form-flat " type="text" id="s" name="s" value="<?php _e('Search For', 'whoiam') ?>" onfocus="if(this.value=='<?php _e('Search For', 'volter') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search For', 'whoiam') ?>';" autocomplete="off" />  
  <span class="input-group-btn">
   <button class="btn primary-btn btn-flat-solid btn-icon " type="submit" value="<?php _e('Search For', 'whoiam') ?>" onfocus="if(this.value=='<?php _e('Search For', 'volter') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search For', 'whoiam') ?>';" id="searchsubmit"><i class="fa fa-search"></i></button>
  </span>
   </div>
</form>
