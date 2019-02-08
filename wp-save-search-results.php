<?php
/*
Plugin Name: WP Save Search Results
Description: Save search text and show it in admin panel
Version: 1.0.0
Author: Pavel
Author URI: //plance.top/
*/

defined('ABSPATH') or die('No script kiddies please!');

/** Include Core */
include plugin_dir_path(__FILE__).'includes'.DIRECTORY_SEPARATOR.'core.php';

/** Set prefix and path to autoload core class */
WPSaveSearchResultCore::autoloadRegister(function($class){
	WPSaveSearchResultCore::loadClass('WPSaveSearchResultCore_', plugin_dir_path(__FILE__).'includes'.DIRECTORY_SEPARATOR, $class);
});

/** Set prefix and path to autoload plugin class */
WPSaveSearchResultCore::autoloadRegister(function ($class) {
	WPSaveSearchResultCore::loadClass('WPSaveSearchResult_', plugin_dir_path(__FILE__).'app'.DIRECTORY_SEPARATOR, $class);
});

/** InIt app */
new WPSaveSearchResult_INIT(array(
	'__FILE__' => __FILE__
));

if(is_admin() == true)
{
	register_activation_hook(__FILE__, 'WPSaveSearchResult_DB::activate');
	register_uninstall_hook(__FILE__, 'WPSaveSearchResult_DB::uninstall');
	register_deactivation_hook(__FILE__, 'WPSaveSearchResult_DB::deactivation');
}