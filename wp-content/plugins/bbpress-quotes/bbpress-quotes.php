<?php

/*
Copyright: © 2011 DomainSoil ( coded in the USA )
<mailto:support@domainsoil.com> <http://www.domainsoil.com/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License,
along with this software. In the main directory, see: /licensing/
If not, see: <http://www.gnu.org/licenses/>.
*/

/*  Copyright 2011  DOMAINSOIL  (email : SUPPORT AT DOMAINSOIL DOT COM)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA.
Alternatively, you may visit: <http://www.gnu.org/licenses/>.
*/

/*
Version:                        0.1
Stable tag:                     0.1
Framework:                      alpha

WordPress Compatible:           YES
Minimum WordPress Version:      3.x
Tested Up To:                   3.x
WP Multisite Compatible:        YES
Multisite Blog Farm Compatible: YES

BuddyPress Compatible:          YES
Minimum BuddyPress Version:     1.5
Tested Up To:                   1.5

bbPress Compatible:             YES
Minimum bbPress Version         2.0
Tested Up To:                   2.0

Other Requirements:             PHP 5.2.3+

Copyright:                      © 2011 DomainSoil
License:                        GNU General Public License
Contributors:                   travis.hill
Author URI:                     http://domainsoil.com/
Author:                         DomainSoil
Donate link:                    http://www.domainsoil.com/donate/

Plugin Name:                    bbPress Quotes
Support URI:                    http://support.domainsoil.com/bbpress-quotes/
Bug Report URI:                 http://trac.domainsoil.com/bbpress-quotes/
Privacy URI:                    http://www.domainsoil.com/legal/privacy-policy/
Plugin URI:                     http://www.domainsoil.com/products/bbpress-quotes/

Description: Add the ability to quote bbPress forum topics and replies. Add a quote button to the end of replies so users can easily quote another user.

Tags: bbpress, forums, forum, topics, topic, replies, reply, quotes, quote

echo "Yes, I'm a WordPress & PHP n00b, so please excuse all the commenting, I'm learning! ;)"; 
*/

load_plugin_textdomain('bbpress-quotes', NULL, dirname(plugin_basename(__FILE__)) . "/languages");  // load plugin language files


/**
 * quote scripts()
 * 
 * registers and enqueues the .js file
 */
function quote_scripts () {

	if ( function_exists('plugin_url') )
		$plugin_url = plugin_url();
	else
		$plugin_url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

	wp_register_script('bbpress_quotes_js', ($plugin_url . '/bbpress-quotes.js'), false, '1.0');
	wp_enqueue_script('bbpress_quotes_js');

}
if (!is_admin()) {
	add_action('init', 'quote_scripts');
}

function add_quote_button( $content = '', $topic_id = 0, $reply_id = 0, $args = array() ) {
    
    // Default arguments
	$defaults = array(
		'separator' => '<hr />',
		'before'    => '<div class="bbpress-quotes">',
		'after'     => '</div>',
        'label'     => 'Quote'
	);
	$r = wp_parse_args( $args, $defaults );
	extract( $r );

	// Verify reply id, get author id
    $topic_id  = bbp_get_topic_id      ( $topic_id );
	$reply_id  = bbp_get_reply_id      ( $reply_id );
	$user_id   = bbp_get_reply_author  ( $reply_id );
    
    //quote link
	$button = "";
	// quote(postid, author, commentarea, commentID)	
	$button .= '&nbsp;&nbsp;';
	$button .= '<span id="quote-reply-'.$reply_id.'" style="display: none;">'.$user_id.'</span>';
	$button .= '<a class="bbpress_quotes_link" ';
	$button .= 'href="javascript:void(null)" ';
	$button .= 'title="' . __('Click here or select text to quote comment', 'bbpress-quotes'). '" ';
		
	//if( get_option('bbpress_quotes_author') == true ) {
		$button .= 'onmousedown="quote(\'' . $reply_id .'\', document.getElementById(\'quote-reply-'.$reply_id.'\').innerHTML, \'bbp_reply_content\',\'q-'. $reply_id .'\');';
	//} else {
		//$button .= 'onmousedown="quote(\'' . $reply_id .'\', null, \'comment\',\'post-'. $reply_id .'\');';
	//}
		
	$button .= 'try { addComment.moveForm(\'q-'.$reply_id.'\', \''.$reply_id.'\', \'bbp-reply-form\', \''.$topic_id.'\'); } catch(e) {}; ';
	$button .= 'return false;">';
	$button .= "" . $label . "";

	// adjust the content accordingly
	$content = $content . $separator . $before . $button . $after;
    
    //return $button;
	return apply_filters( 'add_quote_button', $content, $reply_id, $separator );
    
}
    
if (!is_admin()) {
		//add_action('get_comment_text', 'add_quote_button');
		add_filter('bbp_get_reply_content', 'add_quote_button', 1, 2);
}

function add_quote_tags($output) {
	

	global $user_ID, $bbp;
	if (get_option('comment_registration') && !$user_ID) {
		
		return $output;
		
	} else if (!is_feed() && comments_open()) {
	
		return "\n<div id='q-".bbp_get_reply_id()."'>\n\n\n" . $output . "\n\n\n</div>\n";
	
	} else {
	
		return $output;
		
	}

}
if (!is_admin()) {
	//add_filter('get_comment_text', 'add_quote_tags');
	add_filter('bbp_get_reply_content', 'add_quote_tags', 1);
}

// Options
$themename = "bbPress Quotes";
$shortname = "bbpress_quotes";


$options = array (

	array(	"name" => __('Show author in quote?','bbpress-quotes'),
		"desc" => __('Show authors','bbpress-quotes'),
		"id" => $shortname."_author",
		"std" => true,
		"type" => "checkbox"),

	array(	"name" => __('Show reply link?','bbpress-quotes'),
		"desc" => __('Show reply link','bbpress-quotes'),
		"id" => $shortname."_replylink",
		"std" => false,
		"type" => "checkbox"),
);


function bbpress_quotes_add_admin() {

	global $themename, $shortname, $options, $blog_id;

	if ( $_GET['page'] == basename(__FILE__) ) {
    
		if ( 'save' == $_REQUEST['action'] ) {

			// update options
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

			header("Location: options-general.php?page=bbpress-quotes.php&saved=true");
			die;

		}
	}

	// add options page
	add_options_page($themename, $themename, 8, basename(__FILE__), 'bbpress_quotes_admin');

}

function bbpress_quotes_admin() {

	global $themename, $shortname, $options;

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.','bbpress-quotes').'</strong></p></div>';


	// Show options
?>
<div class="wrap">
<?php if ( function_exists('screen_icon') ) screen_icon(); ?>
<h2><?php echo $themename; _e(': General Options', 'bbpress-quotes'); ?></h2>

<form method="post" action="">

	<p class="submit">
		<input class="button-primary" name="save" type="submit" value="<?php //_e('Save changes','bbpress-quotes'); ?>" />    
		<input type="hidden" name="action" value="save" />
	</p>


	<?php // Smart options ?>
	<table class="form-table">

<?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'checkbox':
		?>
		<tr valign="top"> 
			<th scope="row"><?php echo __($value['name'],'bbpress-quotes'); ?></th>
			<td>
				<?php
					if(get_option($value['id'])){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				?>
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
				<label for="<?php echo $value['id']; ?>"><?php echo __($value['desc'],'bbpress-quotes'); ?></label>
			</td>
		</tr>
		<?php
		break;

		default:

		break;
	}
}
?>

	</table>
	
	

	<p class="submit">
		<input class="button-primary" name="save" type="submit" value="<?php _e('Save changes','bbpress-quotes'); ?>" />    
		<input type="hidden" name="action" value="save" />
	</p>
	
</form>

</div><?php //.wrap ?>
<?php
}

//add_action('admin_menu' , 'bbpress_quotes_add_admin');



?>