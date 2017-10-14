<?php
require("../head.php");
output("ログイン");

if (isset($_SESSION['sid'])){
  header( "Location: ./mypage.php" ) ;
  exit;
}
?>
<div class="container">
<form action="auth.php" method="POST">
  <h2>ログイン</h2>
  <hr>
  <div class="form-froup">
    <label>ID</label></br>
    <input required type="text" name="id" maxlength="100" class="form-control"></br>
  </div>

  <div class="form-froup">
    <label>password</label></br>
    <input required type="password" name="password" maxlength="100" class="form-control"></br>
  </div>
    <input class="btn btn-primary" type="submit" name="login" value="ログイン">
</div>
