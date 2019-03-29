<?php
/**
 * COnfig file for direct access
 */
namespace Config; 
class Config
{
	public static function directory($dir=''){
		return plugin_dir_path( __DIR__ ).$dir;
	}
	public static function fileInclude($dir=''){
		include_once plugin_dir_path( __DIR__ ).$dir;
	}
	public static function url($dir=''){
		return plugins_url( $dir, __DIR__ );
	}
}
