<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Stiff
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-slider-list'); ?>>

	<?php if ( has_post_thumbnail() ) : ?> 
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('stiff_slider_post'); ?>
			</a>
		</div>
	<?php endif; ?>
	
	<div class="post-content">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
			<div class="entry-meta">
				
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_excerpt();
			?>

		</div><!-- .entry-content -->
		
		<div class="readmore">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html('Read More', 'stiff'); ?> </a>
		</div>
		
	</div><!-- .post-content -->

	
	
</article><!-- #post-## -->
