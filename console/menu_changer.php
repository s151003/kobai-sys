<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("メニュー管理");

if (isset($_POST['del'])){
  $id = $_POST['del'];
  $query = "DELETE FROM products WHERE id='$id'";
  mysqli_query($link,"$query");

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
  mysqli_query($link,"UPDATE products SET name='$name',value='$value',category='$category',dis_day='$dis_day',dis_value='$dis_value',day_limit='$day_limit',comment='$comment' WHERE id='$id'");
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
