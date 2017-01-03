<?php
require_once("Database/connection.php");
require_once(dirname(__FILE__).'/cart.php');
class Cart{
    private $con;
    public function __construct()
    {
        $temp=new DBConnection();
        $this->con=$temp->Connection();
    }

    function getCartByUserId($user_id){
        try{
            $sql = "SELECT * FROM carts WHERE user_id  =:user_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('user_id',$user_id);
            $temp->excute();
            $list = $temp->fetchAll(FETCH_BOTH);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function  addOneProductToCart($data){

    }

    function deleteOrder($user_id,$product_id){
        try{
            $sql = "DELETE  FROM carts WHERE user_id =:user_id AND product_id =:product_id ";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('user_id',$user_id);
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