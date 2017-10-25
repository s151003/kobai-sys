<?php
require("../head.php");
output("ログイン");

//エラー表示
if (isset($_GET['err'])){
  echo "<div class=\"panel panel-danger\"><div class=\"panel-heading\">ログインエラー</div>";
  echo "<div class=\"panel-body\">";
  switch($_GET['err']){
    case "logout":
      session_unset($_SESSION['sid']);
      echo "ログアウトしました <a href=\"login.php\"> 再ログイン</a>";
      exit();
    case "login":
      echo "ログインしていないかセッションの有効期限が切れたため、もう一度ログインしてください。";
    case "you_dont_have_permission":
      echo "アクセスに必要な権限がありません";
  }
  echo "</div></div>";
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
