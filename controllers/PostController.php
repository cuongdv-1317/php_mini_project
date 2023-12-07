<?php
require_once('models/Post.php');
require_once('helpers/SessionHelper.php');
class PostController
{
  private $model;

  function __construct() {
    $this->model = new Post();
  }

  function list() {
    $user_id = $_GET['user_id'];
    if (correctUser($user_id)) {
      $user_id = $_GET['user_id'];
      $data = $this->model->findByUserId($user_id);
      require_once('views/post/list.php');
    } else {
      require_once('views/errorPage.php');
    }
  }

  function detail() {
    $id = $_GET['id'];
    $user_id = $_GET['user_id'];
    $data = $this->model->findById($id);
    if (correctUser($user_id) && $user_id == $data['user_id']) {
      require_once('views/post/detail.php');
    } else {
      require_once('views/errorPage.php');
    }
  }

  function add() {
    $user_id = $_GET['user_id'];
    require_once('views/post/add.php');
  }

  function store() {
    $user_id = $_GET['user_id'];
    if (correctUser($user_id)) {
      $data = $_POST;
      $data['user_id'] = $user_id;
      $data['content'] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
      $status = $this->model->insert($data);
      if ($status) {
        $_SESSION['msg'] = 'Thêm mới thành công.';
        header("location: index.php?mod=post&act=list&user_id=" . $user_id);
      } else {
        $_SESSION['msg_failed'] = 'Thêm mới thất bại.';
        header('location: index.php?mod=post&act=add&user_id=' . $user_id);
      }
    } else {
      require_once('views/errorPage.php');
    }
  }

  function edit() {
    $id = $_GET['id'];
    $user_id = $_GET['user_id'];
    $data = $this->model->findById($id);
    if (correctUser($user_id) && $user_id == $data['user_id']) {
      require_once('views/post/edit.php');
    } else {
      require_once('views/errorPage.php');
    }
  }

  function update() {
    $user_id = $_GET['user_id'];
    $id = $_GET['id'];
    $data_post = $this->model->findById($id);
    if (correctUser($user_id) && $user_id == $data_post['user_id']) {
      $data = $_POST;
      $data['id'] = $id;
      $data['content'] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
      $status = $this->model->update($data);
      if ($status) {
        $_SESSION['msg'] = 'Sửa thành công.';
        header("location: index.php?mod=post&act=list&user_id=" . currentUser());
      } else {
        $_SESSION['msg_failed'] = 'Sửa thất bại.';
        header('location: index.php?mod=post&act=edit&user_id=' . $user_id . '&id=' . $id);
      }
    } else {
      require_once('views/errorPage.php');
    }
  }

  function delete() {
    $id = $_GET['id'];
    $user_id = $_GET['user_id'];
    $data_post = $this->model->findById($id);
    if (correctUser($user_id) && $user_id == $data_post['user_id']) {
      $status = $this->model->delete($id);
      if ($status) {
        $_SESSION['msg'] = 'Xóa thành công.';
      } else {
        $_SESSION['msg_failed'] = 'Xóa thất bại.';
      }
      header("location: index.php?mod=post&act=list&user_id=" . currentUser());
    } else {
      require_once('views/errorPage.php');
    }
  }
}
