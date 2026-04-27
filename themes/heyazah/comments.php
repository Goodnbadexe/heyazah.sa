<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ELRYAD
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( ! have_comments() )
	return;
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
	<h4 class="comments-title">
			<?php
			$comment_count = get_comments_numELRYAD();
			if ( $comment_count > 0 && is_rtl()) { 
                esc_html_e( 'التعليقات ', 'ELRYAD' );
                echo '('.absint($comment_count).')';
			}elseif ($comment_count > 0){
                esc_html_e( 'Comments ', 'ELRYAD' );
                echo '('.absint($comment_count).')';
			}
			?>
	</h4><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" >
			<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ELRYAD' ); ?></h4>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'ELRYAD' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'ELRYAD' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'ELRYAD_comment_list',
					'short_ping' => false 
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" >
			<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ELRYAD' ); ?></h4>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'ELRYAD' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'ELRYAD' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_numELRYAD() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p class="no-comments">

		<?php if ( is_rtl() ) { 
			esc_html_e( 'التعليقات مغلقة.', 'ELRYAD' ); 
		}else{
			esc_html_e( 'comments are closed.', 'ELRYAD' ); 
		}
		?>
		
		
		</p>
		
	<?php
	endif;
	
	
	?>

</div><!-- #comments -->
