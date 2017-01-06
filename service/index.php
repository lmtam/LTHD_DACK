<?php
	require_once("Libraries/SlimFramework/vendor/autoload.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	require_once("Controllers/cart.php");
	$app=new \Slim\App();

	

	$app->post("/login",function($request,$response,$args)
	{
		$con=new Login_Controller();
		$input=$request->getParsedBody();
		$data=array(
			"username"=>$input["username"],
			"password"=>$input["password"]
		);
		echo $con->Login($data);
	});
	$app->get("/logout",function($request,$response,$args)
	{
		$con=new Logout_Controller();
		echo $con->Logout();
	});
	$app->get("/carts/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Cart_Controller();
		echo $con->getCartByUserId($id);
	});
	$app->post("/carts/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data= array(
			"product_detail_id"=>$input["product_detail_id"],
			"user_id"=>$input["user_id"]
			); 
		$con=new Cart_Controller();
		echo $con->addOneProductToCart($data);
	});
	$app->get("/carts/delete/{user_id}/{product_id}",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"user_id"=>$input["user_id"],
			"product_id"=>$input["product_id"]
			);
		$con=new Cart_Controller();
		echo $con->deleteOrder($data);
	});
	$app->get("/comments/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Comment_Controller();
		echo $con->getCommentsByProductID($id);
	});
	$app->post("/comments/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"product_detail_id"=>$input["product_detail_id"],
			"user_id"=>$input["user_id"],
			"content"=>$input["content"]
			);
		$con=new Comment_Controller();
		echo $con->addComment($data);
	});
	$app->get("/orders/get",function($request,$response,$args)
	{
		$con=new Order_Controller();
		echo $con->getAllOrder();
	});
	$app->get("/orders/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Order_Controller();
		echo $con->getOrderById($id);
	});
	$app->post("/orders/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"user_id"=>$input["user_id"],
			"total_money"=>$input["total_money"],
			"name"=>$input["name"],
			"address"=>$input["address"],
			"phone"=>$input["phone"],
			"email"=>$input["email"]
			);
		$con-new Order_Controller();
		echo $con->addOrder($data);
	});
	$app->get("/orders/delete/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Order_Controller();
		echo $con->deleteOrder($id);
	});
	$app->get("/products/get",function($request,$response,$args)
	{
		$con=new Product_Controller();
		echo $con->getAllProduct();
	});
	$app->get("/products/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Product_Controller();
		echo $con->getProductById($id);
	});
	$app->post("/products/add",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"name"=>$input["name"],
			"description"=>$input["description"],
			"type"=>$input["type"],
			"price"=>$input["price"],
			"image_name"=>$input["image_name"],
			"count"=>$input["count"]
			);
		$con=new Product_Controller();
		echo $con->addProduct($data);

	});
	$app->get("/products/delete/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Product_Controller();
		echo $con->deleteProduct($id);
	});
	$app->post("/register",function($request,$response,$args)
	{
		$input=$request->getParsedBody();
		$data=array(
			"username"=>$input["username"],
			"password"=>$input["password"]
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