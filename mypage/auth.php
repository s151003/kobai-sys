<?php
require("../connect_db.php");

$id = $_POST['id'];
$password = $_POST['password'];

if($id == "" || $password == ""){
	print "IDかパスワードが空です";
}else{
	$hash = mysqli_query($link,"SELECT * FROM `member` WHERE `user_id` = '$id'");
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

			$query = "INSERT INTO accesslog (user_id, time, ip, host, referer) VALUES ('$id', '$datetime', '$ip','$host', '$referer')";
			$result = mysqli_query($link,$query);

			header( "Location: ./" );
		}else{
			echo "IDかPWが間違いです";
		}
	}
}
