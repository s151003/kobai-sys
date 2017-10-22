<?php
require("../head.php");
output("カート");
require('../connect_db.php');
$userid = $_SESSION['sid'];

if(isset($_GET['id'])){
  $add = $_GET['id'].",".$_POST[$_GET['id']];
  $count = count($_SESSION['cart'][$userid]);
  $_SESSION['cart'][$userid][$count] = explode(',',$add);
}

?>
<div class="container">
<h2><?php echo $userid ?>さんのカート</h2><hr>
<table class="table table-condensed">
  <thead><th>#</th><th>商品</th><th>数量</th><th>価格</th><thead>
    <?php
    $total = 0;
    foreach($_SESSION['cart'][$userid] as $key => $value){
      $query = "SELECT * FROM products WHERE id = '$value[0]'";
      $result = mysqli_query($link,$query);
      $row = mysqli_fetch_array($result);
      $sum = $row['value'] * $value[1];
      echo "<tr><td>".$key."</td><td>".$row['name']."</td><td>".$value[1]."</td><td>".$sum."</td></tr>";
      $total = $total + $sum;
    }
    $key = $key + 1;
    echo <<<EOM
    </table>
    <div class="row">
    <hr>
        <h3>計 {$key} 点</h3>
        <div style="text-align:right;"><h2>{$total}円</h2></div>
    </div>
EOM;
?>
<?php

//カート全削除
if(@$_GET["del"] == 1){
  unset($_SESSION['cart']);
}
