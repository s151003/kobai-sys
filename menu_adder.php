<?php
$product = $_POST['product'];
$value = $_POST['value'];

$link = mysql_connect('localhost','root','');
if(!$link){
	die('接続失敗'.mysql_error());
}

$sql = mysqli_query("INSERT INTO products(product,value) VALUES('$product','$value')");
if(!$sql){
	echo "データベース登録の際にエラー";
}else{
	echo "$product を$value 円で登録しました";
}