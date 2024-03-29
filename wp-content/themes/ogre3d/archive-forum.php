<?php

/**
 * bbPress - Forum Archive
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

		    <div id="forum-front" class="bbp-forum-front">
			    <h1 class="entry-title"><?php bbp_forum_archive_title(); ?></h1>
			    <div class="entry-content">

				    <?php bbp_get_template_part( 'bbpress/content', 'archive-forum' ); ?>

			    </div>
		    </div><!-- #forum-front -->

	    </div><!-- #content -->

<?php get_footer(); ?>
