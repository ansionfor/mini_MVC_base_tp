<?php
/**
 *模型核心类
 * 
 */

	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');	

	class Model extends Db
	{
		public $tableName;
		public function __construct($tableName=''){
			$this->tableName = $tableName;
			parent::__construct();
		}

		public function select($id=''){
			$sql = "select * from $this->tableName where id = $id";
			return $this->execute_dql($sql);
		}

		public function delete($id=''){
			$sql = "delete from $this->tableName where id = $id";
			return $this->execute_dml($sql);
		}
	}