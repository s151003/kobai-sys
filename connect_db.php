<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "koubai";

$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
	echo "dbconnect error";
}else{
	mysqli_query($link,"set names utf8");
}
