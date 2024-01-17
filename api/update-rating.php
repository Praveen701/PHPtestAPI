<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json"); 

$crud = new Crud();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

$data = json_decode(file_get_contents("php://input"), true);
$rating = $data["rating"]; 


$sql = "update recipe set rating = '$rating' where id=".$_GET['id'];
$res = $crud->update($sql);


if ($res)
{
	$result = array("status" => true , "message" => "Product Rating Updated Succefully...");
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