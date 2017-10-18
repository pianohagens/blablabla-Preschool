<?php
/**
 * Stiff functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Stiff
 */


if ( ! function_exists( 'stiff_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stiff_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Stiff, use a find and replace
	 * to change 'stiff' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'stiff', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'stiff_slider_post', 500, 300, array('center','top') );
	add_image_size( 'stiff_big', 750, 350, array('center','top') ); //big Post Featured
	add_image_size( 'stiff_smallfeatured', 380, 250, array('center','top') ); //featured image
	add_image_size( 'stiff_small', 120, 120, true ); //small

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'stiff' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add support for custom header
	$args = apply_filters( 'custom-header', array( 'height' => 200) );
	add_theme_support( 'custom-header', $args );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array( 'height' => 130, 'width' => 200, 'flex-width' => true, 'flex-height' => false ) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'stiff_custom_background_args', array(
		'default-color' => '#26495B',
		'default-image' => '',
	) ) );

}
endif; // stiff_setup
add_action( 'after_setup_theme', 'stiff_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stiff_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stiff_content_width', 640 );
}
add_action( 'after_setup_theme', 'stiff_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stiff_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'stiff' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	//Register footer 1
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'stiff' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	//Register footer 2
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'stiff' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	//Register footer 3
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'stiff' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	//Register footer 4
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'stiff' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'stiff_widgets_init' );



/*-----------------------------------------------------------------------------------*/
/*  Custom Excerpts.
/*-----------------------------------------------------------------------------------*/
if( !is_admin() ){
	function stiff_new_excerpt_more (){
		return ' &hellip; ';
	}
	add_filter('excerpt_more','stiff_new_excerpt_more');

	function stiff_custom_excerpt_length ($lenth){
		return 50; // Excerpts
	}
	add_filter ('excerpt_length', 'stiff_custom_excerpt_length');
}
/*-----------------------------------------------------------------------------------*/
/*  Post Meta infos
/*-----------------------------------------------------------------------------------*/
	//Display meta info if enabled.
function stiff_post_meta(){ ?> <!--We close PHP and open the way for HTML code -->
		<ul>
			<li><?php stiff_posted_on(); ?></li>
			<li><?php stiff_entry_author(); ?></li>
			<li><?php stiff_entry_category(); ?></li>
			<li><?php stiff_entry_comments(); ?></li>
		</ul>
<?php }


//Posts Pagination
function stiff_next_prev_posts() { ?>
		<div class="next_prev_post">
			<div class="nav-previous float-l"><?php next_posts_link( __( 'Older Posts', 'stiff' ) ); ?>
			</div>

			<div class="nav-next float-r"><?php previous_posts_link( __( 'Newer Posts', 'stiff' ) ); ?>
			</div>
		</div><!-- .nav-links -->
	<?php }

/*-----------------------------------------------------------------------------------*/
/*  Single Post Settings
/*-----------------------------------------------------------------------------------*/
		
//Display Post Next/Prev buttons.
function stiff_next_prev_post() { ?> <!--We close PHP and open the way for HTML code -->
	<div class="next_prev_post">
		<?php 
			//We Create the Previous Link
			previous_post_link( '<div class="nav-previous"> %link</div>', '<i class="fa fa-chevron-left"></i> '. __('Previous Post','stiff'));
			
			//We Create the Next Link
			next_post_link( '<div class="nav-next">%link</div>', __('Next Post','stiff'). ' <i class="fa fa-chevron-right"></i>' );
		?>
	</div><!-- .next_prev_post -->
<?php }                 





/**
 * Enqueue scripts and styles.
 */
function stiff_scripts() {
	wp_enqueue_style( 'bootstrap',  get_template_directory_uri() . '/bootstrap/css/bootstrap.css' );
	
	wp_enqueue_style( 'stiff-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'font-awesome',  get_template_directory_uri() . '/font-awesome/css/font-awesome.css' );

	wp_enqueue_script( 'stiff-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'stiff-menu-js', get_template_directory_uri() . '/js/menu.js', array('jquery'), '20120206', true );

	// bxSlider CSS file -->
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri() .'/jquery.bxslider/jquery.bxslider.css' );
	
	// bxSlider Javascript file -->
	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/jquery.bxslider/jquery.bxslider.min.js', array('jquery'), true );
	wp_enqueue_script( 'stiff-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery-bxslider'), '', true );
	

	wp_enqueue_style( 'stiff-lobster-two-font',  '//fonts.googleapis.com/css?family=Lobster+Two:400,700' );

	wp_enqueue_style( 'stiff-open-sans-font',  '//fonts.googleapis.com/css?family=Open+Sans:400,600,700' );

	wp_enqueue_script( 'stiff-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'stiff_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/admin/customizer/customizer.php';
require get_template_directory() . '/admin/customizer/customizer-general.php';
require get_template_directory() . '/admin/customizer/customizer-support.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

