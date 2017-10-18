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
function stiff_general_customizer( $wp_customize ) {

		//Add "Switcher" support to the theme customizer
		class stiff_Customizer_Switcher_Control extends WP_Customize_Control {
			public $type = 'switcher';
		 
			public function render_content() {
				?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input class="ios-switch green bigswitch" type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> /><div class="ios-switch-div" ><div></div></div>
					</label>				
				<?php
			}
		}
	
			// Add Radio-Image control support to the theme customizer
		class stiff_Customizer_Radio_Image_Control extends WP_Customize_Control {
			public $type = 'radio-image';
			
			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-button' );
			}
			
			// Markup for the field's title
			public function title() {
				echo '<span class="customize-control-title">';
					$this->label();
					$this->description();
				echo '</span>';
			}

			// The markup for the label.
			public function label() {
				// The label has already been sanitized in the Fields class, no need to re-sanitize it.
				echo $this->label;
			}

			// Markup for the field's description
			public function description() {
				if ( ! empty( $this->description ) ) {
					// The description has already been sanitized in the Fields class, no need to re-sanitize it.
					echo '<span class="description customize-control-description">' . $this->description . '</span>';
				}
			}
			
			public function render_content() {
				if ( empty( $this->choices ) ) {
					return;
				}
				$name = '_customize-radio-' . $this->id;
				?>
				<?php $this->title(); ?>
				<div id="input_<?php echo $this->id; ?>" class="image">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_url( $label ); ?>">
							</label>
						</input>
					<?php endforeach; ?>
				</div>
				<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
				<?php
			}
		}
	
	
	
		
	//General Settings
	$wp_customize->add_panel( 
		'stiff_general_setting', 
		array(
			'priority'       => 2,
			'capability'     => 'edit_theme_options',
			'title'      => __('General Settings', 'stiff'),
		) 
	);
	
	//Colors
	//Theme Colors
	$wp_customize->add_setting(
		'theme_color',
			array(
			'default' => __('#008692','stiff'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
		$wp_customize,
		'theme_color',
			array(
			'label'   => __('Theme Color','stiff'),
			'section' => 'colors',
			 ) 
		 ) 
	 );
	 //Secondary Colors
	 $wp_customize->add_setting(
		'secondary_theme_color',
			array(
			'default' => __('#DB882E','stiff'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
		$wp_customize,
		'secondary_theme_color',
			array(
			'label'   => __('Secondary Color','stiff'),
			'section' => 'colors',
			 ) 
		 ) 
	 );

	//Search
	 $wp_customize->add_section(
        'home_general_settings_searchfield',
        array(
            'title' => __('Menu Search Field','stiff'),
			'panel'  => 'stiff_general_setting',)
    );
	 
	//Hide search bar
	$wp_customize->add_setting(
		'home_general_hidesearch',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'stiff_sanitize_checkbox',
		)	
	);
	$wp_customize->add_control(
			new stiff_Customizer_Switcher_Control(
				$wp_customize,			
				'home_general_hidesearch', 
				array(
					'label' => __('Search Button','stiff'),
					'section' => 'home_general_settings_searchfield',
			)
		)
	);
	
	
	//<---Slider Section
	 $wp_customize->add_section(
        'general_slider_section',
        array(
            'title' => __('Home Slider Options','stiff'),
			'panel'  => 'stiff_general_setting',)
    );

	//Hide Slider
	$wp_customize->add_setting(
		'general_slider_onoff',
		array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'stiff_sanitize_checkbox',
		)	
	);
	$wp_customize->add_control(
			new stiff_Customizer_Switcher_Control(
				$wp_customize,			
				'general_slider_onoff', 
				array(
					'label' => __('Slider','stiff'),
					'section' => 'general_slider_section',
			)
		)
	);
 	
	// Slider
	$wp_customize->add_setting(
		'general_slider_number',
			array(
			'default' => '3',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		new WP_Customize_Control(
		$wp_customize,
		'general_slider_number',
			array(
			'label'   => __('Number of Posts','stiff'),
			'section' => 'general_slider_section',
			'type' 	=> 'number',
			'input_attrs' => array(
			    'min'   => 1,
			    'max'   => 10,
			    )
			 ) 
		 ) 
	 );
	 
	 //Slider Category Select
	 // create an empty array
		$stiff_cats = array();
		 
		// we loop over the categories and set the names and
		// labels we need
		foreach ( get_categories() as $stiff_categories => $stiff_category ){
			$stiff_cats[$stiff_category->term_id] = $stiff_category->name;
		}
	 $wp_customize->add_setting(
		'general_slider_category',
			array(
			'default' => 1,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		new WP_Customize_Control(
		$wp_customize,
		'general_slider_category',
			array(
			'label'   => __('Select Category','stiff'),
			'section' => 'general_slider_section',
			'type' 	=> 'select',
			'choices' => $stiff_cats,
			 ) 
		 ) 
	 );
	 

	
	/**/
	//Footer Settings
	 $wp_customize->add_section(
        'general_footer',
        array(
            'title' => __('Footer Settings','stiff'),
			'panel'  => 'stiff_general_setting',)
    );
 	
	// Footer
	$wp_customize->add_setting(
		'general_footer_copyright',
			array(
			'default' => __('Powered by WordPress','stiff'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);	
	$wp_customize->add_control( 
		new WP_Customize_Control(
		$wp_customize,
		'general_footer_copyright',
				array(
				'label'   => __('Copyright','stiff'),
				'section' => 'general_footer',
				 'type' => 'text',
			 ) 
		 ) 
	 );
	 	
	
	
	
}
add_action( 'customize_register', 'stiff_general_customizer' );



// Style settings output.
function stiff_style_settings() {
	
	$stiff_theme_color = get_theme_mod( 'theme_color', '#008692' );
	$stiff_secondary_theme_color = get_theme_mod( 'secondary_theme_color', '#DB882E' );
		
	?>
	<style type="text/css">					
		<!--Theme Color-->		
		input[type="text"],input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],textarea, blockquote a { color: <?php echo esc_attr( $stiff_theme_color); ?>;}
		
		.main-navigation,.main-navigation,.main-navigation ul ul,.widget,.content-excerpt,.content-single,.postauthor,.comments-area,.news-excerpt,.main-navigation #main-menu{ background-color: <?php echo esc_attr( $stiff_theme_color ); ?>;}
		
		<!-- Secondary Colors-->
		input[type="text"]:focus,input[type="email"]:focus, input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,textarea:focus,select:focus { box-shadow: 0 0 5px <?php echo esc_attr( $stiff_secondary_theme_color ); ?>; border: 1px solid <?php echo esc_attr( $stiff_secondary_theme_color ); ?>;}
		
		.error-404 input[type="submit"]:hover,input[type="submit"]:hover,.site-header .search-field:focus,.post-readmore:hover,.nav-previous a:hover,.nav-next a:hover{ border: 2px solid <?php echo esc_attr( $stiff_secondary_theme_color ); ?> ;}
		
		.main-navigation,.main-navigation,.widget{ border-bottom: 2px solid <?php echo esc_attr( $stiff_secondary_theme_color ); ?> ;}
		
		.content-excerpt,.content-single,.postauthor,.comments-area,.news-excerpt{ border-top: 3px solid <?php echo esc_attr( $stiff_secondary_theme_color ); ?> ;}
				
		.error-404 input[type="submit"],input[type="submit"],.main-navigation a:hover,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.post-readmore,.nav-previous a,.nav-next a,.foot-bottom{ background-color: <?php echo esc_attr( $stiff_secondary_theme_color ); ?> ;}
		
		 .error-404 input[type="submit"]:hover,input[type="submit"]:hover,.post-readmore:hover,.nav-previous a:hover,.nav-next a:hover { color: <?php echo esc_attr( $stiff_secondary_theme_color ); ?>;}
	</style>
	<?php
}
add_action( 'wp_head', 'stiff_style_settings' );
	
?>