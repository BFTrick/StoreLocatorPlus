<?php
/*
Plugin Name: Store Locator Plus
Plugin URI: http://www.cybersprocket.com/producs/store-locator-plus/
Description: Store Locator Plus is based on the popular Google Maps Store Locator with a few customizations we needed for our clients. Hopefully other WordPress users will find our additions useful. 
Version: 1.5
http://www.cybersprocket.com
License: GPL3

=====================

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

**/


// Define our paths 
//
if (defined('SLPLUS_PLUGINDIR') === false) {
    define('SLPLUS_PLUGINDIR', plugin_dir_path(__FILE__));
}
if (defined('SLPLUS_PLUGINURL') === false) {
    define('SLPLUS_PLUGINURL', plugins_url('',__FILE__));
}
if (defined('SLPLUS_BASENAME') === false) {
    define('SLPLUS_BASENAME', plugin_basename(__FILE__));
}
include_once(SLPLUS_PLUGINDIR.'/libs/csl_helpers.php');
include_once(SLPLUS_PLUGINDIR.'/include/config.php');

$sl_version="1.5";
$sl_db_version=1.3;
$sl_upload_path='';
$sl_path='';
include_once("variables.sl.php");
include_once("functions.sl.php");

register_activation_hook( __FILE__, 'install_table');

add_action('wp_head', 'head_scripts');
add_action('admin_menu', 'csl_slplus_add_options_page');
add_action('admin_print_scripts', 'add_admin_javascript');
add_action('admin_print_styles','add_admin_stylesheet');
add_shortcode('STORE-LOCATOR','store_locator_shortcode');

load_plugin_textdomain($text_domain, false, SLPLUS_PLUGINDIR . '/languages/');



