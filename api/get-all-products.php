<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

$crud = new Crud(); 

if($_SERVER["REQUEST_METHOD"] == "GET")
{
$sql = "select * from recipe";

$res = $crud->read($sql);

$count = mysqli_num_rows($res);


if($res->num_rows > 0)
{
         $recipes = [];
         while($row = $res->fetch_assoc()) {
             $recipes[] = $row;
         }
   
		$result = array("status" => true , "products" => $recipes); 

}
else
{
	$result = array("status" => false , "message" => 'No Post(s) found...'); 
}

echo json_encode($result);
}
else
{
	 $error = array("status" => 405 , "message" => 'Method not allowed...');
	 
echo json_encode($error);
}