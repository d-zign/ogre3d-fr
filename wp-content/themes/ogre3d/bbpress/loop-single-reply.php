<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<tr class="bbp-reply-header">
		<td colspan="2">

			<a href="<?php bbp_reply_url(); ?>" title="<?php echo "n&deg;" . bbp_get_reply_id() ?>" class="bbp-reply-permalink">
				<img src="<?php echo get_bloginfo('template_directory') . '/images/post.png'; ?>" />
			</a>

			<?php printf( __( 'Posted on %1$s at %2$s', 'bbpress' ), get_the_date('d-m-Y'), esc_attr( get_the_time('h:m:s') ) ); ?>

			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

			<?php bbp_reply_admin_links(); ?>

			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

		</td>
	</tr>

	<tr id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

		<td class="bbp-reply-author" width="180">

			<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

			<div>
				<?php bbp_reply_author_link(array('type' => 'name')); ?>
			</div>
			<div>
				<?php bbp_reply_author_link(array('type' => 'avatar')); ?>
			</div>

			<?php if ( is_super_admin() ) : ?>

				<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

				<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

				<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

		</td>

		<td class="bbp-reply-content">

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		</td>

	</tr><!-- #post-<?php bbp_topic_id(); ?> -->
