<?php
require("../head.php");
output("登録フォーム");
?>
<form action="register.php" method="post">
<input type="hidden" name= "mode" value="email_regist" />

<div class="container">
  <h2>登録</h2>
  <hr>
  <div class="form-froup">
    <label>ID</label></br>
    <input required type="text" name="id" maxlength="100" class="form-control"></br>
  </div>

  <div class="form-froup">
    <label>password</label></br>
    <input required type="password" name="password" maxlength="100" class="form-control"></br>
  </div>
    <input class="btn btn-primary" type="submit" name="login" value="新規登録">
</div>
