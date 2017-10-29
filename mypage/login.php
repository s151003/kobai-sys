<?php
require("../head.php");
// 先に$_GET['err']を判定して$_SESSION['sid']をクリアしておかないと
// 右上のアイコンが「ようこそ○さん」のままになる。
if (isset($_GET['err']) && $_GET['err'] == "logout"){
    session_unset($_SESSION['sid']);
}

output("ログイン");
?>
<div class="container">
<?php
//エラー表示
if (isset($_GET['err'])){
  echo "<div class=\"panel-body\">";
  $err_message = "<div class=\"panel panel-danger\"><div class=\"panel-heading\"> %s </div>";
  switch($_GET['err']){
  case "logout":
      echo sprintf($err_message, "ログアウトしました。 <a href=\"login.php\"> 再ログイン</a>");
      break;
  case "login":
      echo sprintf($err_message,
                   "ログインしていないかセッションの有効期限が切れたため、
                    もう一度ログインしてください。<a href=\"login.php\"> 再ログイン</a>");
      break;
  case "you_dont_have_permission":
      echo sprintf($err_message, "アクセスに必要な権限がありません。");
      break;
  default:
      echo sprintf($err_message, "ログインエラー");
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
