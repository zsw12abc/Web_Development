<?php
/**
 * @package WordPress
 * @subpackage goodweb_Theme
 */
?>

<?php if ( post_password_required() ) : ?>
	<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'goodweb' ); ?></p>
<?php return; endif; ?>

<?php if( comments_open()){ 
		//Comments
		$numOfComments = get_comments_number();
		$numOfComments_detail = $numOfComments == 0 ? __("Comments","goodweb") : $numOfComments;
		$numOfComments_detail = $numOfComments == 1 ? __("Comment","goodweb") :  __(" Comments","goodweb");	
?>

		<!-- Begin Comments -->
		<div id="comments" class="clear"></div>
		<!-- THE COMMENTS AND REPLY-->
		<article class="comments-container">

			<div class="boxedbg-title container">
				<h4><?php echo $numOfComments." ".$numOfComments_detail.__(" for this post","goodweb"); ?></h4>	
			</div>
			
			<!-- THE BOXED CONTAINER -->
			<section class="boxedbg container">
				<?php if ( have_comments() ) : ?>
					<!-- THE COMMENTS -->
					<article class="thecomments">
						<ul><?php wp_list_comments(array('style' => 'ul','avatar_size' => '100','callback' => 'goodweb_comment')); ?></li></ul>
					</article><!-- END OF THE COMMENTS -->
				    <!-- End Comments -->
				<?php endif;  ?>
				
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
					<div>
						<div class="left marginbottom10"><?php previous_comments_link( __( 'Older Comments ', 'goodweb' ) ); ?></div>
						<div class="right marginbottom10"><?php next_comments_link( __( 'Newer Comments', 'goodweb' ) ); ?> </div>
					</div>
				<?php endif;  ?>
	
				<div class="clear"></div>
				<article class="thereply">
				<?php	$comments_args = array(
							'fields' => apply_filters( 'comment_form_default_fields', array(
								'author' => '<div class="one_third nobottommargin"><input type="text"  class="prepared-input w100 boxsize" name="author" id="contactname" value="'.__( 'Name', 'goodweb' ).'*"></div>',
							'email'  => '<div class="one_third nobottommargin"><input type="email" class="prepared-input w100 boxsize" name="email" id="contactemail" value="'.__( 'Email', 'goodweb' ).'*"></div>',
							'url'    => '<div class="one_third lastcolumn nobottommargin"><input type="text" class="prepared-input w100 boxsize" id="url" name="url" value="'.__( 'Website', 'goodweb' ).'" /></div>')
							),
							'id_form' => 'commentform',
					        'title_reply'=>__( 'Leave A Reply', 'goodweb' ),
					        'comment_field' => ' <div class="divide10 hidden-phone"></div><textarea id="message" name="comment" rows="3" id="textarea" class="prepared-input w100 boxsize" title="">'.__( 'Enter your comment here...', 'goodweb' ).'</textarea>',
							'label_submit' => __( 'Post Comment' , 'goodweb'),
							'id_submit' => 'From_Comment_Go',
							'comment_notes_before' => ' ',
							'comment_notes_after' => ' ' //remove "You may use these HTML tags and attributes: ...."
						);
				comment_form($comments_args);?>
				</article><!-- END OF REPLY -->
		</section>
		</article>
<?php } ?>

<?php
function goodweb_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		
		$reply_args = array(
			'reply_text' => '<span class="pull-right"><span class="reply-hide">'.__("REPLY","goodweb").'</span><i class="icon-forward"></i></span>'
		);

?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="table-cell avatar">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="table-cell comment-content">
			<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.',"goodweb") ?></em>
				<br />
			<?php endif; ?>

			<?php comment_text() ?>

			<div class="contentdivider-mini"></div>
			<div class="comment-details">
				<span class="commenter pull-left"><?php comment_author_link(); ?></span><span class="pull-left"><?php echo time_ago('comment'); ?></span>
				<?php comment_reply_link(array_merge( $reply_args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }?>
        