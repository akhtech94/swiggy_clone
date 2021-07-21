<?php
class Users {
  // Database connection object
  private $conn;

  public function __construct($connection) {
    // Assign connection object recieved through parameter to private variable conn
    $this->conn = $connection;
  }

  public function register($data) {
    // Collect all the data received from the form
    $firstName    = trim(htmlspecialchars(strip_tags($data['firstName'])));
    $lastName     = trim(htmlspecialchars(strip_tags($data['lastName'])));
    $email        = trim(htmlspecialchars(strip_tags($data['email'])));
    $phoneNumber  = trim(htmlspecialchars(strip_tags($data['phoneNumber'])));
    $password     = (password_hash(htmlspecialchars(trim($data['password'])), PASSWORD_DEFAULT));

    // Make query to retreive email and phone number
    $queryToRetreive = "SELECT email, phone_number
    FROM users
    WHERE email = :email OR phone_number = :phoneNumber";

    // Prepare queryToRetreive to be executed
    $stmt = $this->conn->prepare($queryToRetreive);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phoneNumber);

    // Execute and check if email or phonenumber already exists
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return false;
    }

    // Make the SQL query for insertion
    $queryToInsert = "INSERT INTO users (first_name, last_name, email, phone_number, password)
    VALUES (:firstName, :lastName, :email, :phoneNumber, :password)";

    // Prepare queryToInsert to be executed
    $stmt = $this->conn->prepare($queryToInsert);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':password', $password);

    // Execute the query and return
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
?>
