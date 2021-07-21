<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  require_once "../../config/Database.php";
  require_once "../../models/Users.php";

  // Creating PDO connection to Database
  $database = new Database();
  $connection = $database->connect();

  // Register user using 'users' model
  $user = new Users($connection);
  if ($user->register($_POST)) {
    echo json_encode(array("Success" => "User created successfully"));
  } else {
    echo json_encode(array("Failure" => "User could not be created"));
  }
} else {
  http_response_code(400);
  echo json_encode(array("Error" => "Bad request"));
}
?>