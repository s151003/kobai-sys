<?php
  require("../head.php");
  AdminVerify($_SESSION['sid']);
  output("管理ページ");
?>
    <div class = "container">
    <h1>管理ページ</h1><hr>
    	<div class="row">
        <?php ConsoleMenu(); ?>
  </div>
