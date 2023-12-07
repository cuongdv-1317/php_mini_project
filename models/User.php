<?php
session_start();
require_once('helpers/Validate.php');
require_once('db_connect.php');
class User
{
  private $validate;

  function __construct() {
    $this->validate = new Validate();
  }

  function insert($data) {
    global $conn;
    $errors = $this->validate->validateSignUp($data);
    if (!empty($errors)) {
      $_SESSION['msg_failed'] = $errors;
      return false;
    } else {
      $length = 10;
      $random_string = '';
      do {
        $random_string = base64_encode(uniqid() . bin2hex(random_bytes($length)));
      } while (!empty($this->findByRememberCode($random_string)));
      $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (name, email, password, remember_code) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $data['name'], $data['email'], $hashed_password, $random_string);
      $result = $stmt->execute();
      $stmt->close();
      return $result;
    }
  }

  function findByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
  }

  function findById($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
  }

  function findByRememberCode($remember_code) {
    global $conn;
    $sql = "SELECT * FROM users WHERE remember_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $remember_code);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
  }
}
