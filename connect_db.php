<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "koubai";

$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
	echo "データベースへ接続する際にエラーが発生しました <b>connect_db.php</b>";
	exit;
}else{
	//MySQLで使う文字コードを設定
	mysql_set_charset('utf8');
}
