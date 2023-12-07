<?php
require_once('views/header.php');
require_once('helpers/SessionHelper.php');
?>
<div class="container">
  <h1>POSTS</h1>
  <hr>
  <a href="?mod=post&act=add&user_id=<?php echo $user_id; ?>" class="btn btn-primary">Add new post</a>
  <?php
    if (isset($_SESSION['msg'])) {
  ?>
      <div class="alert alert-success">
        <strong>Success!</strong> <?php echo $_SESSION['msg']; ?>
      </div>
  <?php
      unset($_SESSION['msg']);
    } elseif (isset($_SESSION['msg_failed'])) {
  ?>
      <div class="alert alert-danger">
        <strong>Danger!</strong> <?php echo $_SESSION['msg_failed']; ?>
      </div>
  <?php
      unset($_SESSION['msg_failed']);
    }
  ?>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tablenv" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Post id</th>
            <th>Content</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th style="text-align: center;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!$data) {
          ?>
              <tr>
                <td colspan="5" class="text-center">No data available in table</td>
              </tr>
          <?php
            } else {
              foreach ($data as $row) {
          ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td class="text-truncate" style="max-width: 386px"><?php echo $row['content']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>
                  <td><?php echo $row['updated_at']; ?></td>
                  <td  style="text-align: center;">
                    <a href="?mod=post&act=detail&user_id=<?php echo $row['user_id']; ?>&id=<?php echo $row['id']?>" class="btn btn-success">Detail</a>
                    <a href="?mod=post&act=edit&user_id=<?php echo $row['user_id']; ?>&id=<?php echo $row['id']?>" class="btn btn-warning">Update</a>
                    <a href="#" class="btn btn-danger delete" onclick="confirm_delete(event, <?php echo $row['id'] ?>, <?php echo $row['user_id'] ?>)">Delete</a>
                  </td>
                </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  function confirm_delete(e, id, user_id) {
    e.preventDefault();

    var result = confirm("Bạn có chắc chắn muốn xóa không?");
    if (result) {
      window.location.href = `?mod=post&act=delete&user_id=${user_id}&id=${id}`;
    }
  }
</script>

</body>
</html>
