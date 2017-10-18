<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Stiff
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="post-meta"><!--Post Meta-->
			<?php stiff_post_meta(); ?>
		</div>
	</header><!-- .entry-header -->
	
	<div class="post-image"><!--Featured Image-->
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('stiff_big'); ?>
		<?php endif; ?>
	</div>	

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<div class="links-pages">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'stiff' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="post-tags">
		<?php stiff_entry_tags(); ?>
	</div>
	
	<nav class="navigation post-navigation" role="navigation">
		<?php stiff_next_prev_post(); ?>
	</nav><!-- .navigation -->
</article><!-- #post-## -->

