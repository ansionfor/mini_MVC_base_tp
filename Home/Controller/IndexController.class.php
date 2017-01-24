<?php

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	class IndexController extends Controller
	{
		public function index(){
			//$user = new AboutModel('About');
			$article = new BlogModel('blog_article');
			$data = $article->select(2);

			$this->assign('{$data}', '我的第一个自制mvc框架');
			$this->display('Home/Index/index');
		}
	}