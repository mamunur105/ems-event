<?php
/*
  @package EMS
  @version 1.0
/*
Plugin Name: EMS Event
Plugin URI: http://www.weborigin.org
Description:  This is a Ccompanion Plugin for Event Management system
Author: weborigin
Version: 1.0
Author URI: http://weborigin.org/
*/

/**
 * Plugins main Class
 */
namespace EMS\Main;

use Admin\Event;
use Admin\Imageupload;
use Config\Config;

class EMS
{
	
	public function __construct()
	{
		$this->include_file();                                                                                
		$this->functuon_hooking();                                                                       
	}

	public function functuon_hooking()
	{
		register_activation_hook( __FILE__, [$this,'ems_activation_time'] );
		register_deactivation_hook( __FILE__, [$this,'ems_deactivation_time'] );
		// register_uninstall_hook( __FILE__, [$this,'ems_uninstall_time']  );

		add_action( 'init', [$this,'ems_load_textdomain'] );
		add_action( 'wp_enqueue_scripts', [ $this, 'stylesheet_js' ] );
		add_action('admin_enqueue_scripts', [ $this, 'custom_admin_enqueue_script' ]);
		add_action( 'widgets_init', [ $this, 'ems_register_widgets' ] );
	}

	public function ems_register_widgets() 
	{
		register_widget( 'Admin\ImageUpload' );
	}
	
	public function ems_load_textdomain() 
	{
	  	load_plugin_textdomain( 'smsevent', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

	public function stylesheet_js() 
	{
		wp_enqueue_style( 'ems-main', Config::url('assets/css/ems-main.css'));
	}

	public function custom_admin_enqueue_script() 
	{
		wp_enqueue_media() ;
		wp_enqueue_script( array('jquery') );
		wp_enqueue_script('ems-custom-script', Config::url('assets/js/admin.js'), array('jquery') , '', true);
	}

	public function include_file()
	{
		require_once('vendor/autoload.php');
		new Imageupload();
		new Event();
	}
	 
	public function ems_activation_time()
	{ 
		$this->ems_create_table();
	}

	public function ems_deactivation_time()
	{
		// return $this->ems_delete_table();
	}

	public function ems_uninstall_time()
	{ 
		return $this->ems_delete_table(); 
	}

	public function ems_create_table()
	{

		global $wpdb;
		require_once (ABSPATH.'wp-admin/includes/upgrade.php');
		$ems_event = $wpdb->prefix.'esm_events';
		$ems_event_country = $wpdb->prefix.'esm_events_country';
		$ems_event_city = $wpdb->prefix.'esm_events_city';

		if($wpdb->get_var("SHOW TABLES LIKE '$ems_event'") != $ems_event) {
			$ems_sql = "CREATE TABLE {$ems_event} (
				 `ems_id` int(11) NOT NULL AUTO_INCREMENT,
				 `ems_post_id` int(11) NOT NULL,
				 `ems_start_date` timestamp NULL DEFAULT NULL,
				 `ems_end_date` timestamp NULL DEFAULT NULL,
				 `ems_sponsor` varchar(255) DEFAULT NULL,
				 `ems_featured` int(50) DEFAULT NULL,
				 `ems_fee` double DEFAULT NULL,
				 `zip_code` varchar(50) DEFAULT NULL,
				 `ems_city_id` int(50) DEFAULT NULL,
				 PRIMARY KEY (`ems_id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			dbDelta($ems_sql);
		}

		if($wpdb->get_var("SHOW TABLES LIKE '$ems_event_country'") !=  $ems_event_country) {
			$ems_sql_country = "CREATE TABLE {$ems_event_country} (
			 `ems_country_id` int(11) NOT NULL AUTO_INCREMENT,
			 `ems_country_name` varchar(100) NOT NULL,
			 `ems_country_code` varchar(100) DEFAULT NULL,
			 PRIMARY KEY (`ems_country_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			dbDelta($ems_sql_country);
		}

		if($wpdb->get_var("SHOW TABLES LIKE '$ems_event_city'") !=  $ems_event_city) {
			$ems_sql_city = "CREATE TABLE {$ems_event_city} (
			 `ems_city_id` int(11) NOT NULL AUTO_INCREMENT,
			 `ems_city_name` varchar(100) NOT NULL,
			 `ems_city_code` varchar(100) DEFAULT NULL,
			 PRIMARY KEY (`ems_city_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			dbDelta($ems_sql_city);
		}

	}


	public function ems_delete_table($delete=false )
	{
		global $wpdb;
		$table 		= array();
		$table[]	= $ems_event = $wpdb->prefix.'esm_events';
		$table[] 	= $ems_event_country = $wpdb->prefix.'esm_events_country';
		$table[] 	= $ems_event_city = $wpdb->prefix.'esm_events_city';
		$table 		= implode(', ', $table);
		
		if($delete == false){
			 // drop = DROP TABLE `wp_esm_events`, `wp_esm_events_city`, `wp_esm_events_country`;
			$sql = "DROP TABLE $table";
			$wpdb->query($sql);
		}
	}
}

new EMS();


