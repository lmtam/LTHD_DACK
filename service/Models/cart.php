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
            $sql = "SELECT * FROM carts WHERE user_id=:user_id";

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
        $select = 'SELECT * FROM carts WHERE user_id=:user_id AND product_detail_id=:product_detail_id';
        $temp=$this->con->prepare($select);
        $temp->bindParam('user_id',$user_id);
        $temp->bindParam('product_id',$product_id);
        $temp->excute();
        $list = $temp->fetchAll(FETCH_BOTH);
        $product_detail_id = $data['product_detail_id'];
        $user_id = $data['user_id'];
        if($list == null){

            $sql = "INSERT INTO carts (product_detail_id,count,user_id)". "VALUES ( '$product_detail_id','1','$user_id')";
            $temp1 = $this->con->prepare($sql);
            $temp1->execute();
        }
        else{
            //cần chỉnh sửa param của count
            $sql = "UPDATE carts SET count=:1 WHERE user_id=:user_id AND product_detail_id=:product_detail_id";
            $temp1 = $this->con->prepare($sql);
            $temp1->bindParam('user_id',$user_id);
            $temp1->bindParam('product_id',$product_id);
            $temp1->execute();
        }
    }

    function deleteOrder($user_id,$product_id){
        try{
            $sql = "DELETE  FROM carts WHERE user_id=:user_id AND product_id=:product_id ";

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