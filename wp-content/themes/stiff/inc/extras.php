<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Stiff
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function stiff_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'stiff_body_classes' );


/*
 * Home Page Slider Shortcode
 */
 function stiff_slider_cb(){ 

$stiff_cat_id =  get_theme_mod( 'general_slider_category', 1 ) ; 
$stiff_post_num =  get_theme_mod( 'general_slider_number', 3 ) ;
	?>
	<div class="home-slider">
		<ul class="bxslider">
		
		<?php	
			// Set the argument and query for posts
			$args = array(
			'posts_per_page' => absint($stiff_post_num),
			'category__in'	=>  absint($stiff_cat_id),
			'post_type' 	=> 'post',
			'post_status' 	=> 'publish',		
			);
			$stiff_slider = new WP_Query( $args ); ?>
			
			<?php /* Start the Loop */ ?>
			<?php if ( $stiff_slider->have_posts() ): while ( $stiff_slider->have_posts() ) : $stiff_slider->the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'slider' ); ?>

						<?php endwhile; wp_reset_postdata();?>
								

					<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>
		</ul>
	</div>
	<?php 
}  
add_action( 'stiff_home_slider', 'stiff_slider_cb');


function stiff_footer(){
	$stiff_copyright = get_theme_mod('general_footer_copyright', ''); 

?>
			</div><!-- .container -->
	</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">	
	<div class="foot-top">
		<div class="container">
			<div class="row">
					<div class="col-md-3 col-sm-3">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-3 col-sm-3">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-3 col-sm-3">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-3 col-sm-3">
						<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
							<?php dynamic_sidebar( 'footer-4' ); ?>
						<?php endif; ?>
					</div>	
			</div>
		</div>
	</div>
	<div class="foot-bottom">
		<div class="container">
			<div class="row">
					<div class="col-md-6 float-l">
						<div class="copyright">
						
							<?php if(!empty($stiff_copyright)){ ?>
							
							<p> <?php echo esc_html( $stiff_copyright ); ?></p>
							
							
							<?php } else {  ?> 
						
							<p><a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'stiff' ), 'WordPress' ); ?></a></p>
							<?php }?>
							
							
						</div>	
					</div>
					
					<div class="col-md-6 float-r">
						<div class="designed-by">
							<p><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'stiff' ), '<a href="http://www.wp3layouts.com/stiff-wordpress-simple-bootstrap-blog-theme/" target="_blank">Stiff</a>', '<a href="http://www.wp3layouts.com/" target="_blank">WP3Layouts</a>' ); ?></p>
						</div>
					</div>			
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
	
	
</div><!-- #page -->
<!-- Footer Ends Here -->

<?php wp_footer(); ?>

</body>
</html>
	<?php
}
