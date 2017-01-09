<?php
	require_once("Models/login.php");
	require_once(dirname(__FILE__)."/helper.php");
	class Login_Controller
	{
		private $model;
		public function __construct()
		{
			$this->model=new Login();
		}
		public function Login($data)
		{
			if(Helper_Controller::isValuable($data["username"]) && Helper_Controller::isValuable($data["password"]))
			{	
				if(Helper_Controller::Check_string_length($data["username"]) && Helper_Controller::Check_string_length($data["password"]))
				{
					if(Helper_Controller::Check_string($data["username"]) && Helper_Controller::Check_string($data["password"]))
					{

						return $this->model->Login($data);
					}
                    return "Error";
				}
                return "Error";

			}
            return "Error";
		}
        public function LoginAdmin($data)
        {
            if(Helper_Controller::isValuable($data["username"]) && Helper_Controller::isValuable($data["password"]))
            {
                if(Helper_Controller::Check_string_length($data["username"]) && Helper_Controller::Check_string_length($data["password"]))
                {
                    if(Helper_Controller::Check_string($data["username"]) && Helper_Controller::Check_string($data["password"]))
                    {

                        return $this->model->LoginAdmin($data);
                    }
                    return "Error";
                }
                return "Error";

            }
            return "Error";
        }
        public function IsAdmin($data){
		    return $this->model->IsAdmin($data);
        }
        public function getUserById($user_id){
            return $this->model->getUserById($user_id);
        }
        public function LoginFacebook($data){
            return $this->model->LoginFacebook($data);
        }
    }
?>