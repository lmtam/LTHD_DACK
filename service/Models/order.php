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
    /* data = object(
     *      user_id
     *      total_money
     *      name
     *      address
     *      phone
     *      email
     *      order_detail= array(
     *          0=> product_detail_id
     *
     *      )
     */
    function  addOrder($data){
        $orderId=null;
        $created_day    = new Date('Y-m-d H:i:s');
        $user_id        = $data['user_id'];
        $total_money    = $data['total_money'];
        $name           = $data['name'];
        $address        = $data['address'];
        $phone          = $data['phone'];
        $email          = $data['email'];
        try
        {
            $sqlOrder = "INSERT INTO orders (created_day,total_money,user_id,name,address,phone,email)". "VALUES ('$created_day','$user_id','$total_money','$name','$address','$phone','$email')";
            $temp = $this->con->prepare($sqlOrder);
            $temp->execute();
            
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
        
        try
        {
            $sqlSelect = "SELECT order_id FROM orders WHERE created_day=:created_day AND user_id=:user_id";
            $temp1=$this->con->prepare($sqlSelect);
            $temp1->bindParam('created_day',$created_day);
            $temp1->bindParam('user_id',$user_id);
            $temp1->execute();
            //lấy product_id từ temp1;
            $list = $temp1->fetchAll(PDO::FETCH_BOTH);
            $orderId = $list['order_id'];
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
        


        

        $listOrderDetail = $data['order_detail'];
        foreach ($listOrderDetail as $item){
            $product_detail_id = $item['product_detail_id'];
            try
            {
                $sqlProductDetail = "INSERT INTO order_detail (product_detail_id)"."VALUES ('$product_detail_id')";
                $temp2 = $this->con->prepare($sqlProductDetail);
                $temp2->execute();
            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }
            
        }
        Helper::Disconnection($this->con);
        return "Thêm thành công";
    }

    function deleteOrder($order_id){
        try{
            $sql = "DELETE  FROM orders WHERE order_id=:order_id";

            $temp=$this->con->prepare($sql);
            $temp->bindParam('order_id',$order_id);
            $temp->excute();
            Helper::Disconnection($this->con);
            return "Xóa thành công";
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
}
?>