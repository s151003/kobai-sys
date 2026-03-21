<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("メニュー管理");

if (isset($_POST['del'])){
  $id = $_POST['del'];
  $stmt = mysqli_prepare($link, "DELETE FROM products WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  echo <<<EOM
  <div class="container">
    <div class="panel panel-danger">
    	<div class="panel-heading">
    		商品削除完了
    	</div>
    	<div class="panel-body">
    		商品No.{$id}の削除が完了しました
    	</div>
    </div>
  </div>
EOM;
}
if (isset($_POST['id'])){
  $id = $_POST['id'];
  $name = $_POST['product'.$id];
  $value = $_POST['value'.$id];
  $category = $_POST['category'.$id];
  $dis_day = $_POST['dis_day'.$id];
  $dis_value = $_POST['dis_value'.$id];
  $day_limit = $_POST['day_limit'.$id];
  $comment = $_POST['comment'.$id];
  $stmt2 = mysqli_prepare($link, "UPDATE products SET name=?,value=?,category=?,dis_day=?,dis_value=?,day_limit=?,comment=? WHERE id=?");
  mysqli_stmt_bind_param($stmt2, "siiiiisi", $name, $value, $category, $dis_day, $dis_value, $day_limit, $comment, $id);
  mysqli_stmt_execute($stmt2);
  echo <<<EOM
  <div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
        更新
      </div>
      <div class="panel-body">
  $id
  $name
  $value
  $category
  $dis_day
  $dis_value
  $day_limit
  $comment
  </div>
</div>
</div>
EOM;
}
?>
