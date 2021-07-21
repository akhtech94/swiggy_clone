<?php
class Database {
  // Parameters to connect to the database
  private $host = "localhost";
  private $dbName = "swiggy_clone_db";
  private $userName = "swiggy_clone_user";
  private $password = "swiggy_clone_1234";
  private $conn;

  // Method to connect to the database
  public function connect() {
    // Data Source Name
    $dsn = "mysql:host=$this->host;dbname=$this->dbName";

    // Connect to the database
    try {
      $this->conn = new PDO($dsn, $this->userName, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->conn;
    } catch (PDOException $e) {
      echo "Connection error: ".$e->getMessage();
    }
  }
}
?>