<?php
	require_once("Database/connection.php");
	require_once(dirname(__FILE__).'/helper.php');
	class Register_Controller
	{
		private $model;
		public function __construct()
		{
			$this->model=new Register();
		}
		public function Register($data)
		{
			if(Helper::isValuable($data["username"]) && Helper::isValuable($data["password"]))
			{	
				if(Helper::Check_string_length($data["username"]) && Helper::Check_string_length($data["password"]))
				{
					if(Helper::Check_string($data["username"]) && Helper::Check_string($data["password"]))
					{
						return $this->model->Register($data);
					}
					return "Username hoặc Password có kí tự không hợp lệ";
				}
				return "Username hoặc Password dài quá 15 kí tự";
			}
			return "Username hoặc Password rỗng";
		}
	}
?>