<?php
require_once("Database/connection.php");
require_once(dirname(__FILE__)."/helper.php");
class Order{
    private $con;
    public function __construct()
    {
        $temp=new DBConnection();
        $this->con=$temp->Connection();
    }
    function getAllOrder(){
        try{
            $sql = "SELECT * FROM orders";
            $temp=$this->con->prepare($sql);
            $temp->excute();
            $list = $temp->fetchAll(PDO::FETCH_BOTH);
            Helper::Disconnection($this->con);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function getOrderById($order_id){
        try{
            $sql = "SELECT * FROM orders WHERE order_id=:order_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('order_id',$order_id);
            $temp->excute();
            $list = $temp->fetchAll(FETCH_BOTH);
            Helper::Disconnection($this->con);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function  addOrder($data){

    }

    function deleteOrder($order_id){
        try{
            $sql = "DELETE  FROM orders WHERE order_id=:order_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('order_id',$order_id);
            $temp->excute();
            $list = $temp->fetchAll(PDO::FETCH_BOTH);
            Helper::Disconnection($this->con);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
}
?>