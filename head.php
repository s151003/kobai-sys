<?php

//bootstrapを読み込みヘッダーを生成する
function output($title){
      session_start();


      echo <<<EOM
      <!DOCTYPE html>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <html lang = "ja">
      <head>
        <title> $title </title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

        <!-- bootstrap読み込みここまで -->
      </head>
    <body>
      <!-- ナビゲーションバーここから -->
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="/kobai-sys">購買予約システム</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active">
            <li><a href="/kobai-sys/mypage/login.php">ログイン</a></li>
            <li><a href="/kobai-sys/mypage/regist_form.php">新規登録</a></li>
            <li><a href="/kobai-sys/console">管理画面</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
EOM;
          //どのページからも見られるのでフルパス
          if (isset($_SESSION['sid'])){
            echo "<button type=\"button\" class=\"btn btn-default navbar-btn\"><a href=\"/kobai-sys/mypage/history.php\">あなたの予約履歴</a></button>";
            echo "<a href=\"/kobai-sys/mypage/mypage.php\"><p class=\"navbar-text\">ようこそ！".$_SESSION['sid']."さん</p></a>";
          }else {
            echo "<li><a href=\"/kobai-sys/mypage/regist_form.php\"><span class=\"glyphicon glyphicon-user\"></span> 登録</a></li>";
            echo "<li><a href=\"/kobai-sys/mypage/login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> ログイン</a></li>";
          }
echo <<<EOM
          </ul>
        </div>
      </nav>
      <!-- ナビゲーションバーここまで -->
EOM;
}

  function DataTable($name){
    echo <<<EOM
    <script>  $(document).ready(function() {
      $.extend( $.fn.dataTable.defaults, {
        language: {
            url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
          }
        });
        $('#$name').DataTable();
    } );
  </script>
EOM;
}
