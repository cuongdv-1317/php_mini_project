<?php
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'session';
$act = isset($_GET['act']) ? $_GET['act'] : 'add';

switch ($mod) {
  case 'user':
  require_once('controllers/UserController.php');
  $user_controller = new UserController();
  switch ($act) {
    case 'add':
    $user_controller->add();
    break;
    case 'store':
    $user_controller->store();
    break;
    case 'index':
    $id = $_GET['id'];
    $user_controller->index();
    break;
  }
  break;

  case 'session':
  require_once('controllers/SessionController.php');
  $session_controller = new SessionController();
  switch ($act) {
    case 'add':
    $session_controller->add();
    break;
    case 'create':
    $session_controller->create();
    break;
    case 'destroy':
    $session_controller->destroy();
    break;
  }
  break;

  case 'post':
  require_once('controllers/PostController.php');
  $post_controller = new PostController();
  switch ($act) {
    case 'list':
    $post_controller->list();
    break;
    case 'detail':
    $post_controller->detail();
    break;
    case 'add':
    $post_controller->add();
    break;
    case 'store':
    $post_controller->store();
    break;
    case 'edit':
    $post_controller->edit();
    break;
    case 'update':
    $post_controller->update();
    break;
    case 'delete':
    $post_controller->delete();
    break;
  }
  break;
}
