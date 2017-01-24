<?php

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	class AboutController extends Controller
	{
		public function index(){
			echo "1";
		}

		public function register(){
			echo 2;
		}
	}