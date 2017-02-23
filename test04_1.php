<!DOCTYPE html>
<html>
<head>
	<title>予約完了</title>
	<meta charset="utf-8">
</head>
<body>
<p>予約完了</p>
	<?php
	session_start();
	$sid = $_SESSION['sid'];
	$syohin1 = $_POST['syohin1'];
	$syohin2 = $_POST['syohin2'];
	echo "$sid さん\n";
	if ($syohin1 == $syohin2) {
		echo "$syohin1 ２個を予約";
		echo '<meta http-equiv="refresh"content="2;URL=login.php">';
		} else {
		echo "$syohin1 $syohin2 を予約";
		echo '<meta http-equiv="refresh"content="2;URL=login.php">';
	}

	?>
 
</body>
</html>

