<?php
/* Comments Template */
?>

<?php
$paginatate_comment_class = null;
if ( have_comments() && !get_option( 'page_comments' ) ) {
    $paginatate_comment_class = ' no-paginate-comments';
} else {
    $paginatate_comment_class = ' yes-paginate-comments';
}
?>

<?php if ( post_password_required() ) : ?>
    <p class="post-excerpt"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', AZ_THEME_NAME ); ?></p>
<?php
    return;
    endif;
?>

    <div id="comments">

        <div class="comment-header">

            <div class="comment-header-inner">

                <?php if ( ! comments_open() ) : ?>

                    <p class="post-excerpt"><?php _e( 'Comments are closed.', AZ_THEME_NAME ); ?></p>

                <?php else : ?>

                    <h3 id="comments-title"><span class="comment-count"><?php echo get_comments_number(); ?>.</span><?php comments_number( __( 'Comments', AZ_THEME_NAME ), __( 'Comment', AZ_THEME_NAME ), __( 'Comments', AZ_THEME_NAME ) ); ?></h3>

                    <?php if ( have_comments() && !get_option( 'page_comments' ) ) : ?>

                    <a class="toggle-comment"><i class="font-icon-arrow-down-simple-thin"></i></a>

                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </div>

        <ol class="comments-list<?php echo esc_attr( $paginatate_comment_class ); ?>"><?php wp_list_comments( array( 'callback' => 'az_comment' ) ); ?></ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="paginate-comments">
            <div class="paginate-comments-inner">
                <?php paginate_comments_links('prev_text='. __( 'prev', AZ_THEME_NAME ) .'&next_text='. __( 'next', AZ_THEME_NAME ) .''); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php 
            
            $defaults = array( 'fields' => apply_filters( 
                'comment_form_default_fields', array(
                    'author'        => '<div class="respond-field"><label class="screen-reader">' . __('Name *', AZ_THEME_NAME ) . '</label><input id="author" name="author" placeholder="' . __( 'Name *', AZ_THEME_NAME ) . '" type="text" value="" required="" /></div>',
                    'email'         => '<div class="respond-field"><label class="screen-reader">' . __('Email *', AZ_THEME_NAME ) . '</label><input id="email" name="email" placeholder="' . __( 'Email *', AZ_THEME_NAME ) . '" type="text" value="" required="" /></div>',
                    'url'           => '<div class="respond-field"><label class="screen-reader">' . __('Website', AZ_THEME_NAME ) . '</label><input id="url" name="url" placeholder="' . __( 'Url', AZ_THEME_NAME ) . '" type="text" value="" /></div>' ) 
                ),
                'comment_field' => '<div class="respond-comment"><label for="comment" class="screen-reader">' . __('Comment *', AZ_THEME_NAME ) . '</label><textarea id="comment" name="comment" rows="8" placeholder="' . __( 'Type your message here', AZ_THEME_NAME ) . '" required=""></textarea></div>',
                'must_log_in'   => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', AZ_THEME_NAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                'logged_in_as'  => '<p class="logged-in-as">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) , AZ_THEME_NAME ) . '</p>',
                'comment_notes_before'  => '',
                'comment_notes_after'   => '',
                'id_form'               => 'comment-form',
                'id_submit'             => 'submit',
                'title_reply'           => __( 'Leave a Comment', AZ_THEME_NAME ),
                'title_reply_to'        => __( 'Leave a reply to %s', AZ_THEME_NAME ),
                'cancel_reply_link'     => __( 'Cancel Reply', AZ_THEME_NAME ),
                'label_submit'          => __( 'Submit Comment', AZ_THEME_NAME ),
            ); 
            
            echo '<div class="az-respond-form">';

            comment_form( $defaults ); 

            echo '</div>';
            
        ?>

    </div>

<?php

    /* This is the function which filters the comments */
    function az_comment( $comment, $args, $depth ) {
        
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case '' :
        ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

            <div class="comment-wrap-inner">
            
            <div class="comment-content">

                <div class="comment-avatar"><?php echo get_avatar( $comment, $size='80' ); ?></div>

                <div class="comment-inner">

                    <div class="comment-meta">

                        <div class="comment-author">
                            <h6 class="comment-title"><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?></h6>
                        </div>

                        <div class="comment-misc">
                            <span class="comment-date"><?php echo comment_date( __( 'F j, Y', AZ_THEME_NAME ) ); ?></span>
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2, 'reply_text' => __( ' / Reply', AZ_THEME_NAME ) ) ) ); ?>
                        </div>

                    </div>

                    <div class="comment-text">

                        <?php comment_text(); ?>
                        
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em class="await"><?php _e( 'Your comment is awaiting moderation.', AZ_THEME_NAME ); ?></em>
                        <?php endif; ?>

                    </div>

                </div>

                </div>
            
            </div>

        <?php
            break;
            case 'pingback'  :
            case 'trackback' :
        ?>
        
        <li class="post pingback">
            <p><?php _e( 'Pingback:', AZ_THEME_NAME ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', AZ_THEME_NAME ), ' ' ); ?></p>
        <?php
                break;
        endswitch;
    }

?>