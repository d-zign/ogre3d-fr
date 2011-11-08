=== Plugin Name ===
Contributors: antonchanning, bOingball, Viper007Bond
Donate link: http://bbpressbbcode.chantech.org/donate/
Tags: bbpress, bbpress2, bbpress-plugin, buddypress, bbcode, youtube, googlevideo, quote, css, style, image, spoilers
Requires at least: 2.5
Tested up to: 3.2.1
Stable tag: 1.3

This plugin adds support for popular bbcode forum code to posts, comments,
pages, bbpress 2.0 forums and buddypress activity and group forums.   

== Description ==

This plugin adds support for bbcode markup to wordpress, bbpress and buddypress.
It extends the bOingball bbcode plugin, which was in turn based on the
original bbcode plugin by Viper007Bond, both of which only added bbcode
support to wordpress.  It integrates with the 'bbPress shortcode whitelist'
plugin to provide a safe way of enabling BBCode without giving your users
access to all shortcodes.

`
Bold: [b]bold[/b]
Italics: [i]italics[/i]
Underline: [u]underline[/u]
URL: [url]http://wordpress.org/[/url] [url=http://wordpress.org/]WordPress[/url]
Image: [img]http://s.wordpress.org/style/images/codeispoetry.png[/img] [img=Code is Poetry]http://s.wordpress.org/style/images/codeispoetry.png[/img]
Quote: [quote]Lorem ipsum dolor sit amet, consectetuer adipiscing elit,[/quote] [quote=NAME]Lorem ipsum dolor sit amet[/quote] [quote="NAME"]Lorem ipsum dolor sit amet[/quote] [quote author=NAME]Lorem ipsum dolor sit amet[/quote] [quote author="NAME"]Lorem ipsum dolor sit amet[/quote]
Color: [color="red"]named red[/color] [color="ff0000"]hex red[/color] [color=#ff0000]hex red again[/color]
Strikeout:[s]striked this out[/s]
Center Text:[center]center me[/center]
Computer code:[code]10 GOTO 10[/code]
Font size: [size=10]10px font size[/size]
Ordered lists: [ol][li][/li][/ol]
Unordered lists: [ul][li][/li][/ul]
List Item: [li]item[/li]
(*) Youtube Links: [youtube]Youtube ID[/youtube]
(*) Google Video Links: [gvideo]Google Video ID[/gvideo] [googlevideo]Google Video ID[/googlevideo]
(#) Video URLS Links: [video]Youtube or GoogleVideo URL[/video]
Named Spoiler: [spoiler=two plus two]four[/spoiler]
Unnamed Spoiler: [spoiler]Boo![/spoiler]
`

(*) If Vipers Video Quicktags plugin is installed, this will be used for
these tags instead.
(#) If Vipers Video Quicktags plugin is installed, the [video] tag will also
detect urls for Vimeo, Veoh, Myspace, Flickr, DailyMotion, MetaCafe, iFilm and Spike,
as well as default to supporting Viper's generic [video] tag handler if no url is detected.

I have enhanced support for the [url] and [quote] tags, and added potentially
useful css style class names in the html output of the tags, to allow for
exciting theming potential.  

For example:

`[quote=NAME]QUOTE[/quote]` 

will render as: 

`<div class="bbcode-quote bbcode-quote-NAME"><strong>NAME</strong><blockquote>QUOTE</blockquote></div>`

Or if NAME matches the login name of a user on the system, it will render as:

`<div class="bbcode-quote bbcode-quote-user bbcode-quote-NAME"><strong>DISPLAY_NAME</strong><blockquote>QUOTE</blockquote></div>`

Where DISPLAY_NAME is the display name that user.  With BuddyPress installed the name
also becomes a link to their profile page, otherwise if bbPress is installed, it becomes a
link to their forum user page.

== Installation ==

1. Upload the `bbpress-bbcode` folder and its contents to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Upgrade Notice ==

If you are upgrading from the b0ingball bbcode plugin or viper's
bbcode plugin, just disable that plugin when you install this one.
It is also recommended you install the bbPress2 shortcode whitelist
plugin, to stop unsafe shortcodes being posted on the forum by
your users.


== Frequently Asked Questions ==
= One of your tags doesn't work the way I need it to can you fix it? =

I can try.  I want the plugin to be flexible in the bbcode formats it
accepts.  In the case of conflicts I plan to add options in the administration
dashboard so each wordpress user can control how it behaves for them.

= Can you add support for a popular bbcode that appears to be missing? =

I can't promise anything in this regard.  It looks to me like all the common
tags are already supported.  But if someone points out one that isn't already
supported by another plugin somewhere, I'll look at adding it.

= Do you have a current road map for further development of this plugin? =

Yes.
* Detect if bbPress Toolbar is installed, and if so provide administration options for
replacing some/all of the buttons behaviour to bbcode instead of html.

== Screenshots ==
1. Post and replies with bbcode formatting.
2. What the posts look like with the plugin disabled.

== Changelog ==

= 1.3 =
* Added support for buddypress activity updates
* Added support for buddypress group forums

= 1.2 =
* Added support for [video] tag in a way that enhances Viper's support.  New tag auto
detects if it contains a youtube or googlevideo url and tries to render as if it
was a [youtube] tag or [gvideo] tag if so.  If Viper's is installed, it supports auto
detecting all of the video quicktags that support urls before resorting to Viper's
normal behaviour.  Did this to support old posts imported from a Phorum forum that
supported a generic [video] tag for youtube, googlevideo etc.

= 1.1 =
* I can't actually remember what this version changed now, I forgot to add this note
at the time! o.O  Possibly this is the version where I allowed [googlevideo] as an
alias for [gvideo]

= 1.0 =
* Detects if Viper's Video Quicktags is installed, and if not supports [youtube] and [gvideo] tags natively.
* Improved code structure.

= 0.3 =
* Added support for bbpress-shortcode-whitelist plugin

= 0.2 =
* Fixed quote tags to work with multiple variations
* If quote name matches a registered user's login name:
* * It replaces their user login name with their display name
* * Creates link to their profile page if buddypress is installed
* * else creates link to their bbpress forum page if bbpress is installed
* Added css style classes to much of the output html to allow much fun custom styling...
* Restored support for [gvideo] tag as no conflict with VVQ exists, since the latter uses a [googlevideo] tag instead.

= 0.1 =
* Initial version. Fork from b0ingball bbcode.
* Adds support for bbcode to bbpress 
* Fixes behaviour of [quote] and [url] tags
* Temporarilly disables [youtube] and [gvideo] tags to avoid conflict with Vipers Video Quicktags.







