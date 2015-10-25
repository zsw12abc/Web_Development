<?php
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function extend_customizer( $wp_customize ) {
	//any HTML output
	class tb_html_Control extends WP_Customize_Control {
	    public $type = 'html';
	 
	    public function render_content() {
	        ?>
	            <?php echo $this->label ; ?>
	        <?php
	    }
    } 
   
    //Textarea
    class tb_textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	//Sliders
    class tb_slider_Control extends WP_Customize_Control {
	    public $type = 'slider';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	           <?php     
	                global $wp_registered_sidebars;
					    if( empty( $wp_registered_sidebars ) )
					        return;
					    $meta = $this->value();
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo '<select ';
					    $this->link();
					    echo '><option value="">No Slider</option>';
					    $tax_terms = get_terms("sliders");
                		if(is_array($tax_terms)){
							foreach($tax_terms as $tax_term){	
								$selected = in_array($tax_term->slug,$current) ? 'selected' : '';
								echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
							}
						}
					    echo "</select>";
	            ?>    
	            </label>
	        <?php
	    }
	}
   
    //Sidebars
    class tb_sidebars_Control extends WP_Customize_Control {
	    public $type = 'sidebars';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	           <?php     
	                global $wp_registered_sidebars;
					    if( empty( $wp_registered_sidebars ) )
					        return;
					    $meta = $this->value();
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo '<select ';
					    $this->link();
					    echo '><option value="nosidebar">No Sidebar</option>';
					    foreach( $wp_registered_sidebars as $sidebar ) : 
					        if( $current ) 
					            if($sidebar['name'] == $current)
					            	$selected = "selected";
					            else 
					            	$selected = "";
					        echo "<option value='".$sidebar['name']."' $selected>";
					        echo $sidebar['name'];
					    	echo "</option>";
					    endforeach;
					    echo "</select>";
	            ?>    
	            </label>
	        <?php
	    }
	}
	
	//Pages
    class tb_pages_Control extends WP_Customize_Control {
	    public $type = 'pages';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	           <?php     
	                $pages = get_pages();
					echo '<select ';
					$this->link();
					echo '>';
					$meta = $this->value();
						 echo '><option value="">No Page</option>';
					foreach($pages as $page){
						$selected = $page->ID == $meta ? "selected" : "";
						echo "<option value='".$page->ID."' ".$selected.">";
				        echo $page->post_title;
				    	echo  "</option>";
					}
					echo "</select>";
	            ?>    
	            </label>
	        <?php
	    }
	}
	
}
add_action( 'customize_register', 'extend_customizer' );


/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_general_layout.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_background.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_header.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_footer.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_blog_overview.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_blog_post.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_portfolio_post.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_related.php');
require_once(T_FUNCTIONS.'/theme_options/theme_customizer_custom_css.php');


function returnCustomizerCSS(){
	//General Layout
		$goodweb_font_family	= get_theme_mod( 'goodweb_font-family', 'font-family: \'Open Sans\', sans-serif;' );
		$highlightcolor	= get_theme_mod( 'goodweb_highlight-color', '#ffd658' );
	
	if(get_theme_mod('goodweb_dark-light','dark')=="dark"){
		$typehighlight = '/* Highlight Color */
				.sticky a, .sticky a:visited 	{	color:'.$highlightcolor.' !important}
				a,a:visited						{	color:'.$highlightcolor.'; }
				code							{	background-color:'.$highlightcolor.'}
				#bo-loadmorebutton:hover		{	background:'.$highlightcolor.';}
				.skill-overlay					{	background: '.$highlightcolor.'; }';
	}
	else{
		$typehighlight = '/* Highlight Color */
		.sticky a h3.bo-title, .sticky a:visited h3.bo-title	{	color:'.$highlightcolor.'}
		a					{	color:'.$highlightcolor.' !important }
		a:hover icon			{	color:'.$highlightcolor.' !important }
		#subfooter a:hover		{	color:'.$highlightcolor.' }
		.subfooter-socials:hover		{   color:'.$highlightcolor.' !important }
		.widget_pages ul li a:hover { color:'.$highlightcolor.' !important }
		.widget_pages ul li.current_page_item a { color:'.$highlightcolor.' !important }
		.widget_nav_menu ul li a:hover { color:'.$highlightcolor.' !important }
		.widget_nav_menu ul li.current_page_item a { color:'.$highlightcolor.' !important }
		.widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_recent_entries ul li a:hover { color:'.$highlightcolor.' !important }
		.tagcloud a:hover {  color: '.$highlightcolor.' ; border: 1px solid '.$highlightcolor.'  }
		menu #navigation ul li:hover >a .menubutton,
		menu #navigation ul li.active >a .menubutton		{	color:'.$highlightcolor.'  }
		menu #navigation ul li.hassubmenu:hover >a:after 	{ 	color:'.$highlightcolor.'  }
		.single_bluroverlay								{	background-color:'.$highlightcolor.'  }
		.minibtn, .logged-in-as a, #cancel-comment-reply-link { color: '.$highlightcolor.' !important; border: 1px solid '.$highlightcolor.' !important}
		.glassbtn input[type="submit"] { color: '.$highlightcolor.' !important; border: 1px solid '.$highlightcolor.' !important }
		.mediawall-filter:hover,
		.mediawall-filter.selected			{	color:'.$highlightcolor.' !important }
		.teamgroup .centeredlist li a:hover		{	color:'.$highlightcolor.' !important }
		#bo-loadmorebutton:hover				{	background:'.$highlightcolor.' }
		.blog-author a:hover,
		.blog-category a:hover,
		.blog-comments:hover,
		.bo-comments:hover,
		.bo-category a:hover,
		.blog-tag a:hover,
		.tagcloud a:hover				{	color:'.$highlightcolor.' !important }
		.sb-nav-goodweb .sb-navigation-left:hover i,
		.sb-nav-goodweb .sb-navigation-right:hover i	{	color:'.$highlightcolor.'  }
		.accordion-colored .accordion-heading .accordion-toggle,
		.accordion-colored .accordion-heading .accordion-toggle:hover				{ 	color:'.$highlightcolor.' !important}
		.accordion-glas .accordion-heading .accordion-toggle,
		.accordion-glas .accordion-heading .accordion-toggle:hover 					{ 	color:'.$highlightcolor.' !important }
		.nav-tabs>li.active>a,
		.nav-tabs>li.active>a:hover,
		.nav-tabs>li.active>a:visited,
		.nav-tabs>li>a:hover		{	color:'.$highlightcolor.' !important }
		.skill-overlay			{	background: '.$highlightcolor.'  }
		.ptglas.highlight .decoredbutton		{ 	background-color:'.$highlightcolor.' !important }
		.thecomments .comment-details a:hover		{	color: '.$highlightcolor.' !important}
		.thecomments .comment-details .comment-reply-link span	{ color: '.$highlightcolor.' !important }
		.comment-reply-link:hover .icon-forward	{ color: '.$highlightcolor.' !important }
		code							{	background-color:'.$highlightcolor.'}
		#bo-loadmorebutton:hover		{	background:'.$highlightcolor.' }
		.page-navi ul li a:hover { color: '.$highlightcolor.' !important; border: 1px solid '.$highlightcolor.' !important; }
		.page-navi ul li a.current { color: '.$highlightcolor.' !important; border: 1px solid '.$highlightcolor.' !important; }
		.page-navi ul li a.current span { color: '.$highlightcolor.' !important; }
		.postlist-title a:hover			{ color: '.$highlightcolor.' !important; font-weight: 300 !important}
		ul#recentcomments li a:hover { color: '.$highlightcolor.' !important; font-weight: 300 !important}
		ul#recentcomments li a.url:hover { color: '.$highlightcolor.' !important; font-weight: 400 !important}
		.sb-goodweb-skin .showbiz-title a:hover { color: '.$highlightcolor.' !important; }
		.mediawall-lightbox a:hover,
		.mediawall-link a:hover				{	 color: '.$highlightcolor.' !important;  }
		.mediawall-categories a:hover		{	color: '.$highlightcolor.' !important; }
		.search-results h2.section-title a:hover { color: '.$highlightcolor.' !important; }
		.skill-overlay					{	background: '.$highlightcolor.'  }
		.menuontop menu #navigation > ul >li >a:hover > .menubutton,.menuontop menu #navigation > ul > li.active >a > .menubutton{color:'.$highlightcolor.'!important; } 
	';
	}
	
	return '
	<style>
			'.$typehighlight.'
				
			/* Font Family */
				body, .uneditable-input, .btn, .decoredbutton 	{	'.$goodweb_font_family.'	}
							
	
				'.get_theme_mod( 'goodweb_customcss', '' ).'
	</style>
	<script>
		jQuery("document").ready(function(){
			jQuery(".form-submit input[type=submit]").each(function(){
				jQuery(this).wrap("<div class=\"glassbtn\">");
			});
			jQuery(".wpcf7 input[type=submit]").each(function(){
				jQuery(this).wrap("<div class=\"glassbtn\">");
			});
		});
	</script>';
}
?>