<?php

require_once('models/User.php');
class Validate {
  function validateEmail($email) {
    return strlen($email) <= 255 && filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function validatePassword($password) {
    return strlen($password) >= 6 && strlen($password) <= 100;
  }

  function validateSignUp($data) {
    if (!$this->validateEmail($data['email'])) {
      $errors[] = "Email không đúng định dạng hoặc độ dài hơn 255 ký tự!";
    } else {
      $user = new User();
      $data_user = $user->findByEmail($data['email']);
      if (isset($data_user['email'])) {
        $errors[] = "Email đã tồn tại!";
      }
    }
    if (!$this->validatePassword($data['password'])) {
      $errors[] = "Mật khẩu có độ dài từ 6 - 100 ký tự!";
    }
    if (strcmp($data['password'], $data['password_confirm']) != 0) {
      $errors[] = "Xác nhận mật khẩu không chính xác!";
    }
    return $errors;
  }

  function validateLogin($data) {
    if (!$this->validateEmail($data['email'])) {
      return "Email không đúng định dạng hoặc độ dài hơn 255 ký tự!";
    }
    if (!$this->validatePassword($data['password'])) {
      return "Mật khẩu có độ dài từ 6 - 100 ký tự!";
    }
    $user = new User();
    $data_user = $user->findByEmail($data['email']);
    if (is_null($data_user)) {
      return "Email chưa đăng ký";
    }
    if (!password_verify($data['password'], $data_user['password'])) {
      return "Mật khẩu không chính xác!";
    }
    return;
  }
}
