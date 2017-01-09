<?php

	$_SESSION["login"]=0;
	require_once("Database/connection.php");
	require_once(dirname(__FILE__)."/helper.php");
	require_once(dirname(__FILE__)."/token.php");
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
				$sql="SELECT * FROM users WHERE user_name=:username AND password=:password";
				$temp=$this->con->prepare($sql);
				$temp->bindParam('username',$username,PDO::PARAM_STR);
				$temp->bindParam('password',$password,PDO::PARAM_STR);
				$temp->execute();

				if($temp->rowCount())
				{
					$list=$temp->fetchAll(PDO::FETCH_BOTH);
					$admin=$list[0]["admin"];
					if($admin=="Y")
					{
						$_SESSION["login"]=1;
						$_SESSION["admin"]=1;
						$_SESSION['user_id']= $list[0]['user_id'];


					}
					else
					{
						$_SESSION["login"]=1;
						$_SESSION["admin"]=0;
                        $_SESSION['user_id']= $list[0]['user_id'];
					}
					
					return $list;
				}
				Helper::Disconnection($this->con);
				return "Error";

			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
				
		}
		function LoginAdmin($array){
            $username=$array["username"];
            $password=$array["password"];
            $admin = 'Y';
            try
            {
                $sql="SELECT * FROM users WHERE user_name=:username AND password=:password AND admin=:admin";
                $temp=$this->con->prepare($sql);
                $temp->bindParam('username',$username,PDO::PARAM_STR);
                $temp->bindParam('password',$password,PDO::PARAM_STR);
                $temp->bindParam('admin',$admin,PDO::PARAM_STR);
                $temp->execute();

                if($temp->rowCount())
                {
                    $list=$temp->fetchAll(PDO::FETCH_BOTH);

                    $_SESSION["login"]=1;
                    $_SESSION['user_id']= $list[0]['user_id'];

                    Helper::Disconnection($this->con);
                    $token=Token::createToken($array,"secret");

                    return $token;
                }
                Helper::Disconnection($this->con);
                return "Error";

            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }
        }

        function IsAdmin($array){
            $username=$array["username"];
            $password=$array["password"];
            $admin = 'Y';
            try
            {
                $sql="SELECT * FROM users WHERE user_name=:username AND password=:password AND admin=:admin";
                $temp=$this->con->prepare($sql);
                $temp->bindParam('username',$username,PDO::PARAM_STR);
                $temp->bindParam('password',$password,PDO::PARAM_STR);
                $temp->bindParam('admin',$admin,PDO::PARAM_STR);
                $temp->execute();

                if($temp->rowCount())
                {
                   return true;
                }
                Helper::Disconnection($this->con);
                return false;

            }
            catch(Exception $e)
            {
                return false;
            }
        }
        function getUserById($user_id){
            try
            {
                $sql="SELECT * FROM users WHERE user_id=:user_id";
                $temp=$this->con->prepare($sql);
                $temp->bindParam('user_id',$user_id,PDO::PARAM_STR);

                $temp->execute();

                $list=$temp->fetchAll(PDO::FETCH_BOTH);


                Helper::Disconnection($this->con);
                return $list;

            }
            catch(Exception $e)
            {
                return "error";
            }
        }
        function LoginFacebook($data){
            $username=$data["username"];
            $name=$data["name"];
            $password ='';
            $admin="N";
            $created_day= Date('Y-m-d H:i:s');
            $sqlSelect = " SELECT * FROM users WHERE user_name=:username";
            $temp1=$this->con->prepare($sqlSelect);
            $temp1->bindParam('username',$username,PDO::PARAM_STR);
            $temp1->execute();
            if($temp1->rowCount()) {
                $list = $temp1->fetchAll(PDO::FETCH_BOTH);
                $_SESSION['user_id'] = $list[0]['user_id'];
                $_SESSION["login"]=1;
            }
            else{
                try {
                    $sql = "INSERT INTO users(user_name,password,name,created_day,admin) VALUES('$username','$password','$name','$created_day','$admin')";
                    $temp = $this->con->prepare($sql);
                    $temp->execute();

                    $sqlSelect1 = " SELECT * FROM users WHERE user_name=:username";
                    $temp2=$this->con->prepare($sqlSelect1);
                    $temp2->bindParam('username',$username,PDO::PARAM_STR);
                    $temp2->execute();
                    if($temp2->rowCount()) {
                        $list = $temp2->fetchAll(PDO::FETCH_BOTH);
                        $_SESSION['user_id'] = $list[0]['user_id'];
                        $_SESSION["login"]=1;
                    }
                    else{
                        return "error";
                    }
                    Helper::Disconnection($this->con);
                    return "Success";

                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
        }
	}
?>