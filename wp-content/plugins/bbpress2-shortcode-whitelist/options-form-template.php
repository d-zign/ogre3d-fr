<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div><h2>bbPress2 shortcode whitelist.</h2>

	<?php echo $action_message ?>

	<p>Enabling safe shortcodes to work in your forums.</p>

	<form name="bbpscwl_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<?php if(!empty($supported_plugins)) { ?><div style="background: #cdc; border: 1px solid #363; border-radius: 3px; padding: 10px; margin-top: 10px;"><?php bbp_scwl_supported_plugins_group($supported_plugins,$supported_plugins_title,$supported_plugins_message); ?></div><?php } ?>

		<?php if(!empty($verified_plugins)) { ?><div style="background: #ddc; border: 1px solid #663; border-radius: 3px; padding: 10px; margin-top: 10px;"><?php bbp_scwl_supported_plugins_group($verified_plugins,$verified_plugins_title,$verified_plugins_message); ?></div><?php } ?>

		<?php if(!empty($detected_plugins)) { ?><div style="background: #dcc; border: 1px solid #633; border-radius: 3px; padding: 10px; margin-top: 10px;"><?php bbp_scwl_supported_plugins_group($detected_plugins,$detected_plugins_title,$detected_plugins_message); ?></div><?php } ?>

		<div><h3>Manual additions</h3><p><label for="bbpscwl_enabled_codes">Manually enable additional shortcodes codes to whitelist with a comma delimited string. To add the tags [test] and [test2], enter "test,test2":</label></p>
		<textarea name="bbpscwl_enabled_codes" id="bbpscwl_enabled_codes" rows="10" cols="50"><?php echo $enabled_codes; ?></textarea></div> 
	  
		<p class="submit">  
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />  
		</p>  
	</form> 

		<div style="margin-top: 50px;">
			<script type="text/javascript">
			/* <![CDATA[ */
			    (function() {
				var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
				s.type = 'text/javascript';
				s.async = true;
				s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
				t.parentNode.insertBefore(s, t);
			    })();
			/* ]]> */
			</script>
			<h3>To support this plugin you can:</h3>

			<p><a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://bbpressbbcode.chantech.org/shortcode-whitelist/"></a>
<noscript><a href="http://flattr.com/thing/420079/bbPress-shortcode-whitelist-plugin" target="_blank">
<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript></p>

			<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">Donate GBP using PayPal:&nbsp;<input name="cmd" value="_donations" type="hidden"><input name="business" value="antonchanning@gmail.com" type="hidden"><input name="item_name" value="bbPress bbcode" type="hidden"><input name="item_number" value="bbPress-bbcode plugin donation" type="hidden"><input name="currency_code" value="GBP" type="hidden"><input src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online." type="image"><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" height="1" width="1"></form></p>
			
			<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">Donate USD using PayPal:&nbsp;<input name="cmd" value="_donations" type="hidden"><input name="business" value="antonchanning@gmail.com" type="hidden"><input name="item_name" value="bbPress bbcode" type="hidden"><input name="item_number" value="bbPress-bbcode plugin donation" type="hidden"><input name="currency_code" value="USD" type="hidden"><input src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online." type="image"><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" height="1" width="1"></form></p>
				
			<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">Donate EUR using PayPal:&nbsp;<input name="cmd" value="_donations" type="hidden"><input name="business" value="antonchanning@gmail.com" type="hidden"><input name="item_name" value="bbPress bbcode" type="hidden"><input name="item_number" value="bbPress-bbcode plugin donation" type="hidden"><input name="currency_code" value="EUR" type="hidden"><input src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online." type="image"><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" height="1" width="1"></form></p>
				
			<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">Donate PLN using PayPal:&nbsp;<input name="cmd" value="_donations" type="hidden"><input name="business" value="antonchanning@gmail.com" type="hidden"><input name="item_name" value="bbPress bbcode" type="hidden"><input name="item_number" value="bbPress-bbcode plugin donation" type="hidden"><input name="currency_code" value="PLN" type="hidden"><input src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online." type="image"><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" height="1" width="1"></form></p>
		</div>
</div>
