<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");
header("Content-Type: application/x-www-form-urlencoded");
$crud = new Crud();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['password']) && isset($data['username'])) {
  
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $jwt_token = $crud->generateToken(rand(10, 99));
        $conn = new mysqli('localhost', 'root', '', 'recipes');
        $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($userId, $hashedPassword);

        if ($stmt->fetch() && password_verify($password, $hashedPassword)) {

            echo json_encode(['message' => 'Login successful', 'token' => $jwt_token]);
        } else {

            echo json_encode(['error' => 'Login failed']);
        }

     

        $stmt->close();
        $conn->close();

      
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
