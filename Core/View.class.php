<?php
/**
 *视图类
 * 
 */

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	/**
	* 
	*/
	class View
	{
		private $values;

		public function __construct(){
			$this->values = array();
		}

		//获取模板数据
		public function assign($name='', $value=''){
			if (is_array($name)) {
				$this->values = array_merge($this->values, $name);
			}

			$this->values[$name] = $value;
		}

		//加载模板方法
		public function display($template=''){

			//获取模板路径
			if ( is_array($vars = explode('/', $template)) ) {
				$path = APP . '/' . $vars[0] . '/' . 'View' . '/'.$vars[1] . '/' . $vars[2] . '.html';

			}

			if ( file_exists($path) ) {
				$file = file_get_contents($path);
				//循环替换模板标签
				//var_dump($file);
				//var_dump($this->values);
			
				foreach ($this->values as $k => $v) {
					//var_dump($v);
					$file = str_replace($k, $v, $file);
				}

				header('Content-type:text/html; charset=utf-8');
				echo $file;
				exit;
			}
		}
		
	}
