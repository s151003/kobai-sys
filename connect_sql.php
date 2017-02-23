<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "kobai";


$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
	echo "dbconnect error";
}
