<?php
$link = mysqli_connect("localhost", "root", "", "kobai");
if(!$link){
	$sqlconect = "Mysqlへの接続に失敗";
}else{
	$sqlconect = "connected</br></br>";
}
