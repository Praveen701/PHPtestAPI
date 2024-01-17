<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");
header("Content-Type: application/x-www-form-urlencoded");
 
$crud = new Crud();

if($_SERVER["REQUEST_METHOD"] === "POST")
{
$data = json_decode(file_get_contents("php://input"), true);
$name = $data["name"]; 
$prep_time = $data["prep_time"]; 
$difficulty = $data["difficulty"]; 
$vegetarian = $data["vegetarian"];  


$sql = "insert into recipe (name,prep_time,difficulty,vegetarian) values ('$name','$prep_time','$difficulty','$vegetarian')";
$res = $crud->create($sql); 


if ($res)
{
	$result = array("status" => true , "message" => "Product Added Succefully...");
}
else
{
	$result = array("status" => false , "message" => "Something went wrong...");
}

echo json_encode($result);
}
else
{
	 $error = array("status" => 405 , "message" => 'Method not allowed...');
	 
echo json_encode($error);
} 
