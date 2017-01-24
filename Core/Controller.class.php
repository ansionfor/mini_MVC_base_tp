<?php
/**
 *核心控制器类
 * 
 */

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');	

	/**
	* 核心控制器类
	*/
	class Controller
	{
		 private $view = null;

		 public function __construct(){
		 	$this->view = new View();
		 }

		 /**
		  *跳转方法
		  * @param string 跳转的url
		  * @param string 页面提示信息
		  */
		 protected function redirect($url='', $mag='', $time=2){
		 	$http = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		 	$path = exlode('index.php', $http . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
		 	strpos($url, '/') !== FALSE ? $url = $path[0] . 'index.php/' . $url :$url = $path[0] . 'index.php?' . $url;
		 	
		 	$this->view->assign('{$url}', $url);
		 	$this->view->assign('{$msg}', $msg);
		 	$this->view->assign('{$time}', $time);
		 	$this->view->display('Common/redirect');
		 }

		 /**
		  *成功跳转方法
		  * @param  地址
		  * @param  提示
		  * @param  时间
		  */
		 protected function success($url='', $msg='', $time=1){
		 	$this->redirect($url, $msg, $time);
		 }

		 /**
		  *失败跳转方法
		  * @param  地址
		  * @param  提示
		  * @param  时间
		  */
		 protected function error($url='', $msg='', $time=3){
		 	$this->redirect($url, $msg, $time);
		 }

		 protected function assign($name='', $value=''){
		 	$this->view->assign($name, $value);
		 }

		 protected function display($template=''){
		 	$this->view->display($template);
		 }
	}