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
			if(isset($username) && isset($password))
			{	
				if(Helper::Check_string_length($username) && Helper::Check_string_length($password))
				{
					if(Helper::Check_string($username) && Helper::Check_string($password))
					{
						try
						{
							$sql="SELECT * FROM accounts WHERE username=:username AND password=:password";
							$temp=$this->con->prepare($sql);
							$temp->bindParam('username',$username);
							$temp->bindParam('password',$password);
							$temp->excute();
							if($temp->rowCount())
							{
								$_SESSION["login"]=1;
								return 1;
							}
							return 0;

						}
						catch(Exception $e)
						{
							return 0;
						}
					}
					return 0;
				}
				return 0;
					
			}
			return 0;
		}
	}
?>