<?php
/*
  @package ESM
  @version 1.0
/*
Plugin Name: ESM
Plugin URI: http://www.weborigin.org
Description:  This is a Ccompanion Plugin for Event Management system
Author: weborigin
Version: 1.0
Author URI: http://weborigin.org/
*/


/**
 * Plugins main Class
 */
// namespace ESMMAIN;
use admin\Event as Events;
class EMS
{
	
	public function __construct()
	{
		$this->include_file();                                                                                                                                                                                   
	}
	function functuon_hooking(){
		add_action( 'init', [$this,'ems_load_textdomain'] );
	}
	function ems_load_textdomain() {
	  	load_plugin_textdomain( 'smsevent', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

	public function include_file(){
		require_once('vendor/autoload.php');
		new Events();
	}
	public function activate_function(){

	}

	public function ems_activation_time(){}
	public function ems_deactivation_time(){}
	public function ems_unistall_time(){}
}

new EMS();