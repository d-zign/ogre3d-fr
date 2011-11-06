<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<div id="global">
    <div id="page">
	    <div id="header" role="banner">
		    <div class="centered">
			    <h1><a id="logo" href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>

                <div id="login-widget">
                    <?php if ( is_user_logged_in() ) : ?>
                    <div class="bbp-logged-in">
				        <a href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>" class="submit user-submit"><?php echo get_avatar( bbp_get_current_user_id(), '40' ); ?></a>
				        <h4><?php bbp_user_profile_link( bbp_get_current_user_id() ); ?></h4>

				        <?php bbp_logout_link(get_permalink()); ?>

                        <?php
                        global $wpdb, $current_user;
                        // get number of PM
		                $num_pm = $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'pm WHERE `recipient` = "' . $current_user->user_login . '" AND `deleted` != "2"' );
		                $num_unread = $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'pm WHERE `recipient` = "' . $current_user->user_login . '" AND `read` = 0 AND `deleted` != "2"' );

		                if ( empty( $num_pm ) ) {
			                $num_pm = 0;
		                }
		                if ( empty( $num_unread ) ) {
			                $num_unread = 0;
		                }

                        echo '<a href="', get_bloginfo( 'wpurl' ), '/?page_id=19&page=rwpm_inbox">', 'Messages (', $num_unread, ')</a></p>'; ?>
			        </div>
                    <?php else: ?>

                        <?php wp_loginout(get_permalink()); ?>
                        <?php wp_register(); ?>

                    <?php endif; ?>
                </div>
		    </div>
	    </div>

        <div id="navmenu" role="banner">
		    <div class="centered">
			    <ul id="menu">
                <?php wp_nav_menu() ?>
			    </ul>
		    </div>
	    </div>
