<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "koubai";

$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
	echo "データベースへ接続する際にエラーが発生しました";
	exit;
}else{
	mysqli_query($link,"set names utf8");
}
