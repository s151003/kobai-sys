<?php
$hostname = "172.16.21.146";
$username = "root";
$password = "114514";
$dbname = "koubai";

$link = mysqli_connect($hostname, $username, $password, $dbname);

if(!$link){
echo "no";
echo mysql_errno().":".mysqli_error()."<BR>";
echo mysqli_errono($link);
}else{
echo "ok";
}
