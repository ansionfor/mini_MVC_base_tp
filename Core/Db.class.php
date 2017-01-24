<?php
/**
 *数据库封装类
 * 
 */
	
	//判断当前请求是否是通过index.php进入
	!defined('ACCESS') && die('非法请求！');

	class Db
	{
		public $conn;
		public $dbHost;      //主机
		public $dbPort;		 //端口
		public $dbName;      //数据库
		public $userName;	 //用户名
		public $userPwd;	 //用户密码
		public $charset;     //编码

		//初始化数据库配置信息
		public function __construct($arr=array()){
			$this->dbHost = isset($arr['dbHost']) ? $arr['dbHost'] : $GLOBALS['config']['mysql']['dbHost'];
			$this->dbName = isset($arr['dbName']) ? $arr['dbName'] : $GLOBALS['config']['mysql']['dbName'];
			$this->userName = isset($arr['userName']) ? $arr['userName'] : $GLOBALS['config']['mysql']['userName'];
			$this->userPwd = isset($arr['userPwd']) ? $arr['userPwd'] : $GLOBALS['config']['mysql']['userPwd'];
			$this->dbPort = isset($arr['dbPort']) ? $arr['dbPort'] : $GLOBALS['config']['mysql']['dbPort'];
			$this->charset = isset($arr['charset']) ? $arr['charset'] : $GLOBALS['config']['mysql']['charset'];

			$this->connect_db();
		}

		//连接数据库
		public function connect_db(){
			$this->conn = new mysqli($this->dbHost, $this->userName, $this->userPwd, $this->dbName, $this->dbPort);
			//面向对象的方式屏蔽了连接产生的错误，需要通过函数来判断
			mysqli_connect_error() && die(mysqli_connect_error());
			$this->conn->set_charset($this->charset);

		}

		//执行dql数据查询语句
		public function execute_dql($sql=''){
			$result = $this->conn->query($sql) or die($this->conn->errno.':'.$this->conn->error);
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$arr[] = $row;
			}
			$result->free_result();
			return $arr;
		}

		//执行dml数据操纵语句
		public function execute_dml($sql=''){
			$result = $this->conn->query($sql) or die($this->conn->errno().':'.$this->conn->error());
			if (!$result) {
				//操作失败，语法错误
				return 0;
			}elseif($this->conn->affected_rows() > 0){
				//修改成功
				return 1;
			}else{
				//修改失败，修改行数为0
				return 2;
			}

		}

		//关闭连接
		public function close_conn(){
			!empty($this->conn) && $this->conn->close();
		}
	}	