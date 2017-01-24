<?php 

	//项目入口
	//定义入口变量
	define('ACCESS', true);

	//加载初始化类
	require_once './Core/Application.class.php';

	//对系统进行初始化
	Application::run();

	