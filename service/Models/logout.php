<?php
	class Logout
	{
		public function Logout()
		{
			$_SESSION["login"]=0;
		}
	}
?>