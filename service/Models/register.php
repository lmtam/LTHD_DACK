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

			if(isset($username) && isset($password))
			{	
				if(Helper::Check_string_length($username) && Helper::Check_string_length($password))
				{
					if(Helper::Check_string($username) && Helper::Check_string($password))
					{
						try
						{
							// chưa hoàn thành
							
							return 1;

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