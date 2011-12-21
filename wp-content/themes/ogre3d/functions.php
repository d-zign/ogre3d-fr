<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	wp_register_style('syntaxhighlighter-theme-ogre',
		content_url('themes/ogre3d/syntaxhighlighter-theme.css'),
		array( 'syntaxhighlighter-core' ),
		'0.9.0'
	);
	
	wp_enqueue_style(
		'bp',
		content_url('themes/ogre3d/bp.css'),
		'array of stylesheets it depends on',
		'1.0'
	);
	
	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', TEMPLATEPATH . '/languages' );
    load_theme_textdomain( 'ogre', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'menus' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'ogre' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

    add_theme_support( 'bbpress' );
    //add_action( 'after_setup_theme', 'bbp_twentyten_setup' );
}
endif; // twentyeleven_setup

function add_syntaxhighlighter_theme( $themes )
{
    $themes['ogre'] = 'Ogre3dfr';
    return $themes;
}
add_filter( 'syntaxhighlighter_themes', 'add_syntaxhighlighter_theme' );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function ogre_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'ogre_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function ogre_continue_reading_link() {
	return ' <a class="roundbutton read-more-button" href="'. esc_url( get_permalink() ) . '"><span>' . __( 'Continue reading', 'ogre' ) . '</span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function ogre_auto_excerpt_more($more)
{
	return ' &hellip;' . ogre_continue_reading_link();
}
add_filter( 'excerpt_more', 'ogre_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function ogre_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'ogre_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function ogre_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ogre_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function ogre_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'ogre_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'ogre_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function ogre_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ogre' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'ogre' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="vcard">
					<?php
						echo get_avatar( $comment, 40 );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'ogre' ),
							sprintf( '<span class="comment-author">%s</span>', get_comment_author_link() ),
							sprintf( '<span class="comment-date">%1$s</span>', sprintf( __( '%1$s at %2$s', 'ogre' ), get_comment_date(), get_comment_time()))
						);
					?>
					
				</div><!-- .comment-author .vcard -->
				<?php edit_comment_link( __( 'Edit', 'ogre' ), '<span class="edit-link">', '</span>' ); ?>

			</footer>

			<div class="comment-content">
			<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'ogre' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'ogre' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

function ogre_get_reply_revision_log( $reply_id = 0 ) {

	// Create necessary variables
	$reply_id     = bbp_get_reply_id( $reply_id );
	$revision_log = bbp_get_reply_raw_revision_log( $reply_id );

	// Check reply and revision log exist
	if ( empty( $reply_id ) || empty( $revision_log ) || !is_array( $revision_log ) )
		return false;

	// Get the actual revisions
	if ( !$revisions = bbp_get_reply_revisions( $reply_id ) )
		return false;

	$r = "\n\n" . '<div id="bbp-reply-revision-log-' . $reply_id . '" class="bbp-reply-revision-log">';

	$revision = array_pop($revisions);
	
	if ($revision)
	{
		if ( empty( $revision_log[$revision->ID] ) )
		{
				$author_id = $revision->post_author;
				$reason    = '';
		} else {
			$author_id = $revision_log[$revision->ID]['author'];
			$reason    = $revision_log[$revision->ID]['reason'];
		}

		$author = bbp_get_author_link( array( 'size' => 14, 'link_text' => bbp_get_reply_author_display_name( $revision->ID ), 'post_id' => $revision->ID, 'type' => 'name') );
		$since  = bbp_get_time_since( bbp_convert_date( $revision->post_modified ) );

		$r .= "\t" . '<span id="bbp-reply-revision-log-' . $reply_id . '-item-' . $revision->ID . '" class="bbp-reply-revision-log-item">';
			$r .= "\t\t" . sprintf( __( empty( $reason ) ? 'This reply was last modified %1$s ago by %2$s.' : 'This reply was last modified %1$s ago by %2$s. Reason: %3$s', 'bbpress' ), $since, $author, $reason );
		$r .= "\t" . '</span>';
		
		$r .= "</div>";
	}

	return $r;
}
add_filter( 'bbp_get_reply_revision_log', 'ogre_get_reply_revision_log' );

function ogre_get_forum_freshness_link( $forum_id = 0 )
{
	$forum_id  = bbp_get_forum_id( $forum_id );
	$active_id = bbp_get_forum_last_active_id( $forum_id );

	if ( empty( $active_id ) )
		$active_id = bbp_get_forum_last_reply_id( $forum_id );

	if ( empty( $active_id ) )
		$active_id = bbp_get_forum_last_topic_id( $forum_id );

	if ( bbp_is_topic( $active_id ) ) {
		$link_url = bbp_get_forum_last_topic_permalink( $forum_id );
		$title    = bbp_get_forum_last_topic_title( $forum_id );
	} elseif ( bbp_is_reply( $active_id ) ) {
		$link_url = bbp_get_forum_last_reply_url( $forum_id );
		$title    = bbp_get_forum_last_reply_title( $forum_id );
	}

	$time_since = bbp_get_forum_last_active_time( $forum_id );

	if ( !empty( $time_since ) && !empty( $link_url ) )
		$anchor = '<a href="' . $link_url . '" title="' . esc_attr( $title ) . '">' . $time_since . '</a>';
	else
		$anchor = '<span class="forum_no_topic">' . __( 'No Topics', 'bbpress' ) . '</span>';

	return apply_filters('bbp_get_forum_freshness_link', $anchor, $forum_id);
}

// Ajout des BBCodes à la barre d'outils
function ogre_toolbar_add_items($items)
{
	$result = array();
	$result[] = array('action' => 'api_item',
					 'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/text_bold.png' . '" title="' . __("Bold", "ogre") . '" alt="' . __("Bold", "ogre") . '" />',
					 'data' => "function(stack){insert_shortcode('b');}");
					 
	$result[] = array('action' => 'api_item',
					 'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/text_italic.png' . '" title="' . __("Italic", "ogre") . '" alt="' . __("Italic", "ogre") . '" />',
					 'data' => "function(stack){insert_shortcode('i');}");
					 
	$result[] = array('action' => 'api_item',
					 'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/text_underline.png' . '" title="' . __("Underline", "ogre") . '" alt="' . __("Underline", "ogre") . '" />',
					 'data' => "function(stack){insert_shortcode('u');}");
					 
	$result[] = array('action' => 'api_item',
					 'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/text_strikethrough.png' . '" title="' . __("Strike", "ogre") . '" alt="' . __("Strike", "ogre") . '" />',
					 'data' => "function(stack){insert_shortcode('strike');}");
					 
	$result[] = array('action' => 'api_item',
					 'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/quote.png' . '" title="' . __("Quote", "ogre") . '" alt="' . __("Quote", "ogre") . '" />',
					 'data' => "function(stack){insert_shortcode('quote');}");
					 
	$result[] = array('action' => 'api_item',
					  'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/code.png' . '" title="' . __("Code", "ogre") . '" alt="' . __("Code", "ogre") . '" />',
					  'data' => "function(stack){insertShortcode(stack, 'code', [['title','']]);}");
					 
	$result[] = array('action' => 'switch_panel',
					  'inside_anchor' => '<img src="' . get_bloginfo('template_directory') . '/images/toolbar/link.png' . '" title="' . __("Link", "ogre") . '" alt="' . __("Link", "ogre") . '" />',
					  'panel' => 'links',
					  'data' => '<div style="width: 310px; display: inline-block;"><span>Link URL:</span><br />
<input style="display:inline-block;width:300px;" type="text" id="link_url" value="" /></div>
<div style="width: 310px; display: inline-block;"><span>Link Name: (optional)</span><br />
<input style="display:inline-block;width:300px;" type="text" id="link_name" value="" /></div>
<a class="toolbar-apply" style="margin-top: 1.4em;" onclick="insert_panel(\'link\');">Apply Link</a>');

	return $result;
}
add_filter( 'bbp_5o1_toolbar_add_items' , 'ogre_toolbar_add_items', 0);

function ogre_nav_class($classes, $item)
{
	if (get_post_type() == "wiki" && $item->title == "Wiki")
	{
		array_push($classes, 'current-menu-item');
	}
	else if ((get_post_type() == "forum" || get_post_type() == "topic") &&  $item->title == "Forum")
	{
		array_push($classes, 'current-menu-item');
	}

	return $classes;
}
add_filter('nav_menu_css_class' , 'ogre_nav_class' , 10 , 2);