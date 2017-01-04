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
		public function getCommentsByProductID($product_id)
		{
			try
			{
				$sql="SELECT * FROM  WHERE product_id= :product_id";
				$temp=$this->con->prepare($sql);
				$temp->bindParam("product_id",$product_id);
				$temp->execute();
				$list=$temp->fetchAll(PDO::FETCH_BOTH);
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
			try
			{

			}
			catch(Exception $e)
			{
				return $e->getMessage();
			}
		}
	}
?>