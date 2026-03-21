<?php
require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];
$datetime = date("Y-m-d H:i:s");

$hash = password_hash("$password", PASSWORD_DEFAULT);

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$stmt = mysqli_prepare($link, "SELECT * FROM `member` WHERE `user_id` = ?");
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);

	if(@in_array($id,$row)){ //$rowの配列のなかに$idがあったら
		echo "そのIDは既に使われてます<br />";
        echo '<a href="login.php" target="_blank">ログインはこちら</a>';
	}else{
		$stmt2 = mysqli_prepare($link, "INSERT INTO member(user_id,password,time) VALUES(?,?,?)");
		mysqli_stmt_bind_param($stmt2, "sss", $id, $hash, $datetime);
		$query = mysqli_stmt_execute($stmt2);
		if(!$query){
			echo "データベースへ登録する際にエラーが発生したため登録できませんでした";
		}else{
			echo "登録完了<br />";
			echo '<a href="login.php" target="_blank">ログインはこちら</a>';
		}
	}
}
