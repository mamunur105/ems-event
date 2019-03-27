<?php

// register_uninstall_hook(['EMS\Main\ems_uninstall_time', 'ems_uninstall_time' ] );
/**
 * 
 */

class UninstaEms
{
	
	function __construct()
	{
		// register_uninstall_hook([, 'ems_uninstall_time' ] );
		$this->ems_uninstall_time();
	}
	function ems_uninstall_time(){
		return $this->ems_delete_table();	
	}
	function ems_delete_table($delete=false )
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

new UninstaEms();
