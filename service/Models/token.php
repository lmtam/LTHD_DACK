<?php
/**
 * Created by PhpStorm.
 * User: Tam Le
 * Date: 1/9/2017
 * Time: 1:40 PM
 */
    class Token
    {
        public static function createToken($data,$key)
        {
            $date=Date("Y-m-d H:i:s");
            $header=array(
                "alg"=>"HS256",
                "typ"=>"JWT"
            );
            $body=array(
                "username"=>$data["username"],
                "password"=>$data["password"],
                "date"=>$date
            );
            $body=json_encode($body);
            $header=json_encode($header);

            $body=self::base64url_encode($body);
            $header=self::base64url_encode($header);
            $temp=$header.".".$body;
            $signature=hash_hmac("sha256",$temp,$key,true);
            $signature=self::base64url_encode($signature);
            $token="$temp.$signature";
            return $token;
        }
        public static function base64url_encode($data) {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }
    }
?>