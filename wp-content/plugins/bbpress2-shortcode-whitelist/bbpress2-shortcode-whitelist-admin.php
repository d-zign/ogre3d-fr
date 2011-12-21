<?php

	function bbp_scwl_plugin_menu() {
		add_options_page('bbPress2 shortcode whitelist', 'Shortcode whitelist', 'manage_options', 'bbPress2-shortcode-whitelist', 'bbp_scwl_plugin_options');
	}

	add_action('admin_menu', 'bbp_scwl_plugin_menu');

	function bbp_scwl_plugin_options() {
		global $bbp_sc_whitelist;

		if (!current_user_can('manage_options'))  {
			echo '<div class="wrap"><p>No options currently available.  Sorry!</p></div>';
		} else {
			$action_message = '';
			if($_POST['Submit'] != '') {
				// Save options from form into database
				//echo '--'.$_POST['Submit'].'--';
				$enabled_plugins = $_POST['bbpscwl_plugins'];
        			update_option('bbpscwl_enabled_plugins', serialize($enabled_plugins)); 

				//echo '--'.print_r($enabled_plugins,true).'--';

				$enabled_codes = $_POST['bbpscwl_enabled_codes'];
        			update_option('bbpscwl_enabled_codes', $enabled_codes); 

				$action_message = '<div style="border: 1px solid #999; background: #ff9;">Shortcode options saved.</div>';
				//echo '--'.print_r($enabled_codes,true).'--';
			} else {
				// Get selected options from database
				$enabled_plugins = get_option('bbpscwl_enabled_plugins');  
				if($enabled_plugins == '') $enabled_plugins = array();
				else $enabled_plugins = unserialize($enabled_plugins);
				$enabled_codes = get_option('bbpscwl_enabled_codes');  
			}
			//$enabled_codes = explode(',',$enabled_codes);

			//Detect supported shortcode plugins
			$supported_plugins = $bbp_sc_whitelist->get_supported_plugins();
			$supported_plugins_title = 'Supported plugins';
			$supported_plugins_message = "I directly support these plugins to work with the whitelist safely.";

			$verified_plugins = $bbp_sc_whitelist->get_verified_plugins();
			$verified_plugins_title = 'Verified plugins';
			$verified_plugins_message = "I've looked at these plugins and believe they are safe.";

			$detected_plugins = $bbp_sc_whitelist->get_other_plugins();
			$detected_plugins_title = 'Detected plugins';
			$detected_plugins_message = "I've haven't checked these plugins but their authors believe they are 
			forum safe.";

			include(BBPSCWL_PATH.'/options-form-template.php');
		}
	}

	function bbp_scwl_supported_plugins_group($plugin_array,$plugin_group_title,$plugin_group_message) {
		if(!empty($plugin_array)) {
			include(BBPSCWL_PATH.'/supported-plugins-group-template.php');
		}
	}

	function bbp_scwl_supported_plugins_loop($plugin_array) {
		foreach($plugin_array as $plugin_data) {
			if(empty($plugin_data['shortcodes'])) {
				$tag_list = 'Oops! Currently includes no shortcodes!';
			} else {
				$tag_list = '['.implode('], [',$plugin_data['shortcodes']).']';
			}		

			include(BBPSCWL_PATH.'/supported-plugins-loop-template.php');
		}
	}
?>
