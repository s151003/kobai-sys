<?php

//bootstrapを読み込みヘッダーを生成する
function output($title){
      echo <<<EOM
      <!DOCTYPE html>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <html lang = "ja">
      <head>
        <title> $title </title>
        <!-- bootstrap読み込み -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
EOM;
  }
