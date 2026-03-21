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

// カートの中身をDBから取得
$stmt_cart = mysqli_prepare($link, "SELECT id, product_id, quantity FROM cart WHERE user_id = ?");
mysqli_stmt_bind_param($stmt_cart, "i", $id);
mysqli_stmt_execute($stmt_cart);
$result_cart = mysqli_stmt_get_result($stmt_cart);
$cart_items = mysqli_fetch_all($result_cart, MYSQLI_ASSOC);

if(count($cart_items) > 0){
  $total_sum = 0;
  foreach($cart_items as $cart_item){
    //予約データインサート
    $datetime = date("Y-m-d H:i:s");
    $stmt_insert = mysqli_prepare($link, "INSERT INTO yoyaku (user_id, product, quantity, date) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt_insert, "iiis", $id, $cart_item['product_id'], $cart_item['quantity'], $datetime);
    mysqli_stmt_execute($stmt_insert);

    //結果表示
    $stmt_product = mysqli_prepare($link, "SELECT name, value FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt_product, "i", $cart_item['product_id']);
    mysqli_stmt_execute($stmt_product);
    $product = mysqli_fetch_array(mysqli_stmt_get_result($stmt_product));
    $sum = $product['value'] * $cart_item['quantity'];
    echo htmlspecialchars($product['name'])." ".$cart_item['quantity'] ."個 ". $sum ."円<br>";
    $total_sum = $total_sum + $sum;
  };

  // カートを空にする
  $stmt_del = mysqli_prepare($link, "DELETE FROM cart WHERE user_id = ?");
  mysqli_stmt_bind_param($stmt_del, "i", $id);
  mysqli_stmt_execute($stmt_del);
}else{
    header(" Location: " . $uri_root . "mypage/cart.php");
}

  echo <<<EOM
    <b>計<b>{$total_sum}円</b> 予約が完了しました。<br>
	</div>
</div>
</div>
</div>
EOM;
