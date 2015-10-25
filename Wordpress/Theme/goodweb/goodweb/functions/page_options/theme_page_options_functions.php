<?php
	// use page meta fields if page
function show_custom_page_meta_box(){
	global $custom_page_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_meta_fields;
	show_custom_meta_box();
}

function show_custom_page_portfolio_meta_box(){
	global $custom_page_portfolio_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_portfolio_meta_fields;
	show_custom_meta_box();
}

function show_custom_page_blog_meta_box(){
	global $custom_page_blog_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_blog_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_meta_box(){
	global $custom_post_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_type_meta_box(){
	global $custom_post_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_type_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_overview_meta_box(){
	global $custom_post_overview_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_overview_meta_fields;
	show_custom_meta_box();
}

function show_custom_portfolio_meta_box(){
	global $custom_portfolio_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_portfolio_meta_fields;
	show_custom_meta_box();
}


function show_custom_post_gallery_main_image_fields(){
	global $custom_gallery_main_image_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_gallery_main_image_fields;
	show_custom_meta_box();
}

function show_custom_post_gallery_second_image_fields(){
	global $custom_gallery_second_image_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_gallery_second_image_fields;
	show_custom_meta_box();
}

function show_custom_post_gallery_second_image_manual_fields(){
	global $custom_gallery_second_image_manual_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_gallery_second_image_manual_fields;
	show_custom_meta_box();
}


function show_custom_post_gallery_caption_fields(){
	global $custom_gallery_caption_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_gallery_caption_fields;
	show_custom_meta_box();
}

function show_custom_post_portfolio_type_meta_fields(){
	global $custom_post_portfolio_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_portfolio_type_meta_fields;
	show_custom_meta_box();
}

function show_custom_post_video_type_meta_fields(){
	global $custom_post_video_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_video_type_meta_fields;
	show_custom_meta_box();
}

// add some custom js to the head of the page
function add_custom_scripts() {
	global $custom_meta_fields, $post;
	$output = '<style>
				#page-video-options ,#page-gallery-options, #page-portfolio-options, #page-blog-options, #page-video-options ,#page-social-options, .tp_options {display:none;}
			</style>';
	//if(isset($_GET["post"]) && !isset($_GET['type']) ||  isset($_GET['post_type'])){
		wp_enqueue_script('custom-js', get_template_directory_uri() . '/functions/page_options/page-options.js');
		echo $output;
	//}
}
add_action('edit_page_form','add_custom_scripts');
add_action('edit_form_advanced','add_custom_scripts');

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields,$post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table padding=20 class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		$field['class'] = isset($field['class']) ? $field['class'] : "";
		// Default
		echo '<tr class="'.$field['class'].'" >
				<td style="margin-bottom:20px;"><strong><label for="'.$field['id'].'">'.$field['label'].'</label></strong><br>
				';
				switch($field['type']) {
			//! Field Description
					case 'desc':
						if(!empty($field['text'])) echo $field['text'];
						if(!empty($field['desc'])) echo $field['desc'];
					break;
			//! Field Text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" style="width:100%;max-width:500px" /><br>';
					break;
			
			//! Field Textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4" style="width:100%;max-width:500px">'.$meta.'</textarea><br>';
					break;
			
			//! Field Editor
					case 'editor':
						wp_editor( $meta, $field['id'], $settings = array('media_buttons' => false,'teeny'=>true,'tinymce' => false) );
					break;
			
			//! Field Checkbox
					case 'checkbox':
						if(empty($meta) && !empty($field['default'])) $meta = $field['default'];
						echo '<input type="checkbox" value="on" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
								<label for="'.$field['id'].'">'.$field['text'].'</label><br>';
					break;
			
			//! Field Select
					case 'select':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><br>';
					break;
			//! Field Radio
					case 'radio':
						foreach ( $field['options'] as $option ) {
							if ($meta=="") $meta=$field['default'];
							echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id']."_".$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
					break;
			//! Field Dummy
				case 'dummy':
					echo '<div id="'.$field['id'].'_del"></div> <script>jQuery(document).ready(function(){jQuery("#'.$field['id'].'_del").closest("tr").remove();});</script>';
				break;
			
			//! Field Posttype
					case 'posttype':
						foreach ( $field['options'] as $option ) {
							if ($meta=="") $meta=$field['default'];
							echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id']."_".$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
					break;
			
			//! Field Checkbox_group
					case 'checkbox_group':
						foreach ($field['options'] as $option) {
							echo '<td valign="top"><input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						echo '</td><td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
			
			//! Field Tax_select
					case 'tax_select':
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
						$terms = get_terms($field['id'], 'get=all');
						$selected = wp_get_object_terms($post->ID, $field['id']);
						foreach ($terms as $term) {
							if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
								echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
							else
								echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
						}
						$taxonomy = get_taxonomy($field['id']);
						echo '</select></td>
						<td width="200px" valign="top"><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span></td>';
					break;
			
			//! Field Post_list
					case 'post_list':
					$items = get_posts( array (
						'post_type'	=> $field['post_type'],
						'posts_per_page' => -1
					));
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
							foreach($items as $item) {
								echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
							} // end foreach
						echo '</select></td>
							<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
			
			//! Field Sidebars
					case 'sidebar_list':
						global $wp_registered_sidebars;
					    if( empty( $wp_registered_sidebars ) )
					        return;
					    $name = $field['id'];
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo "<select name='$name'><option value='nosidebar'>No Sidebar</option>";
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
					    echo "</select><br>";
					break;  
			//! Field Menu List		
					case 'menu_list':
						$menus = get_terms('nav_menu');
						//print_r($menus);
						$name = $field['id'];
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo "<select name='$name'>";
					    echo "<!--option value=''>No Menu</option--><option value=''>Default Menu</option>";
					    foreach($menus as $menu) : 
					        if( $current ) 
					            if($menu->term_id == $current)
					            	$selected = "selected";
					            else 
					            	$selected = "";
					        echo "<option value='".$menu->term_id."' $selected>";
					        echo $menu->name;
					    	echo "</option>";
					    endforeach;
					    echo "</select><br>";
					break;
			
			//! Field Color Picker
					case 'colorpicka':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'">';
						echo ' 
							<script>
								(function ($) {
								    "use strict";
								    var default_color = "fbfbfb";
								
								    function pickColor(color) {
								        $("#'.$field['id'].'").val(color);
								    }
								    function toggle_text() {
								        var link_color = $("#'.$field['id'].'");
								        if ("" === link_color.val().replace("#", "")) {
								            link_color.val(default_color);
								            pickColor(default_color);
								        } else {
								            pickColor(link_color.val());
								        }
								    }
								    
								    $(document).ready(function () {
								        var link_color = $("#'.$field['id'].'");
								        link_color.wpColorPicker({
								            change: function (event, ui) {
								                pickColor(link_color.wpColorPicker("color"));
								            },
								            clear: function () {
								                pickColor("");
								            }
								        });
								        $("#'.$field['id'].'").click(toggle_text);
								
								        toggle_text();
								
								    });
								
								}(jQuery));
							   </script> 
							   <style>
							   	.iris-picker .iris-slider-offset {
									position: absolute;
									top: 5px;
									left: 3px;
									right: 0;
									bottom: -3px;
									height: 193px;
									background: transparent;
									border: 0;
									width: 22px;
							    }
							   </style>';
							   break;
			//! Field RevSlider List					
					case 'slider_list':
						if(function_exists('shortcode_exists') && shortcode_exists("rev_slider")){
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
	                		
	                		global $wpdb;
	                		global $table_prefix;
	                		//$table_prefix = $wpdb->base_prefix;
	                		
	                		//if (!isset($wpdb->tablename)) {
							$wpdb->tablename = $table_prefix . 'revslider_sliders';
							//}
	                		$revolution_sliders = $wpdb->get_results( 
								"
								SELECT title,alias 
								FROM $wpdb->tablename
								"
							);
							
							if(!is_array($revolution_sliders))
								echo "<option value=''>No Revolution Slider</option>";
							else
								foreach ( $revolution_sliders as $revolution_slider ) 
								{
									$checked="";
			            		 	if($revolution_slider->alias==$meta) $checked="selected";
			            		 	echo "<option value='$revolution_slider->alias' $checked>".$revolution_slider->title."</option>";
								}
		                	echo '</select><br>';
		                }	
		                else {
			                echo "<strong>Slider Revolution is not activated(installed)</strong><br>";
		                }
					break;
					
			//! Field Showbiz List					
					case 'showbiz_list':
						if(shortcode_exists("showbiz")){
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
	                		
	                		global $wpdb;
	                		global $table_prefix;
	                		//$table_prefix = $wpdb->base_prefix;
	                		
	                		//if (!isset($wpdb->tablename)) {
							$wpdb->tablename = $table_prefix . 'showbiz_sliders';
							//}
	                		$showbiz_sliders = $wpdb->get_results( 
								"
								SELECT title,alias 
								FROM $wpdb->tablename
								"
							);
						
							echo "<option value=''>No Slider</option>";
							
							foreach ( $showbiz_sliders as $showbiz_slider ) 
							{
								$checked="";
		            		 	if($showbiz_slider->alias==$meta) $checked="selected";
		            		 	echo "<option value='$showbiz_slider->alias' $checked>".$showbiz_slider->title."</option>";
							}
		                	echo '</select><br>';
		                }
		                else {
			                echo "<strong>Showbiz is not activated(installed)</strong><br>";
		                }
					break;
			
			//! Field Portfolio List
					case 'portfolio_list':
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		
                		$portfolio_slugs = get_registered_post_types(); 
	
						if(is_array($portfolio_slugs))
							foreach ( $portfolio_slugs as $slug ){
								if(strstr($slug,"portfolio_") !== false){
									$obj = get_post_type_object($slug);
									$name = $obj->labels->singular_name;
									$checked="";
									if($slug==$meta) $checked="selected";
							    	echo '<option value="'.$slug.'" '.$checked.'>'.str_replace("'","",str_replace("Portfolio '","",$name)).'</option>'; 
							    }
							}
                       		echo '</select>';
					break;
			
			//! Field Date
					case 'date':
						echo '<td valign="top"><input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></td>
								<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
					
			//! Field Video Categories
					case 'video_category_list':
						echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" size="5" style="height:100px;width:100%" multiple>';
						$meta = empty($meta) ? array("all") : $meta;
						$selected = in_array("all",$meta) ? 'selected' : '';
						echo '<option value="all" '.$selected.'>All</option>';
                		$tax_terms = get_terms("category_video");
						foreach($tax_terms as $tax_term){	
							$selected = in_array($tax_term->slug,$meta) ? 'selected' : '';
							echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
						}
	                    echo '</select>';
					break;
			//! Field Gallery Categories
					case 'gallery_category_list':
						if(!is_array($meta)) $meta = array();
						echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" >';
						$selected = in_array("all",$meta) ? 'selected' : '';
						//echo '<option value="default" '.$selected.'>Default</option>';
                		$tax_terms = get_terms("sliders");
                		if(is_array($tax_terms)){
							foreach($tax_terms as $tax_term){	
								$selected = in_array($tax_term->slug,$meta) ? 'selected' : '';
								echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
							}
						}
						else echo '<option value="">--- Please Build a Slider ---</option>';
	                    echo '</select>';
					break;	
							
			//! Field Portfolio Categories
					case 'portfolio_category_list':
						if(!is_array($meta)) $meta = array();
						echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" size="5" style="height:100px;width:100%;" multiple>';
						$selected = in_array("all",$meta) ? 'selected' : '';
						echo '<option value="all" '.$selected.'>All</option>';
                		$tax_terms = get_terms("category_portfolio");
						foreach($tax_terms as $tax_term){	
							$selected = in_array($tax_term->slug,$meta) ? 'selected' : '';
							echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
						}
	                    echo '</select>';
					break;		
					
			//! Field Slider
					case 'slider':
						$value = $meta != '' ? $meta : '0';
						$range_array = isset($field['default']) ? explode(",", $field['default'])  : "";
						echo '<div id="'.$field['id'].'-slider"></div>
								<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
								<div id="'.$field['id'].'_slider" style="width:400px;margin-top:10px"></div>    
							    <script>
							        jQuery(document).ready(function(jQuery){
									    jQuery( "#'.$field['id'].'_slider" ).slider({
									        min: '.$range_array[0].',
									        max: '.$range_array[1].',
									        step: 1,
									        value: '.$value.',
									        slide: function( event, ui ) {
									            jQuery( "#'.$field['id'].'" ).val( ui.value );
									        }
									    });
									    jQuery( "#'.$field['id'].'" ).val( jQuery( "#'.$field['id'].'_slider" ).slider( "value" ) );
								    });
								</script>';
					break;
			//! Field Slider Background Image
					case 'slider_background':
						$value = $meta != '' ? $meta : '0';
						$range_array = isset($field['default']) ? explode(",", $field['default'])  : "";
						echo '<div id="'.$field['id'].'-slider"></div>
								<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
								<div id="'.$field['id'].'_slider" style="width:200px;margin-top:10px"></div> 
							    <script>
							        jQuery(document).ready(function(jQuery){
									   jQuery( "#'.$field['id'].'_slider" ).slider({
									        min: '.$range_array[0].',
									        max: '.$range_array[1].',
									        step: 2,
									        value: '.$value.',
									        slide: function( event, ui ) {
									            jQuery( "#'.$field['id'].'" ).val( ui.value );
									            jQuery("#goodweb_image_manipulation").val("true");
									        },
									        stop: function( event, ui ) {
									        	if(jQuery("#goodweb_background_grayscale").is(":checked")) $gray = "on";
										    	else $gray = "off";
										    	//alert(jQuery(".bcustom_media_id").val());
										    	jQuery.ajax({
													  type: "POST",
													  url: "'.get_template_directory_uri().'/functions/theme_create_previewimage.php",
													  data: { imageid: jQuery(".bcustom_media_id").val() , brightness: jQuery("#goodweb_background_brightness").val(), blur: jQuery("#goodweb_background_blur").val() , gray: $gray}
													}).done(function( msg ) {
													  	 jQuery("#effect_media_image").attr("src", msg);
													  	 //alert("result ".msg);
													  	 jQuery("#goodweb_background_src_effect").val(msg.replace("preview","effect"));
													});
									        }
									    });
									    jQuery( "#'.$field['id'].'" ).val( jQuery( "#'.$field['id'].'_slider" ).slider( "value" ) );
								    });
								</script>
								';
					break;
	
			//! Field Image
					case 'image':
						$image_def = get_template_directory_uri().'/images/assets/placeholder.jpg';	
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }	
						else $image = $image_def;			
						echo '<span class="custom_default_image" style="display:none">'.$image_def.'</span><a href="#" class="custom_media_upload">Choose Image</a><br>
								<img style="max-width:200px;" class="custom_media_image" src="'.$image.'" />
								<input class="custom_media_url" type="hidden" name="attachment_url" value="">
								<input class="custom_media_id" type="hidden" name="'.$field['id'].'" value="'.$meta.'"><br clear="all" /><small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small><br>';
					break;
			//! Field Background Image		
					case 'backgroundimage':
						$image_def = get_template_directory_uri().'/images/assets/placeholder.jpg';	
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }	
						else $image = $image_def;
						echo '<span class="custom_default_image" style="display:none">'.$image_def.'</span><a href="#" class="custom_media_supload">Choose Image</a><br>
								<img style="max-width:200px;" class="bcustom_media_image" src="'.$image.'" />
								<input class="bcustom_media_url" type="hidden" name="attachment_url" value="">
								<input type="hidden" name="goodweb_image_manipulation" id="goodweb_image_manipulation" value="false">
								<input class="bcustom_media_id" type="hidden" name="'.$field['id'].'" value="'.$meta.'"><br clear="all" /><small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>';
						echo ' 
						<script>
							jQuery(document).ready(function(){
									jQuery(".custom_media_supload").click(function() {
										var send_attachment_bkp = wp.media.editor.send.attachment;
										wp.media.editor.send.attachment = function(props, attachment) {
											/*if(jQuery("#goodweb_background_grayscale").is(":checked")) $gray = "on";
											else $gray="";
											jQuery.ajax({
											  type: "POST",
											  url: "'.get_template_directory_uri().'/functions/theme_create_previewimage.php",
											  data: { imageid: attachment.id , brightness: jQuery("#goodweb_background_brightness").val(), blur: jQuery("#goodweb_background_blur").val() , gray: $gray}
											}).done(function( msg ) {
											  	 jQuery("#effect_media_image").attr("src", msg);
											  	 jQuery("#goodweb_background_src_effect").val(msg);
											  	 jQuery("#goodweb_image_manipulation").val("true");
											});*/
									        jQuery(".bcustom_media_image").attr("src", attachment.url);
									        jQuery(".bcustom_media_url").val(attachment.url);
									        jQuery(".bcustom_media_id").val(attachment.id);
									        wp.media.editor.send.attachment = send_attachment_bkp;
									    }
									    wp.media.editor.open();	
									    return false;       
								    });
								    
								    jQuery("#sliders-add-toggle").attr("id","#lolo").attr("href","edit-tags.php?taxonomy=sliders&post_type=gallery");

								    
								    	
							});   
						 </script> <style>#goodweb_background_title {height:40px;} #gallery-main-image-options,#gallery-second-image-options,#gallery-second-image-manual-options { width:200px; float:left; margin-right:20px; overflow:hidden} #gallery-caption-options { width: 532px; clear:both; } #gallery-main-image-options { margin-right:20px; } #gallery-second-image-options { display:none; } #poststuff #edit-slug-box {display:none;}</style>';		
					break;
			//! Field Generated Background Image		
					case 'backgroundimage_effect':
						$image_def = get_template_directory_uri().'/images/assets/placeholder.jpg';	
						if (!empty($meta)) { $image = $meta; }	
						else $image = $image_def;
						echo '<br><img src="'.str_replace("effect","preview",$image).'" id="effect_media_image" style="max-width:200px;"><input class="background_src_effect" id="'.$field['id'].'" type="hidden" name="'.$field['id'].'" value="'.$meta.'"><br><a id="imagerefresh" href="#" style="display:none">Regenerate</a>';		
					break;
			//! Field Checkbox
					case 'checkbox_backgroundimage_effect':
						echo '<input type="checkbox" value="on" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/><script>
							jQuery(document).ready(function(){
								jQuery("#'.$field['id'].'").click(function(){
									jQuery("#goodweb_image_manipulation").val("true");
									if(jQuery("#goodweb_background_grayscale").is(":checked")) $gray = "on";
										    	else $gray = "off";
										    	jQuery.ajax({
													  type: "POST",
													  url: "'.get_template_directory_uri().'/functions/theme_create_previewimage.php",
													  data: { imageid: jQuery(".custom_media_id").val() , brightness: jQuery("#goodweb_background_brightness").val(), blur: jQuery("#goodweb_background_blur").val() , gray: $gray}
													}).done(function( msg ) {
													  	 jQuery("#effect_media_image").attr("src", msg);
													  	 jQuery("#goodweb_background_src_effect").val(msg.replace("preview","effect"));
													});

								});	
							});
							</script>
								<label for="'.$field['id'].'">'.$field['text'].'</label><br>';
					break;
			//! Field Repeatable
					case 'repeatable':
						echo '<td valign="top"><a class="repeatable-add button" href="#">+</a>
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) {
							foreach($meta as $row) {
								echo '<li><span class="sort hndle">|||</span>
											<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
											<a class="repeatable-remove button" href="#">-</a></li>';
								$i++;
							}
						} else {
							echo '<li><span class="sort hndle">|||</span>
										<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
										<a class="repeatable-remove button" href="#">-</a></li>';
						}
						echo '</ul>';
					break;
				} //end switch
		if($field['type']!="desc") echo '<span class="description">'.$field['desc'].'</span><br>';
	} // end foreach
	//echo '<tr><td colspan=3 align="right"><input name="save" type="button" class="button-primary tp_publish_buttons" id="mypublish" accesskey="p" value=""></td></tr>';
	echo '</table>'; // end table
}

function remove_taxonomy_boxes() {
	remove_meta_box('categorydiv', 'post', 'side');
}
//add_action( 'admin_menu' , 'remove_taxonomy_boxes' );

//! Save Data
function save_custom_meta($post_id) {
    global $custom_meta_fields,$custom_post_portfolio_type_meta_fields,$custom_gallery_main_image_fields,$custom_page_video_meta_fields,$custom_page_blog_meta_fields,$custom_page_portfolio_meta_fields,$custom_page_meta_fields,$custom_post_meta_fields,$custom_portfolio_meta_fields,$custom_post_type_meta_fields,$custom_post_overview_meta_fields,$custom_page_gallery_meta_fields,$custom_gallery_second_image_fields,$custom_gallery_caption_fields,$custom_gallery_second_image_manual_fields;
    if(isset($_POST['post_type'])){
	    // which fields to use
	    if ('page' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_page_meta_fields,$custom_page_portfolio_meta_fields);
			$custom_meta_fields[] = array('id'	=> 'goodweb_background_link','type'	=> 'text');
		}
		if ('post' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_post_meta_fields,$custom_post_type_meta_fields,$custom_post_overview_meta_fields);
		}

		if ('portfolio' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_portfolio_meta_fields,$custom_post_portfolio_type_meta_fields);
		}

		if ('gallery' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_gallery_main_image_fields,$custom_gallery_caption_fields,$custom_gallery_second_image_manual_fields);
			$template_uri = get_template_directory_uri();	
		}

		// verify nonce
		if(isset($_POST['custom_meta_box_nonce'])){
			if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
				return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}

		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			if($field['type'] == 'tax_select') continue;

				$old = get_post_meta($post_id, $field['id'], true);
				
				if(isset($_POST[$field['id']]))
					$new = $_POST[$field['id']];
				else $new = "";
				
				/*echo "<br><br> ".$field['id']." > ";
				
				echo $new." new<br>";
				echo $old." old<br>";
				*/			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
			
			
			
		} // end foreach
		
		if(isset($_POST["goodweb_overview_excerpts_number"]) && $_POST["goodweb_overview_excerpts_number"]=="0")
			update_post_meta($post_id, "goodweb_overview_excerpts_number", 0);
		
		// save taxonomies
		//$post = get_post($post_id);
		//$category = $_POST['category'];
		//wp_set_object_terms( $post_id, $category, 'category' );
	//die;
	}
}
add_action('save_post', 'save_custom_meta');
?>