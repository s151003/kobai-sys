<!DOCTYPE html>
<html lang = "ja">
<head>
<title>
</title>
</head>
<body>
<meta http-equiv="refresh" content="3;URL=./newres01.php">
<?php
require("../connect_db.php");

$sql = "delete from yoyaku";
if(!$res=mysql_query($sql)){
			echo "エラー";
			exit;
		}else{
			echo "トップページに戻ります。";
			exit;
		}
?>
</body>
</html>
