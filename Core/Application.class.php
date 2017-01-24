<?php 
/**
 *应用核心类
 * 
 */
	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');	

	/**
	* 实现初始化类
	*/
	class Application
	{
		
		//输出字符编码
		private static function initCharSet(){
			header("Content-type:text/html;charset=utf-8");
		}

		//定义目录常量
		private static function initDir(){
			defined('APP') or define('APP', str_replace('Core','',str_replace('\\', '/', __DIR__)));
			defined('APP_ADMIN') or define('APP_ADMIN', APP.'Admin/');
			defined('APP_HOME') or define('APP_HOME', APP.'Home/');
			defined('APP_COMMON') or define('APP_COMMON', APP.'Common/');
			defined('APP_PUBLIC') or define('APP_PUBLIC', APP.'Public/');
			defined('APP_CONFIG') or define('APP_CONFIG', APP.'Config/');
			defined('APP_CORE') or define('APP_CORE', APP.'Core/');
			defined('ADMIN_CONTROLLER') or define('ADMIN_CONTROLLER', APP_ADMIN.'Controller/');
			defined('ADMIN_MODEL') or define('ADMIN_MODEL', APP_ADMIN.'Model/');
			defined('ADMIN_VIEW') or define('ADMIN_VIEW', APP_ADMIN.'View/');
			defined('HOME_CONTROLLER') or define('HOME_CONTROLLER', APP_HOME.'Controller/');
			defined('HOME_MODEL') or define('HOME_MODEL', APP_HOME.'Model/');
			defined('HOME_VIEW') or define('HOME_VIEW', APP_HOME.'View/');
			defined('EXT') or define('EXT', '.class.php');
			
		}

		//初始化系统错误提示
		private static function initError(){
			//默认报错所有
			ini_set('error_reporting', E_ALL);
			//向用户显示错误
			ini_set('display_error', 1);
		}

		//加载公共配置文件
		private static function initConfig(){
			$con = require_once APP_CONFIG.'config.php';
			//设置超全局变量
			$GLOBALS['config'] = $con;
		}

		//加载公共方法文件
		private static function initFuc(){
			require_once APP_COMMON.'function.php';

		}

		//类自动加载实现
		private static function initAutoload(){
			if ( function_exists('spl_autoload_register') ) {
				require_once APP_CORE.'Autoload'.EXT;
				spl_autoload_register(array('Autoload', 'autoloadAppCore'));
				spl_autoload_register(array('Autoload', 'autoloadAdminController'));
				spl_autoload_register(array('Autoload', 'autoloadHomeController'));
				spl_autoload_register(array('Autoload', 'autoloadAdminModel'));
				spl_autoload_register(array('Autoload', 'autoloadHomeModel'));
			}else{
				function __autoload($className){
					//return Core::autoload($className);
				}
			}
		}

		//初始化RUL
		private static function initUrl(){
			//传统传值方式
			if ( $_SERVER['QUERY_STRING'] ) {
				//获取模块
				$module = isset($_REQUEST['m']) ? $_REQUEST['m'] : '';
				//获取控制器信息
				$controller = isset($_REQUEST['c']) ? $_REQUEST['c'] : '';
				//获取方法信息
				$action = isset($_REQUEST['a']) ? $_REQUEST['a'] : '';

				isset($module) && define('MODULE', ucfirst(strtolower($module)));
				
			}else{
				//pathinfo模式
				$http = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
				$url = $http.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$path = explode('index.php', $url);
				
				//默认控制器和方法
				if ( strpos($path[0], $http) !== FALSE && $path[1]=='' ) {
					$controller = 'Index';
					$action = 'index';
				}else{
					$url = explode('/', $url);
					$module = array_slice($url, -3, 1);
					$controller = array_slice($url, -2, 1);
					$action = array_slice($url, -1, 1);

					$controller = $controller[0];
					$action = $action[0];

					//判断模块是否存在
					if ( $module[0] == 'Admin' || $module[0] == 'Home' ) {
						//首字母大写
						$module = ucfirst(strtolower($module[0]));
						define('MODULE', $module);
											
					}

				}
				
			}
			$controller = ucfirst(strtolower($controller));
			define('CONTROLLER', $controller);
			define('ACTION', $action);
		}

		//将接收到的数据进行对应分发
		private static function initDispatch(){
			defined('MODULE') && $module = MODULE;
			$controller = CONTROLLER . 'Controller';
			$action = ACTION;
			//实例化控制器
			$module = new $controller();
			//调用方法
			$module->$action();

		}

		//初始化方法
		public static function run(){

			//编码初始化
			self::initCharSet();

			//目录常量初始化
			self::initDir();
			
			//系统错误初始化
			self::initError();

			//配置文件初始化
			self::initConfig();

			//公共函数加载
			self::initFuc();

			//类的自动加载
			self::initAutoload();

			//URL初始化，根据用户请求格式确定模块、控制器和方法
			self::initUrl();

			//请求内容分发
			self::initDispatch();

		}


	}