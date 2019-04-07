<?php

/**
 * 
 */
namespace ems\apps\admin;
use Config\Config;
class  Settings
{

	public function __construct()
	{                                                                              
		$this->functuon_hooking();                                                                       
	}
	public function functuon_hooking()
	{
		add_action( 'admin_menu', array( $this, 'add_submenu_page_to_post_type' ) );
	}

	/**
	 * Add sub menu page to the custom post type
	 */
	public function add_submenu_page_to_post_type()
	{
	    add_submenu_page(
	        'edit.php?post_type=ems_events', 	// parent slug
	        __('Event Options', 'emsevent'), 	// the name for title bar
	        __('Event Options', 'emsevent'), 	// name for menubar 
	        'manage_options',					// 
	        'ems_events_settings',
	        array($this, 'ems_projects_options_display'));
	}

	public function ems_projects_options_display(){
		Config::fileInclude('apps/adminview/main-page.php');
	}


}

/*
i have a question   to you .
suppose you need to go some where , and there is two roads (road one, and road 2) and one road is currect ,
but there is 2 person , 
and one always Tell a lie  . 
and another one always Tell the true ,
but you donno who is right person , 
you also unknown about those road ,
now you need to ask any one of them, you can ask only one person for get the actual road ,
which question you ask him  so that you get actual road ?

*/