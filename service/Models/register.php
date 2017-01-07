<?php
	require_once("Database/connection.php");
	require_once(dirname(__FILE__).'/helper.php');
	class Register
	{
		private $con;
		public function __construct()
		{
			$temp=new DBConnection();
			$this->con=$temp->Connection();
		}
		public function Register($array)
		{
			$username=$array["username"];
			$password=$array["password"];
			$admin="N";
			$created_day=new Date('Y-m-d H:i:s');

			
			try
			{
				// chưa hoàn thành
				$sql="INSERT INTO users(user_name,password,created_day,admin) VALUES(:username,:password,:created_day,:admin)";
				$temp=$this->con->prepare($sql);
				$temp->bindParam("username",$username);
				$temp->bindParam("password",$password);
				$temp->bindParam("created_day",$created_day);
				$temp->bindParam("admin",$admin);
				Helper::Disconnection($this->con);
				return "Đăng kí thành công";

			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
					
		}
		
	}
?>