<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html lang = "ja">
<head>
  <title>ログイン</title>
  <!-- bootstrap読み込み -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- bootstrap読み込みここまで -->
</head>
<body>

<!-- ナビゲーションバーここから -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand">購買予約システム</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active">
      <li><a href="/kobai-sys/mypage/login.php">ログイン</a></li>
      <li><a href="/kobai-sys/mypage/regist_form.php">新規登録</a></li>
      <li><a href="/kobai-sys/console">管理画面</a></li>
    </ul>
    <button type="button" class="btn btn-default navbar-btn">
      <span class="glyphicon glyphicon-envelope"></span>
    </button>
  </div>
</nav>
<!-- ナビゲーションバーここまで -->
  <div class="container">
    <h2>ログイン</h2>
    <hr>
<form action="auth.php" method="POST">

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
