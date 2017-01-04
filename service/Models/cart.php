<?php
require_once("Database/connection.php");
require_once(dirname(__FILE__).'/helper.php');
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
            $list = $temp->fetchAll(PDO::FETCH_BOTH);
            Helper::Disconnection($this->con);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function  addOneProductToCart($data){
        $product_detail_id = $data['product_detail_id'];
        $user_id = $data['user_id'];
        try
        {
            $select = 'SELECT * FROM carts WHERE user_id=:user_id AND product_detail_id=:product_detail_id';
            $temp=$this->con->prepare($select);
            $temp->bindParam('user_id',$user_id);
            $temp->bindParam('product_id',$product_id);
            $temp->excute();
            $list = $temp->fetchAll(PDO::FETCH_BOTH);

           
            if(!isset($list)){
                try
                {
                    $sql = "INSERT INTO carts (product_detail_id,count,user_id)". "VALUES ( '$product_detail_id','1','$user_id')";
                    $temp1 = $this->con->prepare($sql);
                    $temp1->execute();
                    Helper::Disconnection($this->con);
                    return 1;
                }
                catch(Exception $e)
                {
                    return $e->getMessage();
                }
                
            }
            else{
                //cần chỉnh sửa param của count
                try
                {
                    $sql = "UPDATE carts SET count=count +1 WHERE user_id=:user_id AND product_detail_id=:product_detail_id";
                    $temp1 = $this->con->prepare($sql);
                    $temp1->bindParam('user_id',$user_id);
                    $temp1->bindParam('product_id',$product_id);
                    $temp1->execute();
                    Helper::Disconnection($this->con);
                    return 1;
                }
                catch(Exception $e)
                {
                    return $e->getMessage();
                }
                
            }
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
       
    }

    function deleteOrder($user_id,$product_id){
        try{
            $sql = "DELETE  FROM carts WHERE user_id=:user_id AND product_id=:product_id ";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('user_id',$user_id);
            $temp->bindParam('product_id',$product_id);
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