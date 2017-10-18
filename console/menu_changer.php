<?php
require("../connect_db.php");
require("../head.php");
output("メニュー管理");
if (isset($_POST['del'])){
  $id = $_POST['del'];
  echo $id;
  $query = "DELETE FROM products WHERE id='$id'";
  mysqli_query($link,"$query");
}else{
	$id = $_POST['id'];
	mysqli_query($link,"UPDATE products SET name="$_POST['products'.$id]",value="$_POST['value'.$id]",category = "$_POST['category'.$id]",dis_value = "$_POST['dis_value'.$id]",);
}