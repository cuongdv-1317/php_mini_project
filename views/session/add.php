<?php
require_once('views/header.php')
?>
<div class="container">
  <h3 class="text-center">Đăng nhập</h3>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <?php
      if (isset($_SESSION['msg_failed'])) {
      ?>
      <div class="alert alert-danger">
        <strong>Error!</strong>
        <br>
        <?php
          echo $_SESSION['msg_failed'];
          unset($_SESSION['msg_failed']);
        ?>
      </div>
      <?php
      }
      ?>
      <hr>
      <form action="?mod=session&act=create" method="POST">
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="" placeholder="Email" name="email">
        </div>
        <div class="form-group">
          <label for="">Mật khẩu</label>
          <input type="password" class="form-control" id="" placeholder="Mật khẩu" name="password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        <div class="form-group">
          <input type="checkbox" id="" name="checkbox">
          <label for="">Remember?</label>
        </div>
      </form>
      <p>
        Bạn chưa có tài khoản?
        <a href="index.php?mod=user&act=add">Đăng ký</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
