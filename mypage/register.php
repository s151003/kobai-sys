<?php

require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];
$datetime = date("Y-m-d H:i:s");

$hash = password_hash("$password", PASSWORD_DEFAULT);

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$result = mysqli_query($link,"SELECT * FROM `member` WHERE `id` = '$id'");
	$row = mysqli_fetch_array($result);

	if(in_array($id,$row)){
		echo "使われてます";
	}else{
		$query = mysqli_query($link,"INSERT INTO member(id,password,time) VALUES('$id','$hash','$datetime')");
		if(!$query){
			echo "登録できませんでした";
		}else{
			echo "登録完了</br>";
			echo '<a href="login.php" target="_blank">ログインはこちら</a>';
		}
	}
}
