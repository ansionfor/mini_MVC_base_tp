<?php

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	class AboutModel extends Model
	{
		public function __construct($tableName=''){
			parent::__construct($tableName);
		}
	}