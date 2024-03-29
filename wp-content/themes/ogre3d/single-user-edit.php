<?php

/**
 * bbPress User Profile Edit
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>
<div id="container">
    <div class="centered">
	<div id="content" role="main">

		<div id="bbp-user-<?php bbp_current_user_id(); ?>" class="bbp-single-user">
			<div class="entry-content">

				<?php bbp_get_template_part( 'bbpress/content', 'single-user-edit'   ); ?>

			</div><!-- .entry-content -->
		</div><!-- #bbp-user-<?php bbp_current_user_id(); ?> -->

	</div><!-- #content -->
<?php get_footer(); ?>
