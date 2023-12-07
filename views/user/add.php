<?php
require_once('views/header.php')
?>
<div class="container">
  <h3 class="text-center">Đăng ký</h3>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <?php
      if (isset($_SESSION['msg_failed'])) {
      ?>
      <div class="alert alert-danger">
        <strong>Error!</strong>
        <br>
        <?php
          // $json_encoded = $_COOKIE['signup_errors'];
          // $errors = json_decode($json_encoded, true);
          foreach ($_SESSION['msg_failed'] as $error) {
            echo $error . '<br>';
          }
          unset($_SESSION['msg_failed']);
        ?>
      </div>
      <?php
      }
      ?>
      <hr>
      <form action="?mod=user&act=store" method="POST">
        <div class="form-group">
          <label for="">Họ tên</label>
          <input type="text" class="form-control" id="" placeholder="Họ tên" name="name">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="" placeholder="Email" name="email">
        </div>
        <div class="form-group">
          <label for="">Mật khẩu</label>
          <input type="password" class="form-control" id="" placeholder="Mật khẩu" name="password">
        </div>
        <div class="form-group">
          <label for="">Nhập lại mật khẩu</label>
          <input type="password" class="form-control" id="" placeholder="Nhập lại mật khẩu" name="password_confirm">
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
      </form>
      <p>
        Bạn đã có tài khoản?
        <a href="index.php?mod=session&act=add">Đăng nhập</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
