<?php
    require_once("Models/cart.php");
    require_once(dirname(__FILE__)."/helper.php");
    class Cart_Controller
    {
        private $model;
        public function __construct()
        {
            $this->model=new Cart(); 
        }
        public function getCartByUserId($user_id)
        {
            if(Helper_Controller::isValuable($user_id))
            {
                return $this->model->getCartByUserId($user_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function addOneProductToCart($data)
        {
            if(Helper_Controler::isValuable($data["product_detail_id"]) && Helper_Controller::isValuable($data["user_id"]))
            {
                return $this->model->addOneProductToCart($data);
            }
            else
            {
                return "Lỗi dữ liệu Null hoặc không hợp lệ";
            }
        }
        public function deleteOrder($data)
        {
            if(Helper_Controller::isValuable($data["user_id"]) && Helper_Controller::isValuable($data["product_id"]))
            {
                return $this->model->deleteOrder($data);
            }
            else
            {
                return "Lỗi dữ liệu Null hoặc không hợp lệ";
            }
        }
    }
?>