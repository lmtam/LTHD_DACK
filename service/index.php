<?php
    session_start();
	require_once("Libraries/SlimFramework/vendor/autoload.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/login.php");
	require_once("Controllers/logout.php");
	require_once("Controllers/order.php");
	require_once("Controllers/register.php");
	require_once("Controllers/product.php");
	require_once("Controllers/comment.php");
	require_once ("Controllers/token.php");
	$app=new \Slim\App();

	

	$app->post("/login",function($request,$response,$args)
	{
		$con=new Login_Controller();
		$input=$request->getParsedBody();
		$data=array(
			"username"=>$input["username"],
			"password"=>$input["password"]
		);

		echo json_encode($con->Login($data));
	});
	$app->post('/login/facebook',function($request,$response,$args){
        $con=new Login_Controller();
        $input=$request->getParsedBody();

        $data=array(
            "username"=>$input["user_name"],
            "name"=>$input["name"]
        );

        echo json_encode($con->LoginFacebook($data));
    });
	$app->post('/login/admin',function($request,$response,$args){
        $con=new Login_Controller();
        $input=$request->getParsedBody();
        $data=array(
            "username"=>$input["username"],
            "password"=>$input["password"]
        );
        echo json_encode($con->LoginAdmin($data));
    });
	$app->get("/users/get",function($request,$response,$args){
        $con = new Login_Controller();
        echo json_encode($con->getUserById($_SESSION['user_id']));
    });
	$app->get("/logout",function($request,$response,$args)
	{
		$con=new Logout_Controller();
		echo json_encode($con->Logout());
	});
	$app->get("/carts/get",function($request,$response,$args)
	{
		$user_id= $_SESSION['user_id'];
		$con=new Cart_Controller();
		echo json_encode($con->getCartByUserId($user_id));
	});
	$app->post("/carts/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data= array(
			"product_detail_id"=>$input["product_detail_id"],
			"user_id"=>$_SESSION['user_id']
			); 
		$con=new Cart_Controller();
		echo $con->addOneProductToCart($data);
	});
	$app->get("/carts/delete/{product_detail_id}",function($request,$response,$args)
	{
        $product_detail_id=$args["product_detail_id"];
		$data=array(
			"user_id"=>$_SESSION['user_id'],
			"product_detail_id"=>$product_detail_id
			);
		$con=new Cart_Controller();
		echo json_encode($con->deleteCarts($data));
	});
	$app->get("/comments/get/{product_detail_id}",function($request,$response,$args)
	{
		$id=$args["product_detail_id"];
		$con=new Comment_Controller();
		echo json_encode($con->getCommentsByProductID($id));
	});
	$app->post("/comments/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"product_id"=>$input["product_id"],
			"user_id"=>$_SESSION['user_id'],
			"content"=>$input["content"]
			);

		$con=new Comment_Controller();
		echo json_encode($con->addComment($data));
	});
	$app->get("/orders/get",function($request,$response,$args)
	{
        $input=$request->getParsedBody();
        $token=$input["auth"];
        if(Token_Controller::verifyJWT($token,"secret"))
        {
            $con=new Order_Controller();
            echo json_encode($con->getAllOrder());
        }
        else
        {
            echo "Error";
        }

	});
	$app->get("/orders/get/{id}",function($request,$response,$args)
	{
        $input=$request->getParsedBody();
        $token=$input["auth"];
        if(Token_Controller::verifyJWT($token,"secret"))
        {
            $id=$args["id"];
            $con=new Order_Controller();
            echo json_encode($con->getOrderById($id));
        }
        else
        {
            echo "Error";
        }

	});
	$app->post("/orders/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"user_id"=>$_SESSION['user_id'],
			"total_money"=>$input["total_money"],
			"name"=>$input["name"],
			"address"=>$input["address"],
			"phone"=>$input["phone"],
			"email"=>$input["email"],

			);
		$con=new Order_Controller();
		echo json_encode($con->addOrder($data));
	});
	$app->get("/orders/delete/{id}",function($request,$response,$args)
	{
        $input=$request->getParsedBody();
        $token=$input["auth"];
        if(Token_Controller::verifyJWT($token,"secret"))
        {
            $id=$args["id"];
            $con=new Order_Controller();
            echo $con->deleteOrder($id);
        }
        else
        {
            echo "Error";
        }

	});
	$app->get("/products/get",function($request,$response,$args)
	{
		$con=new Product_Controller();
		echo json_encode($con->getAllProduct());
	});
	$app->get("/products/getId/{id}",function($request,$response,$args)
	{
		$id=$args["id"];

		$con=new Product_Controller();
		echo json_encode($con->getProductById($id));
	});
    $app->get("/products/getType/{type}",function($request,$response,$args)
    {
        $type=$args["type"];

        $con=new Product_Controller();
        echo json_encode($con->getProductByType($type));
    });
	$app->get("/products/searchName/{name}",function($request,$response,$args){

	    $product_name =$args["name"];

        $con=new Product_Controller();
        echo json_encode($con->getProductByName($product_name));
    });
    $app->get("/products/searchPrice/{price1}/{price2}",function($request,$response,$args){

        $price1 =$args["price1"];
        $price2 =$args["price2"];

        $con=new Product_Controller();
        echo json_encode($con->getProductByPrice($price1,$price2));
    });
	$app->post("/products/add",function($request,$response,$args)
	{

		$input=$request->getParsedBody();
		$token=$input["auth"];
		if(Token_Controller::verifyJWT($token,"secret"))
        {
            $data=array(
                "name"=>$input["name"],
                "description"=>$input["description"],
                "type"=>$input["type"],
                "price"=>$input["price"],
                "image_name"=>$input["image_name"],
                "count"=>$input["count"],
                "product_detail" => $input["product_detail"]
            );

            $con=new Product_Controller();
            echo $con->addProduct($data);
        }
        else
        {
            echo "Error";
        }



	});
	$app->get("/products/delete/{id}",function($request,$response,$args)
	{
        $input=$request->getParsedBody();
        $token=$input["auth"];
        if(Token_Controller::verifyJWT($token,"secret"))
        {
            $id=$args["id"];
            $con=new Product_Controller();
            echo $con->deleteProduct($id);
        }
        else
        {
            echo "Error";
        }

	});
	$app->post("/register",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"username"=>$input["username"],
			"password"=>$input["password"],
            "name"=>$input["name"]
			);

		$con=new Register_Controller();
		echo $con->Register($data);
	});
	$app->get("/",function()
	{
		echo "<center><h1>Welcome to Shoe Shop !!!</h1></center>";
	});


	$app->run();

?>