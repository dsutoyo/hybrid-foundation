<?php
/**
 * Foundationalize Walker Class
 * Custom output to enable the the ZURB Navigation style, now supports Foundation 5
 * Adapted from Reverie (http://themefortress.com/reverie/) and Required (http://themes.required.ch/)
 * 
 * @since 0.1.0
 * @access public
 */
class Foundationalize_Walker extends Walker_Nav_Menu {

	/**
	 * Specify the item type to allow different walkers
	 * @var array
	 */
	var $nav_bar = '';

	function __construct( $nav_args = '' ) {

		$defaults = array(
			'item_type' => 'li',
			'in_top_bar' => false,
			'divider' => false,
			'divider_content' => '',
			'offcanvas' => false,
			'has_dropdown_marker' => true
		);
		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		// Reset the classes if this is an offcanvas menu
		if ( $this->nav_bar['offcanvas'] == true ) {
			$classes = array();
		}
		else {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		}
		$classes[] = 'menu-item-' . $item->ID;

		// Additional Class cleanup, as found in Roots_Nav_Walker - Roots Theme lib/nav.php
		// see http://roots.io/ and https://github.com/roots/roots
		$slug = sanitize_title($item->title);

		if ( array_key_exists( 'menu_type', $this->nav_bar ) ) {
			$menu_type = $this->nav_bar['menu_type'];
			$classes[] = 'menu-item menu-item-' . $menu_type . ' menu-item-' . $slug;
		} else {
			$classes[] = 'menu-item menu-item-' . $slug;
		}

		$classes = array_unique($classes);

		// Check for flyouts and submenus depending on the menu type
		$flyout_toggle = '';
		if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {

			// If not inside the top bar...
			if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {

				if ( $this->nav_bar['offcanvas'] == true ) {
					$classes[] = 'has-submenu';
					$flyout_toggle = '<span><i></i></span>';
				}
				else {	
					$classes[] = 'has-flyout';
					$flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';
				}

			}
			// Else if inside the top bar...
			else if ( $this->nav_bar['in_top_bar'] == true ) {

				$classes[] = 'has-submenu';
				$flyout_toggle = '';

				if ( $this->nav_bar['has_dropdown_marker'] == false ) {
					$classes[] = 'no-dropdown-marker';
				}

			}

		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			if ( $this->nav_bar['offcanvas'] == true ) {
				$output .= $indent . '<li id="offcanvas-menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			} else {
				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			}
		} else {
			$menu_item_id = $this->nav_bar['offcanvas'] == true ? 'offcanvas-menu-item-' . $item->ID : 'menu-item-' . $item->ID; 
			if ( $this->nav_bar['divider'] == true ) {
				$output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider">' . $this->nav_bar['divider_content'] . '</li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="' . $menu_item_id . '"' . $value . $class_names .'>';
			} else {
				$output .= $indent . '<' . $this->nav_bar['item_type'] . ' id="' . $menu_item_id . '"' . $value . $class_names .'>';
			}
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output  = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $flyout_toggle; // Add possible flyout toggle
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</" . $this->nav_bar['item_type'] . ">\n";
		}
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
			$indent = str_repeat("\t", 1);
			if ( $this->nav_bar['offcanvas'] == true ) {
				$output .= "\n$indent<ul class=\"submenu menu\">\n";
			}
			else {
				$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"submenu menu\" data-submenu>\n" : "\n$indent<ul class=\"flyout\">\n";
			}
	 	}
	 	else {
			$indent = str_repeat("\t", $depth);
			$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"submenu menu\" data-submenu>\n" : "\n$indent<ul class=\"level-$depth\">\n";
		}
	}
}

?>