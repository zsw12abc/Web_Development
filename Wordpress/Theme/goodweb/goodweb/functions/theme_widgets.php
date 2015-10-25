<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Latest Posts Widget Plugin
	Plugin URI: http://www.damojothemes.com
	Description: A widget that displays Latest Posts in a widget
	Version: 1.0
	Author: damojo
	Author URI: http://www.damojothemes.com

-----------------------------------------------------------------------------------*/	
/*! LATEST POSTS */
	add_action( 'widgets_init', create_function('', 'return register_widget("goodwebPosts");') );
	class goodwebPosts extends WP_Widget {
		function goodwebPosts() {
			$widget_ops = array('classname' => 'goodwebPosts', 'description' => 'A popular/latest posts widget.');
	    	$this->WP_Widget('goodwebPosts', 'goodweb Latest Posts', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
	
	        <p><label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Post Count:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php if( isset($instance['postcount']) ) echo $instance['postcount']; ?>" /></p>
	        
	        <?php if( isset($instance['featuredimage']) ) $checked="checked";
	        	  else $checked = "";
	        ?>
	        <p><label for="<?php echo $this->get_field_id( 'poplatest' ); ?>">Latest or Popular:</label><br />
	        <select class="widefat" id="<?php echo $this->get_field_id( 'poplatest' ); ?>" name="<?php echo $this->get_field_name( 'poplatest' ); ?>">
	        	<option value="1" <?php 
	        		if( isset($instance['poplatest']) && $instance['poplatest']== 1 ) {
	        			echo "selected"; 
	        		}
	        	?>>Latest Posts</option>
	        	<option value="2" <?php 
	        		if( isset($instance['poplatest']) && $instance['poplatest']== 2 ) {
	        			echo "selected"; 
	        		}
	        	?>>Popular Posts</option>
	        </select>
	        </p>	        
	        <p><label for="<?php echo $this->get_field_id( 'category' ); ?>">Show Posts from that Category:</label><br />
	        <select  class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>"> 
				 <option value=""><?php echo 'All Categories'; ?></option> 
				 <?php 
				  $categories=  get_categories(''); 
				  foreach ($categories as $category) {
				  	if(isset($instance['category']) && $instance['category']==$category->cat_ID) $selected = "selected";
				  	else $selected = "";
				  	$option = '<option value="'.$category->cat_ID.'" '.$selected.'>';
					$option .= $category->cat_name;
					$option .= ' ('.$category->category_count.')';
					$option .= '</option>';
					echo $option;
				  }
				 ?>
				</select></p>	
	<?php }
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			if ( isset($instance['postcount']) ) $pcount = $instance['postcount']; else $pcount = 2;
			if ( isset($instance['poplatest']) ) $platest = $instance['poplatest']; else $platest = 1;
			if ( isset($instance['category']) ) $cat_id = $instance['category']; else $cat_id = "";
				
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;
			
			if($platest==1){
				$popargs = array( 'numberposts' => $pcount, 'orderby' => 'post_date', 'category' => $cat_id, 'suppress_filters' => 0);
			}else{
				$popargs = array( 'numberposts' => $pcount, 'orderby' => 'comment_count', 'category' => $cat_id , 'suppress_filters' => 0);
			}
			$unique = uniqid();
			$poplist = get_posts( $popargs );
			echo '<ul class="widget-list">';
			foreach ($poplist as $poppost) :  setup_postdata($poppost);
				$posttitle = $poppost->post_title;
                
				echo '<li class="table">';	
				$image = get_post_thumbnail_id($poppost->ID);
				
				if(!empty($image)){
					echo '<div class="table-cell top ww50"><a href="'.get_permalink($poppost->ID).'"><img src="' . aq_resize(wp_get_attachment_url( $image ),100,100,true,true,true) . '" alt="" /></a></div>';
					$pl20 = "pl20";
				}
				else $pl20 = "";
						
				echo '<div class="table-cell top '.$pl20.'">
						<h5 class="postlist-title"><a href="'.get_permalink($poppost->ID).'" class="black">'.$poppost->post_title.'</a></h5>
						<div class="contentdivider-mini"></div>
						<p class="subtext">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</p>
					</div>
				</li>';
				
	      endforeach;
	      	echo '</ul>';
			echo $after_widget;
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['postcount'] = $new_instance['postcount'];
			$instance['poplatest'] = $new_instance['poplatest'];
			$instance['category'] = $new_instance['category'];
			return $instance;
		}
	}

/*-----------------------------------------------------------------------------------

	Plugin Name: Latest Projects Widget Plugin
	Plugin URI: http://www.domojothemes.com
	Description: A widget that displays Latest Projects in a widget
	Version: 1.0
	Author: damojo
	Author URI: http://www.domojothemes.com

-----------------------------------------------------------------------------------*/	
/*! LATEST PROJECTS */
	add_action( 'widgets_init', create_function('', 'return register_widget("goodwebProjects");') );
	class goodwebProjects extends WP_Widget {
		function goodwebProjects() {
			$widget_ops = array('classname' => 'goodwebProjects', 'description' => 'A latest Projects widget.');
	    	$this->WP_Widget('goodwebProjects', 'goodweb Latest Projects', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
	
	        <p><label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Post Count:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php if( isset($instance['postcount']) ) echo $instance['postcount']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'portfolio_category' ); ?>">Show Posts from that Category:</label><br />
	        <select  class="widefat" id="<?php echo $this->get_field_id( 'portfolio_category' ); ?>" name="<?php echo $this->get_field_name( 'portfolio_category' ); ?>"> 
				 <option value=""><?php echo 'All Categories'; ?></option> 
				 <?php 
				  $categories=  get_terms("category_portfolio"); 
				  foreach ($categories as $category) {
				  	if(isset($instance['portfolio_category']) && $instance['portfolio_category']==$category->slug) $selected = "selected";
				  	else $selected = "";
				  	$option = '<option value="'.$category->slug.'" '.$selected.'>';
					$option .= $category->name;
					$option .= '</option>';
					echo $option;
				  }
				 ?>
				</select></p>
	        
	        <?php if( isset($instance['featuredimage']) ) $checked="checked";
	        	  else $checked = "";
	        ?>
	        <?php
                
	
	 }
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			if ( isset($instance['postcount']) ) $pcount = $instance['postcount']; else $pcount = 2;
			if ( isset($instance['portfolio_category']) ) $cat_id = $instance['portfolio_category']; else $cat_id = "";
				
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;
			$projectcount = $instance['postcount'];
			$portfolio_category = $instance['portfolio_category'];
			$pcat = "category_".$portfolio_category;
			$popargs=array(
				'post_type' => "portfolio",
				'posts_per_page' => $projectcount,
				'category_portfolio' => $portfolio_category
			);
			$unique = uniqid();
			$poplist = get_posts( $popargs );
			echo '<div class="widget_projects"><ul>';
			foreach ($poplist as $poppost) :  setup_postdata($poppost);
				$posttitle = $poppost->post_title;
                
				$image = get_post_thumbnail_id($poppost->ID);
				
				if(!empty($image)){
					echo '<li><a href="'.get_permalink($poppost->ID).'" data-rel="tooltip" data-placement="top" data-animation="true" data-original-title="'.$poppost->post_title.'"><img src="' . aq_resize(wp_get_attachment_url( $image ),100,100,true,true,true) . '" alt=""></a></li>';
					
				}
	      endforeach;
	      	echo '</ul></div><script>/* Tooltips */
	jQuery(document).ready(function(){jQuery("a[data-rel^=\'tooltip\']").tooltip();});</script>';
	
			echo $after_widget;
		}
	
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['postcount'] = $new_instance['postcount'];
			$instance['portfolio_category'] = $new_instance['portfolio_category'];
			return $instance;
		}
	}
/*-----------------------------------------------------------------------------------

	Plugin Name: Testimonial Widget Plugin
	Plugin URI: http://www.themepunch.com
	Description: A widget that displays a simple list of social profile icons
	Version: 1.0
	Author: themepunch
	Author URI: http://www.themepunch.com

-----------------------------------------------------------------------------------*/	
/*! TESTIMONIAL */
	add_action( 'widgets_init', create_function('', 'return register_widget("goodwebTestimonials");') );
	class goodwebTestimonials extends WP_Widget {
	
		function goodwebTestimonials() {
			$widget_ops = array('classname' => 'goodwebTestimonials', 'description' => 'Simple list of Social Profile icons');
	    	$this->WP_Widget('goodwebTestimonials', 'goodweb Testimonials Widget', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
	        <br><br><label>Quotes:</label>
		    <div>
		        <div style="display:none;">
		        	<br><hr><br>
		        	<label for="<?php echo $this->get_field_name( 'quote' ); ?>[]">Quote Text:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'quote' ); ?>[]"/>
		        
		        	<label for="<?php echo $this->get_field_name( 'add1' ); ?>[]">Name:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'add1' ); ?>[]"/>
		       
			        <br><a href="#" class="goodweb_delete_social">Delete Quote</a>
		        </div>
		        <?php 
		        	$social_count=0;
		        	$social_selected="";
		        	$uniq = uniqid();
		        	if(isset($instance['quote'])){
			        	foreach($instance['quote'] as $quote){
				        	    $add1 = "";
				        	    if( isset($instance['add1'][$social_count]) ) $add1 = $instance['add1'][$social_count++]; 
						        
						        echo '<div><br><hr><br><label for="'.$this->get_field_name( 'quote' ).'">Quote Text:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'quote' ).'[]" value=\''.$quote.'\'/>';
						        echo '<label for="'.$this->get_field_name( 'add1' ).'">Name:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'add1' ).'[]" value=\''.$add1.'\' />';
						        echo '<br><a href="#" class="goodweb_delete_social">Delete Quote</a></div>';
			        	}
			        }?>
	        	<span></span>
	        	<br><a href='#' class="goodweb_add_social_<?php echo $uniq;?>"><strong>Add Quote</strong></a><br>
	        </div>
	        
	        <script>
		       
		        	jQuery(".goodweb_add_social_<?php echo $uniq;?>").live("click",function(){
		        		$parent = jQuery(this).closest("div");
		        		$field = $parent.find("div:first").clone(true);
			        	$field.find("input").each(function(){
				        	$this = jQuery(this);
				        	$this.attr("name",$this.data("name"));
				        	});
			        	$field.css("display","");
			        	$parent.find("span").before($field);
			        	return false;
			        });
		        	jQuery(".goodweb_delete_social").live("click",function(){
			        	jQuery(this).closest("div").remove();	
			        	return false;
		        	});

	        </script>
	    <?php
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['quote'] = $new_instance['quote'];
			$instance['add1'] = $new_instance['add1'];
			return $instance;
		}
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];

						
			echo $before_widget;
		   	if ( !empty($title) ) echo $before_title . $title . $after_title;
			echo '<ul class="widget-list">';
				$social_count = 0;
				foreach($instance['quote'] as $quote){
					echo '<li>
							<div class="commnet-list-content">'.$quote.'</div>
							<div class="contentdivider-mini"></div>
							<p class="subtext">'.$instance['add1'][$social_count++].'</p>
						</li>
				';
				}
			echo '</ul>';
			echo $after_widget;	
		}
	}		

/*-----------------------------------------------------------------------------------

	Plugin Name: Social Buttons Widget Plugin
	Plugin URI: http://www.themepunch.com
	Description: A widget that displays a simple list of social profile icons
	Version: 1.0
	Author: themepunch
	Author URI: http://www.themepunch.com

-----------------------------------------------------------------------------------*/	
/*! SOCIALS */
	add_action( 'widgets_init', create_function('', 'return register_widget("goodwebSocials");') );
	class goodwebSocials extends WP_Widget {
	
		function goodwebSocials() {
			$widget_ops = array('classname' => 'goodwebSocials', 'description' => 'Simple list of Social Profile icons');
	    	$this->WP_Widget('goodwebSocials', 'goodweb Socials Widget', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
	        <label>Socials:</label><hr><br>
		    <div>
		        <div style="display:none;">
		        	<select class="widefat" data-name="<?php echo $this->get_field_name( 'socialicon' ); ?>[]">
		        		<option value="appnet">Appnet</option>
		        		<option value="behance">Behance</option>
		        		<option value="blogger">Blogger</option>		        		
		        		<option value="delicious">Delicious</option>
		        		<option value="digg">Digg</option>
			        	<option value="dribbble">Dribbble</option>
			        	<option value="dropbox">Dropbox</option>
			        	<option value="evernote">Evernote</option>
			        	<option value="facebook">Facebook</option>
			        	<option value="flickr">Flickr</option>
			        	<option value="forrst">Forrst</option>
			        	<option value="github">Github</option>
			        	<option value="gplus">Google+</option>
			        	<option value="grooveshark">Grooveshark</option>
			        	<option value="instagram">Instagram</option>
			        	<option value="klout">Klout</option>
			        	<option value="lastfm">LastFM</option>
			        	<option value="linkedin">LinkedIn</option>
			        	<option value="paypal">Paypal</option>
			        	<option value="picasa">Picasa</option>
			        	<option value="pinterest">Pinterest</option>
			        	<option value="posterous">Posterous</option>
			        	<option value="rss">RSS</option>
			        	<option value="skype">Skype</option>
			        	<option value="songkick">Songkick</option>
			        	<option value="soundcloud">Soundcloud</option>
			        	<option value="spotify">Spotify</option>
			        	<option value="stumbleupon">Stumbleupon</option>
			        	<option value="tumblr">Tumblr</option>
			        	<option value="twitter">Twitter</option>
			        	<option value="vimeo">Vimeo</option>
			        	<option value="youtube">Youtube</option>
			        	<option value="500px">500px</option>
			        </select>
			        <label for="<?php echo $this->get_field_name( 'link' ); ?>[]">URL Link:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'link' ); ?>[]"/>
			        <br><a href="#" class="goodweb_delete_social">Delete Social</a>
		        </div>
		        <?php 
		        	$social_count=0;
		        	$social_selected="";
		        	$uniq = uniqid();
		        	if(isset($instance['socialicon'])){
			        	foreach($instance['socialicon'] as $socialicon){
				        	if(!empty($socialicon))
				        		echo '<div><select class="widefat" name="'.$this->get_field_name( 'socialicon' ).'[]">';
				        		
				        		if($socialicon=="appnet") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="appnet" '.$social_selected.'>Appnet</option>'; 
					        	
					        	if($socialicon=="blogger") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="blogger" '.$social_selected.'>Blogger</option>';
					        	
					        	if($socialicon=="behance") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="behance" '.$social_selected.'>Behance</option>';
					        	
					        	if($socialicon=="delicious") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="delicious" '.$social_selected.'>Delicious</option>';
					        	
					        	if($socialicon=="digg") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="digg" '.$social_selected.'>Digg</option>';
					        	
					        	if($socialicon=="dribbble") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="dribbble" '.$social_selected.'>Dribbble</option>';
					        	
					        	if($socialicon=="dropbox") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="dropbox" '.$social_selected.'>Dropbox</option>';
					        	
					        	if($socialicon=="evernote") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="evernote" '.$social_selected.'>Evernote</option>';
					        	
					        	if($socialicon=="facebook") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="facebook" '.$social_selected.'>Facebook</option>';
					        	
					        	if($socialicon=="flickr") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="flickr" '.$social_selected.'>Flickr</option>';
					        	
					        	if($socialicon=="forrst") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="forrst" '.$social_selected.'>Forrst</option>';
					        	
					        	if($socialicon=="github") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="github" '.$social_selected.'>Github</option>';
					        	
					        	if($socialicon=="gplus") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="gplus" '.$social_selected.'>Google+</option>';
					        	
					        	if($socialicon=="grooveshark") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="grooveshark" '.$social_selected.'>Grooveshark</option>';
					        	
					        	if($socialicon=="instagram") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="instagram" '.$social_selected.'>Instagram</option>';
					        	
					        	if($socialicon=="klout") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="klout" '.$social_selected.'>Klout</option>';
					        	
					        	if($socialicon=="lastfm") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="lastfm" '.$social_selected.'>LastFM</option>';
					        	
					        	if($socialicon=="linkedin") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="linkedin" '.$social_selected.'>LinkedIn</option>';
					        	
					        	if($socialicon=="paypal") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="paypal" '.$social_selected.'>Paypal</option>';
					        	
					        	if($socialicon=="picasa") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="picasa" '.$social_selected.'>Picasa</option>';
					        	
					        	if($socialicon=="pinterest") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="pinterest" '.$social_selected.'>Pinterest</option>';
					        	
					        	if($socialicon=="posterous") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="posterous" '.$social_selected.'>Posterous</option>';
					        	
					        	if($socialicon=="rss") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="rss" '.$social_selected.'>RSS</option>';
					        	
					        	if($socialicon=="skype") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="skype" '.$social_selected.'>Skype</option>';
					        	
					        	if($socialicon=="songkick") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="songkick" '.$social_selected.'>Songkick</option>';
					        	
					        	if($socialicon=="soundcloud") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="soundcloud" '.$social_selected.'>Soundcloud</option>';
					        	
					        	if($socialicon=="spotify") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="spotify" '.$social_selected.'>Spotify</option>';
					        	
					        	if($socialicon=="stumbleupon") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="stumbleupon" '.$social_selected.'>Stumbleupon/option>';
					        	
					        	if($socialicon=="tumblr") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="tumblr" '.$social_selected.'>Tumblr</option>';
					        	
					        	if($socialicon=="twitter") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="twitter" '.$social_selected.'>Twitter</option>';
					        	
					        	if($socialicon=="vimeo") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="vimeo" '.$social_selected.'>Vimeo</option>';
					        	
					        	if($socialicon=="youtube") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="youtube" '.$social_selected.'>Youtube</option>';
					        	
					        	if($socialicon=="500px") $social_selected="selected"; else $social_selected ="";
					        	echo '<option value="500px" '.$social_selected.'>500px</option>';
						        
						        echo '</select>';
						        
						        $link = "";
						        if( isset($instance['link'][$social_count]) ) $link = $instance['link'][$social_count++]; 
						        echo '<label for="'.$this->get_field_name( 'link' ).'">URL Link:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'link' ).'[]" value="'.$link.'" />';

						        echo '<br><a href="#" class="goodweb_delete_social">Delete Social</a></div><br>';
			        	}
			        }?>
	        	<span></span>
	        	<br><hr><a href='#' class="goodweb_add_social_<?php echo $uniq;?>">Add Social</a>
	        </div>
	        
	        <script>
		       
		        	jQuery(".goodweb_add_social_<?php echo $uniq;?>").live("click",function(){
		        		$parent = jQuery(this).closest("div");
		        		$field = $parent.find("div:first").clone(true);
			        	$field.find("select,input").each(function(){
				        	$this = jQuery(this);
				        	$this.attr("name",$this.data("name"));
				        	});
			        	$field.css("display","");
			        	$parent.find("span").before($field);
			        	return false;
			        });
		        	jQuery(".goodweb_delete_social").live("click",function(){
			        	jQuery(this).closest("div").remove();	
			        	return false;
		        	});

	        </script>
	    <?php
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['socialicon'] = $new_instance['socialicon'];
			$instance['link'] = $new_instance['link'];

			return $instance;
		}
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];

						
			echo $before_widget;
		   	if ( !empty($title) ) echo $before_title . $title . $after_title;
				$social_count = 0;
				foreach($instance['socialicon'] as $class){
					echo '<a href="'.$instance['link'][$social_count++].'" class="subfooter-socials" target="_blank"><i class="social-'.$class.'"></i></a>
					';
				}
			echo $after_widget;	
		}
	}
/*-----------------------------------------------------------------------------------

	Plugin Name: Infolines Widget Plugin
	Plugin URI: http://www.themepunch.com
	Description: A widget that displays a simple list of social profile icons
	Version: 1.0
	Author: themepunch
	Author URI: http://www.themepunch.com

-----------------------------------------------------------------------------------*/	
/*! INFOLINES */
	add_action( 'widgets_init', create_function('', 'return register_widget("goodwebInfolines");') );
	class goodwebInfolines extends WP_Widget {
	
		function goodwebInfolines() {
			$widget_ops = array('classname' => 'goodwebInfolines', 'description' => 'Simple list of Information');
	    	$this->WP_Widget('goodwebInfolines', 'goodweb Infolines Widget', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
	        <br><br><label>Infolines:</label>
		    <div>
		        <div style="display:none;">
		        	<br><hr><br>
		        	<label for="<?php echo $this->get_field_name( 'name' ); ?>[]">Name:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'name' ); ?>[]"/>
		        
		        	<label for="<?php echo $this->get_field_name( 'info' ); ?>[]">Info:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'info' ); ?>[]"/>
		       
			        <br><a href="#" class="goodweb_delete_social">Delete Infoline</a>
		        </div>
		        <?php 
		        	$social_count=0;
		        	$social_selected="";
		        	$uniq = uniqid();
		        	if(isset($instance['name'])){
			        	foreach($instance['name'] as $quote){
				        	    $add1 = "";
				        	    if( isset($instance['info'][$social_count]) ) $add1 = $instance['info'][$social_count++]; 
						        
						        echo '<div><br><hr><br><label for="'.$this->get_field_name( 'name' ).'">Name:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'name' ).'[]" value=\''.$quote.'\'/>';
						        echo '<label for="'.$this->get_field_name( 'info' ).'">Name:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'info' ).'[]" value=\''.$add1.'\' />';
						        echo '<br><a href="#" class="goodweb_delete_social">Delete Infoline</a></div>';
			        	}
			        }?>
	        	<span></span>
	        	<br><a href='#' class="goodweb_add_social_<?php echo $uniq;?>"><strong>Add Infoline</strong></a><br>
	        </div>
	        
	        <script>
		       
		        	jQuery(".goodweb_add_social_<?php echo $uniq;?>").live("click",function(){
		        		$parent = jQuery(this).closest("div");
		        		$field = $parent.find("div:first").clone(true);
			        	$field.find("input").each(function(){
				        	$this = jQuery(this);
				        	$this.attr("name",$this.data("name"));
				        	});
			        	$field.css("display","");
			        	$parent.find("span").before($field);
			        	return false;
			        });
		        	jQuery(".goodweb_delete_social").live("click",function(){
			        	jQuery(this).closest("div").remove();	
			        	return false;
		        	});

	        </script>
	    <?php
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['name'] = $new_instance['name'];
			$instance['info'] = $new_instance['info'];
			return $instance;
		}
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];

						
			echo $before_widget;
		   	if ( !empty($title) ) echo $before_title . $title . $after_title;
			echo '<ul>';
				$social_count = 0;
				if(is_array($instance['name']))
				  foreach($instance['name'] as $name){
					echo '<li class="contactinfo table">
							<div class="table-cell">
								<p>'.$name.'</p>
							</div>
							<div class="table-cell">
								<p>'.$instance['info'][$social_count++].'</p>
							</div>
						</li>
				';
				}
			echo '</ul>';
			echo $after_widget;	
		}
	}		

	
?>