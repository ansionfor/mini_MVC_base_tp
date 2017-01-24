<?php 
/**
 * 自动加载类
 * 
 */

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	/**
	* 
	*/
	class Autoload
	{
		
		public static function autoloadAppCore($className){
			$path = APP_CORE . $className . EXT;
			file_exists($path) && require_once $path;
		}

		public static function autoloadAdminController($className){
			$path = ADMIN_CONTROLLER . $className . EXT;
			file_exists($path) && require_once $path;
		}

		public static function autoloadHomeController($className){
			$path = HOME_CONTROLLER . $className . EXT;
			file_exists($path) && require_once $path;
		}

		public static function autoloadAdminModel($className){
			$path = ADMIN_MODEL . $className . EXT;
			file_exists($path) && require_once $path;
		}

		public static function autoloadHomeModel($className){
			$path = HOME_MODEL . $className . EXT;
			file_exists($path) && require_once $path;
		}
	}

