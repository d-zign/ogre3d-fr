<?php /*

**************************************************************************

Copyright (C) 2011 Anton Channing
Based on the b0ingBall BBCode plugin - Copyright (C) 2010 b0ingBall
in turn based on the original BBCode plugin - Copyright (C) 2008 Viper007Bond

***** GPL3 *****
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/

class BBCode {
	public $use_whitelist = false;

	// Plugin initialization - modded by Anton Channing
	function __construct() {
		// This version only supports WP 2.5+ (learn to upgrade please!)
		if ( !function_exists('add_shortcode') ) return;

		// Register the shortcodes
		add_shortcode( 'b' , array(&$this, 'shortcode_bold') );
		add_shortcode( 'B' , array(&$this, 'shortcode_bold') );
		add_shortcode( 'i' , array(&$this, 'shortcode_italics') );
		add_shortcode( 'I' , array(&$this, 'shortcode_italics') );
		add_shortcode( 'u' , array(&$this, 'shortcode_underline') );
		add_shortcode( 'U' , array(&$this, 'shortcode_underline') );
		add_shortcode( 'url' , array(&$this, 'shortcode_url') );
		add_shortcode( 'URL' , array(&$this, 'shortcode_url') );
		add_shortcode( 'img' , array(&$this, 'shortcode_image') );
		add_shortcode( 'IMG' , array(&$this, 'shortcode_image') );
		add_shortcode( 'quote' , array(&$this, 'shortcode_quote') );
		add_shortcode( 'QUOTE' , array(&$this, 'shortcode_quote') );
		add_shortcode( 'color' , array(&$this, 'shortcode_color') );
		add_shortcode( 'COLOR' , array(&$this, 'shortcode_color') );
		add_shortcode( 's' , array(&$this, 'shortcode_strikethrough') );
		add_shortcode( 'S' , array(&$this, 'shortcode_strikethrough') );
		add_shortcode( 'center' , array(&$this, 'shortcode_center') );
		add_shortcode( 'CENTER' , array(&$this, 'shortcode_center') );
		//add_shortcode( 'code' , array(&$this, 'shortcode_code') );
		//add_shortcode( 'CODE' , array(&$this, 'shortcode_code') );
		add_shortcode( 'size' , array(&$this, 'shortcode_size') );
		add_shortcode( 'SIZE' , array(&$this, 'shortcode_size') );
		add_shortcode( 'ul' , array(&$this, 'shortcode_unorderedlist') );		
		add_shortcode( 'UL' , array(&$this, 'shortcode_unorderedlist') );
		add_shortcode( 'ol' , array(&$this, 'shortcode_orderedlist') );
		add_shortcode( 'OL' , array(&$this, 'shortcode_orderedlist') );
		add_shortcode( 'li' , array(&$this, 'shortcode_listitem') );
		add_shortcode( 'LI' , array(&$this, 'shortcode_listitem') );
		add_shortcode( 'spoiler' , array(&$this, 'shortcode_spoiler') );
		add_shortcode( 'SPOILER' , array(&$this, 'shortcode_spoiler') );

		if (function_exists('bbp_whitelist_do_shortcode')) {
			$this->use_whitelist = true;
		} else {
			$this->use_whitelist = false;
			// Whitelist not installed.  So enable all shortcodes.
			// This is risky.  Admin page will recommend the admin installs the whitelist.add_filter('bp_get_activity_content_body','scripturize');

			add_filter( 'get_comment_text', 'do_shortcode' ); //Warning, doing it this way adds ALL shortcodes to forum topics
			add_filter( 'bbp_get_reply_content', 'do_shortcode' ); //Warning, doing it this way adds ALL shortcodes to forum replies
			add_filter( 'bp_get_activity_content_body', 'do_shortcode' ); //Warning, doing it this way adds ALL shortcodes to forum replies
			add_filter( 'bp_get_the_topic_post_content', 'do_shortcode' ); //Warning, doing it this way adds ALL shortcodes to forum replies
		}
	}

	function init_videotags() {
		// This initialisation is called later in order to override Viper's video tag handling.
		if(class_exists('VipersVideoQuicktags')) {
			// Remove Viper's handling of video tag, we'll enhance it.
			remove_shortcode( 'video' );
			remove_shortcode( 'VIDEO' );
		} else {
			// Viper's Video Quicktags not installed, so handle these ourselves
			add_shortcode( 'youtube' , array(&$this, 'shortcode_youtube') );		
			add_shortcode( 'YOUTUBE' , array(&$this, 'shortcode_youtube') );
			add_shortcode( 'googlevideo' , array(&$this, 'shortcode_gvideo') );
			add_shortcode( 'GOOGLEVIDEO' , array(&$this, 'shortcode_gvideo') );
			add_shortcode( 'gvideo' , array(&$this, 'shortcode_gvideo') );
			add_shortcode( 'GVIDEO' , array(&$this, 'shortcode_gvideo') );
		}
		add_shortcode( 'video' , array(&$this, 'shortcode_video') );
		add_shortcode( 'VIDEO' , array(&$this, 'shortcode_video') );
	}

	function do_shortcode($content) {
		if(function_exists('bbp_whitelist_do_shortcode')) {
			return bbp_whitelist_do_shortcode($content);
		} else {
			return do_shortcode($content);
		}
	}

	// No-name attribute fixing - modded by Anton Channing
	function attributefix( $atts = array() ) {
		if ( empty($atts[0]) ) return $atts;

		if ( 0 !== preg_match( '#=("|\')(.*?)("|\')#', $atts[0], $match ) )
			$atts[0] = $match[2];
		return $atts;
	}


	// Bold shortcode - modded by Anton Channing
	function shortcode_bold( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
        	return '<strong class="bbcode-strong">' .  $this->do_shortcode($content)  . '</strong>';
	}


	// Italics shortcode - modded by Anton Channing
	function shortcode_italics( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<em class="bbcode-em">' . $this->do_shortcode($content) . '</em>';
	}


	// Underline shortcode - modded by Anton Channing
	function shortcode_underline( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<span style="text-decoration:underline" class="bbcode-underline">' . $this->do_shortcode($content) . '</span>';
	}


	// URL shortcode - modded by Anton Channing
	function shortcode_url( $atts = array(), $content = NULL ) {
		if(empty($atts)) {
			// [url]http://www.example.com/[/url]
			$url = $content;
			$text = $content;
		} else {
			// [url=http://www.example.com/]text[/url]
			// [url="http://www.example.com/"]text[/url]
			$atts = $this->attributefix( $atts );
		    	$url = trim(array_shift($atts),'="'); //Remove quotes and equals.
		}

		if ( empty($url) ) return '';
		if ( empty($text) ) $text = $url;

		return '<a href="' . $url . '" class="bbcode-link">' . $this->do_shortcode($content) . '</a>';
	}



	// Image shortcode by Anton Channing
	function shortcode_image( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		$alt = '';
		if(!empty($atts)) {
			// [img=alttext]imageurl[/img]
		    	$alt = trim(implode( ' ',$atts ),'="'); //Remove quotes and equals.
		}
		return '<img src="' . $content . '" alt="'.$alt.'" title="'.$alt.'" class="bbcode-image" />';
	}

	// Quote shortcode - modded by Anton Channing
	function shortcode_quote( $atts = array(), $content = NULL ) {
		global $bp; //buddypress
		global $bbp; //bbpress
		$css_classes = array('bbcode-quote');

		if ( NULL === $content ) return '';
		if(empty($atts)) {
			return '<div class="'.implode(' ',$css_classes).'"><blockquote>' . $this->do_shortcode($content) . '</blockquote></div>';
		} else {
			//convert Quote attrib by making the array a string
			//NB currently assuming author name is always the first attribute.
			//this may not always be the case, so probably have to edit this
			//to cope with alternative cases.
		    	$name = trim(array_shift($atts),'="'); //Remove quotes and equals.
			$css_classes[] = 'bbcode-quote-'.$name; //Add css class for specific name, to allow special formatting for quotes by specific name

			//maybe add link to user profile if they exist?
			$user = get_user_by('login',$name);
			if(false !== $user) {
				$css_classes[] = 'bbcode-quote-user'; //Add css class for specific user, to allow special formatting for quotes by site members

				// This is a valid username for a user on this wordpress system.
				// Currently creates link for forum user page if bbPress installed or buddypress 
				// profile if buddypress installed.  Otherwise just replaces name with users nicename.
				if (function_exists('bp_is_active')) $name = '<a href="'.site_url().'/members/'.$user->user_login.'">'.$user->display_name.'</a>';
				elseif ( 'bbPress' === get_class( $bbp ) ) $name = '<a href="'.site_url().'?bbp_user='.$user->ID.'">'.$user->display_name.'</a>';
				else $name = $user->display_name;
			}

			If ( "" !== $subattribs ) return '<div class="'.implode(' ',$css_classes).'"><strong>' . $name . ' wrote: </strong><blockquote>' . $this->do_shortcode($content) . '</blockquote></div>';
		}
	}
	
	// color shortcode - modded by Anton Channing
	function shortcode_color( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		if ( "" === $atts ) return '';
		//convert color by making the array a string
		$attribs = implode("",$atts);
		//then take the array and start it at the color start.
		$color = substr ( $attribs, 1);
		if(ctype_xdigit($color)) {
			// $color is a valid hex value, but needs a '#' in front.
			$color = '#'.$color;
		}
		return '<font color=' . $color . ' class="bbcode-color">' . $this->do_shortcode($content) . '</font>';
	}
	
	// bOingball - strikethrough shortcode - modded by Anton Channing
	function shortcode_strikethrough( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<del class="bbcode-strikethrough">' . $this->do_shortcode($content) . '</del>';
	}
	
	// bOingball - center shortcode - modded by Anton Channing
	function shortcode_center( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<center class="bbcode-center">' . $this->do_shortcode($content) . '</center>';
	}
	
	// bOingball - quote code shortcode - modded by Anton Channing
	function shortcode_code( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<code class="bbcode-code">' . $this->do_shortcode($content) . '</code>';
	}
	
	// bOingball - size code shortcode - modded by Anton Channing
	function shortcode_size( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		if ( "" === $atts ) return '';
			//convert size by making the array a string
			$attribs = implode("",$atts);
			//then take the string and start it at the size start.
			$subattribs = substr ( $attribs, 1);
			return '<span style="font-size:' . $subattribs . 'px" class="bbcode-size">' . $this->do_shortcode($content) . '</span>';
		}

	// bOingball - unordered list shortcode - modded by Anton Channing
	function shortcode_unorderedlist( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<ul class="bbcode-ul">' . $this->do_shortcode($content) . '</ul>';
	}
	
	// bOingball - ordered list shortcode - modded by Anton Channing
	function shortcode_orderedlist( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<ol class="bbcode-ol">' . $this->do_shortcode($content) . '</ol>';
	}
	
	// bOingball - list item shortcode - modded by Anton Channing
	function shortcode_listitem( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		return '<li class="bbcode-li">' . $this->do_shortcode($content) . '</li>';
	}		
	
	// bOingball - youtube shortcode - modded by Anton Channing
	function shortcode_youtube( $atts = array(), $content = NULL ) {
echo 'YOUTUBE';
		if ( "" === $content ) return __('No YouTube Video ID Set');
		$id = $text = $content;
		return '<object width="400" height="325"><param name="movie" value="http://www.youtube.com/v/' .$id . '"></param><embed src="http://www.youtube.com/v/' . $id . '" type="application/x-shockwave-flash" width="400" height="325"></embed></object>';
	}	
	
	// bOingball - google video shortcode - modded by Anton Channing
	function shortcode_gvideo( $atts = array(), $content = NULL ) {
		if ( "" === $content ) return 'No Google Video ID Set';
		$id = $text = $content;
		return '<embed style="width:400px; height:325px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=' . $id . '&hl=en"></embed>';
	}	

	// video shortcode - by Anton Channing
	function shortcode_video( $atts = array(), $content = NULL ) {
		global $VipersVideoQuicktags; 
		if("" === $content) return __('No video');

		if(class_exists('VipersVideoQuicktags')) {
			// Viper's Video Quicktags installed, let it handle video.
			// If content is a url, work out which shortcode to emulate
			if(false !== strpos($content,'youtube.com')) return $VipersVideoQuicktags->shortcode_youtube($atts, $content);
			if(false !== strpos($content,'video.google')) return $VipersVideoQuicktags->shortcode_googlevideo($atts, $content);
			if(false !== strpos($content,'dailymotion.com')) return $VipersVideoQuicktags->shortcode_dailymotion($atts, $content);
			if(false !== strpos($content,'vimeo.com')) return $VipersVideoQuicktags->shortcode_vimeo($atts, $content);
			if(false !== strpos($content,'veoh.com')) return $VipersVideoQuicktags->shortcode_veoh($atts, $content);
			if(false !== strpos($content,'metacafe.com')) return $VipersVideoQuicktags->shortcode_metacafe($atts, $content);
			if(false !== strpos($content,'flickr.com')) return $VipersVideoQuicktags->shortcode_flickrvideo($atts, $content);
			if(false !== strpos($content,'ifilm.com')) return $VipersVideoQuicktags->shortcode_ifilm($atts, $content);
			if(false !== strpos($content,'spike.com')) return $VipersVideoQuicktags->shortcode_ifilm($atts, $content);
			if(false !== strpos($content,'myspace.com')) return $VipersVideoQuicktags->shortcode_myspace($atts, $content);
			if(false !== strpos($content,'myspacetv.com')) return $VipersVideoQuicktags->shortcode_myspace($atts, $content);
			//Otherwise we have no choice but to assume its a plain old video file and support
			//it in the way Viper originally did.
			return $VipersVideoQuicktags->shortcode_videofile($atts, $content);
		} else {
			// Viper's Video Quicktags not installed, so handle these ourselves best we can
			if(false !== strpos($content,'youtube.com')) {
				$url_bits = parse_url($content);
				$qs_bits = explode('&',$url_bits['query']);

				$qs=array();
				foreach($qs_bits as $qs_bit) {
					$qs_part = explode('=',$qs_bit);
					$qs[$qs_part[0]] = $qs_part[1];
				}
				return $this->shortcode_youtube($atts, $qs['v']);
			}
			if(false !== strpos($content,'video.google')) {
				$url_bits = parse_url($content);
				$qs_bits = explode('&',$url_bits['query']);

				$qs=array();
				foreach($qs_bits as $qs_bit) {
					$qs_part = explode('=',$qs_bit);
					$qs[$qs_part[0]] = $qs_part[1];
				}
				return $this->shortcode_gvideo($atts, $qs['docId']);
			}
			if("" === $content) return __('Unsupported video type');
		} 

	}	

		
	// bOingball - Spoiler - modded by Anton Channing
	function shortcode_spoiler( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';
		// if not spoiler pre text, return just spoiler
		if ( "" === $atts ) return '<div style="margin:20px; margin-top:5px"><div class="smallfont" style="margin-bottom:2px"><b>Spoiler: </b><input type="button" value="Show" style="width:45px;font-size:10px;margin:0px;padding:0px;" onClick="if (this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display != \'\') { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'\'; this.innerText = \'\'; this.value = \'Hide\'; } else { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'none\'; this.innerText = \'\'; this.value = \'Show\'; }"></div><div class="alt2" style="margin: 0px; padding: 6px; border: 1px inset;"><div style="display: none;">'. $this->do_shortcode($content) .'</div></div></div>';
		//convert spoiler of by making the array a string
		$attribs = implode(" ",$atts);
		//then take the string and start it at the spoiler of start.
		$subattribs = substr ( $attribs, 1);
		return '<div style="margin:20px; margin-top:5px"><div class="smallfont" style="margin-bottom:2px"><b>Spoiler</b> for <i>'. $subattribs .'</i> <input type="button" value="Show" style="width:45px;font-size:10px;margin:0px;padding:0px;" onClick="if (this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display != \'\') { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'\'; this.innerText = \'\'; this.value = \'Hide\'; } else { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'none\'; this.innerText = \'\'; this.value = \'Show\'; }"></div><div class="alt2" style="margin: 0px; padding: 6px; border: 1px inset;"><div style="display: none;">'. $this->do_shortcode($content) .'</div></div></div>';
	}		

	
}
?>
