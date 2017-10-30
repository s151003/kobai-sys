<?php
session_start();
//bootstrapを読み込みヘッダーを生成する
function output($title){
    // DocumentRoot でなくても通るように kobai ディレクトリの場所を確定
    $uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);
    echo <<<EOM
      <!DOCTYPE html>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <html lang = "ja">
      <head>
        <title> $title </title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap.min.js"></script>
        <!-- bootstrap読み込みここまで -->
        <!-- Include Date Range Picker -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ja.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" />

      </head>
    <body>
      <!-- ナビゲーションバーここから -->
      <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="container">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
            <span class="glyphicon glyphicon-triangle-bottom"></span>
          </button>
EOM;
    echo "<a class=\"navbar-brand\" href=\"" . $uri_root . "\">購買予約システム</a>";

    echo <<<EOM
          </div>
          <div class="collapse navbar-collapse" id="Navbar">
          <ul class="nav navbar-nav">
            <li class="active">
EOM;
          if (isset($_SESSION['sid'])){
            echo "<li><a href=\"" . $uri_root . "mypage/mypage.php\">マイページ</a></li>";
            echo "<li><a href=\"" . $uri_root . "mypage/history.php\">予約履歴</a></li>";

          }else {
            echo "<li><a href=\"" . $uri_root . "mypage/login.php\">ログイン</a></li>";
            echo "<li><a href=\"" . $uri_root . "mypage/regist_form.php\">新規登録</a></li>";

          }
          echo "<li><a href=\"" . $uri_root . "console\">管理画面</a></li>";

          echo <<<EOM
          </ul>
          <ul class="nav navbar-nav navbar-right">
EOM;
          //どのページからも見られるのでフルパス
          if (isset($_SESSION['sid'])){
            echo "<a href=\"" . $uri_root . "mypage/mypage.php\"><p class=\"navbar-text\">ようこそ！".$_SESSION['sid']."さん</a> ";
            echo "<a class=\"btn btn-default navbar-btn\" href=\"" . $uri_root . "mypage/cart.php\"><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> カート</a> ";
            echo "<a class=\"btn btn-danger navbar-btn btn-sm\" href=\"" . $uri_root . "mypage/login.php?err=logout\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> ログアウト</a>";
          }else {
            echo "<li><a href=\"" . $uri_root . "mypage/regist_form.php\"><span class=\"glyphicon glyphicon-user\"></span> 登録</a></li>";
            echo "<li><a href=\"" . $uri_root . "mypage/login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> ログイン</a></li>";
          }
          echo <<<EOM
          </ul>
        </div>
        </div>
      </nav>
      <!-- ナビゲーションバーここまで -->

EOM;
}

//DataTabelsを使いたいときにテーブルの名前を入れて呼び出す
function DataTable($name){
    echo <<<EOM
    <script>  $(document).ready(function() {
      $.extend( $.fn.dataTable.defaults, {
        language: {
            url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
          }
        });
        $('#$name').DataTable({
          responsive: true
        } );
    } );
  </script>
EOM;
}

function LoginVerify($session){
  // DocumentRoot でなくても通るように kobai ディレクトリの場所を確定
  $uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);
  if(!isset($session)){
    header("location: " . $uri_root . "mypage/login.php?err=login");
    exit();
  }
}

function AdminVerify($id){
  require_once("../connect_db.php");
  // DocumentRoot でなくても通るように kobai ディレクトリの場所を確定
  $uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);
  $query = "SELECT admin FROM member WHERE user_id = '$id'";
  $result = mysqli_query($link,$query);
  $row = mysqli_fetch_array($result);
  if($row['admin'] == 0){
      header("location: " . $uri_root . "mypage/login.php?err=you_dont_have_permission");
      exit();
  }
}

function ConsoleMenu(){
echo <<<EOM
<div class="col-sm-2">
  <div class="list-group">
    <a href="menu_add.php" class="list-group-item">メニュー追加</a>
    <a href="menu_change.php" class="list-group-item">メニュー管理</a>
    <a href="category_manage.php" class="list-group-item">カテゴリー管理</a>
    <a href="yoyaku_list.php" class="list-group-item">予約一覧</a>
    <a href="user_list.php" class="list-group-item">ユーザーリスト</a>
  </div>
</div>
EOM;
}
