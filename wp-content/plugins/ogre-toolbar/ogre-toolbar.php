<?php
/**
 Plugin Name: OGRE3D.fr Toolbar
 Plugin URI: http://www.ogre3d.fr
 Description: A toolbar for OGRE3D.fr website.
 Version: 0.1
 Author: Jérémie Ledentu
 Author URI: http://www.jeremie-ledentu.com
*/

class ogreToolBar
{
	var $markitup_path = "";

	function __construct()
	{
		$this->siteurl = $this->trailingslashit(get_option('siteurl'));
		$this->markitup_path = $this->siteurl .'wp-content/plugins/' . basename(dirname(__FILE__)) .'/markitup/';
		add_action('wp_head', array($this, 'add_header'));
		add_action('do_ogretoolbar', array($this, 'do_toolbar'), 10, 1);
		
		wp_enqueue_style("ogretoolbar_markitup", WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/markitup/skins/ogre/style.css', false);
		wp_enqueue_style("ogretoolbar_bbcode", WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/markitup/sets/bbcode/style.css', false);
	}
	
	function trailingslashit($string)
	{
        if ( '/' != substr($string, -1))
		{
            $string .= '/';
        }
        return $string;
    }

	function add_header()
	{
	?>
		<script type="text/javascript" src="<?php echo $this->markitup_path;?>jquery.markitup.js"></script>
		<script type="text/javascript" src="<?php echo $this->markitup_path;?>sets/bbcode/set.js"></script>
		<script type="text/javascript" >
		   jQuery(document).ready(function($)
		   {
				//var myBbcodeSettings = {nameSpace:'bbcode'};
				$("textarea").markItUp(mySettings);
		   });
		</script>
	<?php
	}
	
	function do_toolbar($textAreaId)
	{
		echo '<script type="text/javascript">
		$(document).ready(function()
		{
			$("#' . $textAreaId . '").markItUp(mySettings);
		});
		</script>';
	}
}

$ogreToolBar = new ogreToolBar();
?>