<?php
require("../head.php");
output("カート");
require('../connect_db.php');
$userid = $_SESSION['sid'];

if(isset($_GET['id'])){
  $add = $_GET['id'].",".$_POST[$_GET['id']];
  echo $add;
  $count = count($_SESSION['cart'][$userid]);
  $_SESSION['cart'][$userid][$count] = explode(',',$add);
}
?>
<div
<h1><?php echo $userid ?>さんのカート</h1><hr>
<table class="table table-condensed">
  <thead><th>#</th><th>商品</th><th>数量</th><thead>
    <?php
    foreach($_SESSION['cart'][$userid] as $key => $value){
      echo "<tr><td>".$key."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
    }
    ?>
</table>

<?php

//カート全削除
if(@$_GET["del"] == 1){
  unset($_SESSION['cart']);
}
