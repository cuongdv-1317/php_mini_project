<?php
require_once('views/header.php');
// require_once('helpers/SessionHelper.php');
?>
<div class="container">
  <h1>POSTS</h1>
  <hr>
  <?php
    if (isset($_SESSION['msg_failed'])) {
  ?>
    <div class="alert alert-danger">
      <strong>Danger!</strong> <?php echo $_SESSION['msg_failed']; ?>
    </div>
  <?php
      unset($_SESSION['msg_failed']);
    }
  ?>
  <form action="?mod=post&act=update&user_id=<?php echo $user_id; ?>&id=<?php echo $id; ?>" method="POST">
    <div class="form-group">
      <label for="">Content</label>
      <input type="text" class="form-control" id="" value="<?php echo $data['content']; ?>" name="content">
    </div>
    <button type="submit" class="btn btn-primary w-100">Update</button>
  </form>
</div>
</body>
</html>
