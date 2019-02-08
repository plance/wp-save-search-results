<?php
defined('ABSPATH') or die('No script kiddies please!');

class WPSaveSearchResult_Controller_Admin_Search
{
	//===========================================================
	// Light version [START]
	//===========================================================
	
   public function __construct()
   {
		add_action('admin_head', array($this, 'admin_head'));
   }
	
   public function admin_head()
   {
	   
   }
	
   //===========================================================
   // Actions
   //===========================================================
	
	public function action()
	{
		switch(filter_input(INPUT_GET, 'action'))
		{
			case 'delete':
				$this -> actionDelete();
			break;
			case 'clear':
				$this -> actionClear();
			break;
		}
	}
	
	public function actionDelete()
    {
 	   WPSaveSearchResult_DB::deleteTableResult(filter_input(INPUT_GET, 'key', FILTER_SANITIZE_NUMBER_INT));
	   
	   WPSaveSearchResultCore_Helper::flashRedirect(remove_query_arg(array('action', 'key')), __('Query deleted', 'lance'));
    }
	
	public function actionClear()
    {
		WPSaveSearchResult_DB::clearTableResult();
		WPSaveSearchResultCore_Helper::flashRedirect(remove_query_arg('action'), __('Table cleared', 'lance'));
    }
	
	//===========================================================
    // Views
    //===========================================================
	
	public function view()
	{
		$data_ar = WPSaveSearchResult_DB::getListTableResult();
		
		echo WPSaveSearchResultCore_Helper::getView(WPSaveSearchResult_INIT::$glob['path'].'app/view/admin/search/index', array(
			'data_ar' => $data_ar
		));
	}
}