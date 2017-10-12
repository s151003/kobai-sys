<?php

require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];
$datetime = date("Y-m-d H:i:s");

$hash = password_hash("$password", PASSWORD_DEFAULT);

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$result = mysqli_query($link,"SELECT * FROM `member` WHERE `user_id` = '$id'");
	$row = mysqli_fetch_array($result);

	if(in_array($id,$row)){ //$rowの配列のなかに$idがあったら
		echo "そのIDは既に使われてます";
	}else{
		$query = mysqli_query($link,"INSERT INTO member(user_id,password,time) VALUES('$id','$hash','$datetime')");
		if(!$query){
			echo "データベースへ登録する際にエラーが発生したため登録できませんでした";
		}else{
			echo "登録完了</br>";
			echo '<a href="login.php" target="_blank">ログインはこちら</a>';
		}
	}
}
