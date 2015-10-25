<?php
/**
 * Comments.php
 * The template for displaying Comments.
 * @package WordPress
 * @subpackage miniME
 * @subpackage miniME 1.1
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<!-- Comments -->


	<?php if ( have_comments() ) : ?>
		 <h2><span class="icon-chat"></span>
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'minime' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'minime' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'minime' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'minime' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use whoiam_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define whoiam_comment() and that will be used instead.
				 * See whoiam_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'minime_comment' ) );
			?>
		<!-- .commentlist -->
		<hr>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'minime' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'minime' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'minime' ) ); ?></div>
		</nav> 
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments text-center"><?php _e( 'Comments are closed.', 'minime' ); ?></p>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
 		

   
		<div class="clearfix">
			<div class="pull-right"><small><?php cancel_comment_reply_link(); ?></small></div>
		</div>
		 
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p class="alert">You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
	

          <?php comment_form(); ?>
		 
		<?php endif; // If registration required and not logged in ?>
		
	 
	<?php endif; // if you delete this the sky will fall on your head ?>
 


<script type="text/javascript">
jQuery('document').ready(function($){
    var commentform=$('#commentform'); // find the comment form
    commentform.prepend('<div id="comment-status" ></div>'); 
    var statusdiv=$('#comment-status'); 

    commentform.submit(function(){
        //serialize and store form data in a variable
        var formdata=commentform.serialize();
        //Add a status message
        statusdiv.html('<p>Processing...</p>');
        //Extract action URL from commentform
        var formurl=commentform.attr('action');
        //Post Form with data
        $.ajax({
            type: 'post',
            url: formurl,
            data: formdata,
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    statusdiv.html('<p class="ajax-error" >You might have left one of the fields blank, or be posting too quickly</p>');
                },
            success: function(data, textStatus){
                if(data == "success" || textStatus == "success"){
                    statusdiv.html('<p class="ajax-success" >Thanks for your comment. We appreciate your response.</p>');
                }else{
                    statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
                    commentform.find('textarea[name=comment]').val('');
                }
            }
        });
        return false;
    });
});</script>
	<!-- Comments -->