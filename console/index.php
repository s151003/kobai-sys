<?php
  require("../head.php");
  AdminVerify($_SESSION['sid']);
  output("管理ページ");
?>
    <div class = "container">
    <h1>管理ページ</h1><hr>
    	<div class="row">
        <div class="col-sm-2">
    <div class="list-group">
      <a href="menu_add.php" class="list-group-item">メニュー追加</a>
      <a href="menu_change.php" class="list-group-item">メニュー管理</a>
      <a href="category_manage.php" class="list-group-item">カテゴリー管理</a>
      <a href="yoyaku_list.php" class="list-group-item">予約一覧</a>
      <a href="recive_check.php" class="list-group-item">受取確認</a>
    </div>
      </div>
  </div>
