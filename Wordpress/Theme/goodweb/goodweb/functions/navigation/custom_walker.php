<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class rc_scm_walker extends Walker_Nav_Menu
{
  
  //Include Subtitle
      function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	       if(get_theme_mod("goodweb_one-multi","multi")=="one") {
	           if(empty($item->subtitle) && $item->type!="custom"){
		           		$attributes .= ! empty( $item->url )        ? '  class="internallink" href="'.get_home_url().'#'   . esc_attr( str_replace('%','',sanitize_title($item->title))       ) .'"' : '';
		           }
	           else{
	           		if($item->url!="#")
	           			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url ) .'"' : '';	
	           		else ' class="nolink" ';           
	           }
			}
			else{
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url ) .'"' : '';	
			}
           $prepend = '';
           $append = '';
           $icon  = ! empty( $item->icon ) ? '<i class="demoicon '.esc_attr( $item->icon ).'"></i>' : '';

           /*if($depth != 0)
           {
	           $icon = $append = $prepend = "";
           }*/

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>'.$icon;
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= '<div class="clear"></div>';
            $item_output .= $args->after; 

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            
   //Include Special CSS for indicating Submenus
      function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
	        $id_field = $this->db_fields['id'];
	        if ($depth && !empty( $children_elements[ $element->$id_field ] ) ) {
	            $element->classes[] = 'hassubmenu';
	        }
	        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }
}
