<?php /*

**************************************************************************

Plugin Name:  bbPress2 BBCode
Plugin URI:   http://bbpressbbcode.chantech.org/
Description:  Adds support for bbcode to wordpress and bbpress
Version:      1.3
Author:       Anton Channing
Author URI:   http://ant.chantech.org

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

define('BBP_BBCODE_PATH', WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__)) );

//Admin options
include(BBP_BBCODE_PATH.'/bbpress2-bbcode-admin.php');

//Classes
include(BBP_BBCODE_PATH.'/class_bbpress2-bbcode.php');

// Start this plugin once all other plugins are fully loaded
add_action( 'plugins_loaded', create_function( '', 'global $BBCode; $BBCode = new BBCode();' ) );
add_action( 'wp_loaded', create_function( '', 'global $BBCode; $BBCode->init_videotags();' ) );
?>
