<!DOCTYPE html>
<html>
<head>
	<title>予約確認</title>
	<meta charset=utf-8>
</head>
<body>
<p>内容を確認してください</p>
	<?php
	require("../connect_db.php");
	session_start();
	$sid = $_SESSION['sid'];
	$syohin1 = $_POST['syohin1'];
	$syohin2 = $_POST['syohin2'];
	$time = date('Y/m/d H:i:s');

	echo "$sid さん";

	if ($result = mysqli_query($link,"SELECT ID FROM koubai.yoyaku ORDER BY ID")){
		$row_cnt = mysqli_num_rows($result);
		$row_cnt = $row_cnt + 1;
	}else{
		echo "クエリーの実行時にエラーが発生しました\n";
		printf (mysqli_error($link));
	};

	if($syohin1 == 1 && $syohin2 == 1){
	echo "商品を選択してください";
	echo '<br><a href="mypage.php"><input type="button" value="戻る" href="mypage.php">';
	}else{
		if ($syohin1 == $syohin2) {
//レコードの数を数える


			mysqli_query($link,"INSERT INTO yoyaku(ID,Time,product,user_id) VALUES('$row_cnt','$time','$syohin1,$syohin1','$sid')");
			echo "$syohin1 ２個を予約";
		} else {
			mysqli_query($link,"INSERT INTO yoyaku(ID,Time,product,user_id) VALUES('$row_cnt','$time','$syohin1,$syohin2','$sid')");
			echo "$syohin1 $syohin2 を予約";
		}

	?>
	<form action="done.php" method="post">
	<a href="mypage.php"><input type="button" value="戻る" noClick="test03.php" href="mypage.php">
	</a>
	<input type="hidden" name="bango" value="<?php echo $bango ?>">
	<input type="hidden" name="syohin1" value="<?php echo $syohin1 ?>">
	<input type="hidden" name="syohin2" value="<?php echo $syohin2 ?>">
	<input type="submit" value="予約する">
	</form>
	<?php
	}
	?>


</body>
</html>
