<?php
require_once('views/header.php');
require_once('helpers/SessionHelper.php');
?>
<div class="container">
  <h4 class="text-center">
    <?php
      echo "Name: " . $data['name'] . '<br>';
      echo "Email: " . $data['email'] . '<br>';
      echo "Created at: " . $data['created_at']
    ?>
  </h4>
</div>
</body>
</html>
