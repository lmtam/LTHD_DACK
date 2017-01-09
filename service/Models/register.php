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
			$name = $array["name"];
			$admin="N";
			$created_day= Date('Y-m-d H:i:s');

			
			try
			{
				// chưa hoàn thành
				$sql="INSERT INTO users(user_name,password,name,created_day,admin) VALUES('$username','$password','$name','$created_day','$admin')";
				$temp=$this->con->prepare($sql);
                $temp->execute();
				Helper::Disconnection($this->con);
				return "Success";

			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
					
		}
		
	}
?>