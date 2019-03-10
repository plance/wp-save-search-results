<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
* InIt
*/
class WPSaveSearchResult_INIT
{
	private $config_ar;
	public static $glob = array();

	/**
	* Create
	*/
	public function __construct($config_ar)
	{
		$this -> config_ar = $config_ar;

		/** Flahs init */
		WPSaveSearchResultCore_Helper::flashInit();

		/** Hooks */
		add_action('plugins_loaded', array($this, 'plugins_loaded'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));
	}
	
	/**
	 * WP hook "plugins_loaded"
	 */
	public function plugins_loaded()
	{
		self::$glob['path'] = plugin_dir_path($this -> config_ar['__FILE__']);
		self::$glob['url']  = plugin_dir_url($this -> config_ar['__FILE__']);

		/** Hooks */
		add_action('admin_menu', array($this, 'admin_menu'), 10);
	}

	/**
	 * WP: admin_menu
	 */
	public function admin_menu()
	{
		$ControllerSearch = new WPSaveSearchResult_Controller_Admin_Search();
		$hook = add_submenu_page(
			'tools.php',
			__('Search results', 'lance'),
			__('Search results', 'lance'),
			'manage_options',
			'save-search-results',
			array($ControllerSearch, 'view')
		);
		add_action('load-'.$hook, array($ControllerSearch, 'action'));
	}
	
	/**
	 * WP: pre_get_posts
	 */
	public function pre_get_posts($Query)
 	{
		if($Query -> is_search() && $Query -> is_main_query())
		{
			$s = esc_attr(wp_unslash($Query -> get('s')));

			if(empty($s) == false && in_array($s, $_SESSION['wpfsr__search_results'], true) == false)
			{
				if(!empty($_SESSION['wpfsr__search_results']))
				{
					$_SESSION['wpfsr__search_results'] = array();
				}
				
				$_SESSION['wpfsr__search_results'][] = $s;
				
				WPSaveSearchResult_DB::addTableResult(array(
					'text' => $s, 
					'date' => current_time('mysql')
				));
			}
		}
	}
}