<?php
/* ------------------------------------- */
/* SIDEBAR REGISTRATION */
/* ------------------------------------- */

if ( function_exists('register_sidebar')) {
	 
	 //DEFAULT SIDEBARS
	 	register_sidebar(array(
           'name' => "Page",
           'id' => 'sidebar-1',
           'before_widget' => '<div class="clear"></div><article id="%1$s" class="widget %2$s">',
           'after_widget' => '<div class="clear"></div></article>',
           'before_title' => '<h4 class="widget-title">',
           'after_title' => '</h4>'
        )); 

	    register_sidebar(array(
	        'name' => 'Footer Left',
	        'id' => 'sidebar-2',
	        'before_widget' => '<div class="divide30 footer_widget_spacer clear"></div><div id="%1$s" class="footer_widget %2$s">',
	        'after_widget' => '<div class="clear"></div></div>',
	        'before_title' => '<h4 class="widget-title">',
	        'after_title' => '</h4>'
	    ));
	    register_sidebar(array(
	        'name' => 'Footer Center',
	        'id' => 'sidebar-3',
	        'before_widget' => '<div class="divide30 footer_widget_spacer clear"></div><div id="%1$s" class="footer_widget %2$s">',
	        'after_widget' => '<div class="clear"></div></div>',
	        'before_title' => '<h4 class="widget-title">',
	        'after_title' => '</h4>'
	    ));
	    register_sidebar(array(
	        'name' => 'Footer Right',
	        'id' => 'sidebar-4',
	        'before_widget' => '<div class="divide30 footer_widget_spacer clear"></div><div id="%1$s" class="footer_widget %2$s">',
	        'after_widget' => '<div class="clear"></div></div>',
	        'before_title' => '<h4 class="widget-title">',
	        'after_title' => '</h4>'
	    ));
	    register_sidebar(array(
	        'name' => 'SubFooter Left',
	        'id' => 'sidebar-6',
	        'before_widget' => '<div class="%2$s">',
	        'after_widget' => '<div class="clear"></div></div>',
	        'before_title' => '',
	        'after_title' => ''
	    ));
	    register_sidebar(array(
	        'name' => 'SubFooter Right',
	        'id' => 'sidebar-7',
	        'before_widget' => '<div class="%2$s rightfloat subright">',
	        'after_widget' => '<div class="clear"></div></div>',
	        'before_title' => '',
	        'after_title' => ''
	    ));
	    	    
	//CUSTOM SIDEBARS   
	    $sidebars = get_option("webpaint_theme_sidebars_options");
		$i = 0;
	    $j = 1; 
	    if (is_array($sidebars) && !empty($sidebars)) {  
	        foreach($sidebars as $row) {
	        	if($j%2==0){
	        		register_sidebar(array(
		               'name' => $sidebar,
		               'id' => 'sidebar-'.$row,
		               'before_widget' => '<div class="clear"></div><article id="%1$s" class="widget %2$s">',
			           'after_widget' => '<div class="clear"></div></article>',
			           'before_title' => '<h4 class="widget-title">',
			           'after_title' => '</h4>'
		            )); 
	                $j = 0;
		        }
		        else{
			        $sidebar = $row;
			    }
			    $j++;
	        }
	    }

}?>