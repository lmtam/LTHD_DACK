<?php
	class Logout
	{
		public function Logout()
		{
			$_SESSION["login"]=0;
			$_SESSION['user_id'] = 0;
			return "Success";
		}
	}
?>