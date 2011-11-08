<?php

	function bbp_bbcode_plugin_menu() {
		add_options_page('bbPress2 BBCode', 'bbPress2 BBCode', 'manage_options', 'bbPress2-bbcode', 'bbp_bbcode_plugin_options');
	}

	add_action('admin_menu', 'bbp_bbcode_plugin_menu');

	function bbp_bbcode_plugin_options() {
		global $bbp_sc_whitelist;

		if (!current_user_can('manage_options'))  {
			echo '<div class="wrap"><p>No options currently available.  Sorry!</p></div>';
		} else {
			$bbcodes_active = true;
			$whitelist_enabled = is_plugin_active('bbpress2-shortcode-whitelist/bbpress2-shortcode-whitelist.php');

			if($whitelist_enabled) {
				$enabled_plugins = get_option('bbpscwl_enabled_plugins');  
				if($enabled_plugins == '') $enabled_plugins = array();
				else $enabled_plugins = unserialize($enabled_plugins);

				$bbcodes_active = false;
				foreach($enabled_plugins as $plugin_tag) {
					if($plugin_tag == 'bbpress-bbcode') $bbcodes_active = true;
				}
			}

			include(BBP_BBCODE_PATH.'/options-form-template.php');
		}
	}
?>
