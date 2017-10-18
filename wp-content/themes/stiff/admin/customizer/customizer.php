<?php
/**
 * Stiff WP3 Theme Customizer.
 *
 * @package Stiff
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function stiff_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'stiff_customize_register' );

/**
 * Checkbox sanitization callback
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function stiff_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//Loading Customizer Styles
function stiff_customizer_inline_css() {
?>
	<style type="text/css">
	#customize-control-favicon_image .current {
		width: 50px;
	}	
	.ui-state-active img {
		border: 2px solid #c60000;
	}
	#customize-control-sidebar_settings .ui-state-active img {
		width: 71px;
		height: 46px;
	}
	#input_background_pattern {
		height: 220px;
		overflow: auto;
	}
	#input_background_pattern img {
		width: 70px;
		height: 70px;
	}	
	#input_background_pattern .ui-state-active img {
		width: 66px;
		height: 66px;
	}	
	/* Switch Styles */	
	input[type="checkbox"].ios-switch {
		display: none !important;
	}
	input[type="checkbox"].ios-switch + div {
		vertical-align: middle;
		width: 40px;	height: 20px;
		border: 1px solid rgba(0,0,0,.4);
		border-radius: 999px;
		background-color: rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: .4s;
		-webkit-transition-property: background-color, box-shadow;
		box-shadow: inset 0 0 0 0px rgba(0,0,0,0.4);
		margin: 15px 1.2em 15px 2.5em;
	}
	input[type="checkbox"].ios-switch:checked + div {
		width: 40px;
		background-position: 0 0;
		background-color: #3b89ec;
		border: 1px solid #0e62cd;
		box-shadow: inset 0 0 0 10px rgba(59,137,259,1);
	}
	input[type="checkbox"].tinyswitch.ios-switch + div {
		width: 34px;	height: 18px;
	}
	input[type="checkbox"].bigswitch.ios-switch + div {
		width: 50px;	height: 25px;
	}
	input[type="checkbox"].green.ios-switch:checked + div {
		background-color: #00e359;
		border: 1px solid rgba(0, 162, 63,1);
		box-shadow: inset 0 0 0 10px rgba(0,227,89,1);
	}
	input[type="checkbox"].ios-switch + div > div {
		float: left;
		width: 18px; height: 18px;
		border-radius: inherit;
		background: #ffffff;
		-webkit-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
		-webkit-transition-duration: 0.4s;
		-webkit-transition-property: transform, background-color, box-shadow;
		-moz-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
		-moz-transition-duration: 0.4s;
		-moz-transition-property: transform, background-color;
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(0, 0, 0, 0.4);
		pointer-events: none;
		margin-top: 1px;
		margin-left: 1px;
	}
	input[type="checkbox"].ios-switch:checked + div > div {
		-webkit-transform: translate3d(20px, 0, 0);
		-moz-transform: translate3d(20px, 0, 0);
		background-color: #ffffff;
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].tinyswitch.ios-switch + div > div {
		width: 16px; height: 16px;
		margin-top: 1px;
	}
	input[type="checkbox"].tinyswitch.ios-switch:checked + div > div {
		-webkit-transform: translate3d(16px, 0, 0);
		-moz-transform: translate3d(16px, 0, 0);
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].bigswitch.ios-switch + div > div {
		width: 23px; height: 23px;
		margin-top: 1px;
	}
	input[type="checkbox"].bigswitch.ios-switch:checked + div > div {
		-webkit-transform: translate3d(25px, 0, 0);
		-moz-transform: translate3d(16px, 0, 0);
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].green.ios-switch:checked + div > div {
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 162, 63,1);
	}
	.ios-switch-div {
		margin: 1px !important;
		margin-bottom: 10px !important;
	}
	#rate-theme {
	  background: #038764;
	  border-color: #037758 #015238 #015238;
	  color: #ffffff;
	  -webkit-box-shadow: 0 1px 0 #015238;
	  box-shadow: 0 1px 0 #015238;
	  text-shadow: 0 -1px 1px #015238, -1px 0 1px #015238, 0 1px 1px #015238, 1px 0 1px #015238;
	}
	</style>
	<?php
}
add_action( 'customize_controls_enqueue_scripts', 'stiff_customizer_inline_css' );






/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function stiff_customize_preview_js() {
	wp_enqueue_script( 'stiff_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'stiff_customize_preview_js' );
