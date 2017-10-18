<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Stiff
 */

if ( ! function_exists( 'stiff_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function stiff_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html__( '%s ', 'stiff' ),
		 $time_string
	);

	echo '<span class="posted-on"><i class="space fa fa-calendar"></i> ' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;


// Prints Author Name.
if ( ! function_exists( 'stiff_entry_author' ) ) :
function stiff_entry_author() {
    if ( 'post' == get_post_type() ) {
        $byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'stiff' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
            echo '<span class="theauthor"> ' . $byline . '</span>';
    }
}
endif;

// Prints Category.
if ( ! function_exists( 'stiff_entry_category' ) ) :
function stiff_entry_category() {
    if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$stiff_categories_list = get_the_category_list( __( ', ', 'stiff' ) );
		if ( $stiff_categories_list && stiff_categorized_blog() ) {
			printf( '<div class="thecategory">' . esc_html__( '%1$s ', 'stiff' ) . '</div>', $stiff_categories_list );
		}
    }
}
endif;

// Prints number of Comments.
if ( ! function_exists( 'stiff_entry_comments' ) ) :
function stiff_entry_comments() {
    if ( 'post' == get_post_type() ) {
              $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                  if ( comments_open() ) {
                       if ( $num_comments == 0 ) {
		       $comments = __('No Comments', 'stiff' );
	               } elseif ( $num_comments > 1 ) {
		       $comments = $num_comments . __(' Comments', 'stiff' );
	               } else {
           	       $comments = __('1 Comment', 'stiff' );
	               }
	               $write_comments = $comments;
                       } else {
	               $write_comments =  __('Comments Off!', 'stiff' ); //If comments are disabled
                  }
    
		if ( $write_comments ) {
			printf( '<span class="comments"><i class="fa fa-comments"></i> ' . esc_html__( '%1$s ', 'stiff' ) . '</span>', $write_comments );
		}
    }
}
endif;

// Prints Post Tags.
if ( ! function_exists( 'stiff_entry_tags' ) ) :
function stiff_entry_tags() {
    if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'stiff' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags"></i> ' . esc_html__( '%1$s ', 'stiff' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
    }
}
endif;


if ( ! function_exists( 'stiff_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function stiff_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'stiff' ) );
		if ( $categories_list && stiff_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'stiff' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'stiff' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'stiff' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'stiff' ), esc_html__( '1 Comment', 'stiff' ), esc_html__( '% Comments', 'stiff' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'stiff' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function stiff_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'stiff_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'stiff_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so stiff_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so stiff_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in stiff_categorized_blog.
 */
function stiff_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'stiff_categories' );
}
add_action( 'edit_category', 'stiff_category_transient_flusher' );
add_action( 'save_post',     'stiff_category_transient_flusher' );
