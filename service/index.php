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
	require_once("Controllers/token.php");
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
	$app->get("/logout",function($request,$response,$args)
	{
		$con=new Logout_Controller();
		echo $con->Logout();
	});
	$app->get("/carts/get",function($request,$response,$args)
	{

		if($_SESSION["login"]==1)
		{
			$user_id=1;
			$con=new Cart_Controller();
			echo json_encode($con->getCartByUserId($user_id));
		}
		else
		{
			echo "Phải đăng nhập";
		}
		
	});
	$app->post("/carts/add",function($request,$response,$args)//sửa lại
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();
		
		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$input=$request->getParsedBody();
			$data= array(
			"product_detail_id"=>$input["product_detail_id"],
			"user_id"=>'1'
			); 
			$con=new Cart_Controller();
			echo $con->addOneProductToCart($data);
		}
		else
		{
			echo "Không được phép !!!";
		}
		
		
	});
	$app->get("/carts/delete/{product_detail_id}",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();

		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$product_detail_id=$args["id"];
      	
			$data=array(
			"user_id"=>'1',
			"product_detail_id"=>$product_detail_id
			);
			$con=new Cart_Controller();
			echo $con->deleteOrder($data);
		}
		else
		{
			echo "Không được phép !!!";
		}
  
	});
	$app->get("/comments/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];
		$con=new Comment_Controller();
		echo $con->getCommentsByProductID($id);
	});
	$app->post("/comments/add",function($request,$response,$args)
	{
		if($_SESSION["login"]==1)
		{
			$input=$request->getParsedBody();
			$data=array(
			"product_detail_id"=>$input["product_detail_id"],
			"user_id"=>$input["user_id"],
			"content"=>$input["content"]
			);

			$con=new Comment_Controller();
			echo $con->addComment($data);
		}
		else
		{
			echo "Phải đăng nhập";
		}
		
	});
	$app->get("/orders/get",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();
		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$con=new Order_Controller();
			echo $con->getAllOrder();
		}
		else
		{
			echo "Không được phép !!!";
		}	
		
	});
	$app->get("/orders/get/{id}",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();

		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$id=$args["id"];
			$con=new Order_Controller();
			echo $con->getOrderById($id);
		}
		else
		{
			echo "Không được phép !!!";
		}	
		
	});
	$app->post("/orders/add",function($request,$response,$args)
	{
		if($_SESSION["login"]==1)
		{
			$input=$request->getParsedBody();
			$data=array(
			"user_id"=>'1',
			"total_money"=>$input["total_money"],
			"name"=>$input["name"],
			"address"=>$input["address"],
			"phone"=>$input["phone"],
			"email"=>$input["email"],

			);
			$con=new Order_Controller();
			echo $con->addOrder($data);
		}
		else
		{
			echo "Không được phép !!!";
		}	

		
	});
	$app->get("/orders/delete/{id}",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();

		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$id=$args["id"];
			$con=new Order_Controller();
			echo $con->deleteOrder($id);
		}
		else
		{
			echo "Không được phép !!!";
		}	
		
	});
	$app->get("/products/get",function($request,$response,$args)
	{
		$con=new Product_Controller();
		echo json_encode($con->getAllProduct());
	});
	$app->get("/products/get/{id}",function($request,$response,$args)
	{
		$id=$args["id"];

		$con=new Product_Controller();
		echo json_encode($con->getProductById($id));
	});
	$app->post("/products/add",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();

		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$input=$request->getParsedBody();
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
			echo "Không được phép !!!";
		}	

		
	});
	$app->get("/products/delete/{id}",function($request,$response,$args)
	{
		$header=$request->getHeaderLine("Authorization");
		$arr=Token_Controller::verifyJWT($header);
		$login=new Login_Controller();
		if($_SESSION["login"]==1 && $_SESSION["admin"]==1 && $login->compareUser($arr))
		{
			$id=$args["id"];
			$con=new Product_Controller();
			echo $con->deleteProduct($id);

		}
		else
		{
			echo "Không được phép !!!";
		}	

		
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