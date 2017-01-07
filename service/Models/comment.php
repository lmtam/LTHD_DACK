<?php
	require_once("Database/connection.php");
	require_once(dirname(__FILE__)."/helper.php");
	class Comment
	{
		private $con;

		public function __construct()
		{
			$temp=new DBConnection();
			$this->con=$temp->Connection();
		}
		public function getCommentsByProductID($product_detail_id)
		{

			try
			{
				$sql="SELECT * FROM comments WHERE product_detail_id=:product_detail_id";
				$temp=$this->con->prepare($sql);
				$temp->bindParam("product_detail_id",$product_detail_id);
				$temp->execute();
				$list=$temp->fetchAll(PDO::FETCH_BOTH);
                echo "<pre>";
                var_dump($list);
                die();

                Helper::Disconnection($this->con);


				return $list;
			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
		}
		public function addComment($data)
		{
			$product_detail_id=$data["product_detail_id"];
			$content=$data["content"];
			$user_id=$data["user_id"];
			$created_day =  Date("Y-m-d H:i:s");
			try
			{
				$sql="INSERT INTO comments(product_detail_id,content,user_id,created_day) VALUES(:product_detail_id,:content,:user_id,:created_day)";
				$temp=$this->con->prepare($sql);
				$temp->bindParam("product_detail_id",$product_detail_id,PDO::PARAM_STR);
				$temp->bindParam("content",$content,PDO::PARAM_STR);
				$temp->bindParam("user_id",$user_id,PDO::PARAM_STR);
				$temp->bindParam("created_day",$created_day,PDO::PARAM_STR);
				$temp->execute();
				return "Thêm comment thành công";
			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
		}
	}
?>