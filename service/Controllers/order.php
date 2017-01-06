<?php
    require_once("Models/order.php");
    require_once(dirname(__FILE__)."/helper.php");
    class Order_Controller
    {
        private $model;
        public function __construct()
        {
            $this->model=new Order();
        }
        public function getAllOrder()
        {
            return $this->model->getAllOrder();
        }
        public function getOrderById($order_id)
        {
            if(Helper_Controler::isValuable($order_id))
            {
                return $this->model->getOrderById($order_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function addOrder($data)
        {
            if(Helper_Controler::isValuable($data["user_id"]) && Helper_Controler::isValuable($data["total_money"]) && Helper_Controler::isValuable($data["name"]) && Helper_Controler::isValuable($data["address"]) && Helper_Controler::isValuable($data["phone"]) && Helper_Controler::isValuable($data["email"]))
            {
                if(Helper_Controler::Check_number_string($data["total_money"]) && Helper_Controler::Check_phone_string($data["phone"]) && Helper_Controler::Check_email_string($data["email"]))
                {
                    return $this->model->addOrder($data);
                }
                return "Lỗi dữ liệu Null hoặc không hợp lệ";
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function deleteOrder($order_id)
        {
            if(Helper_Controler::isValuable($order_id))
            {
                return $this->model->deleteOrder($order_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
    }
}
?>