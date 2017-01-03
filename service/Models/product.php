<?php
require_once("Database/connection.php");
require_once(dirname(__FILE__).'/product.php');
class Product{
    private $con;
    public function __construct()
    {
        $temp=new DBConnection();
        $this->con=$temp->Connection();
    }
    function getAllProduct(){
        try{
            $sql = "SELECT * FROM products";
            $temp=$this->con->prepare($sql);
            $temp->excute();
            $list = $temp->fetchAll(FETCH_BOTH);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function getProductById($product_id){
        try{
            $sql = "SELECT * FROM products WHERE product_id := product_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('product_id',$product_id);
            $temp->excute();
            $list = $temp->fetchAll(FETCH_BOTH);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function  addProduct($data){

    }

    function deleteProduct($data){
        try{
            $sql = "DELETE  FROM products WHERE product_id := product_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('product_id',$product_id);
            $temp->excute();
            $list = $temp->fetchAll(FETCH_BOTH);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
}
?>