<?php
	require("../connect_db.php");
	require("../head.php");
	output("商品ページ");
	$cat = $_GET['cat'];
?>
	<!-- レイアウトが崩れないように画像の縦幅を固定 -->
	<style type="text/css">
	img {
	  max-height: 250px;
	}
	</style>
<?php
	$query = mysqli_query($link,"SELECT * FROM `products` WHERE `category` = '$cat'");
	echo "<div class=\"container\">";
	echo "<div class=\"row\">";
  while ($row = mysqli_fetch_assoc($query)){
		$name = $row['name'];
		$comment = $row['comment'];
		$id = $row['id'];
		$img = "../imgs/".$row['id'].".jpg";
		//画像がなかったら$imgをダミー画像に
		if(!$get_contents = @file_get_contents($img)){
			$img = "../imgs/not_found.jpg";
		}
		ProductCard("$name","$comment","$id","$img");
	}
  echo "</div>";
	echo "</div>";
