<?php

if ( ! function_exists( 'hybrid_foundation_get_option' ) ) {

	function hybrid_foundation_get_option( $option, $default = '' ) {

		$theme_options = Hybrid_Foundation_Theme_Options::get_options();

		$value = ( isset( $theme_options[ $option ] ) && '' !== $theme_options[ $option ] ) ? $theme_options[ $option ] : $default;

		return $value;
	}

}