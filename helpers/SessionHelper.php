<?php
session_start();
require_once('models/User.php');
function login($user_id) {
  $_SESSION['user_id'] = $user_id;
}

function logout() {
  unset($_SESSION['user_id']);
}

function isLogin() {
  if (isset($_SESSION['user_id'])) {
    return true;
  }
  if (isset($_COOKIE['remember_code'])) {
    $user = new User();
    $data = $user->findByRememberCode(base64_encode($_COOKIE['remember_code']));
    if (!empty($data)) {
      login($data['id']);
      return true;
    }
  }
  return false;
}

function currentUser() {
  if (isLogin()) {
    return $_SESSION['user_id'];
  }
}

function correctUser($id) {
  if (isLogin()) {
    return $id == $_SESSION['user_id'];
  }
  return false;
}

function remember($id) {
  $user = new User();
  $data = $user->findById($id);
  setcookie("remember_code", base64_decode($data['remember_code']), time() + 3600);
}

function forget() {
  $user = new User();
  setcookie("remember_code", '', time() - 1);
}
