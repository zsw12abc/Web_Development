<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General Config'
      ),

      array(
        'id'          => 'background_settings',
        'title'       => 'Background Settings'
      ),

      array(
        'id'          => 'blog_layout',
        'title'       => 'Blog Layout'
      ),	  

 
      array(
        'id'          => 'meta',
        'title'       => 'Meta Tags'
      ),

      array(
        'id'          => 'map_settings',
        'title'       => 'Map Settings'
      ),

      array(
        'id'          => 'social',
        'title'       => 'Social'
      )
 
    ),
    'settings'        => array(

      array(
        'id'          => 'layout_set',
        'label'       => __( 'Blog Layout', 'theme-text-domain' ),
        'desc'        => __( 'Right Sidebar - Left Sidebar and Full Width Sections', 'theme-text-domain' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'blog_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),


 
	array(
        'id'          => 'minime_logo',
        'label'       => 'Logo Image',
        'desc'        => 'Upload your own logo.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


	array(
        'id'          => 'minime_logotext',
        'label'       => 'Logo Text',
        'desc'        => 'Add Logo Text',
        'std'         => 'miniME',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

 
      array(
        'id'          => 'minime_fav',
        'label'       => 'Favicon',
        'desc'        => 'Upload your favicon',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
 
      array(
        'id'          => 'minime_css',
        'label'       => 'Additional CSS',
        'desc'        => 'Additional css here (optional)',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
       array(
        'id'          => 'minime_js',
        'label'       => 'Additional JS',
        'desc'        => 'Additional js here (optional)',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
       array(
        'id'          => 'minime_googleanalitycs',
        'label'       => 'Google Analitycs',
        'desc'        => 'Google Analitycs',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'minime_background',
        'label'       => __( 'Background', 'minime' ),
        'desc'        => 'The Background option type is for adding background styles to miniME',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'background_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),


      array(
        'id'          => 'minime_description',
        'label'       => 'Description',
        'desc'        => 'Description Add',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'meta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


      array(
        'id'          => 'minime_keywords',
        'label'       => 'Keywords',
        'desc'        => 'Keywords Add',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'meta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'minime_author',
        'label'       => 'Author',
        'desc'        => 'Author Add',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'meta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
	  
	  
	array(
        'id'          => 'minime_latitude',
        'label'       => 'Latitude Position',
        'desc'        => 'Add Your Latitude Position',
        'std'         => '40.6700',
        'type'        => 'text',
        'section'     => 'map_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

	array(
        'id'          => 'minime_longitude',
        'label'       => 'Longitude Position',
        'desc'        => 'Add Your Longitude Position',
        'std'         => '-73.9400',
        'type'        => 'text',
        'section'     => 'map_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

	array(
        'id'          => 'minime_map_zoom',
        'label'       => 'Map Zoom',
        'desc'        => 'Your Map Zoom Setting',
        'std'         => '15',
        'type'        => 'text',
        'section'     => 'map_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),		  
	  




      array(
        'id'          => 'minime_socialicons',
        'label'       => 'Social Icons',
        'desc'        => 'Add Social Box On Footer',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 



          array(
            'id'          => 'minime_sociallink',
            'label'       => 'Social link',
            'desc'        => 'Add Social Link',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),

          array(
            'id'          => 'minime_socialicon',
            'label'       => 'Icon Name',
            'desc'        => 'Add Social Icon',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )

        )
      ),
	  

	  



 
 
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}