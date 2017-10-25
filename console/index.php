<?php
  require("../head.php");
  AdminVerify($_SESSION['sid']);
  output("メニュー管理ページ");
?>
    <div class = "container">
    <h1>メニュー管理ページ</h1><hr>

    <a class="btn btn-primary" href="menu_add.php">メニュー追加</a></br></br>
    <a class="btn btn-primary" href="menu_change.php">メニュー管理</a></br></br>
    <a class="btn btn-primary" href="category_manage.php">カテゴリー管理</a>
    <a class="btn btn-primary" href="yoyaku_list.php">yoyakulist</a>
    <a class="btn btn-primary" href="recive_check.php">yoyakulist</a>
