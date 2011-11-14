<?php

/**
 * Template Name: bbPress - Forums (Index)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>
<div id="container">
    <div class="centered">
		<div id="content" role="main">

			<?php do_action( 'bbp_template_notices' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<div id="forum-front" class="bbp-forum-front">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">

						<?php the_content(); ?>

						<?php bbp_breadcrumb(); ?>

						<?php do_action( 'bbp_template_before_forums_index' ); ?>
						
						<?php if ( bbp_has_forums() ) : ?>
							<?php do_action( 'bbp_template_before_forums_loop' ); ?>

								<?php while ( bbp_forums() ) : bbp_the_forum(); ?>
						
								<table class="bbp-forums">

									<thead>
										<tr>
											<th class="bbp-forum-info"><?php _e( bbp_forum_title(), 'bbpress' ); ?></th>
											<th class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></th>
											<th class="bbp-forum-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></th>
										</tr>
									</thead>

									<tfoot>
										<tr><td colspan="4">&nbsp;</td></tr>
									</tfoot>

									<tbody>
									
										<?php if ($sub_forums = bbp_forum_get_subforums()) : ?>
											<?php foreach ( $sub_forums as $sub_forum ) { ?>
												
												<tr id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

													<td class="bbp-forum-info">
														<a class="bbp-forum-title" href="<?php bbp_forum_permalink($sub_forum->ID); ?>" title="<?php bbp_forum_title($sub_forum->ID); ?>"><?php bbp_forum_title($sub_forum->ID); ?></a>
													</td>
													
													<td class="bbp-forum-topic-count"><?php bbp_forum_topic_count($sub_forum->ID); ?></td>

													<td class="bbp-forum-freshness">

														<?php bbp_forum_freshness_link($sub_forum->ID); ?>

														<p class="bbp-topic-meta">

															<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id($sub_forum->ID), 'size' => 14 ) ); ?></span>

														</p>
													</td>
												</tr>
											
											<?php } ?>
										<?php endif; ?>
										
									</tbody>
								
								</table>

								<?php endwhile; ?>

								<?php do_action( 'bbp_template_after_forums_loop' ); ?>

						<?php else : ?>

							<?php bbp_get_template_part( 'bbpress/feedback', 'no-forums' ); ?>

						<?php endif; ?>

						<?php do_action( 'bbp_template_after_forums_index' ); ?>

					</div>
				</div><!-- #forum-front -->

			<?php endwhile; ?>

		</div><!-- #content -->

<?php get_footer(); ?>
