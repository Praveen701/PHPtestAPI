<?php
include("../includes/connection.php");
include '../vendor/autoload.php';

use Firebase\JWT\JWT;

class Crud extends Connection
{

  private static $key = "your_secret_key"; 
    private static $tokenExpireTime = 3600; 

  public function __construct()
 {
	  parent::__construct();
 }


 public function generateToken($random)
 {
     $issuedAt = time();
     $expirationTime = $issuedAt + self::$tokenExpireTime;

     $token = [
         "iss" => "your_issuer",
         "aud" => "your_audience", 
         "iat" => $issuedAt,
         "exp" => $expirationTime,
         "data" => [
             "userId" => $random,
         ],
     ];

     $jwt = JWT::encode($token, self::$key, 'HS256');

     return $jwt;
 }

 function authenticate_user($username, $password) {
  global $conn;
  
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
      return true;
  } else {
      return false;
  }
}
 

 public function create($data)
{
  if($this->authenticate_user())
  {
    $insert = $this->con->query($data) or die();

    if($insert)
    {
      return $insert;
    }
    else 
    {
      echo "Query failed...";
    }
  }
  else{
    echo "First Login or Register ot create a product.";
  }

}

public function create_user($data)
{
  $insert = $this->con->query($data) or die();

  if($insert)
  {
    return $insert;
  }
  else 
  {
    echo "Query failed...";
  }
}
 
 public function read($data)
{
  $view = $this->con->query($data) or die();

  if ($view->num_rows > 0)
  {
    return $view;
  }
  else
  {
	 return $view;
  }
}

public function update($data)
{
  $update = $this->con->query($data) or die();

  if($update)
  {
   return $update;
  }
  else 
  {
    echo "Query failed...";
  }
}

public function deletes($data)
{
  $delete = $this->con->query($data) or die();

  if($delete)
  {
    return $delete;
  }
  else
  {
    echo "Query failed...";
  }
}
}
?>