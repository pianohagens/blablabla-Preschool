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

function Stiff_Support_Customizer( $wp_customize ) {
	class WP_Pro_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		<div style="border-bottom: 1px solid #ddd;">

		<div class="lite-box" style="text-align:center">
			<a style="margin: 20px 10px 0px;"href="<?php echo esc_url('http://demo.wp3layouts.com/stiff/'); ?>" class="button" target="_blank"><?php echo esc_html('View Demo!','stiff');?></a>

			<a style="margin: 20px 10px 0px;"href="<?php echo esc_url('http://www.wp3layouts.com/support/');?>" class="button" target="_blank"><?php echo esc_html('Documentation','stiff');?></a>
		</div>

		<a class="button" id="rate-theme" style="display: table;margin: 20px auto;"href="<?php echo esc_url('https://wordpress.org/support/theme/stiff/reviews/'); ?>" class="button" target="_blank"><?php echo esc_html('Rate This Theme','stiff');?>
		</a>

		<div style="text-align:center">
			<?php _e('<div class="support-box">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="8LQ6HJL7587D4">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>', 'stiff'); ?>
		</div>

		</div>
		 <div class="pro-vesrion">
		 <?php echo esc_html('If you like this WordPress Layout please do well to support our work by donating.  ','stiff');?>
		 </div>
		<?php
		}
	}
$wp_customize->add_section( 'stiff_pro_section' , array(
		'title'      => __('SUPPORT', 'stiff'),
		'priority'   => 1,
   	) );

$wp_customize->add_setting(
    'upgrade_pro',
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_Pro_Customize_Control( 
	$wp_customize, 
		'upgrade_pro', array(
		'label' => __('Discover Stiff','stiff'),
        'section' => 'stiff_pro_section',
		'setting' => 'upgrade_pro',
    ))
);




}
add_action( 'customize_register', 'Stiff_Support_Customizer' );
?>