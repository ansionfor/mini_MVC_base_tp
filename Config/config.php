<?php 

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	return array(
		'mysql'=>array(
			'dbHost'  =>  'localhost',
			'dbName'    =>  'ansion_blog',
			'dbPort'    =>  '3306',
			'userName'  =>  'root',	 //用户名
			'userPwd'   =>  'root',     //用户密码
			//'prefix'     =>  'blog_',    //数据表前缀
			'charset'    =>  'utf8'		 //数据库编码
			)

		); 