=== Plugin Name ===
Contributors: antonchanning
Donate link: http://bbpressbbcode.chantech.org/donate/
Tags: bbpress, bbpress2, bbpress-plugin, whitelist, shortcode, shortcodes, bbcode, youtube, googlevideo, quote, css, style, image, spoilers
Requires at least: 2.5
Tested up to: 3.2.1
Stable tag: 1.3

This plugin adds creates a whitelist of shortcode tags that can be
applied to blog comments, bbpress forum topics and replies.  

== Description ==

This plugin is designed to safely allow bbcode shortcodes and other
safe shortcodes to be embedded in bbpress topics and replies and also
blog comments. You don't wan't users entering shortcodes such as
[bbp-login] in the middle of their reply.   

It doesn't actually implement the shortcodes though,
for that you need a separate plugin.  I recommend my own bbPress2
BBCode plugin, as this is fully whitelist aware, in that it also
parses the contents of the shortcodes, so [b][bbp-login][/b] also
gets parsed for safety.  Something that doesn't happen with non 
whitelist aware shortcode plugins.  

For video content I recommend Viper's Video Quicktags.

== Installation ==

1. Upload the `bbpress-shortcode-whitelist` folder and its contents to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Upgrade Notice ==

Please upgrade bbPress2 BBCode to the new whitelist aware version, if you haven't
already.

== Frequently Asked Questions ==

= How do I add new shortcodes to the whitelist? =

In admin settings.  In addition to supported plugins, verified plugins
and any self-declared plugins, you can also enable a custom list of
shortcodes you want your forum users to be able to use.

= I'm a shortcode plugin developer.  How do I make my shortcodes safe? =

If your shortcodes contain no calls to do_shortcode($content), then they
are probably already safe as far as I'm aware.  If they do contain calls
to do_shortcode($content), then you can make them safe by creating a 
function or class method in your plugin similar to:

`
	function yourplugin_do_shortcode($content) {
		if(function_exists('bbp_whitelist_do_shortcode')) {
			return bbp_whitelist_do_shortcode($content);
		} else {
			return do_shortcode($content);
		}
	}
`

And then replace calls to do_shortcode($content) inside your shortcode
handlers with calls to this new function.

= I'm a shortcode plugin developer.  How do I self-declare my plugin? =

To self-declare your plugin to the shortcode whitelist 
plugin, include the following code somewhere in your plugin, changing 
the names, unique identifier and the array of safe to use in the forums 
shortcodes that your plugin provides:

`
function yourplugin_get_shortcode_whitelist() {
	$plugin_name = 'Your Plugin Name';
	$plugin_author = 'Plugin Author Name';
	$shortcodes = array('test','test2'); //array of safe shortcodes the plugin provides.

	return array('name'=>$plugin_name,'tag'=>'your-plugin-unique-identifier','author'=>$plugin_author,'shortcodes'=>$shortcodes);
}

if(!isset($bbpscwl_selfdeclared_plugins)) $bbpscwl_selfdeclared_plugins = array();
$bbpscwl_selfdeclared_plugins[] = yourplugin_get_shortcode_whitelist();
`

= I'm a shortcode plugin developer.  How do I get my plugin verfified? =

Ask me to verify it.  I'll take a look at the code when I get a chance, 
will make sure it works and let you know if I find anything that needs
fixing or if I can add it to the verified plugins list.

= Do you have a current road map for further development of this plugin? =

Not at the minute.  But if any one can suggest plugins that have safe
shortcodes that I should auto-detect and verify, I'll take a look when 
I get a chance.  Also, I'll fix any bugs anyone finds.  I may make the
admin screen a bit more user friendly when I get a chance.

== Screenshots ==
1. None.

== Changelog ==

= 1.3 =
* Added support for buddypress activity updates
* Added support for buddypress group forums

= 1.2 =
* Fixed bug that stopped manually added tags to whitelist from working.
* Added support for [video] tag to bbPress BBCode plugin.

= 1.1.2 =
* Added actions on the 'comment_text' and 'bbp_get_reply_content' filters to make videos work properly when VVQ is installed.

= 1.0 =
* Admin screen added.
* Auto-detects bbPress2 BBCode
* Auto-detects Viper's Video Quicktags
* Auto-detects self declared plugins
* Allows admins to manually add a list shortcodes

= 0.1 =
* Initial version.  Allows bbcode shortcodes only.


