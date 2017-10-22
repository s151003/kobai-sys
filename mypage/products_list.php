<?php
	require("../connect_db.php");
	require("../head.php");
	output("商品ページ");
	$cat = $_GET['cat'];
	LoginVerify($_SESSION['sid']);
	DayLimit("4");
?>
	<!-- レイアウトが崩れないように画像の縦幅を固定 -->

	<style type="text/css">
	img {
	  max-height: 200px;
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
		$value = $row['value'];
		$img = "../imgs/".$row['id'].".jpg";
		//画像がなかったら$imgをダミー画像に
		if(!$get_contents = @file_get_contents($img)){
			$img = "../imgs/not_found.jpg";
		}
		ProductCard("$name","$comment","$id","$img","$value");

	}
  echo "</div>";
	echo "</div>";

function DayLimit($product_id){
		require("../connect_db.php");
		$result = mysqli_query($link,"SELECT day_limit FROM `products` WHERE `id` = '$product_id'");
		$row = mysqli_fetch_assoc($result);
		$day_limit = $row['day_limit'];

		$today = date("Y-m-d");
		$result = mysqli_query($link,"SELECT * FROM `yoyaku` WHERE `date` BETWEEN '$today 00:00:00' AND '$today 23:59:59' AND `product`= '$product_id'");
		while($row = mysqli_fetch_assoc($result)){
			$today_quantity = $today_quantity + $row['quantity'];
		}
		@$remaining = $day_limit - $today_quantity;
}

function ProductCard($name,$comment,$id,$img,$value){
		//当日の曜日番号
		$weekno = date('w');
		require("../connect_db.php");
		$result = mysqli_query($link,"SELECT id,name,value,dis_day,dis_value FROM products WHERE id = '$id'");
		$row = mysqli_fetch_array($result);
		if ($row[3] == $weekno) {
			$display = "</br><b>（本日".$row[4]."円引き！）</b>";
			$row[2] = $row[2]-$row[4];
			$value = "<font size=\"5\" color=\"#FF0000\">".$row[2]."</font>";
		} else {
			$display = "";
		};
	  echo <<<EOM
		<form action="cart.php?id=$id" method="post">
		<div class="col-md-4">
	  <div class="panel panel-primary">
	  <div class="panel-heading"><div style="float:left;">$name</div><div style="text-align:right;">本日残り *個</div></div>
	  <div class="panel-body">
	    <div class="thumbnail">
	      <img src="$img">
	    </div>
	    <h3>$name</h3>
	    <p>{$comment}{$display}</p>
	  </div>
	  <div class="panel-footer">
			<div style="float:left;"><font size="5"><b><span class="glyphicon glyphicon-yen aria-hidden="true"></span>$value</b></font></div>
			<div class="pull-right">
			<select name="{$id}" class="form-control" style="width: 65px">
			<optgroup>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="13">13</option>
			<optgroup>
			</select></div>
			<div style="text-align:right;">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 追加</button></p></font>
			</div></div>
		</div>
	  </div>
EOM;
	}
?>
