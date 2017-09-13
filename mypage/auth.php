<?php
require("../connect_sql.php");

$id = $_POST['id'];
$password = $_POST['password'];


if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$result = mysqli_query($link,"SELECT * FROM `member` WHERE `id` = '$id'");
	$row = mysqli_fetch_array($result);
		if($row[0] == "" || $row[1] == ""){
		echo "そのようなIDは存在しません。まず登録してください";
	}else{
		if($row[1] == "$password"){
			//loginへ
			session_start();
			$_SESSION['sid'] = "$id";
			header( "Location: mypage.php" );
		}else{
			echo "IDかPWが間違いです";
		}
	}
}
