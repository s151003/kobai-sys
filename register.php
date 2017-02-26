<?php

require("connect_sql.php");

$id = $_POST['id'];
$password = $_POST['password'];

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$result = mysqli_query($link,"SELECT * FROM `member` WHERE `id` = '$id'");
	$row = mysqli_fetch_array($result);
	
	if(in_array($id,$row)){
		echo "使われてます";
	}else{
		$query = mysqli_query($link,"INSERT INTO member(id,password) VALUES('$id','$password')");
		if(!$query){
			echo "登録できませんでした";
		}else{
			echo "登録完了</br>";
			echo '<a href="login.php" target="_blank">ログインはこちら</a>';
		}
	}
}
