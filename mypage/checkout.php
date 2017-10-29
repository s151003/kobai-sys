<?php
require("../connect_db.php");
require("../head.php");
output("予約確定ページ");
LoginVerify($_SESSION['sid']);
$uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);

$userid = $_SESSION['sid'];
$query = "SELECT id FROM member WHERE user_id = '$userid'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$id = $row['id'];

echo <<<EOM
  <div class="container">
  <div class="row">
  <div class="panel panel-success">
  <div class="panel-heading">
     <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> 予約完了！
  </div>
  <div class="panel-body">
EOM;

if(isset($_SESSION['cart'][$userid])){
  $total_sum = 0;
  foreach($_SESSION['cart'][$userid] as $key => $value){
    //予約データインサート
    $datetime = date("Y-m-d H:i:s");
    $query = "INSERT INTO yoyaku (user_id, product, quantity, date) VALUES ('$id', '$value[0]', '$value[1]','$datetime')";
    $result = mysqli_query($link,$query);

    //結果表示
    $query = "SELECT name,value FROM products WHERE id = '$value[0]'";
    $result = mysqli_query($link,$query);
    $product = mysqli_fetch_array($result);
    $sum = $product['value'] * $value[1];
    echo $product['name'].$value[1] ."個 ". $sum ."円<br>";
    $total_sum = $total_sum + $sum;
  };
}else{
    header(" Location: " . $uri_root . "mypage/cart.php");
}

  unset($_SESSION['cart']);
  echo <<<EOM
    <b>計<b>{$total_sum}円</b> 予約が完了しました。<br>
	</div>
</div>
</div>
</div>
EOM;
