<?php
    require_once("Models/product.php");
    require_once(dirname(__FILE__)."/helper.php");

    class Product_Controller
    {
        private $model;
        public function __construct()
        {
            $this->model=new Product();
        }
        public function getAllProduct()
        {
            return $this->model->getAllProduct();
        }
        public function getProductById($product_id)
        {
            if(Helper::isValuable($product_id))
            {
                return $this->model->getProductById($product_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function addProduct($data)
        {
            if(Helper::isValuable($data["name"]) && Helper::isValuable($data["description"]) && Helper::isValuable($data["type"]) && Helper::isValuable($data["price"]) && Helper::isValuable($data["image_name"]) && Helper::isValuable($data["count"]))
            {
                if(Helper::Check_number_string($data["price"]) && Helper::Check_number_string($data["count"]))
                {
                    return $this->model->addProduct($data);
                }
                return "Lỗi dữ liệu Null hoặc không hợp lệ";
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
        public function deleteProduct($product_id)
        {
            if(Helper::isValuable($product_id))
            {
                return $this->model->deleteProduct($product_id);
            }
            return "Lỗi dữ liệu Null hoặc không hợp lệ";
        }
    }

?>