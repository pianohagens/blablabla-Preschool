<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Stiff
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-excerpt'); ?>>
	<header class="entry-header"><!--Post Title-->
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<div class="post-image"><!--Featured Image-->
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('stiff_big'); ?></a>
			<?php endif; ?>
		</div>					
		<div class="post-meta"><!--Post Meta-->
			<?php stiff_post_meta(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
			/* the post excerpts */
				the_excerpt();
			?> 
		
		<div class="readmore">
			<a class="post-readmore float-r" href="<?php the_permalink(); ?>"><?php echo esc_html('READ MORE', 'stiff'); ?></a>
		</div>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
