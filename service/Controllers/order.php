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
            if(Helper::isValuable($order_id))
            {
                return $this->model->getOrderById($order_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function addOrder($data)
        {
            if(Helper::isValuable($data["user_id"]) && Helper::isValuable($data["total_money"]) && Helper::isValuable($data["name"]) && Helper::isValuable($data["address"]) && Helper::isValuable($data["phone"]) && Helper::isValuable($data["email"]))
            {
                if(Helper::Check_number_string($data["total_money"]) && Helper::Check_phone_string($data["phone"]) && Helper::Check_email_string($data["email"]))
                {
                    return $this->model->addOrder($data);
                }
                return "Lỗi dữ liệu Null hoặc không hợp lệ";
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function deleteOrder($order_id)
        {
            if(Helper::isValuable($order_id))
            {
                return $this->model->deleteOrder($order_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
    }
}
?>