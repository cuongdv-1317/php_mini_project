<?php

require_once('models/User.php');
require_once('helpers/Validate.php');
require_once('helpers/SessionHelper.php');
class SessionController
{
  private $user_model;
  private $validate;

  function __construct() {
    $this->user_model = new User();
    $this->validate = new Validate();
  }

  function add() {
    if (isLogin()) {
      header("location: index.php?mod=post&act=list&user_id=" . currentUser());
    } else {
      require_once('views/session/add.php');
    }
  }

  function create() {
    $data = $_POST;
    $error = $this->validate->validateLogin($data);
    $data_user = $this->user_model->findByEmail($data['email']);
    if (empty($error)) {
      login($data_user['id']);
      if ($data['checkbox'] == "on") {
        remember($data_user['id']);
      }
      header("location: index.php?mod=post&act=list&user_id=" . $data_user['id']);
    } else {
      $_SESSION['msg_failed'] = $error;
      header('location: index.php?mod=session&act=add');
    }
  }

  function destroy() {
    forget();
    logout();
    header('location: index.php?mod=session&act=add');
  }
}
