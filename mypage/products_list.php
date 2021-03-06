<?php
	require("../connect_db.php");
	require("../head.php");
	output("商品ページ");
	$cat = $_GET['cat'];
	LoginVerify($_SESSION['sid']);

?>
	<!-- レイアウトが崩れないように画像の縦幅を固定 -->

	<style type="text/css">
	img {
	  max-height: 200px;
	}
	</style>
<?php
	$result = mysqli_query($link,"SELECT * FROM `products` WHERE `category` = '$cat'");
	echo "<div class=\"container\">";
	echo "<div class=\"row\">";
	if (isset($result)){
	  while ($row = mysqli_fetch_assoc($result)){
			$name = $row['name'];
			$comment = $row['comment'];
			$id = $row['id'];
			$value = $row['value'];
			//画像がなかったら$imgをNot found画像に
			if($get_contents = @file_get_contents("../imgs/".$row['id'].".jpg")){
				$img = "../imgs/".$row['id'].".jpg";
			}elseif($get_contents = @file_get_contents("../imgs/".$row['id'].".png")){
				$img = "../imgs/".$row['id'].".png";
			}elseif($get_contents = @file_get_contents("../imgs/".$row['id'].".gif")){
				$img = "../imgs/".$row['id'].".gif";
			}else{
				$img = "../imgs/not_found.jpg";
			}
			ProductCard("$name","$comment","$id","$img","$value");
		}
	}else{
		echo "a";
	}
  echo "</div>";
	echo "</div>";

function DayLimit($product_id){
		require("../connect_db.php");

		//商品の一日制限個数取得
		$result = mysqli_query($link,"SELECT day_limit FROM `products` WHERE `id` = '$product_id'");
		$row = mysqli_fetch_assoc($result);
		$day_limit = $row['day_limit'];
		//
		$today = date("Y-m-d");
		$result = mysqli_query($link,"SELECT * FROM `yoyaku` WHERE `date` BETWEEN '$today 00:00:00' AND '$today 23:59:59' AND `product`= $product_id");
		$today_quantity = 0;
		while($row = mysqli_fetch_assoc($result)){
			$today_quantity = $today_quantity + $row['quantity'];
		}
		$remaining = $day_limit - $today_quantity;
		return $remaining;
}

function ProductCard($name,$comment,$id,$img,$value){
		//当日の曜日番号
		$weekno = date('w');
		require("../connect_db.php");
		$result = mysqli_query($link,"SELECT id,name,value,dis_day,dis_value FROM products WHERE id = '$id'");
		$row = mysqli_fetch_array($result);
		if ($row[3] == $weekno) {
			$display = "<br><b>（本日".$row[4]."円引き！）</b>";
			$row[2] = $row[2]-$row[4];
			$value = "<font size=\"5\" color=\"#FF0000\">".$row[2]."</font>";
		} else {
			$display = "";
		};

		$daylimit = DayLimit($id);
	  echo <<<EOM
		<form action="cart.php" method="post">
		<div class="col-md-4">
	  <div class="panel panel-primary">
	  <div class="panel-heading"><div style="float:left;">$name</div><div style="text-align:right;">本日残り {$daylimit}個</div></div>
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
EOM;
			if(!$daylimit==0){
				if($daylimit<5){
					for($i=1; $i<=$daylimit; $i++){
						echo "<option value=\"".$i."\">".$i."</option>";
					}
				}else{
					for($i=1; $i<=5; $i++){
						echo "<option value=\"".$i."\">".$i."</option>";
					}
				}
				echo <<<EOM
				<optgroup>
				</select></div>
				<div style="text-align:right;">
				<button type="submit" name="add" value="{$id}" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 追加</button></p></font>
				</div>
EOM;
			}else{
				echo <<<EOM
				<optgroup>
				</select></div>
				<div style="text-align:right;">
				<button type="button" name="add" disabled="disabled" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 売切</button></p>
				</div>
EOM;
			}

			echo <<<EOM

			</div>
		</div>
	  </div>
EOM;
	}
?>
