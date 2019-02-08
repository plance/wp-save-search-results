<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
 * DB class
 */
class WPSaveSearchResult_DB
{
	const TABLE_RESULTS = 'wpfsr__table_results';
	
    /**
	 * Plugin Activate
	 */
    public static function activate()
    {
        return true;
    }
	
    /**
	 * Plugin Deactivation
	 */
    public static function deactivation()
    {
		return true;
    }
	
    /**
	 * Plugin Uninstall
	 */
    public static function uninstall()
    {
		delete_option(WPSaveSearchResult_DB::TABLE_RESULTS);
		
		return true;
    }
    
	//===========================================================
    // Tabl Results
    //===========================================================
	
	/**
	 * Return table with search results
	 * @return array
	 */
	public static function getListTableResult()
	{
		$data_ar = get_option(WPSaveSearchResult_DB::TABLE_RESULTS, array());
		
		krsort($data_ar);
		
		return $data_ar;
	}
	
	/**
	 * Add data to Table Result
	 * @return array
	 */
	public static function addTableResult($new_ar)
	{
		$data_ar = get_option(WPSaveSearchResult_DB::TABLE_RESULTS, array());
		$data_ar = array_merge($data_ar, array($new_ar));

		update_option(WPSaveSearchResult_DB::TABLE_RESULTS, $data_ar, false);
	}
	
	/**
	 * Delete row from Table Result
	 * @return array
	 */
	public static function deleteTableResult($key)
	{
		$data_ar = WPSaveSearchResult_DB::getListTableResult();
		
		if(array_key_exists($key, $data_ar))
		{
			unset($data_ar[$key]);
		}
		
		update_option(WPSaveSearchResult_DB::TABLE_RESULTS, $data_ar, false);
	}
	
	/**
	 * Clear Table Result
	 * @return array
	 */
	public static function clearTableResult()
	{
		update_option(WPSaveSearchResult_DB::TABLE_RESULTS, array(), false);
	}
}