<?php
require_once("Database/connection.php");
require_once(dirname(__FILE__)."/helper.php");

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
            $list = $temp->fetchAll(PDO::FETCH_BOTH);
            Helper::Disconnection($this->con);
            return $list;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    function getProductById($product_id){
        try{
            $sql = "SELECT * FROM products WHERE product_id=:product_id";

            $temp=$this->con->prepare($sql);
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
    /* data = object(
     *       name
     *       description
     *       type
     *       price
     *       image_name
     *       count
     *       product = array(
     *          0 => { size, color,count}
     *          1 => { size, color,count}
     *
     *          )
     *      )
     */
    function  addProduct($data){
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];
        $price = $data['price'];
        $image_name = $data['image_name'];
        $count = $data['count'];
        $created_day = new Date('Y-m-d H:i:s');
        $sqlProduct = "INSERT INTO products (product_name,description,type,price,created_day,image_name,count)". "VALUES ( '$name','$description','$type','$price','$created_day','$image_name','$count')";
        $temp=$this->con->prepare($sqlProduct);
        $temp->execute();

        $sqlSelect = "SELECT product_id FROM products WHERE created_day=:created_day AND product_name=:name";
        $temp1=$this->con->prepare($sqlSelect);
        $temp1->bindParam('created_day',$created_day);
        $temp1->bindParam('name',$name);
        $temp1->execute();

        //lấy product_id từ temp1;
        $list = $temp1->fetchAll(PDO::FETCH_BOTH);
        $productId = $list['product_id'];

        $listProductDetail = $data['product'];
        foreach ($listProductDetail as $item){
            $size = $item['size'];
            $color = $item['color'];
            $countDetail = $item['count'];
            $sqlProductDetail = "INSERT INTO product_detail (product_id,size,color,count)"."VALUES ('$productId','$size','$color','$countDetail')";
            $temp2 = $this->con->prepare($sqlProductDetail);
            $temp2->execute();
        }

    }

    function deleteProduct($data){
        try{
            $sql = "DELETE  FROM products WHERE product_id=:product_id";

            $temp=$this->con->prepare($sql);
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