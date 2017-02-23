<?php
$product = $_POST['product'];
$value = $_POST['value'];

require("yoyaku_connect.php");

$sql = mysqli_query($link,"INSERT INTO products (product,value) VALUES('$product',''$value')");
if(!$sql){
	echo "データベース登録の際にエラー";
}else{
	echo "$product を$value 円で登録しました";
}
