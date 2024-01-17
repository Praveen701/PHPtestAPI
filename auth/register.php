<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");
header("Content-Type: application/x-www-form-urlencoded");

$crud = new Crud();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['username']) && isset($data['password']) && isset($data['email'])) {

        $username = $data['username'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

     
            $jwt_token = $crud->generateToken(rand(10, 99));

            $sql = "INSERT INTO users (username, password, email, token) VALUES ('$username', '$password', '$email' , '$jwt_token')";

            $res = $crud->create_user($sql); 
            $_SESSION["loggedin"] = true;

           echo json_encode(["message" => "User registered successfully", "token" => $jwt_token]);
      
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Invalid registration data"]);
    }
}
else
{
	 $error = array("status" => 405 , "message" => 'Method not allowed...');
	 
echo json_encode($error);
} 
