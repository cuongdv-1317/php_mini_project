<?php

require_once('models/User.php');
require_once('helpers/SessionHelper.php');
class UserController
{
  private $model;

  function __construct() {
    $this->model = new User();
  }

  function add() {
    require_once('views/user/add.php');
  }

  function store() {
    $data = $_POST;
    $status = $this->model->insert($data);
    if ($status) {
      $data_user = $this->model->findByEmail($data['email']);
      login($data_user['id']);
      header("location: index.php?mod=post&act=list&user_id=" . $data_user['id']);
    } else {
      header("location: index.php?mod=user&act=add");
    }
  }

  function index() {
    $id = $_GET['id'];
    if (correctUser($id)) {
      $data = $this->model->findById($id);
      require_once('views/user/index.php');
    } else {
      require_once('views/errorPage.php');
    }
  }
}
