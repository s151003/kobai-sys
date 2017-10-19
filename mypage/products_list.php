<?php
	require("../connect_db.php");
	require("../head.php");
	output("商品ページ");
	$cat = $_GET['cat'];
	
	$query = mysqli_query($link,"SELECT * FROM `products` WHERE `category` = '$cat'");
	echo "<div class=\"container\">";
	echo "<div class=\"row\">";
    while ($row = mysqli_fetch_assoc($query)){
		$name = $row['name'];
		$comment = $row['comment'];
		$id = $row['id'];
		CategoryCard("$name","$comment","$id");
    }
      echo "</div>";
	  echo "</div>";
?>
