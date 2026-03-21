<?php
require("../head.php");
require('../connect_db.php');
output("カート");
LoginVerify($_SESSION['sid']);
$userid = $_SESSION['sid'];
$uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);

// ユーザの数値IDを取得
$stmt_member = mysqli_prepare($link, "SELECT id FROM member WHERE user_id = ?");
mysqli_stmt_bind_param($stmt_member, "s", $userid);
mysqli_stmt_execute($stmt_member);
$result_member = mysqli_stmt_get_result($stmt_member);
$member_row = mysqli_fetch_assoc($result_member);
$member_id = $member_row['id'];

// 前日以前のカートアイテムを削除（放置カートの掃除）
$today_start = date("Y-m-d") . ' 00:00:00';
$stmt_clean = mysqli_prepare($link, "DELETE FROM cart WHERE user_id = ? AND added_time < ?");
mysqli_stmt_bind_param($stmt_clean, "is", $member_id, $today_start);
mysqli_stmt_execute($stmt_clean);
?>
<form action="cart.php" method="post">
<div class="container">
<?php
if(isset($_POST['del'])){
  if($_POST['del'] == "all"){
    $stmt_del = mysqli_prepare($link, "DELETE FROM cart WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt_del, "i", $member_id);
    mysqli_stmt_execute($stmt_del);
    ?>
      <div class="panel panel-danger">
         <div class="panel-heading">
           カートの商品をすべて削除しました
         </div>
      </div>
    <?php
  }else{
    $cart_item_id = intval($_POST['del']);
    $stmt_del = mysqli_prepare($link, "DELETE FROM cart WHERE id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt_del, "ii", $cart_item_id, $member_id);
    mysqli_stmt_execute($stmt_del);
  }
}
if(isset($_POST['add'])){
  $product_id = intval($_POST['add']);
  $quantity = intval($_POST[$_POST['add']]);

  $today_date = date("Y-m-d");
  $today_start_add = $today_date . ' 00:00:00';
  $today_end_add = $today_date . ' 23:59:59';

  // 商品情報と一日制限を取得
  $stmt_limit = mysqli_prepare($link, "SELECT day_limit, name FROM products WHERE id = ?");
  mysqli_stmt_bind_param($stmt_limit, "i", $product_id);
  mysqli_stmt_execute($stmt_limit);
  $result_limit = mysqli_stmt_get_result($stmt_limit);
  $row_limit = mysqli_fetch_assoc($result_limit);
  $day_limit = $row_limit['day_limit'];
  $product_name = $row_limit['name'];

  // 本日の確定済み予約数
  $stmt_reserved = mysqli_prepare($link, "SELECT COALESCE(SUM(quantity), 0) as total FROM yoyaku WHERE date BETWEEN ? AND ? AND product = ?");
  mysqli_stmt_bind_param($stmt_reserved, "ssi", $today_start_add, $today_end_add, $product_id);
  mysqli_stmt_execute($stmt_reserved);
  $row_reserved = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_reserved));
  $today_reserved = $row_reserved['total'];

  // 本日のカート内数量（全ユーザ）
  $stmt_in_cart = mysqli_prepare($link, "SELECT COALESCE(SUM(quantity), 0) as total FROM cart WHERE added_time BETWEEN ? AND ? AND product_id = ?");
  mysqli_stmt_bind_param($stmt_in_cart, "ssi", $today_start_add, $today_end_add, $product_id);
  mysqli_stmt_execute($stmt_in_cart);
  $row_in_cart = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_in_cart));
  $today_in_cart = $row_in_cart['total'];

  $remaining = max(0, $day_limit - $today_reserved - $today_in_cart);

  if ($quantity <= 0 || $quantity > $remaining) {
    ?>
    <div class="panel panel-danger">
       <div class="panel-heading">
         在庫が不足しています
       </div>
       <div class="panel-body">
         <?php echo htmlspecialchars($product_name); ?>の残り数量は<?php echo max(0, $remaining); ?>個です。カートに追加できませんでした。<br>引き続き商品を選ぶ場合は<a href="../mypage">こちら</a>
       </div>
    </div>
    <?php
  } else {
    $datetime = date("Y-m-d H:i:s");
    $stmt_insert = mysqli_prepare($link, "INSERT INTO cart (user_id, product_id, quantity, added_time) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt_insert, "iiis", $member_id, $product_id, $quantity, $datetime);
    mysqli_stmt_execute($stmt_insert);
    ?>
    <div class="panel panel-default">
       <div class="panel-heading">
         カートに追加しました
       </div>
       <div class="panel-body">
         <?php echo htmlspecialchars($product_name); ?>を追加しました。<br>引き続き商品を選ぶ場合は<a href="../mypage">こちら</a>
       </div>
    </div>
    <?php
  }
}
?>
<h2><?php echo htmlspecialchars($userid) ?>さんのカート</h2><hr>
<table class="table table-condensed">
  <thead><th>#</th><th>商品</th><th>数量</th><th>価格</th><th>割引適用</th><th>削除</th><thead>
    <?php
    $stmt_cart = mysqli_prepare($link, "SELECT c.id, c.product_id, c.quantity FROM cart c WHERE c.user_id = ? ORDER BY c.id");
    mysqli_stmt_bind_param($stmt_cart, "i", $member_id);
    mysqli_stmt_execute($stmt_cart);
    $result_cart = mysqli_stmt_get_result($stmt_cart);
    $cart_items = mysqli_fetch_all($result_cart, MYSQLI_ASSOC);
    $query_count = count($cart_items);

    if($query_count > 0){
      $total = 0;
      $weekno = date('w');
      foreach($cart_items as $cart_item){
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];
        $cart_id = $cart_item['id'];

        $stmt_product = mysqli_prepare($link, "SELECT * FROM products WHERE id = ?");
        mysqli_stmt_bind_param($stmt_product, "i", $product_id);
        mysqli_stmt_execute($stmt_product);
        $result_product = mysqli_stmt_get_result($stmt_product);
        $row = mysqli_fetch_array($result_product);

        //割引判定
        if ($row['dis_day'] == $weekno) {
          $discount = 1;
          $item_price = $row['value'] - $row['dis_value'];
          $sum = "<font color=\"red\">".($item_price * $quantity)."<font>";
        } else {
          $discount = 0;
          $item_price = $row['value'];
          $sum = $item_price * $quantity;
        }
        $total = $total + ($item_price * $quantity);

        echo "<tr><td>".$cart_id."</td><td>".$row['name']."</td><td>".$quantity."</td><td>".$sum."</td><td>".$discount."</td>";
        echo "<td><button class=\"btn btn-danger btn-sm\" type=\"submit\" name=\"del\" value=\"".$cart_id."\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
   削除する</button></td>";
        echo "</tr>";
      }
      echo <<<EOM
      </table>
      <div class="row">
      <div class="col-md-12">
      <div align="right"><button class="btn btn-danger btn-xs" type="submit" name="del" value="all"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
 商品をすべて削除する</button></div>

      <hr>
          <h3>計 {$query_count} 点</h3>
          <div style="text-align:right;"><h2>{$total}円</h2></div>
          <br>
EOM;
      echo "<a class=\"btn btn-info btn-lg btn-block\" href=\"" . $uri_root ."mypage/checkout.php\"><span class=\"glyphicon glyphicon-send\" aria-hidden=\"true\"></span> 予約確定！</a>";
      echo "</div>";
      echo "</div>";
    }else{
      echo "</table>";
      echo "<center><h3>カートは空です</h3></center>";
    }
