<!DOCTYPE html>
<html>
<head>
	<title>予約確認</title>
	<meta charset="utf-8">
</head>
<body>
<p>内容を確認してください</p>
	<?php

	$bango = $_POST["bango"];
	$syohin1 = $_POST['syohin1'];
	$syohin2 = $_POST['syohin2'];
	echo $bango."さん";
	if($syohin1 == 1 && $syohin2 == 1){
	echo "商品を選択してください";
	}else{
		if ($syohin1 == $syohin2) {
			echo "$syohin1 ２個を予約";
		} else {
			echo "$syohin1 $syohin2 を予約";
		}
		
	?>
	<form action="test04_1.php" method="post">   
	<a href="sample03.html"><input type="button" value="戻る" noClick="test03.php" href="sample03.html">
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

