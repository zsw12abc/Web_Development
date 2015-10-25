<?php

function minime_shortcodes_formatter($content) {
	$block = join("|",array(
						"button",
						"full_width_color",
						"contact_box",
						"testimonial_slider_box",
						"testimonial_slide",
						"service_box",
						"parallax_twitter",

						));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

	return $rep;
}
add_filter('the_content', 'minime_shortcodes_formatter');
add_filter('widget_text', 'minime_shortcodes_formatter');

/*-----------------------------------------------------------------------------------*/
/*  miniMe Box Text About Section
/*-----------------------------------------------------------------------------------*/

function minime_box_text( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => '',
        "width" => '4'
    ), $atts) ); 
	
   return '      <div class="col-md-'.$width.'">
                    <div class="box-text">
                     '. do_shortcode($content) . '
                      </div>
                  </div>';

}

add_shortcode('box_text', 'minime_box_text');

/*-----------------------------------------------------------------------------------*/
/*	miniMe Title h1
/*-----------------------------------------------------------------------------------*/

function minime_title_one( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => ''
    ), $atts) ); 
	
   return '<h1>'.$title.'</h1>';
}

add_shortcode('title_one', 'minime_title_one');

/*-----------------------------------------------------------------------------------*/
/*	miniMe Title H2
/*-----------------------------------------------------------------------------------*/

function minime_title_two( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => ''
    ), $atts) ); 
	
   return '<h2>'.$title.'</h2>';
}

add_shortcode('title_two', 'minime_title_two');



/*-----------------------------------------------------------------------------------*/
/*  miniMe Box IMG
/*-----------------------------------------------------------------------------------*/

function minime_box_img( $atts, $content = null ) {	

   return '  <div class="col-md-4">
                <div class="box-img">
                '. do_shortcode($content) . '
                </div>
             </div>';
}

add_shortcode('box_img', 'minime_box_img');

/*-----------------------------------------------------------------------------------*/
/*  miniMe image shortcodes
/*-----------------------------------------------------------------------------------*/

function minime_img_src( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "url" => ''
    ), $atts) ); 
   return '<img src="'.$url.'" alt="office" />';
}

add_shortcode('img_src', 'minime_img_src');



/*-----------------------------------------------------------------------------------*/
/*	Minime Carousel Slider
/*-----------------------------------------------------------------------------------*/

function minime_carousel_slider( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "date" => '',
        "price" => '',
        "quantity" => '',
		"title" =>''
    ), $atts) ); 
	
   return '<div id="owl-demo" class="owl-carousel owl-theme">
                '. do_shortcode($content) . '
                      </div>';  

}

add_shortcode('carousel_slider', 'minime_carousel_slider');



/*-----------------------------------------------------------------------------------*/
/*  miniMe Carousel Slider Item
/*-----------------------------------------------------------------------------------*/

function minime_carousel_item( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => '',
        "name" => '',
		"context" =>'',
        "icon"   => 'anchor'
    ), $atts) ); 
	
   return '<div class="item">
              <div class="carousel-desc">
                  <span class=" icon-'.$icon.'"></span>
                    <h1>'.$title.'</h1>
                    <p>'.$context.'</p>
                    <p class="nm-name">'.$name.'</p>
               </div>
            </div>';  

}

add_shortcode('carousel_item', 'minime_carousel_item');


/*-----------------------------------------------------------------------------------*/
/*	miniME Experience First Row
/*-----------------------------------------------------------------------------------*/

function minime_experience_one( $atts, $content = null ) {	
	
   return '<div class="row">
            <div class="col-md-12">
               <div class="box-content">
                '. do_shortcode($content) . '
              </div>
            </div>
		  </div>';  

}

add_shortcode('experience_one', 'minime_experience_one');


/*-----------------------------------------------------------------------------------*/
/*	miniME Experience Second Row
/*-----------------------------------------------------------------------------------*/

function minime_experience_second( $atts, $content = null ) {	
	
   return '<div class="row">
               <div class="col-md-12">
                <div class="box-content experiences">
                '. do_shortcode($content) . '
              </div>
            </div>
		  </div>';  

}

add_shortcode('experience_second', 'minime_experience_second');


/*-----------------------------------------------------------------------------------*/
/*	miniME Slogan
/*-----------------------------------------------------------------------------------*/

function minime_slogan( $atts, $content = null ) {	
	
   return '<p class="slogan">'. do_shortcode($content) . '</p>
';  

}

add_shortcode('slogan', 'minime_slogan');


/*-----------------------------------------------------------------------------------*/
/*	miniME SIGNATURE
/*-----------------------------------------------------------------------------------*/

function minime_signature( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "img" => ''
    ), $atts) ); 
	
   return '<img class="signature" src="'.$img.'" alt="" />';  

}

add_shortcode('signature', 'minime_signature');



/*-----------------------------------------------------------------------------------*/
/*	miniME Skill Area
/*-----------------------------------------------------------------------------------*/

function minime_skill_area( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => '',
    ), $atts) ); 
	
   return ' <div class="col-md-6">
				    <div class="skills-area triggerAnimation animated" data-animate="fadeInLeft">
					
                        <div class="box-text">
                        <h2>'.$title.'</h2>
					    <div class="skills-box">
							    <div class="skills-progress">
                               '. do_shortcode($content) . '
							    </div>
						    </div>
                        </div>
				    </div>
			    </div>';  

}

add_shortcode('skill_area', 'minime_skill_area');


/*-----------------------------------------------------------------------------------*/
/*	miniME Skill Item
/*-----------------------------------------------------------------------------------*/

function minime_skill_item( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "percent" => '',
        "context" => ''
    ), $atts) ); 
	
   return '<p>'.$context.'<span>'.$percent.'%</span></p>
				<div class="meter nostrips web-applications">
					<p style="width: '.$percent.'%"></p>
				</div>';  

}

add_shortcode('skill_item', 'minime_skill_item');


/*-----------------------------------------------------------------------------------*/
/*	miniME Experience List
/*-----------------------------------------------------------------------------------*/

function minime_exp_list( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "title" => '',
        "date" => '',
        "icon" => 'briefcase'
    ), $atts) ); 
	
   return '<div class="col-md-12 list-experiences">
                        <h2><i class="fa fa-'.$icon.'"></i>'.$title.'<span class="data">'.$date.'</span></h2>
                  '. do_shortcode($content) . '
          </div>';  

}

add_shortcode('exp_list', 'minime_exp_list');


/*-----------------------------------------------------------------------------------*/
/*	miniME Contact Info
/*-----------------------------------------------------------------------------------*/

function minime_contact_info( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "width" => '4',
        "icon" => 'phone'
    ), $atts) ); 
	
   return '<div class="col-md-'.$width.' c-info"><p><i class="fa fa-'.$icon.'"></i>'. do_shortcode($content) .'</p></div>';  

}

add_shortcode('contact_info', 'minime_contact_info');



/*-----------------------------------------------------------------------------------*/
/*	miniME Map Shortcode
/*-----------------------------------------------------------------------------------*/

function minime_map_area( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "open_text" => 'Open the map',
        "close_text" => 'Close the map'
    ), $atts) ); 
	
   return '<div id="map-google"></div>
             <div class="cover-map">
                <div class="content-map"><img src="'.get_template_directory_uri().'/images/map.png" alt="" /></div>
                  <div class="mm-open">'.$open_text.'<i class="fa fa-angle-down"></i></div>
                   <div class="mm-close">'.$close_text.' <i class="fa fa-angle-up"></i></div>
          </div>';  

}

add_shortcode('map_area', 'minime_map_area');



/*-----------------------------------------------------------------------------------*/
/*	Br-Tag
/*-----------------------------------------------------------------------------------*/

function act_br() {
   return '<br />';
}

 add_shortcode('br', 'act_br');
 



/*-----------------------------------------------------------------------------------*/
/*	miniME Latest Blog
/*-----------------------------------------------------------------------------------*/

function minime_blog($atts){
	extract(shortcode_atts(array(
       	'posts'      => '4',
       	'categories' => 'all',
		'columns'  =>  '4',
		'excerpt_size' => '15'
    ), $atts));
    
    global $post;
	$blog_post_type = '';

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	//var_dump($arr);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts( $args );
    $out = '';
    
		if($columns == '3'){
			$return = 'one_third';
			$image_grid = 'span4';
		}
		elseif($columns == '2'){
			$return = 'one_half';
			$image_grid = 'span6';
		}
		else{
			$return = 'one_fourth';
			$image_grid = 'span3';
		}
		
		
   

	if( have_posts() ) :
	$count = 0;

    	$out .= '';	
		
		while ( have_posts() ) : the_post();
		$count++;

		if($count%$columns=='0' && $count!='1') {
			$last = 'last';
		} else {
			$last = '';
		}
			
			$out .= '';			
 			$out .= '';
			if ( has_post_thumbnail()) {
				$blog_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_grid );
				$out .= '
			<div class="item"><img src="'.$blog_thumbnail[0].'" />';

			$out .= '<p class="details-title">' . get_the_title() . '<a href="'.get_permalink().'" class="itemPreview smooth-redirect"></a></p>

                         <p class="blog-desc">
                           '.minime_limit_words(get_the_excerpt(), $excerpt_size).'
                         </p>
                         <p class="date-blog">'.get_the_time('j').''.get_the_time(' F, Y').' / '.get_the_author().'
                         <a href="'.get_permalink().'" class="cl-read-more text-right">Read More <i class="fa fa-angle-right"></i></a></p>


                      '; 

            $out .= '</div>';

			}

 
		endwhile;
		
		 wp_reset_query();
	
	endif;

	return $out;
}
add_shortcode('blog', 'minime_blog');


?>