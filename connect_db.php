<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kobai";

$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
	require("head.php");
	output("データベース接続エラー");
	echo '<div class="container">';
	echo '<h1>データベース接続エラー</h1><hr>';
	echo '<div class="alert alert-warning" role="alert">';
	echo mysqli_errno($link).": ".mysqli_error($link);
	echo 'データベースへ接続する際にエラーが発生しました <b>connect_db.php</b></div></div>';
	exit;
}else{
	//MySQLで使う文字コードを設定
	mysqli_set_charset($link,"utf8");
	//PHPの時刻を日本時間へ設定
	date_default_timezone_set('Asia/Tokyo');
}
