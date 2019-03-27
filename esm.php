<?php
/*
  @package ESM
  @version 1.0
/*
Plugin Name: ESM Event
Plugin URI: http://www.weborigin.org
Description:  This is a Ccompanion Plugin for Event Management system
Author: weborigin
Version: 1.0
Author URI: http://weborigin.org/
*/


/**
 * Plugins main Class
 */

class EMS
{
	
	public function __construct()
	{
		$this->include_file();                                                                                
		$this->functuon_hooking();                                                                       
	}

	function functuon_hooking(){
		add_action( 'init', [$this,'ems_load_textdomain'] );
		add_action( 'wp_enqueue_scripts', [ $this, 'stylesheet_js' ] );
		add_action('admin_enqueue_scripts', [ $this, 'custom_admin_enqueue_script' ]);
	}
	
	function ems_load_textdomain() {
	  	load_plugin_textdomain( 'smsevent', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

	public function stylesheet_js() {
		wp_enqueue_style( 'ems-main', Config::url('assets/css/ems-main.css'));
	}

	function custom_admin_enqueue_script() {
		wp_enqueue_media() ;
		wp_enqueue_script( array('jquery') );
		wp_enqueue_script('ems-custom-script', Config::url('assets/js/admin.js'), array('jquery') , '', true);
	}

	public function include_file(){
		require_once('vendor/autoload.php');
		new Imageupload();
		new Event();
	}
	public function activate_function(){

	}
	public function ems_activation_time(){}
	public function ems_deactivation_time(){}
	public function ems_unistall_time(){}
}

new EMS();