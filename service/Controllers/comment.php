<?php
	require_once("Models/comment.php");
	require_once(dirname(__FILE__)."/helper.php");
	class Comment_Controller
	{
		private $model
		public function __construct()
		{
			$this->model=new Comment();
		}
		public function getCommentsByProductID($product_id)
		{
			if(Helper::isValuable($product_id))
			{
				return $this->model->getCommentsByProductID($product_id);
			}
			else
			{
				return "Lỗi dữ liệu Null hoặc không hợp lệ";
			}
		}
		public function addComment($data)
		{
			if(Helper::isValuable($data["product_detail_id"]) && Helper::isValuable($data["user_id"]) && Helper::isValuable($data["content"]))
			{
				return $this->model->addComment($data);
			}
			else
			{
				return "Lỗi dữ liệu Null hoặc không hợp lệ";
			}
		}
	}
?>