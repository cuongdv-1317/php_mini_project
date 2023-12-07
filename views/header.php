<?php
require_once('helpers/SessionHelper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="public/css/custom.css">
  <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Sample App</a>
    <?php
    if (!isLogin()) {
    ?>
    <ul class="navbar-nav ml-auto mr-0 navbar__nav">
      <li class="nav-item header__item">
        <a class="nav-link text-center" href="index.php?mod=session&act=add">Log in</a>
      </li>
      <li class="nav-item header__item">
        <a class="nav-link text-center" href="index.php?mod=user&act=add">Sign up</a>
      </li>
    </ul>
    <?php
    } else {
    ?>
    <ul class="navbar-nav ml-auto mr-0 navbar__nav">
      <li class="nav-item header__item">
        <?php
        echo "<a class='nav-link text-center' href='index.php?mod=user&act=index&id=" . $_SESSION['user_id'] . "'>Account</a>";
        ?>
      </li>
      <li class="nav-item header__item">
        <?php
        echo "<a class='nav-link text-center' href='index.php?mod=post&act=list&user_id=" . $_SESSION['user_id'] . "'>Post</a>";
        // echo "<a class='nav-link text-center' href='index.php?mod=post&act=list>Post</a>";
        ?>
      </li>
      <li class="nav-item header__item">
        <a class="nav-link text-center" href="index.php?mod=session&act=destroy">Logout</a>
      </li>
    </ul>
    <?php
    }
    ?>
  </nav>
