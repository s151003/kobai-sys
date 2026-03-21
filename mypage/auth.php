<?php
require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$stmt = mysqli_prepare($link, "SELECT * FROM `member` WHERE `user_id` = ?");
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	$hash = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($hash);
		if($row[1] == "" || $row[2] == ""){
		echo "IDかPWが間違いです";
	}else{
		if(password_verify($password, $row[2])){
			//loginへ
			session_start();
			$_SESSION['sid'] = "$id";
			$datetime = date("Y-m-d H:i:s");
			$ip = getenv("REMOTE_ADDR");
			$host = getenv("REMOTE_HOST");
			$referer = getenv("HTTP_REFERER");
			if($referer == "")
			{
				$referer = "(not_found)";
			}

			$stmt2 = mysqli_prepare($link, "INSERT INTO accesslog (user_id, time, ip, host, referer) VALUES (?, ?, ?, ?, ?)");
			mysqli_stmt_bind_param($stmt2, "sssss", $id, $datetime, $ip, $host, $referer);
			mysqli_stmt_execute($stmt2);

			header( "Location: ./" );
		}else{
			echo "IDかPWが間違いです";
		}
	}
}
