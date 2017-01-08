<?php
	class Token
	{
		public static function createToken($data)
		{
			$header=array(
				"alg"=>"HS256",
				"typ"=>"JWT"
			);
			$body=array(
				"username"=>$data["username"],
				"password"=>$data["password"]
			);
			$body=json_encode($body);
			$header=json_encode($header);
			
			$body=self::base64url_encode($body);
			$header=self::base64url_encode($header);
			$temp=$header.".".$body;
			$signature=hash_hmac("sha256",$temp,"secret",true);
			$signature=self::base64url_encode($signature);
			$token="$temp.$signature";
			return $token;
		}
		public static function base64url_encode($data) { 
			return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
		} 
	}
?>