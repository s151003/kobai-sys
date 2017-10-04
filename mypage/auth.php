<?php
require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$hash = mysqli_query($link,"SELECT * FROM `member` WHERE `id` = '$id'");
	$row = mysqli_fetch_array($hash);
		if($row[0] == "" || $row[1] == ""){
		echo "そのようなIDは存在しません。まず登録してください";
	}else{
		if(password_verify($password, $row[1])){
			//loginへ
			session_start();
			$_SESSION['sid'] = "$id";
			header( "Location: mypage.php" );
		}else{
			echo "IDかPWが間違いです";
		}
	}
}
