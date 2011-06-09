<?php
/*
Plugin Name: Store Locator Plus
Plugin URI: http://www.cybersprocket.com/products/store-locator-plus/
Description: An advanced system for managing multiple physical locations via a fully integrated WordPress solution. Store just a few or as many as a few thousand locations in the WordPress database using the built-in location management system. 
Version: 2.0
Author: Cyber Sprocket Labs
Author URI: http://www.cybersprocket.com
License: GPL3

	Copyright 2010  Cyber Sprocket Labs (info@cybersprocket.com)

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation; either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


// Globals
global $sl_upload_path,$slpath;
$sl_upload_path='';
$sl_path='';

// Define our paths 
//
if (defined('SLPLUS_PLUGINDIR') === false) {
    define('SLPLUS_PLUGINDIR', plugin_dir_path(__FILE__));
}
if (defined('SLPLUS_COREDIR') === false) {
    define('SLPLUS_COREDIR', plugin_dir_path(__FILE__) . 'core/');
}
if (defined('SLPLUS_PLUGINURL') === false) {
    define('SLPLUS_PLUGINURL', plugins_url('',__FILE__));
}
if (defined('SLPLUS_BASENAME') === false) {
    define('SLPLUS_BASENAME', plugin_basename(__FILE__));
}
if (defined('SLPLUS_PREFIX') === false) {
    define('SLPLUS_PREFIX', 'csl-slplus');
}
include_once(SLPLUS_PLUGINDIR . '/libs/csl_helpers.php' );
include_once(SLPLUS_PLUGINDIR . '/include/config.php'   );
include_once(SLPLUS_COREDIR   . 'variables.sl.php'      );
include_once(SLPLUS_COREDIR   . 'functions.sl.php'      );

register_activation_hook( __FILE__, 'activate_slplus');

// Actions
//
add_action('wp_head', 'head_scripts');
add_action('admin_menu', 'csl_slplus_add_options_page');
add_action('admin_init','csl_slplus_setup_admin_interface',10);
add_action('admin_print_scripts', 'add_admin_javascript');
add_action('admin_print_styles','add_admin_stylesheet');

// Short Codes
//
add_shortcode('STORE-LOCATOR','store_locator_shortcode');
add_shortcode('SLPLUS','store_locator_shortcode');
add_shortcode('slplus','store_locator_shortcode');

// Text Domains
//
load_plugin_textdomain(SLPLUS_PREFIX, false, SLPLUS_PLUGINDIR . '/languages/');
