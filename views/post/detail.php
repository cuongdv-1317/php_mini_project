<?php
require_once('views/header.php');
// require_once('helpers/SessionHelper.php');
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h2 class="text-center">Chi tiết bài viết</h2>
      <p>ID: <?php echo $data['id'] ?></p>
      <p>User id: <?php echo $data['user_id'] ?></p>
      <p>Content: <?php echo $data['content'] ?></p>
      <p>Created at: <?php echo $data['created_at'] ?></p>
      <p>Updated at: <?php echo $data['updated_at'] ?></p>
    </div>
  </div>

</div>
</body>
</html>
