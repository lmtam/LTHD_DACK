<?php
	session_start();
	$_SESSION["login"]=0;
	require_once("Database/connection.php");
	require_once(dirname(__FILE__)."/helper.php");
	class Login
	{
		private $con;
		public function __construct()
		{
			$temp=new DBConnection();
			$this->con=$temp->Connection();

		}
		
		public function Login($array)
		{
			$username=$array["username"];
			$password=$array["password"];
			
			try
			{
				$sql="SELECT admin FROM users WHERE user_name=:username AND password=:password";
				$temp=$this->con->prepare($sql);
				$temp->bindParam('username',$username);
				$temp->bindParam('password',$password);
				$temp->excute();
				if($temp->rowCount())
				{
					$list=$temp->fetchAll(PDO::FETCH_BOTH);
					$admin=$list["admin"];
					if($admin=="Y")
					{
						$_SESSION["login"]=1;
						$_SESSION["admin"]=1;

					}
					else
					{
						$_SESSION["login"]=1;
						$_SESSION["admin"]=0;
					}
					
					Helper::Disconnection($this->con);
					return "Đăng nhập thành công";
				}
				Helper::Disconnection($this->con);
				return "Đăng nhập thất bại";

			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
				
		}
	}
?>