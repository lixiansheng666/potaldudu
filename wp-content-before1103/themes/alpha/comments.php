<?php
/**
 * Comments template
 */
?>

<?php if ( post_password_required() ) : ?>
	<p class="post-excerpt"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'alpha' ); ?></p>
<?php
		return;
	endif;
?>

	<aside id="comments">

	<?php if ( ! comments_open() ) : ?>

		<p class="post-excerpt"><?php esc_html_e( 'Comments are closed.', 'alpha' ); ?></p>

	<?php else : ?>

		<h3 id="comments-title"><?php esc_html_e( 'Comments', 'alpha'); ?> (<?php comments_number( '0', '1', '%' ); ?>)</h3>

	<?php endif; ?>

	<?php if ( ! have_comments() ) : ?>

		<p class="post-excerpt"><?php esc_html_e( 'There are not comments on this post yet. Be the first one!', 'alpha' ); ?></p>

	<?php endif; ?>

		<ol id="comments-list" itemscope itemtype="http://schema.org/UserComments"><?php wp_list_comments( array( 'callback' => 'alpha_comment' ) ); ?></ol>

		<?php paginate_comments_links(); ?>

		<?php 
			
			$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="krown-column-container span4" style="margin-left:0"><label for="autor">' . esc_html__( 'Name', 'alpha' ) . '</span></label><input id="author" name="author" type="text" value="" placeholder="' . esc_html__( 'Name', 'alpha' ) . '" /></div>',
				'email'  => '<div class="krown-column-container span4"><label for="email">' . esc_html__( 'Email', 'alpha' ) . '</span></label><input id="email" name="email" type="text" value="" placeholder="' . esc_html__( 'Email', 'alpha' ) . '" /></div>',
				'url'    => '<div class="krown-column-container span4 last"><label for="url">' . esc_html__( 'Website', 'alpha' ) . '</span></label><input id="url" name="url" type="text" value="" placeholder="' . esc_html__( 'Website', 'alpha' ) . '" /></div>' ) ),
				'comment_field' => '<div class="krown-column-container span12 last" style="margin-left:0"><label for="comment">' . esc_html__( 'Your Comment', 'alpha' ) . '</span></label><textarea id="comment" name="comment" rows="8" placeholder="' . esc_html__( 'Your comment', 'alpha' ) . '"></textarea></div>',
				'must_log_in' => '<p style="margin-bottom:25px" class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'alpha' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as' => '<p style="margin-bottom:25px" class="logged-in-as">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'alpha' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'id_form' => 'comment-form',
				'id_submit' => 'submit',
				'title_reply' => esc_html__( 'Post a comment', 'alpha' ),
				'title_reply_to' => esc_html__( 'Leave a reply to %s', 'alpha' ),
				'cancel_reply_link' => esc_html__( 'Cancel reply', 'alpha' ),
				'label_submit' => esc_html__( 'Post comment', 'alpha' ),
			); 
			
			echo '<div class="krown-form">';

			comment_form( $defaults ); 

			echo '</div>';
			
		?>
		
	</aside>

	
<?php

	/* This is the function which filters the comments */

	function alpha_comment( $comment, $args, $depth ) {

		$retina = alpha_retina();
		
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment clearfix">
			
			<div class="comment-avatar"><?php echo get_avatar( $comment, ( $retina === 'true' ? 160 : 80 ), $default='' ); ?></div>

			<div class="comment-content">

				<div class="comment-meta clearfix">

					<h6 class="comment-title"><?php echo ( get_comment_author_url() != '' ? '<a href="' . get_comment_author_url() . '" target="blank">' . get_comment_author() . '</a>' : comment_author() ); ?></h6>
					<span class="comment-date"><?php echo comment_date( esc_html__( 'F j, Y', 'alpha' ) ); ?></span>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3, 'reply_text' =>  '<i class="krown-icon-cw"></i>' . esc_html__( 'Reply', 'alpha') ) ) ); ?>

				</div>

				<div class="comment-text">

					<?php comment_text(); ?>
					
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="await"><?php esc_html_e( 'Your comment is awaiting moderation.', 'alpha' ); ?></em>
					<?php endif; ?>

				</div>

			</div>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php esc_html_e( 'Pingback:', 'alpha' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__('(Edit)', 'alpha'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
	}

?>