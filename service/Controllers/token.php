<?php
	class Token_Controller
	{

		public static function verifyJWT($token)
		{
			$token=explode(".",$token);
			if(count($token)<3)
			{
				return 0;
			}
			$header=json_decode(self::base64url_decode($token[0]));
			if(!isset($header->typ))
			{
				return 0;
			}
			if($header->typ!="JWT")
			{
				
				return 0;
			}
			if(!isset($header->alg))
			{
				return 0;
			}
			if($header->alg!="HS256")
			{
				
				return 0;
			}
			$signature=self::base64url_decode($token[2]);
			
			if($signature!=hash_hmac("sha256","$token[0].$token[1]","secret",true))
			{
				
				return 0;
			}
			$claim=json_decode(self::base64url_decode($token[1]));
			
			if(!$claim)
			{
				
				return 0;
			}
			if(!isset($claim->username))
			{
				
				return 0;
			}
			$arr=array(
				"username"=>$claim->username,
				"password"=>$claim->password
				);
			return $arr;
	
		}
		
		public static function base64url_decode($data) { 
			return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
		} 
	}
?>